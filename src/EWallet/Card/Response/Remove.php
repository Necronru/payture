<?php

namespace Necronru\Payture\EWallet\Card\Response;

use Necronru\Payture\EWallet\Response\AbstractResponse;

/**
 * @link http://payture.com/integration/api/#ewallet_init_
 */
class Remove extends AbstractResponse
{
    /**
     * Идентификатор Пользователя в системе Payture (Соответствует переданному в запросе)
     *
     * @var string
     */
    public $VWUserLgn;

    /**
     * 	Идентификатор карты в системе Payture (Соответствует переданному в запросе)
     *
     * @var string
     */
    public $CardId;

}