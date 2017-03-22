<?php


namespace Necronru\Payture\EWallet\Response;


/**
 * @link http://payture.com/integration/api/#ewallet_init_
 */
class InitResponse
{
    /**
     * Флаг успешности операции
     *
     * @var boolean
     */
    public $Success;

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
     * Код ошибки.
     * Передается, если «Success=False»
     *
     * @var string
     * @see \Necronru\Payture\Enum\ErrorCode
     */
    public $ErrCode;

    /**
     * Переданый тип сессии
     *
     * @var string
     */
    public $SessionType;

}