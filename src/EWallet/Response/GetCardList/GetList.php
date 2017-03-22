<?php
namespace Necronru\Payture\EWallet\Response\GetCardList;

/**
 * @link http://payture.com/integration/api/#ewallet_init_
 */
class GetList
{
    /**
     * Флаг успешности операции
     *
     * @var boolean
     */
    public $Success;

    /**
     * Идентификатор Пользователя в системе Payture    Соответствует переданному в запросе
     *
     * @var string
     */
    public $VWUserLgn;

    /**
     * Передается, если «Success=True»
     *
     * @var Item[]
     */
    public $Item = [];

    /**
     * Код ошибки. Передается, если «Success=False»
     *
     * @var string
     */
    public $ErrCode;
}