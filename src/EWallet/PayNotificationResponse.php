<?php


namespace Necronru\EWallet;


use Necronru\Payture\Abstraction\AbstractEnum;

/**
 * Class PayNotificationResponse
 * @package Necronru\EWallet
 *
 * http://payture.com/integration/api/#notifications_
 */
class PayNotificationResponse extends AbstractEnum
{

    const ENGINE_BLOCK_SUCCESS  = 'EngineBlockSuccess';
    const ENGINE_BLOCK_FAIL     = 'EngineBlockFail';

    const ENGINE_PAY_SUCCESS    = 'EnginePaySuccess';
    const ENGINE_PAY_FAIL       = 'EnginePayFail';

    const ENGINE_CHARGE_SUCCESS = 'EngineChargeSuccess';
    const ENGINE_CHARGE_FAIL    = 'EngineChargeFail';

    const CUSTOMER_PAY_SUCCESS  = 'CustomerPaySuccess';
    const CUSTOMER_PAY_FAIL     = 'CustomerPayFail';
}