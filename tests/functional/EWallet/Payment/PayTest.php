<?php

use Necronru\Payture\Enum\TransactionStatus;
use Necronru\Payture\EWallet\Payment\Command\InitCommand;
use Necronru\Payture\EWallet\Payment\Command\RefundCommand;
use Necronru\Payture\EWallet\Payment\Enum\SessionType;
use Necronru\Payture\EWallet\Payment\Response\InitResponse;
use Necronru\Payture\EWallet\Payment\Response\PayStatusResponse;

class PayTest extends AbstractPaymentTest
{
    /**
     * @group pay
     * @return mixed|InitResponse
     */
    public function testInit()
    {
        $response = $this->eWallet->payment()->init(new InitCommand(
            SessionType::PAY,
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

        return $response;
    }

    /**
     * @depends testInit
     * @group pay
     *
     * @param InitResponse $response
     * @return PayStatusResponse
     */
    public function testPay($response)
    {
        $this->pay($response->SessionId);
        return $this->checkStatus($response->OrderId, TransactionStatus::STATUS_CHARGED);
    }

    /**
     * @depends testPay
     * @group pay
     * @param PayStatusResponse $response
     */
    public function testRefund($response)
    {
        $response = $this->eWallet->payment()->refund(new RefundCommand($response->OrderId, $response->Amount));

        $this->checkStatus($response->OrderId, TransactionStatus::STATUS_REFUNDED);
    }
}