<?php


namespace Ced\CsMarketplace\Block\Adminhtml;


/**
 * Class Vproducts
 * @package Ced\CsMarketplace\Block\Adminhtml
 */
class Vproducts extends \Magento\Backend\Block\Widget\Container
{

    /**
     * @var string
     */
    protected $_template = 'vproducts/vproducts.phtml';

    /**
     * Prepare button and grid
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('Ced\CsMarketplace\Block\Adminhtml\Vproducts\Grid',
                'ced.csmarketplace.vendor.products.grid')
        );
        return parent::_prepareLayout();
    }

    /**
     * @return array
     */
    protected function _getAddButtonOptions()
    {
        $splitButtonOptions[] = [
            'label' => __('Add New'),
            'onclick' => "setLocation('" . $this->_getCreateUrl() . "')"
        ];

        return $splitButtonOptions;
    }

    /**
     * @return string
     */
    protected function _getCreateUrl()
    {
        return $this->getUrl(
            '*/*/new'
        );
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
