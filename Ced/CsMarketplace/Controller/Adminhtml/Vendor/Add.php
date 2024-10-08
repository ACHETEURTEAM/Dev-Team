<?php


namespace Ced\CsMarketplace\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Add
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vendor
 */
class Add extends \Ced\CsMarketplace\Controller\Adminhtml\Vendor
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
     * Add action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ced_CsMarketplace::csmarketplace');
        $resultPage->addBreadcrumb(__('CsMarketplace'), __('CsMarketplace'));
        $resultPage->addBreadcrumb(__('Manage Vendors'), __('Select Customer'));
        $resultPage->getConfig()->getTitle()->prepend(__('Select Customer'));

        return $resultPage;
    }
}
