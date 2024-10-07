<?php


namespace Ced\CsMarketplace\Observer;

use Ced\CsMarketplace\Model\VendorFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SetEmail
 * @package Ced\CsMarketplace\Observer
 */
Class SetEmail implements ObserverInterface
{

    /**
     * @var VendorFactory
     */
    protected $vendorFactory;

    /**
     * SetEmail constructor.
     * @param VendorFactory $vendorFactory
     */
    public function __construct(VendorFactory $vendorFactory)
    {
        $this->vendorFactory = $vendorFactory;
    }

    /**
     *Notify Customer Account share Change
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $customer = $observer->getCustomer();
        $vendor = $this->vendorFactory->create()->loadByCustomerId($customer->getId());
        if ($vendor && $vendor->getEmail() != $customer->getEmail()) {
            $vendor->setSettingFromCustomer(true)->setEmail($customer->getEmail())->save();
        }
    }
}
