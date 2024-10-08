<?php


namespace Ced\CsMarketplace\Block\Adminhtml;


/**
 * Class Vorders
 * @package Ced\CsMarketplace\Block\Adminhtml
 */
class Vorders extends \Magento\Backend\Block\Widget\Container
{

    /**
     * @var string
     */
    protected $_template = 'vorders/vorders.phtml';

    /**
     * Render grid
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }

    /**
     * Prepare button and grid
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        $this->setChild(
            'grid',
            $this->getLayout()
                ->createBlock(
                    'Ced\CsMarketplace\Block\Adminhtml\Vorders\Grid',
                    'ced.csmarketplace.vendor.order.grid'
                )
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
        return $this->getUrl('*/*/new');
    }
}
