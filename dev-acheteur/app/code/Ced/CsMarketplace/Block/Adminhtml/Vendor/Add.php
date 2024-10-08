<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vendor;


use Magento\Backend\Block\Widget\Container;
use Magento\Backend\Block\Widget\Context;

/**
 * Class Add
 * @package Ced\CsMarketplace\Block\Adminhtml\Vendor
 */
class Add extends Container
{

    /**
     * @var string
     */
    protected $_template = 'vendor/vendor.phtml';

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->getAddButtonOptions();
    }

    /**
     * Prepare button and grid
     *
     * @return \Magento\Catalog\Block\Adminhtml\Product
     */
    protected function _prepareLayout()
    {
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('Ced\CsMarketplace\Block\Adminhtml\Vendor\Add\Grid',
                'ced.marketplace.vendor.add.entity')
        );
        return parent::_prepareLayout();
    }

    /**
     * @return void
     */
    protected function getAddButtonOptions()
    {
        $splitButtonOptions = [
            'label' => __('Add New Customer'),
            'class' => 'primary',
            'onclick' => "setLocation('" . $this->_getCreateUrl() . "')"
        ];
        $this->buttonList->add('add', $splitButtonOptions);
    }

    /**
     * @return string
     */
    protected function _getCreateUrl()
    {
        return $this->getUrl('customer/index/new/ced_vendor/1' );
    }

    /**
     * Render grid
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}
