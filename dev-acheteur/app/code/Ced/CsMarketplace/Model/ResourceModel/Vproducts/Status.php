<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Vproducts;

/**
 * Class Status
 * @package Ced\CsMarketplace\Model\ResourceModel\Vproducts
 */
class Status extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ced_csmarketplace_vendor_products_status', 'id');
    }
}
