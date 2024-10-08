<?php


namespace Ced\CsMarketplace\Model\Indexer;

/**
 * Class FlatCategory
 * @package Ced\CsMarketplace\Model\Indexer
 */

class FlatCategory extends \Magento\Catalog\Model\Indexer\Category\Flat\State
{
    /**
     * FlatCategory constructor.
     * @param \Magento\Framework\App\Request\Http $http
     * @param \Magento\Framework\App\State $state
     */
    protected $state;
    protected $http;
    public function __construct(
        \Magento\Framework\App\Request\Http $http,
        \Magento\Framework\App\State $state
    ){
        $this->state = $state;
        $this->http = $http;
    }

    /**
     * @return bool
     */
    public function isFlatEnabled()
    {
        $module = $this->http->getModuleName();
        $controller = $this->http->getControllerName();
        if(($this->state->getAreaCode()=='adminhtml' && $module == 'csmarketplace') || ($module == 'csproduct' && $controller == 'vproducts') || ($module == 'csmarketplace' && $controller == 'vproducts') ||
            ($module =='csmarketplace' && $controller == 'vshops')|| ($module == "cscmspage") || ($module == "cscategorymap")) {
            return false;
        }
    }

}
