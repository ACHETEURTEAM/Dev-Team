<?php



namespace Ced\CsMarketplace\Controller\Vendor;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\UrlFactory;

/**
 * Class Country
 * @package Ced\CsMarketplace\Controller\Vendor
 */
class Country extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    public $resultJsonFactory;

    /**
     * @var \Magento\Directory\Model\ResourceModel\Region\CollectionFactory
     */
    public $regionCollection;

    /**
     * Country constructor.
     * @param Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param Session $customerSession
     * @param UrlFactory $urlFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper
     * @param \Ced\CsMarketplace\Helper\Acl $aclHelper
     * @param \Ced\CsMarketplace\Model\VendorFactory $vendor
     * @param \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollection
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
        \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollection
    ) {
        $this->resultJsonFactory = $jsonFactory;
        $this->regionCollection = $regionCollection;
        parent::__construct($context, $resultPageFactory, $customerSession, $urlFactory, $registry, $jsonFactory,
            $csmarketplaceHelper, $aclHelper, $vendor);
    }

    /**
     * Default vendor dashboard page
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $regionCollection = $this->regionCollection->create()
            ->addCountryFilter($this->getRequest()->getParam('cid'));
        if ($regionCollection->getData() != null) {
            $resultJson->setData('true');
        } else {
            $resultJson->setData('false');
        }

        return $resultJson;
    }
}
