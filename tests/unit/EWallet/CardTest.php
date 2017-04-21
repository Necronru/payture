<?php


use GuzzleHttp\Client;
use Necronru\Payture\EWallet\Card\Command\GetCardListCommand;
use Necronru\Payture\EWallet\EWallet;

class CardTest extends \Codeception\Test\Unit
{
    /**
     * @var EWallet
     */
    private $service;

    protected function _before()
    {
        $this->service = new EWallet(new Client(['base_uri' => $_ENV['PAYTURE_API']]), $_ENV['PAYTURE_TERMINAL_ID'], $_ENV['PAYTURE_TERMINAL_PASSWORD']);
    }


    public function testCartList()
    {
        $login = '123@ya.ru';
        $response = $this->service->card()->getList(new GetCardListCommand($login, '2645363'));

        static::assertEquals('True', $response->Success);
        static::assertEquals($login, $response->VWUserLgn);

        static::assertNotEmpty($response->Item);

//        dump($response);
    }
}