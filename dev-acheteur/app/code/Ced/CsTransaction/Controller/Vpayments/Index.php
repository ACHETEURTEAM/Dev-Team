<?php


namespace Ced\CsTransaction\Controller\Vpayments;

class Index extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * @var \Magento\Framework\View\Result\Page
     */
    protected $resultPageFactory;

    /**
     * Blog Index, shows a list of recent blog posts.
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Requsted Transaction'));
        return $resultPage;
    }
}
