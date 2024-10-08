<?php


namespace Ced\CsOrder\Model\ResourceModel\Shipment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Ced\CsOrder\Model\Shipment::class,
            \Ced\CsOrder\Model\ResourceModel\Shipment::class
        );
    }
}
