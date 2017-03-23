<?php


namespace Necronru\Payture\EWallet\Payment;


use Necronru\Payture\EWallet\Payment\Command\InitCommand;
use Necronru\Payture\EWallet\Payment\Command\PayCommand;
use Necronru\Payture\EWallet\Payment\Command\PayStatusCommand;
use Necronru\Payture\EWallet\Payment\Command\RefundCommand;
use Necronru\Payture\EWallet\Payment\Response\InitResponse;
use Necronru\Payture\EWallet\Payment\Response\PayStatusResponse;
use Necronru\Payture\EWallet\Payment\Response\RefundResponse;
use Necronru\Payture\EWallet\EWalletTransport;

class PaymentService implements PaymentServiceInterface
{

    /**
     * @var EWalletTransport
     */
    private $_transport;

    public function __construct(EWalletTransport $transport)
    {
        $this->_transport = $transport;
    }

    /**
     * @inheritdoc
     */
    public function init(InitCommand $command)
    {
        return $this->_transport->executeCommand($command, InitResponse::class, '/vwapi/Init');
    }

    /**
     * @inheritdoc
     */
    public function pay(PayCommand $command)
    {
        return $this->_transport->getClient()->getConfig('base_uri') . 'vwapi/Pay' . '?' . http_build_query($command);
    }

    /**
     * @inheritdoc
     */
    public function payStatus(PayStatusCommand $command)
    {
        return $this->_transport->executeCommand($command, PayStatusResponse::class, '/vwapi/PayStatus');
    }

    /**
     * @inheritdoc
     */
    public function refund(RefundCommand $command)
    {
        return $this->_transport->executeCommand($command, RefundResponse::class, '/vwapi/Refund', function ($data) {
            return array_merge(['Password' => $this->_transport->getVmPassword()], $data);
        });
    }

    /**
     * @inheritdoc
     */
    public function sendCode()
    {
        // TODO: Implement sendCode() method.
    }

    /**
     * @inheritdoc
     */
    public function unblock()
    {
        // TODO: Implement unblock() method.
    }

    /**
     * @inheritdoc
     */
    public function charge()
    {
        // TODO: Implement charge() method.
    }
}