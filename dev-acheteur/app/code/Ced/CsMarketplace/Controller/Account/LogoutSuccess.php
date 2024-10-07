<?php


namespace Ced\CsMarketplace\Controller\Account;

/**
 * Class LogoutSuccess
 * @package Ced\CsMarketplace\Controller\Account
 */
class LogoutSuccess extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * Logout success page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Logged Out'));
        return $resultPage;
    }
}
