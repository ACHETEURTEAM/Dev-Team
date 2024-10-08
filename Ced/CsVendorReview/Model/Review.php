<?php



namespace Ced\CsVendorReview\Model;

use Magento\Framework\Exception\ReviewException;

class Review extends \Magento\Framework\Model\AbstractModel
{

    public function _construct()
    {
        $this->_init(\Ced\CsVendorReview\Model\ResourceModel\Review::class);
    }
}
