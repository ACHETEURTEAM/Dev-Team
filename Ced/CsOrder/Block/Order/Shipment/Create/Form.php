<?php


namespace Ced\CsOrder\Block\Order\Shipment\Create;

class Form extends \Magento\Shipping\Block\Adminhtml\Create\Form
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Form constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Admin $adminHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Admin $adminHelper,
        array $data = []
    ) {
        $this->registry = $registry;
        parent::__construct($context, $registry, $adminHelper, $data);
    }

    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('csorder/*/save', ['_current' => true]);
    }

    /**
     * @return \Magento\Framework\Registry
     */
    public function getRegistry()
    {
        return $this->registry;
    }
}
