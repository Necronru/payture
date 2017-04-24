<?php


namespace Necronru\Payture\EWallet\Notification\Command;


use Necronru\Payture\EWallet\AbstractNotification;

class CustomerAddFail extends AbstractNotification
{
    public $VWUserLgn; // payture.tester@gmail.com
    public $PhoneNumber; // 79265351604
    public $TransactionDate; // 27.01.2016 10:39:41
    public $Success; // False
    public $ErrCode; // WRONG_PARAMS
    public $MerchantContract; // Arrows12

}