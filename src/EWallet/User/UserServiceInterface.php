<?php


namespace Necronru\Payture\EWallet\User;


interface UserServiceInterface
{
    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-clients_register_
     */
    public function register();

    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-clients_update_
     */
    public function update();

    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-clients_delete_
     */
    public function delete();

    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-clients_check_
     */
    public function check();

}