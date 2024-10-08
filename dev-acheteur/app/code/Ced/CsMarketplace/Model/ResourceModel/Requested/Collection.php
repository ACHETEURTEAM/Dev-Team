<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Requested;

/**
 * Class Collection
 * @package Ced\CsMarketplace\Model\ResourceModel\Requested
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Model initialization
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\Vpayment\Requested', 'Ced\CsMarketplace\Model\ResourceModel\Requested');
    }
}

