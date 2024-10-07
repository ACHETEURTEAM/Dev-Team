<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Vpayment;

/**
 * Class Collection
 * @package Ced\CsMarketplace\Model\ResourceModel\Vpayment
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Model initialization
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\Vpayment', 'Ced\CsMarketplace\Model\ResourceModel\Vpayment');
    }
}
