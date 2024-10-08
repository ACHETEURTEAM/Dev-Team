<?php


namespace Ced\CsMarketplace\Plugin;

/**
 * Class SetVendorPanel
 * @package Ced\CsMarketplace\Plugin
 */
class SetVendorPanel
{

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public $_scopeConfig;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * SetVendorPanel constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Registry $registry
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_coreRegistry = $registry;
    }

    /**
     * @param $subject
     * @param $result
     * @return mixed
     */
    public function afterGetConfigurationDesignTheme($subject, $result)
    {
        if ($this->_coreRegistry->registry('vendorPanel')) {
            $result = $this->_scopeConfig->getValue('ced_csmarketplace/vendor/theme');
        }
        return $result;
    }
}
