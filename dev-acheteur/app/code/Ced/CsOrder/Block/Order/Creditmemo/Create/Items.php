<?php


namespace Ced\CsOrder\Block\Order\Creditmemo\Create;

class Items extends \Magento\Sales\Block\Adminhtml\Order\Creditmemo\Create\Items
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * Items constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
     * @param \Magento\CatalogInventory\Api\StockConfigurationInterface $stockConfiguration
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Data $salesData
     * @param \Magento\Customer\Model\SessionFactory $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Magento\CatalogInventory\Api\StockConfigurationInterface $stockConfiguration,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Data $salesData,
        \Magento\Customer\Model\SessionFactory $customerSession,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        parent::__construct($context, $stockRegistry, $stockConfiguration, $registry, $salesData, $data);
    }

    /**
     * Get update url
     * @return string
     */
    public function getUpdateUrl()
    {
        return $this->getUrl(
            'csorder/*/updateQty',
            [
                'order_id' => $this->getCreditmemo()->getOrderId(),
                'invoice_id' => $this->getRequest()->getParam('invoice_id', null)
            ]
        );
    }

    /**
     * @return \Magento\Customer\Model\Session
     */
    public function getSession()
    {
        return $this->customerSession->create();
    }
}
