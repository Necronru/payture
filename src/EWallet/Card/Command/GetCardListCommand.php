<?php


namespace Necronru\Payture\EWallet\Card\Command;

/**
 * @link http://payture.com/integration/api/#ewallet_init_
 */
class GetCardListCommand
{
    public $VWUserLgn;
    public $VWUserPsw;

    public function __construct($VMUserLgn, $VMUserPsw)
    {
        $this->VWUserLgn = $VMUserLgn;
        $this->VWUserPsw = $VMUserPsw;
    }
}