<?php

namespace Ced\CsVendorProductAttribute\Model\ResourceModel;

/**
 * Class Attributeset
 * @package Ced\CsVendorProductAttribute\Model\ResourceModel
 */
class Attributeset extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ced_vendor_attributes_set', 'id');
    }
}
