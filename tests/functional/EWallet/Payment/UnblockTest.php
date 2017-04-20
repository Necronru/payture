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
     * @group block
     * @param InitResponse $response
     *
     * @return PayStatusResponse
     */
    public function testBlock($response)
    {
        $this->pay($response->SessionId);
        return $this->checkStatus($response->OrderId, TransactionStatus::STATUS_AUTHORIZED);
    }

    /**
     * @depends testBlock
     * @group block
     * @param PayStatusResponse $response
     */
    public function testUnblock($response)
    {
        $orderId = $response->OrderId;

        $response = $this->eWallet->payment()->unblock(new UnblockCommand($orderId, $response->Amount));

        static::assertEquals('True', $response->Success);

        $this->checkStatus($response->OrderId, TransactionStatus::STATUS_VOIDED);

    }

}