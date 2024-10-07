<?php


namespace Ced\CsTransaction\Model\ResourceModel\Items;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init(
            \Ced\CsTransaction\Model\Items::class,
            \Ced\CsTransaction\Model\ResourceModel\Items::class
        );
    }
}
