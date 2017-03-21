<?php


namespace Necronru\Payture\EWallet\Response;


class PayStatusResponse
{

    public $Success;

    /**
     * Текущий статус платежа.
     * Передается, если «Success=True».
     *
     * @see \Necronru\Payture\Enum\TransactionStatus
     */
    public $Status;

    /**
     * Идентификатор Пользователя в системе Payture. Передается, если «Success=True»	Cтрока (максимум 50 символов)
     */
    public $VWUserLgn;

    /**
     * Идентификатор платежа в системе Продавца. Передается, если «Success=True».	Соответствует переданному в запросе
     */
    public $OrderId;

    /**
     * Сумма платежа в копейках.
     * Передается, если «Success=True»
     * Цифры, не содержащие десятичных или других разделителей
     */
    public $Amount;

    /**
     * Идентификатор карты в системе Payture.
     * Передается, если «Success=True».
     */
    public $CardId;

    /**
     * Код ошибки.
     * Передается, если «Success=False»
     *
     * @var string
     * @see \Necronru\Payture\Enum\ErrorCode
     */
    public $ErrCode;

}