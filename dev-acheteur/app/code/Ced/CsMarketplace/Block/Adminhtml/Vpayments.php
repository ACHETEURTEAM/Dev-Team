<?php


namespace Ced\CsMarketplace\Block\Adminhtml;


use Ced\CsMarketplace\Model\Vpayment;

/**
 * Class Vpayments
 * @package Ced\CsMarketplace\Block\Adminhtml
 */
class Vpayments extends \Magento\Backend\Block\Widget\Container
{

    /**
     * @var string
     */
    protected $_template = 'vpayments/vpayments.phtml';

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
        $this->addButton('assign', array(
            'label' => __('Credit Amount'),
            'onclick' => "setLocation('" . $this->_getCreateUrl() . "')",
            'class' => 'primary',
        ));

        $this->setChild(
            'grid',
            $this->getLayout()->createBlock(
                \Ced\CsMarketplace\Block\Adminhtml\Vpayments\Grid::class,
                'ced.csmarketplace.vendor.payments.grid'
            )
        );
        return parent::_prepareLayout();
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
}
