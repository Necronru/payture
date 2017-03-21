<?php


namespace Necronru\Payture\EWallet\Response;


class RefundResponse
{
    /**
     * Флаг успешности операции
     *
     * @var boolean
     */
    public $Success;

    /**
     * Идентификатор платежа в системе ТСП.
     * Соответствует переданному в запросе.
     *
     * @var string
     */
    public $OrderId;

    /**
     * Остаток списанной ранее суммы после проведения возврата в копейках.
     * Передается, если «Success=True»
     * Цифры не содержащие десятичных или других разделителей
     *
     * @var int
     */
    public $NewAmount;

    /**
     * Код ошибки.
     * Передается, если «Success=False»
     *
     * @var string
     * @see \Necronru\Payture\Enum\ErrorCode
     */
    public $ErrCode;

}