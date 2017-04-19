<?php


namespace Necronru\Payture\EWallet\Payment\Response;


use Necronru\Payture\EWallet\Response\AbstractResponse;

class UnblockResponse extends AbstractResponse
{
    /**
     * Идентификатор платежа в системе ТСП.
     * Соответствует переданному в запросе.
     *
     * @var string
     */
    public $OrderId;

    /**
     * Остаток заблокированной суммы в копейках.
     * Передается, если «Success=True»
     * Цифры не содержащие десятичных или других разделителей
     *
     * @var int
     */
    public $NewAmount;
}