<?php


namespace Ced\CsMarketplace\Observer;


use Ced\CsMarketplace\Model\SetVendorOrderFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SetVendorSalesOrder
 * @package Ced\CsMarketplace\Observer
 */
Class SetVendorSalesOrder implements ObserverInterface
{

    /**
     * @var SetVendorOrderFactory
     */
    protected $setVendorOrderFactory;

    /**
     * SetVendorSalesOrder constructor.
     * @param SetVendorOrderFactory $setVendorOrderFactory
     */
    public function __construct(SetVendorOrderFactory $setVendorOrderFactory)
    {
        $this->setVendorOrderFactory = $setVendorOrderFactory;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $this->setVendorOrderFactory->create()->setVendorOrder($order);
    }
}
