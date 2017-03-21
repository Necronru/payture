<?php


namespace Necronru\Payture\EWallet\Command;


class PayCommand
{
    public $SessionId;

    public function __construct($SessionId)
    {
        $this->SessionId = $SessionId;
    }

}