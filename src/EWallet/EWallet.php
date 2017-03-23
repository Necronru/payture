<?php


namespace Necronru\Payture\EWallet;


use GuzzleHttp\ClientInterface;
use Necronru\Payture\Abstraction\EWalletInterface;
use Necronru\Payture\Enum\ErrorCode;
use Necronru\Payture\EWallet\Command\GetCardListCommand;
use Necronru\Payture\EWallet\Command\InitCommand;
use Necronru\Payture\EWallet\Command\PayCommand;
use Necronru\Payture\EWallet\Command\PayStatusCommand;
use Necronru\Payture\EWallet\Command\RefundCommand;
use Necronru\Payture\EWallet\Exception\EWalletError;
use Necronru\Payture\EWallet\Exception\EWalletException;
use Necronru\Payture\EWallet\Response\GetCardList\Item;
use Necronru\Payture\EWallet\Response\InitResponse;
use Necronru\Payture\EWallet\Response\PayStatusResponse;
use Necronru\Payture\EWallet\Response\RefundResponse;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class EWallet implements EWalletInterface
{
    /**
     * Идентификатор Продавца. Выдается Продавцу с параметрами тестового/боевого доступа
     *
     * @var string
     */
    private $vmId;

    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * Пароль ТСП для проведения операций через API. Выдается с параметрами тестового/боевого доступа
     *
     * @var string
     */
    private $vmPassword;

    /**
     * EWallet constructor.
     * @param ClientInterface $client
     * @param string $vmId
     * @param string $vmPassword
     */
    public function __construct(ClientInterface $client, $vmId, $vmPassword)
    {
        $this->vmId = $vmId;
        $this->client = $client;
        $this->vmPassword = $vmPassword;
    }

    /**
     * @inheritdoc
     */
    public function init(InitCommand $command)
    {
        return $this->executeCommand($command, InitResponse::class, '/vwapi/Init');
    }

    /**
     * @inheritdoc
     */
    public function pay(PayCommand $command)
    {
        return $this->client->getConfig('base_uri') . 'vwapi/Pay' . '?' . http_build_query($command);
    }

    /**
     * @inheritdoc
     */
    public function payStatus(PayStatusCommand $command)
    {
        return $this->executeCommand($command, PayStatusResponse::class, '/vwapi/PayStatus');
    }

    /**
     * @inheritdoc
     */
    public function refund(RefundCommand $command)
    {
        return $this->executeCommand($command, RefundResponse::class, '/vwapi/Refund', function($data) {
            return array_merge(['Password' => $this->vmPassword], $data);
        });
    }

    /**
     * @inheritdoc
     */
    public function cartList(GetCardListCommand $command)
    {
        return $this->executeCommand($command, RefundResponse::class, '/vwapi/GetList', null, function ($object, $data, PropertyAccessor $accessor) {
            $object->Item = array_map(function ($arr) use ($accessor) {

                $item = new Item();

                foreach ($accessor->getValue($arr, '[@attributes]') as $key => $value) {
                    $item->{$key} = $value;
                }

                return $item;

            }, (array)$accessor->getValue($data, '[Item]'));

            return $object;
        });
    }

    protected function prepareFormData($data, callable $fn = null)
    {
        if (is_callable($fn)) {
            $data = $fn($data);
        }

        return [
            'VWID' => $this->getVmId(),
            'DATA' => http_build_query($data, null, ';')
        ];
    }

    /**
     * @return string
     */
    public function getVmId()
    {
        return $this->vmId;
    }

    protected function executeCommand($command, $responseClass, $uri, callable $prepareFormDataCallback = null, callable $responseCallback = null)
    {
        $data = get_object_vars($command);

        $response = $this->client->request('POST', $uri, [
            'form_params' => $this->prepareFormData($data, $prepareFormDataCallback)
        ]);

        return $this->prepareResponse($response, $responseClass, $responseCallback);
    }


    private function prepareResponse(ResponseInterface $response, $responseClass, callable $fn = null)
    {
        $contents = $response->getBody()->getContents();

        $accessor = PropertyAccess::createPropertyAccessor();
        $data = json_decode(json_encode((array)simplexml_load_string($contents)), 1);

        $Success = strtolower($accessor->getValue($data, '[@attributes][Success]'));
        $ErrCode = $accessor->getValue($data, '[@attributes][ErrCode]');

        if ('true' === $Success) {

            $object = new $responseClass();
            $attributes = $accessor->getValue($data, '[@attributes]');

            foreach ($attributes as $key => $value) {
                $object->{$key} = $value;
            }

            if (is_callable($fn)) {
                $fn($object, $data, $accessor);
            }

            return $object;
        }

        if (!empty($ErrCode) && array_key_exists($ErrCode, ErrorCode::$codes)) {
            throw new EWalletError(ErrorCode::getTitle($ErrCode), ErrorCode::$codes[$ErrCode]);
        }

        throw new EWalletException(sprintf('Неизвестный статус в ответе: "%s"', $ErrCode));
    }
}