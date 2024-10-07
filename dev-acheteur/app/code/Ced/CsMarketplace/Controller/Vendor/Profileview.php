<?php



namespace Ced\CsMarketplace\Controller\Vendor;

/**
 * Class Profileview
 * @package Ced\CsMarketplace\Controller\Vendor
 */
class Profileview extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * Default vendor profile page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Vendor Profile View'));
        return $resultPage;
    }
}
