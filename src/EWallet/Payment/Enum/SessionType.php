<?php


namespace Necronru\Payture\EWallet\Payment\Enum;


use Necronru\Payture\Abstraction\AbstractEnum;

/**
 * Class SessionType
 * @package Necronru\EWallet\Enum
 *
 * @link http://payture.com/integration/api/#ewallet_init_
 */
class SessionType extends AbstractEnum
{
    /**
     * Регистрация карты
     */
    const ADD = 'Add';

    /**
     * Одностадийный платеж
     */
    const PAY = 'Pay';

    /**
     * Двухстадийный платеж
     */
    const BLOCK = 'Block';

}