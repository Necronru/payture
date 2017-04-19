<?php


namespace Necronru\Payture\EWallet\User\Command;


/**
 * @link http://payture.com/integration/api/#ewallet_ewallet-clients_delete_
 */
class DeleteCommand
{
    /**
     * 	Идентификатор Пользователя в системе Payture. Рекомендуется использовать e-mail
     *
     * @var string
     */
    public $VWUserLgn;

    public function __construct($VWUserLgn)
    {
        $this->VWUserLgn = $VWUserLgn;
    }


}