<?php


use Codeception\Test\Unit;
use GuzzleHttp\Client;
use Necronru\Payture\EWallet\EWallet;

class AbstractPaymentTest extends Unit
{
    /**
     * @var EWallet
     */
    protected $eWallet;

    /**
     * @var \FunctionalTester
     */
    protected $tester;

    public function _before()
    {
        $this->eWallet = new EWallet(new Client(['base_uri' => $_ENV['PAYTURE_API']]), $_ENV['PAYTURE_TERMINAL_ID'], $_ENV['PAYTURE_TERMINAL_PASSWORD']);
    }
}