<?php



namespace Ced\CsMarketplace\Controller\Vreports;

/**
 * Class Vproducts
 * @package Ced\CsMarketplace\Controller\Vreports
 */
class Vproducts extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * @return bool|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if (!$this->_getSession()->getVendorId()) {
            return false;
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Product Reports'));
        return $resultPage;
    }
}
