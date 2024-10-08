<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Vshop;

/**
 * Class Flatcatalog
 * @package Ced\CsMarketplace\Model\ResourceModel\Vshop
 */
class Flatcatalog
{
    /**
     * Flatcatalog constructor.
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
     * @param $subject
     * @param callable $proceed
     * @return bool
     */
    public function aroundIsEnabledFlat($subject,callable $proceed)
    {
        $module = $this->http->getModuleName();
        $controller = $this->http->getControllerName();

        if(($module == 'csproduct' && $controller == 'vproducts') || ($module == 'csmarketplace' && $controller == 'vproducts') ||
            ($module =='csmarketplace' && $controller == 'vshops')|| ($module == "cscmspage") || ($module == "cscategorymap")) {

            return false;
        }
        $returnValue = $proceed();
    }
}
