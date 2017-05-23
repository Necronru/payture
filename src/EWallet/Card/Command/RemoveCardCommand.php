<?php


namespace Necronru\Payture\EWallet\Card\Command;

/**
 * @link http://payture.com/integration/api/#ewallet_ewallet-cards_remove_
 */
class RemoveCardCommand
{
    /**
     * @var string
     */
    public $VWUserLgn;

    /**
     * @var string
     */
    public $VWUserPsw;

    /**
     * @var string
     */
    public $CardId;

    public function __construct($CardId, $VMUserLgn, $VMUserPsw)
    {
        $this->VWUserLgn = $VMUserLgn;
        $this->VWUserPsw = $VMUserPsw;
        $this->CardId = $CardId;
    }
}