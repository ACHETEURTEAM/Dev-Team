<?php

namespace Ced\VendorsocialLogin\Block\Facebook;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magento\Customer\Model\Session;
use Ced\VendorsocialLogin\Model\Facebook\Oauth2\Client;

class Button extends Template
{
    protected $_registry;
    protected $_clientFacebook;
    protected $_customerSession;
    protected $userInfo = null;

    public function __construct(
        Client $clientFacebook,
        Registry $registry,
        Session $customerSession,
        Template\Context $context,
        array $data = []
    ) {
        $this->_clientFacebook = $clientFacebook;
        $this->_registry = $registry;
        $this->_customerSession = $customerSession;
        $this->userInfo = $this->_registry->registry('ced_sociallogin_facebook_userdetails');
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->_customerSession->setFacebookCsrf($csrf = hash('sha256', uniqid(rand(), true)));
        $this->_clientFacebook->setState($csrf);
    }

    public function getButtonText()
    {
        $userInfo = $this->_registry->registry('ced_sociallogin_userinfo');
        if (($userInfo === null) || !$userInfo->hasData()) {
            $text = $this->getData('button_text') ?: __('Connect');
        } else {
            $text = __('Disconnect');
        }
        return $text;
    }

    public function getButtonUrl()
    {
        return empty($this->userInfo) ? $this->_clientFacebook->createAuthUrl() : $this->getUrl('cedsociallogin/facebook/disconnect');
    }

    public function getButtonClass()
    {
        return empty($this->userInfo) ? "ced_fb_connect" : "ced_fb_disconnect";
    }

    public function getScope()
    {
        return $this->_clientFacebook->getScope();
    }

    public function getAppId()
    {
        return $this->_clientFacebook->getClientId();
    }

    public function getState()
    {
        return $this->_clientFacebook->getState();
    }
}
