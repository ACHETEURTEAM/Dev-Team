<?php


namespace Ced\CsTransaction\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Requested extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('ced_csmarketplace_vendor_payments_requested', 'entity_id');
    }
}
