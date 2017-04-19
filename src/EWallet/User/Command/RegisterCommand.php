<?php


namespace Necronru\Payture\EWallet\User\Command;


/**
 * @link http://payture.com/integration/api/#ewallet_ewallet-clients_register_
 */
class RegisterCommand
{
    /**
     * Идентификатор Пользователя в системе Payture. Рекомендуется использовать e-mai
     *
     * @var string
     */
    public $VWUserLgn;

    /**
     * Дополнительный параметр доступа к приватной информации Пользователя (пароль Пользователя)
     *
     * @var string
     */
    public $VWUserPsw;

    /**
     * Номер телефона в международном формате (только цифры, без пробелов): [код страны][код оператора][номер абонента]
     *
     * @var int
     */
    public $PhoneNumber;

    public function __construct($VWUserLgn, $VWUserPsw, $PhoneNumber = null)
    {
        $this->VWUserLgn = $VWUserLgn;
        $this->VWUserPsw = $VWUserPsw;
        $this->PhoneNumber = $PhoneNumber;
    }


}