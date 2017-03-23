<?php


namespace Necronru\Payture\EWallet;


use GuzzleHttp\ClientInterface;
use Necronru\Payture\EWallet\Card\CardService;
use Necronru\Payture\EWallet\Payment\PaymentService;
use Necronru\Payture\EWallet\User\UserService;

class EWallet
{
    /**
     * @var CardService
     */
    private $_card;

    /**
     * @var PaymentService
     */
    private $_payment;

    /**
     * @var UserService
     */
    private $_user;

    /**
     * EWallet constructor.
     * @param ClientInterface $client
     * @param string $vmId
     * @param string $vmPassword
     */
    public function __construct(ClientInterface $client, $vmId, $vmPassword)
    {
        $transport = new EWalletTransport($client, $vmId, $vmPassword);

        $this->_card    = new CardService($transport);
        $this->_payment = new PaymentService($transport);
        $this->_user    = new UserService($transport);
    }

    /**
     * @return CardService
     */
    public function card()
    {
        return $this->_card;
    }

    /**
     * @return PaymentService
     */
    public function payment()
    {
        return $this->_payment;
    }

    public function user()
    {
        return $this->_user;
    }
}