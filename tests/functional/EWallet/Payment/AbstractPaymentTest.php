<?php


use Codeception\Test\Unit;
use GuzzleHttp\Client;
use Necronru\Payture\Enum\TransactionStatus;
use Necronru\Payture\EWallet\EWallet;
use Necronru\Payture\EWallet\Payment\Command\PayStatusCommand;

class AbstractPaymentTest extends Unit
{
    /**
     * @var EWallet
     */
    protected $eWallet;

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function _before()
    {
        $this->eWallet = new EWallet(new Client(['base_uri' => 'https://sandbox2.payture.com/']), 'Merchant', '123');
    }

    protected function pay($sessionId)
    {
        $uri = $this->eWallet->payment()->getSessionLink($sessionId, false);

        static::assertNotEmpty($uri);

        $this->tester->amOnPage($uri);
        $this->tester->see('Оплатить');

        $this->tester->submitForm('#payForm', [
            'CardNumber' => '4111111111100023',
            'DateTo' => '12/18',
            'SecureCode' => '123',
            'CardHolder' => 'IVAN IVANOV'
        ]);

        $this->tester->wait(10);
    }

    protected function checkStatus($orderId, $expectedStatus)
    {
        $response = $this->eWallet->payment()->payStatus(new PayStatusCommand($orderId));

        static::assertEquals('True', $response->Success);
        static::assertEquals($expectedStatus, $response->Status, TransactionStatus::getTitle($response->Status));
        static::assertNotEmpty($response->Status);

        return $response;
    }

}