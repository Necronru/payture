<?php

namespace Necronru\Payture\EWallet\User;

use Necronru\Payture\EWallet\EWalletTransport;
use Necronru\Payture\EWallet\User\Command\CheckCommand;
use Necronru\Payture\EWallet\User\Command\DeleteCommand;
use Necronru\Payture\EWallet\User\Command\RegisterCommand;
use Necronru\Payture\EWallet\User\Command\UpdateCommand;
use Necronru\Payture\EWallet\User\Response\CheckResponse;
use Necronru\Payture\EWallet\User\Response\DeleteResponse;
use Necronru\Payture\EWallet\User\Response\RegisterResponse;
use Necronru\Payture\EWallet\User\Response\UpdateResponse;

class UserService implements UserServiceInterface
{
    const METHOD_CHECK = '/vwapi/Check';
    const METHOD_REGISTER = '/vwapi/Register';
    const METHOD_UPDATE = '/vwapi/Update';
    const METHOD_DELETE = '/vwapi/Delete';
    /**
     * @var EWalletTransport
     */
    private $_transport;

    public function __construct(EWalletTransport $transport)
    {
        $this->_transport = $transport;
    }

    public function register(RegisterCommand $command)
    {
        return $this->_transport->executeCommand($command, RegisterResponse::class, self::METHOD_REGISTER);
    }

    public function update(UpdateCommand $command)
    {
        return $this->_transport->executeCommand($command, UpdateResponse::class, self::METHOD_UPDATE);
    }

    public function delete(DeleteCommand $command)
    {
        return $this->_transport->executeCommand($command, DeleteResponse::class, self::METHOD_DELETE, function($data, $formData) {
            return array_merge(
                $formData,
                ['DATA' => http_build_query(array_merge(['Password' => $this->_transport->getVmPassword()], $data), null, ';')]
            );
        });
    }

    public function check(CheckCommand $command)
    {
        return $this->_transport->executeCommand($command, CheckResponse::class, self::METHOD_CHECK);
    }


}