<?php


namespace Ced\CsOrder\Block\Order\View\Tab;

class Info extends \Magento\Sales\Block\Adminhtml\Order\View\Tab\Info implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Framework\Registry
     */
    public $registry;

    /**
     * @var \Ced\CsOrder\Helper\Data
     */
    public $csorderHelper;

    /**
     * @var \Ced\CsMarketplace\Model\VendorFactory
     */
    protected $vendorFactory;

    /**
     * @var \Ced\CsMarketplace\Model\ResourceModel\Vendor
     */
    protected $_vendorResource;

    /**
     * Info constructor.
     * @param \Ced\CsMarketplace\Model\VendorFactory $vendorFactory
     * @param \Ced\CsMarketplace\Model\ResourceModel\Vendor $vendorResource
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Admin $adminHelper
     * @param \Ced\CsOrder\Helper\Data $csorderHelper
     * @param array $data
     */
    public function __construct(
        \Ced\CsMarketplace\Model\VendorFactory $vendorFactory,
        \Ced\CsMarketplace\Model\ResourceModel\Vendor $vendorResource,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Admin $adminHelper,
        \Ced\CsOrder\Helper\Data $csorderHelper,
        array $data = []
    ) {
        $this->csorderHelper = $csorderHelper;
        $this->registry = $registry;
        $this->vendorFactory = $vendorFactory;
        $this->_vendorResource = $vendorResource;
        parent::__construct($context, $registry, $adminHelper, $data);
    }

    /**
     * Retrieve source model instance
     * @return \Magento\Sales\Model\Order
     */
    public function getSource()
    {
        return $this->getOrder();
    }

    /**
     * Retrieve order model instance
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        return $this->_coreRegistry->registry('current_order');
    }

    /**
     * Get order info data
     * @return array
     */
    public function getOrderInfoData()
    {
        return ['no_use_order_link' => true];
    }

    /**
     * Retrieve order totals block settings
     * @return array
     */
    public function getOrderTotalData()
    {
        return [
            'can_display_total_due' => true,
            'can_display_total_paid' => true,
            'can_display_total_refunded' => true
        ];
    }

    /**
     * Get items html
     * @return string
     */
    public function getItemsHtml()
    {
        return $this->getChildHtml('order_items');
    }

    /**
     * Get tracking html
     * @return string
     */
    public function getTrackingHtml()
    {
        return $this->getChildHtml('order_tracking');
    }

    /**
     * Get payment html
     * @return string
     */
    public function getPaymentHtml()
    {
        return $this->getChildHtml('order_payment');
    }

    /**
     * Retrieve gift options container block html
     * @return string
     */
    public function getGiftOptionsHtml()
    {
        return $this->getChildHtml('gift_options');
    }

    /**
     * View URL getter
     * @param  int $orderId
     * @return string
     */
    public function getViewUrl($orderId)
    {
        return $this->getUrl('sales/*/*', ['order_id' => $orderId]);
    }

    /**
     * ######################## TAB settings #################################
     */

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Order Information');
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * @return \Ced\CsOrder\Helper\Data
     */
    public function getCsorderHelper()
    {
        return $this->csorderHelper;
    }

    /**
     * @return \Magento\Framework\Registry
     */
    public function getRegistry()
    {
        return $this->registry;
    }

    /**
     * @return mixed|null
     */
    public function getVOrder()
    {
        return $this->registry->registry('current_vorder');
    }

    /**
     * @return \Ced\CsMarketplace\Model\Vendor
     */
    public function getVendor()
    {
        $vendor = $this->vendorFactory->create();
        $this->_vendorResource->load($vendor, $this->getVOrder()->getVendorId());
        return $vendor;
    }

    /**
     * @return bool
     */
    public function canShowShipmentBlock()
    {
        return $this->csorderHelper->canShowShipmentBlock($this->getVOrder());
    }
}
