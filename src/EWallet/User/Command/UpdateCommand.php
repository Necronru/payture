<?php


namespace Necronru\Payture\EWallet\User\Command;

/**
 * @link http://payture.com/integration/api/#ewallet_ewallet-clients_update_
 */
class UpdateCommand
{
    /**
     * Идентификатор Пользователя в системе Payture. Рекомендуется использовать e-mail
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
     * Телефон Пользователя
     * Номер телефона в международном формате (только цифры, без пробелов): [код страны][код оператора][номер абонента]
     *
     * @var int
     */
    public $PhoneNumber;

    /**
     * E-mail Пользователя
     *
     * @var string
     */
    public $Email;

    public function __construct($VWUserLgn, $VWUserPsw, $PhoneNumber = null, $Email = null)
    {
        $this->VWUserLgn = $VWUserLgn;
        $this->VWUserPsw = $VWUserPsw;
        $this->PhoneNumber = $PhoneNumber;
        $this->Email = $Email;
    }

}