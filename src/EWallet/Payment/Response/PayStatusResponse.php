<?php


namespace Necronru\Payture\EWallet\Payment\Response;


class PayStatusResponse extends BaseResponse
{
    /**
     * Текущий статус платежа.
     * Передается, если «Success=True».
     *
     * @var string
     *
     * @see \Necronru\Payture\Enum\TransactionStatus
     */
    public $Status;

    /**
     * Идентификатор Пользователя в системе Payture. Передается, если «Success=True»
     *
     * @var string Cтрока (максимум 50 символов)
     */
    public $VWUserLgn;

    /**
     * Идентификатор платежа в системе Продавца. Передается, если «Success=True».
     * Соответствует переданному в запросе
     *
     * @var string
     */
    public $OrderId;

    /**
     * Сумма платежа в копейках.
     * Передается, если «Success=True»
     * Цифры, не содержащие десятичных или других разделителей
     *
     * @var float
     */
    public $Amount;

    /**
     * Идентификатор карты в системе Payture.
     * Передается, если «Success=True».
     *
     * @var string
     */
    public $CardId;
}