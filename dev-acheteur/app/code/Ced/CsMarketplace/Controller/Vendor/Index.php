<?php



namespace Ced\CsMarketplace\Controller\Vendor;

/**
 * Class Index
 * @package Ced\CsMarketplace\Controller\Vendor
 */
class Index extends \Ced\CsMarketplace\Controller\Vendor
{

    /**
     * Default vendor dashboard page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Dashboard'));
        return $resultPage;
    }
}
