<?php



namespace Ced\CsMarketplace\Controller\Vpayments;

/**
 * Class Index
 * @package Ced\CsMarketplace\Controller\Vpayments
 */
class Index extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * @return bool|\Ced\CsMarketplace\Controller\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if (!$this->_getSession()->getVendorId()) {
            return false;
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Transactions'));
        return $resultPage;
    }
}
