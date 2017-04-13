<?php


namespace Necronru\Payture\EWallet\Payment\Response;


class UnblockResponse extends BaseResponse
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