<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Bookmark;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Bookmark Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Ced\CsMarketplace\Model\Bookmark::class, \Ced\CsMarketplace\Model\ResourceModel\Bookmark::class);
    }
}
