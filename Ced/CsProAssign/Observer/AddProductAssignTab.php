<?php


namespace Ced\CsProAssign\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\Http;

/**
 * Class AddProductAssignTab
 * @package Ced\CsProAssign\Observer
 */
Class AddProductAssignTab implements ObserverInterface
{
    const VENDOR_EDIT_ACTION = 'edit';
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Framework\View\Element\Context
     */
    protected $context;

    /**
     * AddProductAssignTab constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\View\Element\Context $context
     */
    private $_request;
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Element\Context $context,
        Http $request
    )
    {
        $this->_scopeConfig = $scopeConfig;
        $this->context = $context;
        $this->_request = $request;
    }

    /**
     *Product Assignment Tab
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->_scopeConfig->getValue('ced_csmarketplace/general/csproassignactivation',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE) &&
            $this->_request->getParam('vendor_id') &&
            $this->_request->getActionName()==self::VENDOR_EDIT_ACTION
            ) {
            $block = $observer->getEvent()->getTabs();
            $block->removeTab('vproducts');
            $block->addTab(
                'assign_product', array(
                    'label' => __('Vendor Products'),
                    'title' => __('Vendor Products'),
                    'after' => 'payment_details',
                    'content' => $this->context->getLayout()->createBlock('Ced\CsProAssign\Block\Adminhtml\AddPro')->toHtml() . $this->context->getLayout()->createBlock('Ced\CsProAssign\Block\Adminhtml\Vendor\Products\Grid')->toHtml(),
                )
            );
        }
    }
}

