<?php


namespace Ced\CsVendorProductAttribute\Model\ResourceModel\Attribute;

/**
 * Class Collection
 * @package Ced\CsVendorProductAttribute\Model\ResourceModel\Attribute
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected function _construct()
    {
        $this->_init('Ced\CsVendorProductAttribute\Model\Attribute',
            'Ced\CsVendorProductAttribute\Model\ResourceModel\Attribute');
    }
}
