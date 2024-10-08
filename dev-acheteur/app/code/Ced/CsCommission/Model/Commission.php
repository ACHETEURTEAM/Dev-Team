<?php


namespace Ced\CsCommission\Model;

class Commission extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(\Ced\CsCommission\Model\ResourceModel\Commission::class);
    }
}
