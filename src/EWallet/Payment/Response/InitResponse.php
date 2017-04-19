<?php


namespace Necronru\Payture\EWallet\Payment\Response;
use Necronru\Payture\EWallet\Response\AbstractResponse;


/**
 * @link http://payture.com/integration/api/#ewallet_init_
 */
class InitResponse extends AbstractResponse
{
    /**
     * Идентификатор платежа в системе Продавца.
     * Передается, если «Success=True» и «SessionType=Pay»
     * Соответствует переданному в запросе
     *
     * @var string
     */
    public $OrderId;

    /**
     * Сумма платежа в копейках. Передается, если «Success=True»
     * Соответствует переданному в запросе или равен «0» если «SessionType=Add» в запросе
     *
     * @var int
     */
    public $Amount;

    /**
     * Идентификатор платежа в системе Payture.
     * Передается, если «Success=True»
     * Строка (максимум 50 символов)
     *
     * @var string
     */
    public $SessionId;

    /**
     * Переданый тип сессии
     *
     * @var string
     */
    public $SessionType;

}