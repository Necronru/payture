<?php

use GuzzleHttp\Client;
use Necronru\Payture\EWallet\EWallet;
use Necronru\Payture\EWallet\Payment\Command\InitCommand;
use Necronru\Payture\EWallet\Payment\Command\PayCommand;
use Necronru\Payture\EWallet\Payment\Enum\SessionType;

require_once __DIR__ . '/../vendor/autoload.php';

$eWallet = new EWallet(new Client(['base_uri' => 'https://sandbox2.payture.com/']), 'Merchant', '123');
$response = $eWallet->payment()->init(new InitCommand(SessionType::PAY, '123@ya.ru', '2645363', '98.132.229.220', uniqid('test_'), 500, '79001234567'));
$link = $eWallet->payment()->getSessionLink(new PayCommand($response->SessionId));
?>

<a href="<?= $link ?>" target="_blank">Оплатить</a>
