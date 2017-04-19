<?php


namespace Necronru\Payture\EWallet\User\Response;


use Necronru\Payture\EWallet\Response\AbstractResponse;

class DeleteResponse extends AbstractResponse
{
    /**
     * Идентификатор Пользователя в системе Payture
     * Соответствует переданному в запросе
     *
     * @var string
     */
    public $VWUserLgn;
}