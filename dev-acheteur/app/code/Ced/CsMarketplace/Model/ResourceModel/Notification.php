<?php


namespace Ced\CsMarketplace\Model\ResourceModel;

/**
 * Class Notification
 * @package Ced\CsMarketplace\Model\ResourceModel
 */
class Notification extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ced_csmarketplace_notification', 'id');
    }
}
