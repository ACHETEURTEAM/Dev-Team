<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Vshop;

/**
 * Class Collection
 * @package Ced\CsMarketplace\Model\ResourceModel\Vshop
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\Vshop', 'Ced\CsMarketplace\Model\ResourceModel\Vshop');
    }
}
