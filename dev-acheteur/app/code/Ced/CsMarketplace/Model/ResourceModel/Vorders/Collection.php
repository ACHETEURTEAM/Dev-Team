<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Vorders;

/**
 * Class Collection
 * @package Ced\CsMarketplace\Model\ResourceModel\Vorders
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Prepare page's statuses.
     * Available event cms_page_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\Vorders', 'Ced\CsMarketplace\Model\ResourceModel\Vorders');
        //$this->_map['fields']['id'] = 'main_table.id';
    }
}
