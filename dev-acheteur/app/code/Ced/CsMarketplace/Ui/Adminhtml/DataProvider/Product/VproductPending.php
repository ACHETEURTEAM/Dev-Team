<?php


namespace Ced\CsMarketplace\Ui\Adminhtml\DataProvider\Product;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\Store;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Ced\CsMarketplace\Model\ResourceModel\Vproducts\CollectionFactory;


/**
 * Class VOrderListing
 * @package Ced\CsMarketplace\Ui\Adminhtml\DataProvider\Order
 */
class VproductPending extends AbstractDataProvider
{

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollection;

    /**
     * @var \Ced\CsMarketplace\Model\ResourceModel\Vproducts\Collection
     */
    protected $collection;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Ced\CsMarketplace\Model\VendorFactory
     */
    protected $vendorFactory;

    /**
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory
     */
    protected $setCollection;

    /**
     * @var \Magento\Store\Model\WebsiteFactory
     */
    protected $websiteFactory;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product
     */
    protected $product;


    /**
     * VproductPending constructor.
     * @param \Magento\Store\Model\WebsiteFactory $websiteFactory
     * @param CollectionFactory $collection
     * @param UrlInterface $urlBuilder
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param \Ced\CsMarketplace\Model\VendorFactory $vendorFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollection
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory $setCollection
     * @param \Magento\Catalog\Model\ResourceModel\Product $product
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        \Magento\Store\Model\WebsiteFactory $websiteFactory,
        CollectionFactory $collection,
        UrlInterface $urlBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Module\Manager $moduleManager,
        \Ced\CsMarketplace\Model\VendorFactory $vendorFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollection,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory $setCollection,
        \Magento\Catalog\Model\ResourceModel\Product $product,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data =[]
    ) {
        $this->setCollection = $setCollection;
        $this->websiteFactory = $websiteFactory;
        $this->product = $product;
        $this->request = $request;
        $this->moduleManager = $moduleManager;
        $this->productCollection = $productCollection;
        $this->urlBuilder = $urlBuilder;
        $this->storeManager = $storeManager;
        $this->collection = $collection->create();
        $this->vendorFactory = $vendorFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('vendorGrid');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setDefaultSort('entity_id');
        $this->setUseAjax(true);
        $this->setVarNameFilter('vendor_filter');
    }

    /**
     * @return array
     */
    public function getData()
    {
        $this->collection->addFieldToFilter('check_status', 2);
        $allowedIds = [];

        foreach ($this->collection as $item) {
            $allowedIds[] = $item->getProductId();
        }
        $store = $this->storeManager->getStore();
        $vendor_id = $this->request->getParam('vendor_id',0);
        $collection = $this->productCollection->create()
            ->addAttributeToSelect('attribute_set_id')
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('type_id')
            ->addAttributeToSelect('name')->addAttributeToFilter('entity_id',array('in'=>$allowedIds));

        $moduleManager = $this->moduleManager;
        if ($moduleManager->isEnabled('Magento_CatalogInventory')) {
            $collection->joinField('qty', 'cataloginventory_stock_item', 'qty', 'product_id=entity_id',
                '{{table}}.stock_id=1', 'left');
        }

        if ($store->getId()) {
            $adminStore = Store::DEFAULT_STORE_ID;
            $collection->joinAttribute('name', 'catalog_product/name', 'entity_id', null, 'inner', $adminStore);
            $collection->joinAttribute(
                'custom_name', 'catalog_product/name', 'entity_id', null, 'inner', $store->getId()
            );
            $collection->joinAttribute(
                'price', 'catalog_product/price', 'entity_id', null, 'left', $store->getId()
            );
        } else {
            $collection->addAttributeToSelect('price');
        }
        $collection->joinField('vendor_id','ced_csmarketplace_vendor_products', 'vendor_id',
            'product_id=entity_id',null,'left');
        $collection->joinField('check_status','ced_csmarketplace_vendor_products', 'check_status',
            'product_id=entity_id',null,'left');
        $collection->joinField('reason','ced_csmarketplace_vendor_products', 'reason',
            'product_id=entity_id',null,'left');
        $collection->joinField('id','ced_csmarketplace_vendor_products', 'id',
            'product_id=entity_id',null,'left');
        $collection->joinField('website_id','ced_csmarketplace_vendor_products', 'website_id',
            'product_id=entity_id',null,'left');

        if($vendor_id) {
            $collection->addFieldToFilter('vendor_id',array('eq'=>$vendor_id));
        }
        $collection = $collection->getData();
        $collection = array_filter(
            $collection, function ($var) {
            return ($var['check_status'] == '2');
        });
        $this->setCollection = $this->setCollection->create();
        $this->websiteFactory = $this->websiteFactory->create();
        foreach ($collection as $key => $collectionValues) {
            $html = '';
            $attributeSetName = $this->setCollection->addFieldToFilter('attribute_set_id',
                $collectionValues['attribute_set_id'])->getData()[0]['attribute_set_name'];
            $vendorId = $collectionValues['vendor_id'];
            $vendor = $this->vendorFactory->create()->load($vendorId);
            $target = "target='_blank'";
            $url =  $this->urlBuilder->getUrl("csmarketplace/vendor/edit/", array('vendor_id' =>
                $vendorId));
            $html .= '<a title="Click to view Vendor Details" onClick="setLocation(\''.$url.'\')" 
            href="'.$url.'" "'.$target.'">'.$vendor->getName().'</a>';
            $collection[$key]['website_name'] = $this->websiteFactory->load($collectionValues['website_id'])->getName();
            $collection[$key]['vendor_name'] = $html;
            $collection[$key]['set_name'] = $attributeSetName;
        }

        return [
            'totalRecords' => $this->collection->getSize(),
            'items' => array_values($collection),
        ];
    }
}
