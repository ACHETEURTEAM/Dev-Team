<?php


namespace Ced\CsProduct\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\ScopeInterface;

class SetRtl implements ObserverInterface
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
     * @var \Magento\Framework\Registry
     */
    private $_registry;

    /**
     * SetRtl constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\View\Page\Config $pageConfig
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Request\Http $request
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Page\Config $pageConfig,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_registry = $registry;
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
            $currentStore = $this->_registry->registry('current_store_data');
            if ($currentStore) {
                if ($this->_scopeConfig->getValue(
                    'ced_csmarketplace/general/rtl_active',
                    ScopeInterface::SCOPE_STORE,
                    $currentStore->getStoreId()
                )) {
                    $this->_pageConfig->addBodyClass('rtl-is-active');
                }
            }
        }
    }
}
