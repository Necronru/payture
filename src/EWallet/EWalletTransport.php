<?php


namespace Necronru\Payture\EWallet;


use GuzzleHttp\ClientInterface;
use Necronru\Payture\Enum\ErrorCode;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class EWalletTransport
{
    private $_client;

    /**
     * Идентификатор Продавца. Выдается Продавцу с параметрами тестового/боевого доступа
     *
     * @var string
     */
    private $_vmId;

    /**
     * Пароль ТСП для проведения операций через API. Выдается с параметрами тестового/боевого доступа
     *
     * @var string
     */
    private $_vmPassword;

    public function __construct(ClientInterface $client, $vmId, $vmPassword)
    {
        $this->_client = $client;

        $this->_vmId = $vmId;
        $this->_vmPassword = $vmPassword;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * @return mixed
     */
    public function getVmPassword()
    {
        return $this->_vmPassword;
    }

    /**
     * @return string
     */
    public function getVmId()
    {
        return $this->_vmId;
    }

    public function executeCommand($command, $responseClass, $uri, callable $prepareFormDataCallback = null, callable $responseCallback = null)
    {
        $formData = $this->prepareFormData(get_object_vars($command), $prepareFormDataCallback);

        $response = $this->_client->request('POST', $uri, [
            'form_params' => $formData
        ]);

        return $this->prepareResponse($response, $responseClass, $responseCallback);
    }

    protected function prepareFormData($data, callable $fn = null)
    {

        $formData = [
            'VWID' => $this->getVmId()
        ];

        if (is_callable($fn)) {
            $formData = $fn($data, $formData);
        } else {
            $formData['DATA'] = http_build_query($data, null, ';');
        }

        return $formData;
    }

    protected function prepareResponse(ResponseInterface $response, $responseClass, callable $fn = null)
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