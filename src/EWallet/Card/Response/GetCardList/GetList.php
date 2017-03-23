<?php

namespace Necronru\Payture\EWallet\Card\Response\GetCardList;

use Necronru\Payture\EWallet\Payment\Response\BaseResponse;

/**
 * @link http://payture.com/integration/api/#ewallet_init_
 */
class GetList extends BaseResponse
{
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
}