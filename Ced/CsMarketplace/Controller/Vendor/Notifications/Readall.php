<?php


namespace Ced\CsMarketplace\Controller\Vendor\Notifications;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\UrlFactory;

/**
 * Class Readall
 * @package Ced\CsMarketplace\Controller\Vendor\Notifications
 */
class Readall extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * @var \Ced\CsMarketplace\Helper\Data
     */
    protected $csmarketplaceHelper;

    /**
     * Readall constructor.
     * @param Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param Session $customerSession
     * @param UrlFactory $urlFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper
     * @param \Ced\CsMarketplace\Helper\Acl $aclHelper
     * @param \Ced\CsMarketplace\Model\VendorFactory $vendor
     */
    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        Session $customerSession,
        UrlFactory $urlFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper,
        \Ced\CsMarketplace\Helper\Acl $aclHelper,
        \Ced\CsMarketplace\Model\VendorFactory $vendor
    ) {
        $this->csmarketplaceHelper = $csmarketplaceHelper;
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
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if (!$this->_getSession()->getVendorId()) {
            return $this->_redirect('csmarketplace/vendor/index');
        } else {
            $vendorId = $this->_getSession()->getVendorId();
            $this->csmarketplaceHelper->readAllNotifications($vendorId);

            return $this->_redirect('csmarketplace/vendor/index');
        }
    }
}

