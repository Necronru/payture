<?php


namespace Necronru\Payture\EWallet\Card;


use Necronru\Payture\EWallet\Card\Command\GetCardListCommand;
use Necronru\Payture\EWallet\Card\Command\RemoveCardCommand;
use Necronru\Payture\EWallet\Card\Response\Remove;

interface CardServiceInterface
{
    /**
     * @param GetCardListCommand $command
     * @return \Necronru\Payture\EWallet\Card\Response\GetCardList\GetList
     *
     * @link http://payture.com/integration/api/#ewallet_ewallet-cards_getlist_
     */
    public function getList(GetCardListCommand $command);

    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-cards_add_
     */
    public function add();

    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-cards_activate_
     */
    public function activate();

    /**
     * @link http://payture.com/integration/api/#ewallet_ewallet-cards_remove_
     * @param RemoveCardCommand $command
     * @return Remove
     */
    public function remove(RemoveCardCommand $command);

    /**
     * @param $sessionId
     */
    public function getSessionLink($sessionId);

}