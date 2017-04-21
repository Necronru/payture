<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module\WebDriver;
use Necronru\Payture\Enum\TransactionStatus;
use Necronru\Payture\EWallet\EWallet;
use Necronru\Payture\EWallet\Payment\Command\PayStatusCommand;

class EWalletHelper extends WebDriver
{
    public function amPay(EWallet $eWallet, $sessionId, $orderId, $expectedStatus, array $card = null)
    {
        $I = $this;

        $card = $card ? $card : [
            'CardNumber' => '4111111111100023',
            'DateTo' => '12/18',
            'SecureCode' => '123',
            'CardHolder' => 'IVAN IVANOV'
        ];

        $sessionUrl = $eWallet->payment()->getSessionLink($sessionId, false);

        $I->assertNotEmpty($sessionUrl);
        $I->amOnPage($sessionUrl);
        $I->see('Оплатить');
        $I->submitForm('#payForm', $card);
        $I->wait(5);

        $I->amCheckOrder($eWallet, $orderId, $expectedStatus);
    }

    public function amCheckOrder(EWallet $eWallet, $orderId, $expectedStatus)
    {
        $response = $eWallet->payment()->payStatus(new PayStatusCommand($orderId));

        $I = $this;
        $I->assertEquals('True', $response->Success);
        $I->assertEquals($expectedStatus, $response->Status, TransactionStatus::getTitle($response->Status));
        $I->assertNotEmpty($response->Status);
    }
}
