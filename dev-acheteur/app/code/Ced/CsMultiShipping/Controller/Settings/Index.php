<?php


namespace Ced\CsMultiShipping\Controller\Settings;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\UrlFactory;

class Index extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * @var \Ced\CsMultiShipping\Helper\Data
     */
    protected $csmultishippingHelper;

    /**
     * Index constructor.
     * @param Context $context
     * @param Session $customerSession
     * @param UrlFactory $urlFactory
     * @param \Ced\CsMultiShipping\Helper\Data $csmultishippingHelper
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper
     * @param \Ced\CsMarketplace\Helper\Acl $aclHelper
     * @param \Ced\CsMarketplace\Model\VendorFactory $vendor
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        UrlFactory $urlFactory,
        \Ced\CsMultiShipping\Helper\Data $csmultishippingHelper,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper,
        \Ced\CsMarketplace\Helper\Acl $aclHelper,
        \Ced\CsMarketplace\Model\VendorFactory $vendor
    ) {
        $this->csmultishippingHelper = $csmultishippingHelper;
        parent::__construct(
            $context,
            $resultPageFactory,
            $customerSession,
            $urlFactory,
            $registry,
            $jsonFactory,
            $csmarketplaceHelper,
            $aclHelper,
            $vendor
        );
    }

    /**
     * Default vendor dashboard page
     *
     * @return \Magento\Framework\View\Result\Page
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        if (!$this->_getSession()->getVendorId()) {
            $this->_redirect('csmarketplace/account/login');
        }
        if (!$this->csmultishippingHelper->isEnabled()) {
            $this->_redirect('csmarketplace/vendor/index');
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Shipping Settings'));
        return $resultPage;
    }
}
