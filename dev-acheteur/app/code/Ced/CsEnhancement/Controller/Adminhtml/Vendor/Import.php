<?php


namespace Ced\CsEnhancement\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Import
 * @package Ced\CsEnhancement\Controller\Adminhtml\Vendor
 */
class Import extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var \Ced\CsEnhancement\Helper\File
     */
    protected $fileHelper;

    /**
     * Import constructor.
     * @param Context $context
     * @param \Ced\CsEnhancement\Helper\File $fileHelper
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        \Ced\CsEnhancement\Helper\File $fileHelper,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->fileHelper = $fileHelper;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->messageManager->addNoticeMessage(
            $this->fileHelper->getMaxFileSizeMessage()
        );

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ced_CsEnhancement::import_vendors');
        $resultPage->addBreadcrumb(__('Marketplace'), __('Marketplace'));
        $resultPage->addBreadcrumb(__('Import Vendors'), __('Import Vendors'));
        $resultPage->getConfig()->getTitle()->prepend(__('Import Vendors'));

        return $resultPage;
    }
}
