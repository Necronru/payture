<?php


namespace Necronru\Payture\EWallet\Payment\Command;


class SendCodeCommand
{
    /**
     * Идентификатор Пользователя в системе Payture.
     * Рекомендуется использовать e-mail
     *
     * @var string Строка (максимум 50 символов)
     */
    public $VWUserLgn;

    /**
     * Дополнительный параметр доступа к приватной информации.
     * Пользователя (пароль Пользователя)
     *
     * @var string Строка (максимум 50 символов)
     */
    public $VWUserPsw;

    /**
     * Идентификатор карты в системе Payture
     * Строка (максимум 32 символов)
     *
     * @var string
     */
    public $CardId;

    /**
     * Идентификатор платежа в системе Продавца
     * Строка (максимум 50 символов)
     *
     * @var string
     */
    public $OrderId;

    /**
     * Сумма платежа в копейках
     * Цифры, не содержащие десятичных или других разделителей
     *
     * @var string
     */
    public $Amount;

    public function __construct($VWUserLgn, $VWUserPsw, $CardId = null, $OrderId = null, $Amount = null)
    {
        $this->VWUserLgn = $VWUserLgn;
        $this->VWUserPsw = $VWUserPsw;
        $this->CardId = $CardId;
        $this->OrderId = $OrderId;
        $this->Amount = $Amount;
    }


}