<?php


namespace Necronru\Payture\EWallet;


use GuzzleHttp\ClientInterface;
use Necronru\Payture\Abstraction\EWalletInterface;
use Necronru\Payture\Enum\ErrorCode;
use Necronru\Payture\EWallet\Command\InitCommand;
use Necronru\Payture\EWallet\Command\PayCommand;
use Necronru\Payture\EWallet\Command\PayStatusCommand;
use Necronru\Payture\EWallet\Command\RefundCommand;
use Necronru\Payture\EWallet\Exception\EWalletError;
use Necronru\Payture\EWallet\Exception\EWalletException;
use Necronru\Payture\EWallet\Response\GetCardList\GetList;
use Necronru\Payture\EWallet\Response\GetCardList\Item;
use Necronru\Payture\EWallet\Response\InitResponse;
use Necronru\Payture\EWallet\Response\PayStatusResponse;
use Necronru\Payture\EWallet\Response\RefundResponse;
use Symfony\Component\PropertyAccess\PropertyAccess;

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
        $response = $this->client->request('POST', '/vwapi/Init', [
            'form_params' => $this->prepareFormData(get_object_vars($command))
        ]);

        $contents = $response->getBody()->getContents();

        $accessor = PropertyAccess::createPropertyAccessor();
        $data     = json_decode(json_encode((array) simplexml_load_string($contents)), 1);

        $status = strtolower($accessor->getValue($data, '[@attributes][Success]'));

        if ('true' === $status) {

            $object = new InitResponse();
            $attributes = $accessor->getValue($data, '[@attributes]');

            foreach ($attributes as $key => $value) {
                $object->{$key} = $value;
            }

            return $object;
        }

        $errCode = $accessor->getValue($data, '[@attributes][ErrCode]');

        if ('false' === $status) {
            throw new EWalletError(ErrorCode::getTitle($errCode));
        }

        throw new EWalletException(sprintf('Неизвестный статус в ответе: "%s"', $errCode));
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
        $response = $this->client->request('POST', '/vwapi/PayStatus', [
            'form_params' => $this->prepareFormData(get_object_vars($command))
        ]);

        $contents = $response->getBody()->getContents();

        $accessor = PropertyAccess::createPropertyAccessor();
        $data     = json_decode(json_encode((array) simplexml_load_string($contents)), 1);

        $status = strtolower($accessor->getValue($data, '[@attributes][Success]'));

        if ('true' === $status) {

            $object = new PayStatusResponse();
            $attributes = $accessor->getValue($data, '[@attributes]');

            foreach ($attributes as $key => $value) {
                $object->{$key} = $value;
            }

            return $object;
        }

        $errCode = $accessor->getValue($data, '[@attributes][ErrCode]');

        if ('false' === $status) {
            throw new EWalletError(ErrorCode::getTitle($errCode));
        }

        throw new EWalletException(sprintf('Неизвестный статус в ответе: "%s"', $errCode));
    }

    /**
     * @inheritdoc
     */
    public function refund(RefundCommand $command)
    {
        $response = $this->client->request('POST', '/vwapi/Refund', [
            'form_params' => $this->prepareFormData(
                array_merge(['Password' => $this->vmPassword], get_object_vars($command))
            )
        ]);

        $contents = $response->getBody()->getContents();

        $accessor = PropertyAccess::createPropertyAccessor();
        $data     = json_decode(json_encode((array) simplexml_load_string($contents)), 1);

        $status = strtolower($accessor->getValue($data, '[@attributes][Success]'));

        if ('true' === $status) {

            $object = new RefundResponse();
            $attributes = $accessor->getValue($data, '[@attributes]');

            foreach ($attributes as $key => $value) {
                $object->{$key} = $value;
            }

            return $object;
        }

        $errCode = $accessor->getValue($data, '[@attributes][ErrCode]');

        if ('false' === $status) {
            throw new EWalletError(ErrorCode::getTitle($errCode));
        }

        throw new EWalletException(sprintf('Неизвестный статус в ответе: "%s"', $errCode));
    }

    /**
     * @inheritdoc
     */
    public function getCartList($VWUserLgn, $VWUserPsw)
    {
        $response = $this->client->request('POST', '/vwapi/GetList', [
            'form_params' => $this->prepareFormData([
                'VWUserLgn' => $VWUserLgn,
                'VWUserPsw' => $VWUserPsw
            ])
        ]);

        $contents = $response->getBody()->getContents();

        $accessor = PropertyAccess::createPropertyAccessor();
        $data     = json_decode(json_encode((array) simplexml_load_string($contents)), 1);

        $status = strtolower($accessor->getValue($data, '[@attributes][Success]'));

        if ('true' === $status) {

            $object = new GetList();
            $attributes = $accessor->getValue($data, '[@attributes]');

            foreach ($attributes as $key => $value) {
                $object->{$key} = $value;
            }

            $object->Item = array_map(function($arr) use ($accessor) {

                $item = new Item();

                foreach ($accessor->getValue($arr, '[@attributes]') as $key => $value) {
                    $item->{$key} = $value;
                }

                return $item;

            }, (array) $accessor->getValue($data, '[Item]'));

            return $object;
        }

        $errCode = $accessor->getValue($data, '[@attributes][ErrCode]');

        if ('false' === $status) {
            throw new EWalletError(ErrorCode::getTitle($errCode));
        }

        throw new EWalletException(sprintf('Неизвестный статус в ответе: "%s"', $errCode));
    }

    protected function prepareFormData($data)
    {
        return [
            'VWID' => $this->getVmId(),
            'DATA' => http_build_query($data, null, ';')
        ];
    }

    /**
     * @return string
     */
    protected function getVmId()
    {
        return $this->vmId;
    }
}