<?php

namespace Ced\CsVendorProductAttribute\Block\Product\Attribute\Set\Toolbar;

/**
 * Class Main
 * @package Ced\CsVendorProductAttribute\Block\Product\Attribute\Set\Toolbar
 */
class Main extends \Magento\Backend\Block\Template
{
    /**
     * @var string
     */
    protected $_template = 'Magento_Catalog::catalog/product/attribute/set/toolbar/main.phtml';

    public function _construct()
    {
        parent::_construct();
        $this->setData('area','adminhtml');
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        $this->getToolbar()->addChild(
            'addButton',
            'Magento\Backend\Block\Widget\Button',
            [
                'label' => __('Add Attribute Set'),
                'onclick' => 'setLocation(\'' . $this->getUrl('csvendorproductattribute/*/add') . '\')',
                'class' => 'add primary add-set',
                'area' => 'adminhtml'
            ]
        );
        return parent::_prepareLayout();
    }

    /**
     * @return string
     */
    public function getNewButtonHtml()
    {
        return $this->getChildHtml('addButton');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    protected function _getHeader()
    {
        return __('Attribute Sets');
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        $this->_eventManager->dispatch(
            'adminhtml_catalog_product_attribute_set_toolbar_main_html_before',
            ['block' => $this]
        );
        return parent::_toHtml();
    }
}
