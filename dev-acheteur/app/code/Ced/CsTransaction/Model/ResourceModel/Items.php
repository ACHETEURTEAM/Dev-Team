<?php


namespace Ced\CsTransaction\Model\ResourceModel;

class Items extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('ced_cstransaction_vorder_items', 'id');
    }
}
