<?php


namespace Necronru\Payture\EWallet\Payment\Response;


class ChargeResponse extends BaseResponse
{
    /**
     * Идентификатор платежа в системе ТСП.
     * Соответствует переданному в запросе
     *
     * @var string
     */
    public $OrderId;

    /**
     * Списанная сумма.
     * Передается, если «Success=True»
     *
     * @var int - целое число без делителей
     */
    public $Amount;
}