<?php


namespace Necronru\Payture\EWallet\Notification\Command;


use Necronru\Payture\EWallet\AbstractNotification;

class CustomerSendCode extends AbstractNotification
{
    public $Email;
    public $OrderId;  // 333444555
    public $Amount;  // 300
    public $TransactionDate;  // 27.01.2016 10:27:03
    public $MerchantContract;  // Arrows12

}