<?php


namespace Ced\CsMarketplace\Model\ResourceModel;

/**
 * Class Vshop
 * @package Ced\CsMarketplace\Model\ResourceModel
 */
class Vshop extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ced_csmarketplace_vendor_shop', 'id');
    }
}
