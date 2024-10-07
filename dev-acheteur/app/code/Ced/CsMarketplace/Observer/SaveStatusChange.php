<?php


namespace Ced\CsMarketplace\Observer;

use Ced\CsMarketplace\Model\ResourceModel\Vproducts\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SaveStatusChange
 * @package Ced\CsMarketplace\Observer
 */
Class SaveStatusChange implements ObserverInterface
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
     * SaveStatusChange constructor.
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
        $productIds = (array)$this->request->getParam('selected');
        $status = (int)$this->request->getParam('status');
        $store = (int)$this->request->getParam('store') ? (int)$this->request->getParam('store') : 0;
        if ($status) {
            $collection = $this->collectionFactory->create()->addFieldToFilter('product_id', ['in' => $productIds]);
            if (count($collection) > 0) {
                foreach ($collection as $row) {
                    $row->setStoreId($store);
                    $row->setStatus($status);
                }
            }
        }
    }
}
