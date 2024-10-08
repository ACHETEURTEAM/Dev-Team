<?php



namespace Ced\CsVendorReview\Block\Adminhtml;

class Review extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        parent::_construct();
        $this->_controller = 'adminhtml_review';
        $this->_blockGroup = 'Ced_CsVendorReview';
        $this->_headerText = __('Manage Vendor Review');
        $this->removeButton('add');
    }
}
