<?php


namespace Ced\CsMarketplace\Controller\Vreports;
/**
 * Class Index
 * @package Ced\CsMarketplace\Controller\Vreports
 */
class Index extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * @return bool|\Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        if (!$this->_getSession()->getVendorId()) {
            return false;
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Vendor Reports'));
        return $resultPage;
    }
}
