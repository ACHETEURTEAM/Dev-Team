<?php



namespace Ced\CsMarketplace\Controller\Vendor;
/**
 * Class Notifications
 * @package Ced\CsMarketplace\Controller\Vendor
 */
class Notifications extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * Default vendor dashboard page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Notifications'));
        return $resultPage;
    }
}

