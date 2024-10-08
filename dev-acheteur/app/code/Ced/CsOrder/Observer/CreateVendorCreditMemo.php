<?php


namespace Ced\CsOrder\Observer;

use Magento\Framework\Event\ObserverInterface;

class CreateVendorCreditmemo implements ObserverInterface
{
    /**
     * @var \Ced\CsMarketplace\Helper\Data
     */
    protected $marketplacehelper;

    /**
     * @var \Ced\CsOrder\Model\CreditmemoFactory
     */
    protected $vcreditmemo;

    /**
     * @var \Ced\CsOrder\Model\ResourceModel\Creditmemo
     */
    protected $_vcreditmemoResource;

    /**
     * @var \Ced\CsOrder\Helper\Data
     */
    protected $helper;

    /**
     * CreateVendorCreditmemo constructor.
     * @param \Ced\CsOrder\Helper\Data $helper
     * @param \Ced\CsOrder\Model\CreditmemoFactory $vcreditmemo
     * @param \Ced\CsOrder\Model\ResourceModel\Creditmemo $vcreditmemoResource
     * @param \Ced\CsMarketplace\Helper\Data $marketplacehelper
     */
    public function __construct(
        \Ced\CsOrder\Helper\Data $helper,
        \Ced\CsOrder\Model\CreditmemoFactory $vcreditmemo,
        \Ced\CsOrder\Model\ResourceModel\Creditmemo $vcreditmemoResource,
        \Ced\CsMarketplace\Helper\Data $marketplacehelper
    ) {
        $this->helper = $helper;
        $this->vcreditmemo = $vcreditmemo;
        $this->_vcreditmemoResource = $vcreditmemoResource;
        $this->marketplacehelper = $marketplacehelper;
    }

    /**
     * Set vendor name and url to product in cart
     * @param $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            if ($this->helper->isActive()) {
                $creditmemo = $observer->getCreditmemo();
                $allItems = $creditmemo->getAllItems();
                $creditmemoVendor = [];
                foreach ($allItems as $item) {
                    $vendorId = $item->getVendorId();
                    $creditmemoVendor[$vendorId] = $vendorId;
                }

                foreach ($creditmemoVendor as $vendorId) {
                    try {
                        $id = $creditmemo->getId();
                        $vCreditmemo = $this->vcreditmemo->create();
                        $vCreditmemo->setCreditmemoId($id);
                        $vCreditmemo->setVendorId($vendorId);
                        $this->_vcreditmemoResource->save($vCreditmemo);
                    } catch (\Exception $e) {
                        $this->marketplacehelper->logException($e);
                    }
                }
            }
        } catch (\Exception $e) {
            $this->marketplacehelper->logException($e);
        }
    }
}
