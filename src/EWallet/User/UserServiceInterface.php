<?php


namespace Necronru\Payture\EWallet\User;


use Necronru\Payture\EWallet\User\Command\CheckCommand;
use Necronru\Payture\EWallet\User\Command\DeleteCommand;
use Necronru\Payture\EWallet\User\Command\RegisterCommand;
use Necronru\Payture\EWallet\User\Command\UpdateCommand;
use Necronru\Payture\EWallet\User\Response\CheckResponse;
use Necronru\Payture\EWallet\User\Response\DeleteResponse;
use Necronru\Payture\EWallet\User\Response\RegisterResponse;
use Necronru\Payture\EWallet\User\Response\UpdateResponse;

interface UserServiceInterface
{
    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-clients_register_
     * @param RegisterCommand $command
     * @return RegisterResponse
     */
    public function register(RegisterCommand $command);

    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-clients_update_
     * @param UpdateCommand $command
     * @return UpdateResponse
     */
    public function update(UpdateCommand $command);

    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-clients_delete_
     * @param DeleteCommand $command
     * @return DeleteResponse
     */
    public function delete(DeleteCommand $command);

    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-clients_check_
     * @param CheckCommand $command
     * @return CheckResponse
     */
    public function check(CheckCommand $command);

}