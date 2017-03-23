<?php


namespace Necronru\Payture\EWallet\Response;


class BaseResponse
{
    /**
     * Флаг успешности операции
     * "True" / "False"
     *
     * @var string
     */
    public $Success;

    /**
     * Код ошибки.
     * Передается, если «Success=False»
     *
     * @var string
     * @see \Necronru\Payture\Enum\ErrorCode
     */
    public $ErrCode;

}