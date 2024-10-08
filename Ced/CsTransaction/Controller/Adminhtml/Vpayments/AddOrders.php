<?php


namespace Ced\CsTransaction\Controller\Adminhtml\Vpayments;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class AddOrders extends \Ced\CsMarketplace\Controller\Adminhtml\Vendor
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * AddOrders constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Customer edit action
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function execute()
    {
        return $this->getResponse()->setBody(
            $this->resultPageFactory->create(true)->getLayout()
                ->createBlock(\Ced\CsTransaction\Block\Adminhtml\Vpayments\Edit\Tab\Addorder::class)->getAddOrderBlock()
        );
    }
}
