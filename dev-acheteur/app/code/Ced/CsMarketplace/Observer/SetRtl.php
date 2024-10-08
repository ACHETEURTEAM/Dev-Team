<?php


namespace Ced\CsMarketplace\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class SetRtl
 * @package Ced\CsMarketplace\Observer
 */
Class SetRtl implements ObserverInterface
{

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Framework\View\Page\Config
     */
    private $_pageConfig;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $_request;

    /**
     * SetRtl constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\View\Page\Config $pageConfig
     * @param \Magento\Framework\App\Request\Http $request
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Page\Config $pageConfig,
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_pageConfig = $pageConfig;
        $this->_request = $request;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        if (!$this->_request->isXmlHttpRequest()) {
            if ($this->_scopeConfig->getValue('ced_csmarketplace/general/rtl_active', ScopeInterface::SCOPE_STORE)) {
                $this->_pageConfig->addBodyClass('rtl-is-active');
            }
        }
    }
}
