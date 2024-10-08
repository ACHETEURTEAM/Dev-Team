<?php

namespace Ced\VendorsocialLogin\Block\Container;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Login extends Template
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * Check if Google login is enabled
     *
     * @return bool
     */
    public function googleEnabled()
    {
        return $this->scopeConfig->isSetFlag('vendorsociallogin/general/google_enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check if Facebook login is enabled
     *
     * @return bool
     */
    public function facebookEnabled()
    {
        return $this->scopeConfig->isSetFlag('vendorsociallogin/general/facebook_enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check if Twitter login is enabled
     *
     * @return bool
     */
    public function twitterEnabled()
    {
        return $this->scopeConfig->isSetFlag('vendorsociallogin/general/twitter_enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check if LinkedIn login is enabled
     *
     * @return bool
     */
    public function linkedinEnabled()
    {
        return $this->scopeConfig->isSetFlag('vendorsociallogin/general/linkedin_enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get collection of enabled social logins
     *
     * @return array
     */
    public function _getColSet() // Change visibility to public
    {
        return [
            'google' => $this->googleEnabled(),
            'facebook' => $this->facebookEnabled(),
            'twitter' => $this->twitterEnabled(),
            'linkedin' => $this->linkedinEnabled(),
        ];
    }
}
