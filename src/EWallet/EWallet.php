<?php


namespace Necronru\Payture\EWallet;


use GuzzleHttp\ClientInterface;
use Necronru\Payture\Abstraction\EWalletInterface;

class EWallet implements EWalletInterface
{
    /**
     * @var string
     */
    private $vmId;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * EWallet constructor.
     * @param ClientInterface $client
     * @param string $vmId - Идентификатор Продавца. Выдается Продавцу с параметрами тестового/боевого доступа
     */
    public function __construct(ClientInterface $client, $vmId)
    {
        $this->vmId = $vmId;
        $this->client = $client;
    }
}