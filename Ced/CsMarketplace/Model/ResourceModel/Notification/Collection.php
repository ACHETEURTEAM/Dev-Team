<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Notification;

/**
 * Class Collection
 * @package Ced\CsMarketplace\Model\ResourceModel\Notification
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @param $dataToUpdate
     * @param $condition
     */
    public function updateRecords($dataToUpdate, $condition)
    {
        $this->getConnection()->update($this->getTable('ced_csmarketplace_notification'), $dataToUpdate, $condition);
    }

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\Notification', 'Ced\CsMarketplace\Model\ResourceModel\Notification');
    }
}
