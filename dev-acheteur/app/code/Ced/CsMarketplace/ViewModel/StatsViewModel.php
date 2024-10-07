<?php



namespace Ced\CsMarketplace\ViewModel;

class StatsViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    /**
     * @var \Magento\Framework\Pricing\Helper\Data $pricingHelper
     */
    protected $pricingHelper;

    /**
     * @param \Magento\Framework\Pricing\Helper\Data $pricingHelper
     */
    public function __construct(
        \Magento\Framework\Pricing\Helper\Data $pricingHelper
    ) 
    {
        $this->pricingHelper = $pricingHelper;
    }

    /**
     * @return \Magento\Framework\Pricing\Helper\Data
     */
    public function getPricingHelper()
    {
        return $this->pricingHelper;
    }
}
