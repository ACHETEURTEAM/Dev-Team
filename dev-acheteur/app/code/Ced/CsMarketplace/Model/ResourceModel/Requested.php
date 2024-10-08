<?php


namespace Ced\CsMarketplace\Model\ResourceModel;

/**
 * Class Requested
 * @package Ced\CsMarketplace\Model\ResourceModel
 */
class Requested extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Model Initialization
     */
    protected function _construct()
    {
        $this->_init('ced_csmarketplace_vendor_payments_requested', 'entity_id');
    }
}
