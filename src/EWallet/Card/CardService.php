<?php


namespace Necronru\Payture\EWallet\Card;

use Necronru\Payture\EWallet\Card\Command\GetCardListCommand;
use Necronru\Payture\EWallet\Card\Command\RemoveCardCommand;
use Necronru\Payture\EWallet\Card\Response\GetCardList\Item;
use Necronru\Payture\EWallet\Card\Response\Remove;
use Necronru\Payture\EWallet\EWalletTransport;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Necronru\Payture\EWallet\Card\Response\GetCardList\GetList;

class CardService implements CardServiceInterface
{
    const METHOD_ADD = '/vwapi/Add';
    const METHOD_REMOVE = '/vwapi/Remove';
    const METHOD_GET_LIST = '/vwapi/GetList';
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
        return $this->_transport->executeCommand($command, GetList::class, self::METHOD_GET_LIST, null, function ($object, $data, PropertyAccessor $accessor) {
            
            if (!!$accessor->getValue($data, '[Item][@attributes]')) {
                $Item = (array) [$accessor->getValue($data, '[Item][@attributes]')];
            } else {
                $Item = array_map(function($arr) use ($accessor) {
                    return $accessor->getValue($arr, '[@attributes]');
                }, (array) $accessor->getValue($data, '[Item]'));
            }

            $object->Item = array_map(function ($list) use ($accessor) {

                $item = new Item();

                foreach ($list as $key => $value) {
                    $item->{$key} = $value;
                }

                return $item;

            }, $Item);

            return $object;
        });
    }

    /**
     * @inheritdoc
     */
    public function getSessionLink($sessionId, $host = true)
    {
        return ($host ? $this->_transport->getClient()->getConfig('base_uri') : '')
            . self::METHOD_ADD
            . '?'
            . http_build_query([
                'SessionId' => $sessionId
            ])
            ;
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
    public function remove(RemoveCardCommand $command)
    {
        return $this->_transport->executeCommand($command, Remove::class, self::METHOD_REMOVE);
    }
}