<?php


namespace Necronru\Payture\EWallet\Notification;


use Necronru\Payture\EWallet\AbstractNotification;
use Symfony\Component\PropertyAccess\PropertyAccess;

class NotificationService implements NotificationServiceInterface
{
    /**
     * @inheritdoc
     */
    public function convert(array $data, $type = null, $defaultKey = 'Notification')
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        $type      = $type ? $type : $accessor->getValue($data, "[$defaultKey]");
        $className = sprintf('Necronru\\Payture\\EWallet\\Notification\\Command\\%s', $type);

        if (!class_exists($className)) {
            throw new \Exception(sprintf('Class %s doesn\'t exists.', $className));
        }

        /** @var AbstractNotification $notification */
        $notification = new $className;

        foreach ($data as $key => $value) {

            if ($key == 'Notification') {
                continue;
            }

            $notification->{$key} = $value;
        }

        return $notification;
    }
}