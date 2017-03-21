<?php


namespace Necronru\Payture\EWallet\Command;


class RefundCommand
{
    /**
     * Пароль ТСП для проведения операций через API. Выдается с параметрами тестового/боевого доступа.
     *
     * @var string
     */
    public $Password;

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


    public function __construct($Password, $OrderId, $Amount)
    {
        $this->Password = $Password;
        $this->OrderId = $OrderId;
        $this->Amount = $Amount;
    }

}