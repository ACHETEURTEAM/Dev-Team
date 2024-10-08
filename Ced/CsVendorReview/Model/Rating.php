<?php



namespace Ced\CsVendorReview\Model;

use Magento\Framework\Exception\RatingException;

class Rating extends \Magento\Framework\Model\AbstractModel
{

    public function _construct()
    {
        $this->_init(\Ced\CsVendorReview\Model\ResourceModel\Rating::class);
    }
}
