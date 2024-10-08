<?php


namespace Ced\CsTransaction\Model;

use Magento\Framework\Model\AbstractModel;

class Requested extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(\Ced\CsTransaction\Model\ResourceModel\Requested::class);
    }
}
