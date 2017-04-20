<?php


namespace Necronru\Payture\EWallet\Payment;


use Necronru\Payture\EWallet\Payment\Command\ChargeCommand;
use Necronru\Payture\EWallet\Payment\Command\InitCommand;
use Necronru\Payture\EWallet\Payment\Command\PayStatusCommand;
use Necronru\Payture\EWallet\Payment\Command\RefundCommand;
use Necronru\Payture\EWallet\Payment\Command\UnblockCommand;
use Necronru\Payture\EWallet\Payment\Response\ChargeResponse;
use Necronru\Payture\EWallet\Payment\Response\InitResponse;
use Necronru\Payture\EWallet\Payment\Response\PayStatusResponse;
use Necronru\Payture\EWallet\Payment\Response\RefundResponse;
use Necronru\Payture\EWallet\EWalletTransport;
use Necronru\Payture\EWallet\Payment\Response\UnblockResponse;

class PaymentService implements PaymentServiceInterface
{
    const METHOD_INIT = '/vwapi/Init';
    const METHOD_PAY = '/vwapi/Pay';
    const METHOD_STATUS = '/vwapi/PayStatus';
    const METHOD_REFUND = '/vwapi/Refund';
    const METHOD_CHARGE = '/vwapi/Charge';
    const METHOD_UNBLOCK = '/vwapi/Unblock';


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
        return $this->_transport->executeCommand($command, InitResponse::class, self::METHOD_INIT);
    }

    /**
     * @inheritdoc
     */
    public function getSessionLink($sessionId, $host = true)
    {
        return ($host ? $this->_transport->getClient()->getConfig('base_uri') : '')
            . self::METHOD_PAY
            . '?'
            . http_build_query([
                'SessionId' => $sessionId
            ])
        ;
    }

    /**
     * @inheritdoc
     */
    public function payStatus(PayStatusCommand $command)
    {
        return $this->_transport->executeCommand($command, PayStatusResponse::class, self::METHOD_STATUS);
    }

    /**
     * @inheritdoc
     */
    public function refund(RefundCommand $command)
    {
        return $this->_transport->executeCommand($command, RefundResponse::class, self::METHOD_REFUND, function ($data, $formData) {
            return array_merge(
                $formData,
                ['DATA' => http_build_query(array_merge(['Password' => $this->_transport->getVmPassword()], $data), null, ';')]
            );
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
    public function unblock(UnblockCommand $command)
    {
        return $this->_transport->executeCommand($command, UnblockResponse::class, self::METHOD_UNBLOCK, function ($data, $formData) {
            $data = array_merge(
                $formData,
                $data,
                ['Password' => $this->_transport->getVmPassword()]
            );

            return $data;
        });
    }

    /**
     * @inheritdoc
     */
    public function charge(ChargeCommand $command)
    {
        return $this->_transport->executeCommand($command, ChargeResponse::class, self::METHOD_CHARGE, function ($data, $formData) {
            $data = array_merge(
                $formData,
                $data,
                ['Password' => $this->_transport->getVmPassword()]
            );

            return $data;
        });
    }
}