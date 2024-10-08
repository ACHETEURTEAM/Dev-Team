<?php


namespace Ced\CsOrder\Block\Order;

class AbstractOrder extends \Magento\Sales\Block\Adminhtml\Order\AbstractOrder
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * AbstractOrder constructor.
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
     * Retrieve available order
     * @return Order
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getvOrder()
    {
        $vorder = $this->registry->registry('current_vorder');
        if ($order = $vorder->getOrder(false, true)) {
            return $order;
        }
        throw new \Magento\Framework\Exception\LocalizedException(__('We can\'t get the order instance right now.'));
    }

    /**
     * Retrieve available order
     * @return Order
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getOrder()
    {
        if ($this->hasOrder()) {
            return $this->getData('order');
        }
        if ($this->_coreRegistry->registry('current_order')) {
            return $this->_coreRegistry->registry('current_order');
        }
        if ($this->_coreRegistry->registry('order')) {
            return $this->_coreRegistry->registry('order');
        }
        return $this->getvOrder();
    }
}
