<?php


namespace Necronru\Payture\EWallet\Payment\Command;


class RefundCommand
{
    /**
     * Идентификатор платежа в системе ТСП
     *
     * @var string
     */
    public $OrderId;

    /**
     * Сумма возврата в копейках
     *
     * @var int
     */
    public $Amount;


    public function __construct($OrderId, $Amount)
    {
        $this->OrderId = $OrderId;
        $this->Amount = $Amount;
    }

}