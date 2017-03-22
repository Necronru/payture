<?php


namespace Necronru\Payture\EWallet\Command;

/**
 * @link http://payture.com/integration/api/#ewallet_init_
 */
class InitCommand
{
    /**
     * @var string
     *
     * @see \Necronru\Payture\EWallet\Enum\SessionType
     */
    public $SessionType;

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
    public $IP;

    /**
     * @var null|string
     */
    public $OrderId;

    /**
     * @var null|float
     */
    public $Amount;

    /**
     * @var null
     */
    public $PhoneNumber;

    /**
     * @var null
     */
    public $CardId;

    /**
     * @var null
     */
    public $TemplateTag;

    /**
     * @var null
     */
    public $Language;

    public function __construct(
        $SessionType,
        $VWUserLgn,
        $VWUserPsw,
        $IP,
        $OrderId = null,
        $Amount = null,
        $PhoneNumber = null,
        $CardId = null,
        $TemplateTag = null,
        $Language = null
    )
    {
        $this->SessionType = $SessionType;
        $this->VWUserLgn = $VWUserLgn;
        $this->VWUserPsw = $VWUserPsw;
        $this->IP = $IP;
        $this->OrderId = $OrderId;
        $this->Amount = $Amount;
        $this->PhoneNumber = $PhoneNumber;
        $this->CardId = $CardId;
        $this->TemplateTag = $TemplateTag;
        $this->Language = $Language;
    }


}