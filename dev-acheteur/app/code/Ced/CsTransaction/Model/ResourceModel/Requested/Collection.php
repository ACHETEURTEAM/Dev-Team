<?php


namespace Ced\CsTransaction\Model\ResourceModel\Requested;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Ced\CsTransaction\Model\Requested::class,
            \Ced\CsTransaction\Model\ResourceModel\Requested::class
        );
    }
}
