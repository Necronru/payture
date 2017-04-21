<?php

use GuzzleHttp\Client;
use Necronru\Payture\EWallet\EWallet;
use Necronru\Payture\EWallet\Payment\Command\InitCommand;
use Necronru\Payture\EWallet\Payment\Enum\SessionType;
use Necronru\Payture\EWallet\Payment\Response\InitResponse;

class PaymentTest extends \Codeception\Test\Unit
{
    /**
     * @var EWallet
     */
    private $service;

    protected function _before()
    {
        $this->service = new EWallet(new Client(['base_uri' => $_ENV['PAYTURE_API']]), $_ENV['PAYTURE_TERMINAL_ID'], $_ENV['PAYTURE_TERMINAL_PASSWORD']);
    }

    /**
     * @group pay
     * @return mixed|InitResponse
     */
    public function testInit()
    {
        $response = $this->service->payment()->init(new InitCommand(
            SessionType::PAY,
            $_ENV['PAYTURE_CALLBACK_URL'],
            '98.132.229.220',
            '123@ya.ru',
            '2645363',
            uniqid('test_'),
            500,
            '79001234567'
        ));

        static::assertEquals('True', $response->Success);
        static::assertEmpty($response->ErrCode);

        static::assertNotEmpty($response->SessionId);
        static::assertNotEmpty($response->Amount);
        static::assertNotEmpty($response->OrderId);

//        dump($response);
    }
}