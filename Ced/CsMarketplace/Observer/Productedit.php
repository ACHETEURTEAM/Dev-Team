<?php


namespace Ced\CsMarketplace\Observer;

use Ced\CsMarketplace\Model\ResourceModel\Vproducts\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class Productedit
 * @package Ced\CsMarketplace\Observer
 */
Class Productedit implements ObserverInterface
{

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Productedit constructor.
     * @param CollectionFactory $collectionFactory
     * @param RequestInterface $request
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        RequestInterface $request
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->request = $request;
    }

    /**
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $productid = $observer->getEvent()->getProduct()->getId();
        $data = $this->request->getPostValue('product');
        if ($data) {
            $vproduct = $this->collectionFactory->create()
                ->addFieldToFilter('product_id', $productid)->getFirstItem();
            if ($vproduct && $vproduct->getId()) {
                $vproduct->setData('name', $data['name']);
                $vproduct->setData('description', $data['description']);
                $vproduct->setData('short_description', $data['short_description']);
                $vproduct->setData('sku', $data['sku']);
                $vproduct->setData('is_in_stock', $data['quantity_and_stock_status']['is_in_stock']);
                //$vproduct->setData('qty', $data['quantity_and_stock_status']['qty']);
                $vproduct->setData('price', isset($data['price']) ? $data['price'] : 0);
                $vproduct->save();
            }
        }
    }
}
