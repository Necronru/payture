<?php


namespace Necronru\Payture\EWallet\Notification\Command;


use Necronru\Payture\EWallet\AbstractNotification;

class CustomerPaySuccess extends AbstractNotification
{
    public $VWUserLgn; // payture.tester@gmail.com
    public $CardId; // 15227c4a-d352-4191-8c3d-b331e9a9e57d
    public $OrderId; // da0b3a87-602f-40c4-83d7-3d88fd1151f2
    public $Amount; // 300
    public $ConfirmCode; // 10
    public $ExternalMerchantOrderId; // da0b3a87-602f-40c4-83d7-3d88fd1151f2
    public $IP; // 109.73.11.168
    public $Is3DS; // False
    public $IsAFAuthorize; // False
    public $IsSecureCodeByPhone; // False
    public $TransactionDate; // 26.01.2016 17:42:43
    public $SessionId; // 4788156e-48bc-4103-96fb-2f32f5d65e6c
    public $CardNumber; // 411111xxxxxx1112
    public $DateTime; // 635894269530527343
}