<?php



namespace Ced\CsVendorReview\Model\ResourceModel\Review;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    public function _construct()
    {
        $this->_init(
            \Ced\CsVendorReview\Model\Review::class,
            \Ced\CsVendorReview\Model\ResourceModel\Review::class
        );
    }
}
