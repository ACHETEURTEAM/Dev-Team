<?php


namespace Ced\CsMarketplace\Model\ResourceModel;

/**
 * Class Vproducts
 * @package Ced\CsMarketplace\Model\ResourceModel
 */
class Vproducts extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ced_csmarketplace_vendor_products', 'id');
    }
}
