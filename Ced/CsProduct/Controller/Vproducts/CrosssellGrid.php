<?php


namespace Ced\CsProduct\Controller\Vproducts;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\UrlFactory;

class CrosssellGrid extends \Ced\CsProduct\Controller\Vproducts
{
    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * @var \Magento\Catalog\Controller\Adminhtml\Product\Builder
     */
    protected $productBuilder;

    /**
     * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\App\Request\Http $http
     * @param \Magento\Catalog\Controller\Adminhtml\Product\Builder $productBuilderAdminController
     * @param Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param Session $customerSession
     * @param UrlFactory $urlFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper
     * @param \Ced\CsMarketplace\Helper\Acl $aclHelper
     * @param \Ced\CsMarketplace\Model\VendorFactory $vendor
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Ced\CsMarketplace\Model\VproductsFactory $vproductsFactory
     * @param \Ced\CsMarketplace\Model\System\Config\Source\Vproducts\Type $type
     */
    public function __construct(
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\Request\Http $http,
        \Magento\Catalog\Controller\Adminhtml\Product\Builder $productBuilderAdminController,
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        Session $customerSession,
        UrlFactory $urlFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper,
        \Ced\CsMarketplace\Helper\Acl $aclHelper,
        \Ced\CsMarketplace\Model\VendorFactory $vendor,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Ced\CsMarketplace\Model\VproductsFactory $vproductsFactory,
        \Ced\CsMarketplace\Model\System\Config\Source\Vproducts\Type $type
    ) {
        $this->productBuilder = $productBuilderAdminController;
        $this->resultLayoutFactory = $resultLayoutFactory;
        parent::__construct(
            $scopeConfig,
            $http,
            $context,
            $resultPageFactory,
            $customerSession,
            $urlFactory,
            $registry,
            $jsonFactory,
            $csmarketplaceHelper,
            $aclHelper,
            $vendor,
            $storeManager,
            $productFactory,
            $vproductsFactory,
            $type
        );
    }

    /**
     * Get crosssell products grid
     *
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $this->productBuilder->build($this->getRequest());
        $resultLayout = $this->resultLayoutFactory->create();
        $resultLayout->getLayout()->getBlock('catalog.product.edit.tab.crosssell')
            ->setProductsRelated($this->getRequest()->getPost('products_crosssell', null));
        return $resultLayout;
    }
}
