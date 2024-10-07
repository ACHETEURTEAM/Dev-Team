<?php


namespace Ced\CsOrder\Block\Order\View;

use Magento\Customer\Model\Session;
use Magento\Sales\Model\ResourceModel\Order\Status\History\Collection;
use Magento\Sales\Model\ResourceModel\Order\Status\History\CollectionFactory;

class History extends \Magento\Sales\Block\Adminhtml\Order\View\History
{
    protected $historyCollectionFactory;
    protected $customerSession;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Sales\Helper\Data $salesData
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Admin $adminHelper
     * @param CollectionFactory $historyCollectionFactory
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Sales\Helper\Data $salesData,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Admin $adminHelper,
        CollectionFactory $historyCollectionFactory,
        Session $customerSession,
        array $data = []
    ) {
        $this->historyCollectionFactory = $historyCollectionFactory;
        $this->customerSession = $customerSession;
        parent::__construct($context, $salesData, $registry, $adminHelper, $data);
    }

    /**
     * Check allow to add comment
     * @return bool
     */
    public function canAddComment()
    {
        return $this->getOrder()->canComment();
    }

    /**
     * Submit URL getter
     * @return string
     */
    public function getSubmitUrl()
    {
        return $this->getUrl('csorder/*/addComment', ['order_id' => $this->getOrder()->getId()]);
    }

    /**
     * Check allow to send order comment email
     * @return bool
     */
    public function canSendCommentEmail()
    {
        return $this->_salesData->canSendOrderCommentEmail($this->getOrder()->getStore()->getId());
    }

    /**
     * @return Collection
     */
    public function getStatusHistoryCollection(): Collection
    {
        /* Considering 0 as Admin */
        $value = [0];
        $vendorId = $this->customerSession->getVendorId();
        $value[] = $vendorId;
        return $this->historyCollectionFactory->create()
            ->setOrderFilter($this->getOrder())
            ->addFieldToFilter('vendor_id', ['in' => $value])
            ->setOrder('created_at', 'desc')
            ->setOrder('entity_id', 'desc');
    }
}
