<?php


namespace Ced\CsMarketplace\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Themecss
 * @package Ced\CsMarketplace\Block
 */
class Themecss extends Template
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $themeColor = $this->_scopeConfig->getValue(
            'ced_csmarketplace/general/theme_color',
            ScopeInterface::SCOPE_STORE
        );
        $this->pageConfig->addPageAsset('css/seller-reg.css');
        $this->pageConfig->addPageAsset('css/color/' . $themeColor);
    }
}
