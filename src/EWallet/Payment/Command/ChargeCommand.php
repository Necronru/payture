<?php


namespace Necronru\Payture\EWallet\Payment\Command;


class ChargeCommand
{
    /**
     * Идентификатор платежа в системе ТСП
     *
     * @var string - максимум 50 символов
     */
    public $OrderId;

    /**
     * Сумма платежа в копейках
     * Цифры не содержащие десятичных или других разделителей
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