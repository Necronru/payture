<?php


namespace Necronru\Payture\EWallet\User\Command;


/**
 * Class CheckCommand
 * @package Necronru\Payture\EWallet\User\Command
 * @link http://payture.com/integration/api/#ewallet_ewallet-clients_check_
 */
class CheckCommand
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

    public function __construct($VWUserLgn, $VWUserPsw)
    {
        $this->VWUserLgn = $VWUserLgn;
        $this->VWUserPsw = $VWUserPsw;
    }


}