<?php



namespace Ced\CsMarketplace\Controller\Vorders;

use Ced\CsMarketplace\Model\Session as MarketplaceSession;
use Ced\CsMarketplace\Model\Vorders as vendorOrder;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\UrlFactory;

/**
 * Class Index
 * @package Ced\CsMarketplace\Controller\Vorders
 */
class Index extends \Ced\CsMarketplace\Controller\Vorders
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param Session $customerSession
     * @param UrlFactory $urlFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper
     * @param \Ced\CsMarketplace\Helper\Acl $aclHelper
     * @param \Ced\CsMarketplace\Model\VendorFactory $vendor
     * @param MarketplaceSession $mktSession
     * @param vendorOrder $vorders
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
        \Ced\CsMarketplace\Model\VendorFactory $vendor,
        MarketplaceSession $mktSession,
        vendorOrder $vorders
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $resultPageFactory, $customerSession, $urlFactory, $registry, $jsonFactory,
            $csmarketplaceHelper, $aclHelper, $vendor, $mktSession, $vorders);
    }

    /**
     * @return \Ced\CsMarketplace\Controller\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Order List'));
        return $resultPage;
    }
}
