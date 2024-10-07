<?php



namespace Ced\CsVendorReview\Block\Adminhtml\Review\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('checkmodule_review_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Review Information'));
    }
}
