<?php


namespace Necronru\Payture\EWallet\Notification;


use Necronru\Payture\EWallet\AbstractNotification;

interface NotificationServiceInterface
{
    /**
     * @param array $data
     * @return AbstractNotification
     */
    public function convert(array $data);
}