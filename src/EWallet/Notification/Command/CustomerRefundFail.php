<?php


namespace Necronru\Payture\EWallet\Notification\Command;


use Necronru\Payture\EWallet\AbstractNotification;

/**
 * Неуспешный возврат средств
 */
class CustomerRefundFail extends AbstractNotification
{

    public $OrderId; // d751e605-2f24-4917-ae95-c2a57e3e5769
    public $Amount; // 700
    public $TransactionDate; // 19.02.2016 10:58:44
    public $Success; // False
    public $ErrCode; // AMOUNT_ERROR
    public $MerchantContract; // Arrows12

}