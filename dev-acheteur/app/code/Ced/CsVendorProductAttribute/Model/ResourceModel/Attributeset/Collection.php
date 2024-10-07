<?php

namespace Ced\CsVendorProductAttribute\Model\ResourceModel\Attributeset;

/**
 * Class Collection
 * @package Ced\CsVendorProductAttribute\Model\ResourceModel\Attributeset
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Ced\CsVendorProductAttribute\Model\Attributeset',
            'Ced\CsVendorProductAttribute\Model\ResourceModel\Attributeset');
    }
}
