<?php


namespace Ced\CsMarketplace\Model;

/**
 * Class NotificationHandler
 * @package Ced\CsMarketplace\Model
 */
class NotificationHandler
{

    /**
     * @var array $params
     */
    private $notificationList;

    /**
     * @param array $notificationList
     */
    public function __construct(
        array $notificationList = []
    ) {

        $this->notificationList = $notificationList;
    }

    /**
     * @return array
     */
    public function getNotifications()
    {
        $notifications = [];

        foreach ($this->notificationList as $notification) {
            $notifications = array_merge($notification->getNotifications(), $notifications);
        }
        return $notifications;
    }
}
