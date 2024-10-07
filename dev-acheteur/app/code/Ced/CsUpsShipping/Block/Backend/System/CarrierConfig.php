<?php


namespace Ced\CsUpsShipping\Block\Backend\System;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context as TemplateContext;
use Magento\Store\Model\Website;
use Magento\Ups\Helper\Config as ConfigHelper;

/**
 * Backend shipping UPS content block
 */
class CarrierConfig extends Template
{
    /**
     * Shipping carrier config
     *
     * @var \Magento\Ups\Helper\Config
     */
    protected $carrierConfig;

    /**
     * @var \Magento\Store\Model\Website
     */
    protected $_websiteModel;

    const XML_PATH_TEMPLATE_ALLOW_SYMLINK = 'dev/template/allow_symlink';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public $_scopeConfig;

    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template;

    /**
     * CarrierConfig constructor.
     * @param ConfigHelper $carrierConfig
     * @param Website $websiteModel
     * @param TemplateContext $context
     * @param array $data
     */
    public function __construct(
        ConfigHelper $carrierConfig,
        Website $websiteModel,
        TemplateContext $context,
        array $data = []
    )
    {
        $this->_scopeConfig = $context->getScopeConfig();
        $this->carrierConfig = $carrierConfig;
        $this->_websiteModel = $websiteModel;
        parent::__construct($context, $data);
    }

    /**
     * Get shipping model
     *
     * @return \Magento\Ups\Helper\Config
     */
    public function getCarrierConfig()
    {
        return $this->carrierConfig;
    }

    /**
     * Get website model
     *
     * @return \Magento\Store\Model\Website
     */
    public function getWebsiteModel()
    {
        return $this->_websiteModel;
    }

    /**
     * Get store config
     *
     * @param string $path
     * @param mixed $store
     * @return mixed
     */
    public function getConfig($path, $store = null)
    {
        return $this->_scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $store);
    }
}
