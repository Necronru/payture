<?php

namespace Necronru\Payture\EWallet\Card\Response\GetCardList;

class Item
{
    /**
     * @var string
     */
    public $CardName;

    /**
     * @var string
     */
    public $CardId;

    /**
     * @var string
     */
    public $CardHolder;

    /**
     * @var string
     */
    public $Status;

    /**
     * @var string
     */
    public $NoCVV;

    /**
     * @var string
     */
    public $Expired;

}