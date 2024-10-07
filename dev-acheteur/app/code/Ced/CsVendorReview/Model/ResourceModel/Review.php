<?php




namespace Ced\CsVendorReview\Model\ResourceModel;

class Review extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function _construct()
    {
        $this->_init('ced_csvendorreview_review', 'id');
    }
}
