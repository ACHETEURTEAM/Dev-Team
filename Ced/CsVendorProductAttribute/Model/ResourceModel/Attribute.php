<?php

namespace Ced\CsVendorProductAttribute\Model\ResourceModel;

/**
 * Class Attribute
 * @package Ced\CsVendorProductAttribute\Model\ResourceModel
 */
class Attribute extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ced_vendor_product_attributes', 'id');
    }
}
