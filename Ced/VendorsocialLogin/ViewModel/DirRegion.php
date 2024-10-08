<?php


namespace Ced\VendorsocialLogin\ViewModel;

/**
 * Class DirRegion
 * @package Ced\VendorsocialLogin\ViewModel
 */
class DirRegion implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    /**
     * @var \Magento\Directory\Helper\Data
     */
    private $helperData;
    /**
     * Google constructor.
     * @param \\Magento\Directory\Helper\Data $helperData
     */
    public function __construct(
        \Magento\Directory\Helper\Data $helperData
    ) {
        $this->helperData= $helperData;
    }
    public function getDirRegion()
    {
        return $this->helperData>getRegionJson();
    }
    public function getCountriesWithOptionalZip()
    {
        return $this->helperData>getCountriesWithOptionalZip(true);
    }
    
}
