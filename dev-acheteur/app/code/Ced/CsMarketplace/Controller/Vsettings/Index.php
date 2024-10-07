<?php


namespace Ced\CsMarketplace\Controller\Vsettings;
/**
 * Class Index
 * @package Ced\CsMarketplace\Controller\Vsettings
 */
class Index extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Transaction Settings'));
        return $resultPage;
    }
}
