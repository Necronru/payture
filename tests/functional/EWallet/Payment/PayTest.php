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
            $_ENV['PAYTURE_CALLBACK_URL'],
            '98.132.229.220',
            '123@ya.ru',
            '2645363',
            uniqid('test_'),
            500 * 100,
            '79001234567',
            null,
            null,
            null,
            500,
            'Тестовый продукт'
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
        $this->tester->amPay($this->eWallet, $response->SessionId, $response->OrderId, TransactionStatus::STATUS_CHARGED);

        return ['OrderId' => $response->OrderId, 'Amount' => $response->Amount];
    }

    /**
     * @depends testPay
     * @group pay
     * @param array $parameters
     */
    public function testRefund($parameters)
    {
        $I = $this->tester;
        $response = $this->eWallet->payment()->refund(new RefundCommand($parameters['OrderId'], $parameters['Amount']));

        $I->amCheckOrder($this->eWallet, $parameters['OrderId'], TransactionStatus::STATUS_REFUNDED);
    }
}