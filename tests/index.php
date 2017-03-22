<?php

use GuzzleHttp\Client;
use Necronru\Payture\EWallet\Command\InitCommand;
use Necronru\Payture\EWallet\Command\PayCommand;
use Necronru\Payture\EWallet\Enum\SessionType;
use Necronru\Payture\EWallet\EWallet;

require_once __DIR__ . '/bootstrap.php';

$eWallet = new EWallet(new Client(['base_uri' => 'https://sandbox2.payture.com/']), 'Merchant');
$response = $eWallet->init(new InitCommand(SessionType::PAY, '123@ya.ru', '2645363', '98.132.229.220', uniqid('test_'), 500, '79001234567'));
$link = $eWallet->pay(new PayCommand($response->SessionId));
?>

<a href="<?= $link ?>" target="_blank">Оплатить</a>
