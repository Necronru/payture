<?php

use GuzzleHttp\Client;
use Necronru\Payture\EWallet\EWallet;
use Necronru\Payture\EWallet\Payment\Command\InitCommand;
use Necronru\Payture\EWallet\Payment\Enum\SessionType;
use Necronru\Payture\EWallet\Payment\Response\InitResponse;

class PaymentTest extends \Codeception\Test\Unit
{
    /**
     * @group pay
     * @return mixed|InitResponse
     */
    public function testInit()
    {
        $eWallet = new EWallet(new Client(['base_uri' => 'https://sandbox2.payture.com/']), 'Merchant', '123');

        $response = $eWallet->payment()->init(new InitCommand(
            SessionType::PAY,
            'http://localhost:8000?order={orderid}&success={success}',
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