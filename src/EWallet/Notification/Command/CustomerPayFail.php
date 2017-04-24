<?php


namespace Necronru\Payture\EWallet\Notification\Command;


use Necronru\Payture\EWallet\AbstractNotification;

/**
 * Неуспешное списание средств
 */
class CustomerPayFail extends AbstractNotification
{

    public $Email; // test@server.com
    public $OrderId; // 462e381b-5bd4-4d0e-91e8-e9036dc3c896
    public $CardNumber; // 411111xxxxxx1112
    public $Amount; // 10000
    public $TransactionDate; // 03.02.2016 13:28:27
    public $Success; // False
    public $ErrCode; // AMOUNT_ERROR
    public $MerchantContract; // Arrows12

}