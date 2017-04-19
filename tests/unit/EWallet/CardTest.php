<?php


use GuzzleHttp\Client;
use Necronru\Payture\EWallet\Card\Command\GetCardListCommand;
use Necronru\Payture\EWallet\EWallet;

class CardTest extends \Codeception\Test\Unit
{
    public function testCartList()
    {
        $eWallet = new EWallet(new Client(['base_uri' => 'https://sandbox2.payture.com/']), 'Merchant', '123');

        $login = '123@ya.ru';
        $response = $eWallet->card()->getList(new GetCardListCommand($login, '2645363'));

        static::assertEquals('True', $response->Success);
        static::assertEquals($login, $response->VWUserLgn);

        static::assertNotEmpty($response->Item);

//        dump($response);
    }
}