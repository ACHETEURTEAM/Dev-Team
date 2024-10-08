<?php


namespace Ced\CsMultiShipping\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;

class Vendorrates extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'vendor_rates';

    /**
     * @var bool
     */
    protected $_isFixed = true;

    /**
     * @param RateRequest $request
     * @return false
     */
    public function collectRates(RateRequest $request)
    {
        return false;
    }

    /**
     * @return array
     */
    public function getAllowedMethods()
    {
        return ['vendor_rates'=>$this->getConfigData('name')];
    }
}
