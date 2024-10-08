<?php


namespace Ced\CsOrder\Model\ResourceModel\Invoice;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Ced\CsOrder\Model\Invoice::class,
            \Ced\CsOrder\Model\ResourceModel\Invoice::class
        );
    }
}
