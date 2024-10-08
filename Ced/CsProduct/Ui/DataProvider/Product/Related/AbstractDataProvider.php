<?php


namespace Ced\CsProduct\Ui\DataProvider\Product\Related;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductLinkInterface;
use Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Api\ProductLinkRepositoryInterface;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Api\StoreRepositoryInterface;

abstract class AbstractDataProvider extends ProductDataProvider
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var StoreRepositoryInterface
     */
    protected $storeRepository;

    /**
     * @var ProductLinkRepositoryInterface
     */
    protected $productLinkRepository;

    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * @var StoreInterface
     */
    private $store;

    protected $_vproduct;

    /**
     * AbstractDataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param RequestInterface $request
     * @param ProductRepositoryInterface $productRepository
     * @param StoreRepositoryInterface $storeRepository
     * @param ProductLinkRepositoryInterface $productLinkRepository
     * @param \Ced\CsMarketplace\Model\Vproducts $vproduct
     * @param $addFieldStrategies
     * @param $addFilterStrategies
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        ProductRepositoryInterface $productRepository,
        StoreRepositoryInterface $storeRepository,
        ProductLinkRepositoryInterface $productLinkRepository,
        \Ced\CsMarketplace\Model\Vproducts $vproduct,
        array $addFieldStrategies = [],
        array $addFilterStrategies = [],
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $collectionFactory,
            $addFieldStrategies,
            $addFilterStrategies,
            $meta,
            $data
        );

        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
        $this->productLinkRepository = $productLinkRepository;
        $this->_vproduct = $vproduct;
    }

    /**
     * Retrieve link type
     *
     * @return string
     */
    abstract protected function getLinkType();

    /**
     * {@inheritdoc}
     */
    public function getCollection()
    {
        /** @var Collection $collection */
        $collection = parent::getCollection();
        $vproducts = $this->_vproduct->getVendorProductIds();
        $collection->addFieldToFilter('entity_id', ['in' => $vproducts])->addAttributeToSelect('status');

        if ($this->getStore()) {
            $collection->setStore($this->getStore());
        }

        if (!$this->getProduct()) {
            return $collection;
        }

        $collection->addAttributeToFilter(
            $collection->getIdFieldName(),
            ['nin' => [$this->getProduct()->getId()]]
        );

        return $this->addCollectionFilters($collection);
    }

    /**
     * Add specific filters
     *
     * @param Collection $collection
     * @return Collection
     */
    protected function addCollectionFilters(Collection $collection)
    {
        $relatedProducts = [];

        /** @var ProductLinkInterface $linkItem */
        foreach ($this->productLinkRepository->getList($this->getProduct()) as $linkItem) {
            if ($linkItem->getLinkType() !== $this->getLinkType()) {
                continue;
            }

            $relatedProducts[] = $this->productRepository->get($linkItem->getLinkedProductSku())->getId();
        }

        if ($relatedProducts) {
            $collection->addAttributeToFilter(
                $collection->getIdFieldName(),
                ['nin' => [$relatedProducts]]
            );
        }

        return $collection;
    }

    /**
     * Retrieve product
     *
     * @return ProductInterface|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function getProduct()
    {
        if (null !== $this->product) {
            return $this->product;
        }

        if (!($id = $this->request->getParam('current_product_id'))) {
            return null;
        }

        return $this->product = $this->productRepository->getById($id);
    }

    /**
     * Retrieve store
     *
     * @return StoreInterface|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function getStore()
    {
        if (null !== $this->store) {
            return $this->store;
        }

        if (!($storeId = $this->request->getParam('current_store_id'))) {
            return null;
        }

        return $this->store = $this->storeRepository->getById($storeId);
    }
}
