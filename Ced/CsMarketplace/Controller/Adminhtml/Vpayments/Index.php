<?php



namespace Ced\CsMarketplace\Controller\Adminhtml\Vpayments;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vpayments
 */
class Index extends \Ced\CsMarketplace\Controller\Adminhtml\Vendor
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
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
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ced_CsMarketplace::csmarketplace');
        $resultPage->addBreadcrumb(__('CsMarketplace'), __('CsMarketplace'));
        $resultPage->addBreadcrumb(__('Manage Vendor Transactions'), __('Manage Vendor Transactions'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Vendor Transactions'));
        return $resultPage;

    }
}
