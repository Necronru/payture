<?php


namespace Necronru\Payture\EWallet\Payment\Command;


class PayStatusCommand
{
    /**
     * Идентификатор платежа в системе Продавца
     *
     * @var string
     */
    public $OrderId;

    public function __construct($OrderId)
    {
        $this->OrderId = $OrderId;
    }

}