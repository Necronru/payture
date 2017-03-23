<?php


namespace Necronru\Payture\EWallet\Card;

use Necronru\Payture\EWallet\Card\Command\GetCardListCommand;
use Necronru\Payture\EWallet\Card\Response\GetCardList\Item;
use Necronru\Payture\EWallet\Payment\Response\RefundResponse;
use Necronru\Payture\EWallet\EWalletTransport;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class CardService implements CardServiceInterface
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
    public function getList(GetCardListCommand $command)
    {
        return $this->_transport->executeCommand($command, RefundResponse::class, '/vwapi/GetList', null, function ($object, $data, PropertyAccessor $accessor) {
            $object->Item = array_map(function ($arr) use ($accessor) {

                $item = new Item();

                foreach ($accessor->getValue($arr, '[@attributes]') as $key => $value) {
                    $item->{$key} = $value;
                }

                return $item;

            }, (array)$accessor->getValue($data, '[Item]'));

            return $object;
        });
    }

    /**
     * @inheritdoc
     */
    public function add()
    {
        // TODO: Implement add() method.
    }

    /**
     * @inheritdoc
     */
    public function activate()
    {
        // TODO: Implement activate() method.
    }

    /**
     * @inheritdoc
     */
    public function remove()
    {
        // TODO: Implement remove() method.
    }
}