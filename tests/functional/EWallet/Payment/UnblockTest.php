<?php

use Necronru\Payture\Enum\TransactionStatus;
use Necronru\Payture\EWallet\Payment\Command\InitCommand;
use Necronru\Payture\EWallet\Payment\Command\UnblockCommand;
use Necronru\Payture\EWallet\Payment\Enum\SessionType;
use Necronru\Payture\EWallet\Payment\Response\InitResponse;
use Necronru\Payture\EWallet\Payment\Response\PayStatusResponse;

class UnblockTest extends AbstractPaymentTest
{
    /**
     * @group block
     * @return mixed|InitResponse
     */
    public function testInit()
    {
        $response = $this->eWallet->payment()->init(new InitCommand(
            SessionType::BLOCK,
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
     * @group block
     * @param InitResponse $response
     *
     * @return array
     */
    public function testBlock($response)
    {
        $this->tester->amPay($this->eWallet, $response->SessionId, $response->OrderId, TransactionStatus::STATUS_AUTHORIZED);

        return ['OrderId' => $response->OrderId, 'Amount' => $response->Amount];
    }

    /**
     * @depends testBlock
     * @group block
     * @param array $parameters
     */
    public function testUnblock($parameters)
    {
        $orderId = $parameters['OrderId'];
        $amount = $parameters['Amount'];

        $response = $this->eWallet->payment()->unblock(new UnblockCommand($orderId, $amount));

        static::assertEquals('True', $response->Success);

        $this->tester->amCheckOrder($this->eWallet, $response->OrderId, TransactionStatus::STATUS_VOIDED);

    }

}