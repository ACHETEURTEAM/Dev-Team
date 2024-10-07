<?php



namespace Ced\CsMarketplace\Controller\Vendor;
/**
 * Class Profile
 * @package Ced\CsMarketplace\Controller\Vendor
 */
class Profile extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * Default vendor profile page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Profile'));
        return $resultPage;
    }
}
