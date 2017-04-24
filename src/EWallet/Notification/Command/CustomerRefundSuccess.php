<?php


namespace Necronru\Payture\EWallet\Notification\Command;


use Necronru\Payture\EWallet\AbstractNotification;

/**
 * Успешный возврат средств
 */
class CustomerRefundSuccess extends AbstractNotification
{
    public $OrderId; // 805be31d-5f08-4a03-b7d1-adbaf82ec913
    public $NewAmount; // 0
    public $TransactionDate; // 01/26/2016 18:40:25
    public $Success; // True
    public $MerchantContract; // Arrows12
}