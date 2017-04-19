<?php


namespace Necronru\Payture\EWallet\Payment\Response;


use Necronru\Payture\EWallet\Response\AbstractResponse;

class ChargeResponse extends AbstractResponse
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