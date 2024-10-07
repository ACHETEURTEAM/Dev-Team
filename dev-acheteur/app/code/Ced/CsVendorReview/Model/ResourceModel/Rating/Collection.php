<?php



namespace Ced\CsVendorReview\Model\ResourceModel\Rating;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    public function _construct()
    {
        $this->_init(
            \Ced\CsVendorReview\Model\Rating::class,
            \Ced\CsVendorReview\Model\ResourceModel\Rating::class
        );
    }
}
