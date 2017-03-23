<?php

namespace Necronru\Payture\EWallet\User;

use Necronru\Payture\EWallet\EWalletTransport;

class UserService implements UserServiceInterface
{
    /**
     * @var EWalletTransport
     */
    private $_transport;

    public function __construct(EWalletTransport $transport)
    {
        $this->_transport = $transport;
    }

    public function register()
    {
        // TODO: Implement register() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function check()
    {
        // TODO: Implement check() method.
    }
}