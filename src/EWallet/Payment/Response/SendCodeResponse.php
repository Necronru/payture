<?php


namespace Necronru\Payture\EWallet\Payment\Response;


use Necronru\Payture\EWallet\Response\AbstractResponse;

class SendCodeResponse extends AbstractResponse
{
    /**
     * Идентификатор Покупателя в системе Payture
     * Соответствует переданному в запросе
     *
     * @var string
     */
    public $VWUserLgn;

    /**
     * Сумма платежа в копейках
     * Соответствует переданному в запросе или равен «0» если параметр не передавался в запросе
     *
     * @var int
     */
    public $Amount;

    /**
     * Идентификатор платежа в системе Продавца.
     * Соответствует переданному в запросе
     * Присутствует если передавался в запросе
     *
     * @var string
     */
    public $OrderId;
}