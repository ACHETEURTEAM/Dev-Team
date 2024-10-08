<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vpayments;


use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;

/**
 * Class Details
 * @package Ced\CsMarketplace\Block\Adminhtml\Vpayments
 */
class Details extends Container
{

    /**
     * Details constructor.
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context, array $data = [])
    {
        $this->_controller = '';
        parent::__construct($context, $data);
        $this->_headerText = __('Transaction Details');
        $this->removeButton('reset')
            ->removeButton('delete')
            ->removeButton('save');
    }

    /**
     * Initialize form
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->setChild('form',
            $this->getLayout()->createBlock('Ced\CsMarketplace\Block\Adminhtml\Vpayments\Details\Form'));
        return $this;
    }
}