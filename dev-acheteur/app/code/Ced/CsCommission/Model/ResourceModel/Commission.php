<?php

namespace Ced\CsCommission\Model\ResourceModel;

class Commission extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('cscommission_commission', 'id');
    }
}
