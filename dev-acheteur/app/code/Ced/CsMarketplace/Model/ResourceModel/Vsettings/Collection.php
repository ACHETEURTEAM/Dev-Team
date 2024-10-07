<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Vsettings;

/**
 * Class Collection
 * @package Ced\CsMarketplace\Model\ResourceModel\Vsettings
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Model initialization
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\Vsettings', 'Ced\CsMarketplace\Model\ResourceModel\Vsettings');
    }
}

