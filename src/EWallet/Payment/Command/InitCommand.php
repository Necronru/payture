<?php

namespace Necronru\Payture\EWallet\Payment\Command;

use Necronru\Payture\EWallet\Payment\Enum\SessionType;

/**
 * @link http://payture.com/integration/api/#ewallet_init_
 */
class InitCommand
{
    /**
     * @var SessionType::ADD|SessionType::PAY|SessionType::BLOCK|string
     *
     * @see \Necronru\Payture\EWallet\Payment\Enum\SessionType
     */
    public $SessionType;

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
     * IP адрес Пользователя
     *
     * @var string Строка вида xxx.xxx.xxx.xxx
     */
    public $IP;

    /**
     * Идентификатор платежа в системе Продавца.
     * Присутствует, если «SessionType=Pay, Block»
     *
     * @var null|string
     */
    public $OrderId;

    /**
     * Сумма платежа в копейках.
     * Присутствует, если «SessionType=Pay, Block»
     *
     * @var null|float
     */
    public $Amount;

    /**
     * @var null
     */
    public $PhoneNumber;

    /**
     * Идентификатор карты в системе Продавца
     * Присутствует, если «SessionType=Pay, Block»
     *
     * @var null
     */
    public $CardId;

    /**
     * Используемый шаблон страницы оплаты.
     * При отсутствии используется шаблон «по умолчанию»
     *
     * @var null
     */
    public $TemplateTag;

    /**
     * Дополнительный параметр, для определения шаблона страницы.
     * Используется для определения языка страницы
     *
     * @var null
     */
    public $Language;

    /**
     * Пример ссылки http://localhost?order={orderid}&success={success}
     *
     * @var string
     */
    public $Url;

    public function __construct(
        $SessionType,
        $Url,
        $IP,
        $VWUserLgn,
        $VWUserPsw = null,
        $OrderId = null,
        $Amount = null,
        $PhoneNumber = null,
        $CardId = null,
        $TemplateTag = null,
        $Language = null
    )
    {
        $this->SessionType = $SessionType;
        $this->VWUserLgn = $VWUserLgn;
        $this->VWUserPsw = $VWUserPsw;
        $this->IP = $IP;
        $this->OrderId = $OrderId;
        $this->Amount = $Amount;
        $this->PhoneNumber = $PhoneNumber;
        $this->CardId = $CardId;
        $this->TemplateTag = $TemplateTag;
        $this->Language = $Language;
        $this->Url = $Url;
    }


}