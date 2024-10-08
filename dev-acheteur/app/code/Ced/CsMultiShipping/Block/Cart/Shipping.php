<?php


namespace Ced\CsMultiShipping\Block\Cart;

class Shipping extends \Magento\Checkout\Block\Cart\Shipping
{
    /**
     * @var \Ced\CsMultiShipping\Helper\Data
     */
    protected $csmultishippingHelper;

    /**
     * Shipping constructor.
     * @param \Ced\CsMultiShipping\Helper\Data $csmultishippingHelper
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Checkout\Model\CompositeConfigProvider $configProvider
     * @param array $layoutProcessors
     * @param array $data
     */
    public function __construct(
        \Ced\CsMultiShipping\Helper\Data $csmultishippingHelper,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Checkout\Model\CompositeConfigProvider $configProvider,
        array $layoutProcessors = [],
        array $data = []
    ) {
        $this->csmultishippingHelper = $csmultishippingHelper;
        parent::__construct($context, $customerSession, $checkoutSession, $configProvider, $layoutProcessors, $data);
    }

    /**
     * @return array|string|string[]
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getJsLayout()
    {
        if ($this->csmultishippingHelper->isEnabled()) {
            return str_replace(
                "Magento_Checkout\/js\/view\/cart\/shipping-rates",
                "Ced_CsMultiShipping\/js/cart\/shipping-rates",
                parent::getJsLayout()
            );
        } else {
            return parent::getJsLayout();
        }
    }
}
