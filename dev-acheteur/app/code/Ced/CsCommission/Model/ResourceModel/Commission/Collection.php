<?php


namespace Ced\CsCommission\Model\ResourceModel\Commission;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            \Ced\CsCommission\Model\Commission::class,
            \Ced\CsCommission\Model\ResourceModel\Commission::class
        );
    }
}
