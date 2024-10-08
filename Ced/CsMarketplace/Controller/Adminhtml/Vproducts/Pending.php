<?php



namespace Ced\CsMarketplace\Controller\Adminhtml\Vproducts;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Pending
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vproducts
 */
class Pending extends \Ced\CsMarketplace\Controller\Adminhtml\Vendor
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Pending constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
    }

    /**
     * Vendor Products pending action
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $this->registry->register('usePendingProductFilter', true);
        $resultPage->setActiveMenu('Ced_CsMarketplace::csmarketplace');
        $resultPage->addBreadcrumb(__('CsMarketplace'), __('CsMarketplace'));
        $resultPage->addBreadcrumb(__('Vendor Pending Products'), __('Vendor Pending Products'));
        $resultPage->getConfig()->getTitle()->prepend(__('Vendor Pending Products'));
        return $resultPage;
    }
}
