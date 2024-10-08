<?php


namespace Ced\CsOrder\Model\ResourceModel;

class Creditmemo extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ced_csorder_creditmemo', 'id');
    }
}
