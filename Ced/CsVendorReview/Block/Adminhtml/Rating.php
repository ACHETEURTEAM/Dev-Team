<?php



namespace Ced\CsVendorReview\Block\Adminhtml;

class Rating extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_rating';
        $this->_blockGroup = 'Ced_CsVendorReview';
        $this->_headerText = __('Rating');
        $this->_addButtonLabel = __('Add New');
        parent::_construct();
    }
}
