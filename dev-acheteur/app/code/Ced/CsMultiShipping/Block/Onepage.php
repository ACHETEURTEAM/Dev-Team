<?php


namespace Ced\CsMultiShipping\Block;

class Onepage extends \Magento\Checkout\Block\Onepage
{
    /**
     * @var \Ced\CsMultiShipping\Helper\Data
     */
    protected $csmultishippingHelper;

    /**
     * Onepage constructor.
     * @param \Ced\CsMultiShipping\Helper\Data $csmultishippingHelper
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param \Magento\Checkout\Model\CompositeConfigProvider $configProvider
     * @param array $layoutProcessors
     * @param array $data
     */
    public function __construct(
        \Ced\CsMultiShipping\Helper\Data $csmultishippingHelper,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Checkout\Model\CompositeConfigProvider $configProvider,
        array $layoutProcessors = [],
        array $data = []
    ) {
        $this->csmultishippingHelper = $csmultishippingHelper;
        parent::__construct($context, $formKey, $configProvider, $layoutProcessors, $data);
    }

    /**
     * @return array|bool|string|string[]
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }
        return \Zend_Json::encode($this->jsLayout);
    }
}
