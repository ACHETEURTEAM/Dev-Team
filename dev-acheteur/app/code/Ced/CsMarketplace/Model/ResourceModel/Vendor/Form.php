<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Vendor;

/**
 * Class Form
 * @package Ced\CsMarketplace\Model\ResourceModel\Vendor
 */
class Form extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ced_csmarketplace_vendor_form_attribute', 'id');
    }
}
