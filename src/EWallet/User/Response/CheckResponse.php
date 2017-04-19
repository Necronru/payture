<?php


namespace Necronru\Payture\EWallet\User\Response;


use Necronru\Payture\EWallet\Response\AbstractResponse;

class CheckResponse extends AbstractResponse
{
    /**
     * Идентификатор Пользователя в системе Payture. Рекомендуется использовать e-mail.
     * Соответствует переданному в запросе.
     *
     * @var string
     */
    public $VWUserLgn;
}