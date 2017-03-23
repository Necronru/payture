<?php


namespace Necronru\Payture\Tests\Unit\EWallet;


use GuzzleHttp\Client;
use Necronru\Payture\EWallet\Card\Command\GetCardListCommand;
use Necronru\Payture\EWallet\EWallet;
use Necronru\Payture\EWallet\Payment\Command\InitCommand;
use Necronru\Payture\EWallet\Payment\Command\PayCommand;
use Necronru\Payture\EWallet\Payment\Command\PayStatusCommand;
use Necronru\Payture\EWallet\Payment\Command\RefundCommand;
use Necronru\Payture\EWallet\Payment\Enum\SessionType;
use Necronru\Payture\EWallet\Payment\Response\InitResponse;
use Necronru\Payture\Tests\Unit\PaytureTestCase;

class EWalletTest extends PaytureTestCase
{
    /**
     * @var EWallet
     */
    private $eWallet;

    public function setUp()
    {
        $this->eWallet = new EWallet(new Client(['base_uri' => 'https://sandbox2.payture.com/']), 'Merchant', '123');
    }

    public function testCartList()
    {
        $login = '123@ya.ru';
        $response = $this->eWallet->card()->getList(new GetCardListCommand($login, '2645363'));

        static::assertEquals('True', $response->Success);
        static::assertEquals($login, $response->VWUserLgn);

        static::assertNotEmpty($response->Item);

//        dump($response);
    }

    public function testInitPay()
    {
        $response = $this->eWallet->payment()->init(new InitCommand(
            SessionType::PAY,
            '123@ya.ru',
            '2645363',
            '98.132.229.220',
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
     * @depends testInitPay
     *
     * @param InitResponse $response
     */
    public function testPay($response)
    {
        $url = $this->eWallet->payment()->pay(new PayCommand($response->SessionId));

        static::assertNotEmpty($url);

//        dump($url);
    }

    /**
     * @depends testInitPay
     *
     * @param InitResponse $response
     */
    public function testPayStatus($response)
    {
        $response = $this->eWallet->payment()->payStatus(new PayStatusCommand($response->OrderId));

        static::assertNotEmpty($response->Status);

//        dump(TransactionStatus::getTitle($response->Status), $response);
    }

    public function refundProvider()
    {
        return [
            [
                'OrderId' => uniqid('test_'),
                'Amount' => '100'
            ]
        ];
    }

    /**
     * @dataProvider refundProvider
     *
     * @expectedException \Necronru\Payture\EWallet\EWalletError
     * @expectedExceptionCode 34
     */
    public function testRefund()
    {
        $this->eWallet->payment()->refund(new RefundCommand(uniqid('test_'), '100'));
    }

}