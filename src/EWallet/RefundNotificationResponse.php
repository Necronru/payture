<?php


namespace Necronru\EWallet;


use Necronru\Payture\Abstraction\AbstractEnum;

/**
 * Class RefundNotificationResponse
 * @package Necronru\EWallet
 *
 * @link http://payture.com/integration/api/#notifications_
 */
class RefundNotificationResponse extends AbstractEnum
{

    const CUSTOMER_REFUND_SUCCESS   = 'CustomerRefundSuccess';
    const CUSTOMER_REFUND_FAIL      = 'CustomerRefundFail';

    const ENGINE_REFUND_SUCCESS     = 'EngineRefundSuccess';
    const ENGINE_REFUND_FAIL        = 'EngineRefundFail';
}