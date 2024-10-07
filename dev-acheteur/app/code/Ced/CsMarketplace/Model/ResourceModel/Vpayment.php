<?php


namespace Ced\CsMarketplace\Model\ResourceModel;

/**
 * Class Vpayment
 * @package Ced\CsMarketplace\Model\ResourceModel
 */
class Vpayment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Model Initialization
     */
    protected function _construct()
    {
        $this->_init('ced_csmarketplace_vendor_payments', 'entity_id');
    }
}
