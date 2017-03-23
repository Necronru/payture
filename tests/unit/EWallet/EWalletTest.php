<?php


namespace Necronru\Payture\Tests\Unit\EWallet;


use GuzzleHttp\Client;
use Necronru\Payture\EWallet\Command\GetCardListCommand;
use Necronru\Payture\EWallet\Command\InitCommand;
use Necronru\Payture\EWallet\Command\PayCommand;
use Necronru\Payture\EWallet\Command\PayStatusCommand;
use Necronru\Payture\EWallet\Command\RefundCommand;
use Necronru\Payture\EWallet\Enum\SessionType;
use Necronru\Payture\EWallet\EWallet;
use Necronru\Payture\EWallet\Response\InitResponse;
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

    public function cardProvider()
    {
        return array(
            array(
                'CardName' => '411111xxxxxx1112',
                'CardId' => '856e3a1d-6b35-4f65-a6f6-b6aa53fd42e3',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx0031',
                'CardId' => '4942764e-a219-4556-a9e8-07f78176c6df',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx1114',
                'CardId' => '6c9c12e3-2f8c-489a-b4d3-87c61f8a9bbf',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '461111xxxxxx1112',
                'CardId' => '4382b55e-2952-43e3-8c1d-7507ecbc8711',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx1111',
                'CardId' => '45eed080-12f7-4601-bdae-514f4b00d464',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx1113',
                'CardId' => '621d25f8-5b4d-4861-8d55-9fa934918c64',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx1111',
                'CardId' => '6817f6d2-1f02-4481-b131-91296b8a7356',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx111\\',
                'CardId' => '92d5c541-6df2-4b77-90e4-821d4b20ff38',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
            array(
                'CardName' => '411111xxxxxx1111',
                'CardId' => '6b858f93-a35c-4aa4-8f35-3cb5f973ddb4',
                'CardHolder' => 'Ivan Ivanov',
                'Status' => 'NotActive3DS',
                'NoCVV' => 'true',
                'Expired' => 'false',
            ),
        );
    }

    public function testCartList()
    {
        $login = '123@ya.ru';
        $response = $this->eWallet->cartList(new GetCardListCommand($login, '2645363'));

        static::assertEquals('True', $response->Success);
        static::assertEquals($login, $response->VWUserLgn);

        static::assertNotEmpty($response->Item);

//        dump($response);
    }

    public function testInitPay()
    {
        $response = $this->eWallet->init(new InitCommand(
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
        $url = $this->eWallet->pay(new PayCommand($response->SessionId));

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
        $response = $this->eWallet->payStatus(new PayStatusCommand($response->OrderId));

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
     * @expectedException \Necronru\Payture\EWallet\Exception\EWalletError
     * @expectedExceptionCode 34
     */
    public function testRefund()
    {
        $this->eWallet->refund(new RefundCommand(uniqid('test_'), '100'));
    }

}