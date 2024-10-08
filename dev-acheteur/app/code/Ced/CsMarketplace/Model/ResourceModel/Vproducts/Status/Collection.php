<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Vproducts\Status;

/**
 * Class Collection
 * @package Ced\CsMarketplace\Model\ResourceModel\Vproducts\Status
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\Vproducts\Status',
            'Ced\CsMarketplace\Model\ResourceModel\Vproducts\Status');
    }
}
