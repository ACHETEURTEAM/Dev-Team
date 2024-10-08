<?php


namespace Ced\CsTransaction\Observer;

use Ced\CsMarketplace\Model\Vpayment\Requested;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class VpaymentsSaveAfter implements ObserverInterface
{
    /**
     * @var Ced\CsTransaction\Model\RequestedFactory
     */
    protected $_requestedFactory;

    /**
     * @var \Ced\CsTransaction\Model\ResourceModel\Requested
     */
    protected $_requestedResource;

    /**
     * @var \Ced\CsOrder\Helper\Data
     */
    protected $_csorderHelper;

    /**
     * VpaymentsSaveAfter constructor.
     * @param \Ced\CsTransaction\Model\RequestedFactory $requestedFactory
     * @param \Ced\CsTransaction\Model\ResourceModel\Requested $requestedResource
     * @param \Ced\CsOrder\Helper\Data $csorderHelper
     */
    public function __construct(
        \Ced\CsTransaction\Model\RequestedFactory $requestedFactory,
        \Ced\CsTransaction\Model\ResourceModel\Requested $requestedResource,
        \Ced\CsOrder\Helper\Data $csorderHelper
    ) {
        $this->_requestedFactory = $requestedFactory;
        $this->_requestedResource = $requestedResource;
        $this->_csorderHelper = $csorderHelper;
    }

    /**
     * @param Observer $observer
     * @return $this|void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            if (!$this->_csorderHelper->isActive()) {
                return $this;
            }
            $vPayment = $observer->getVpayment();
            if (!$vPayment->getId()) {
                return $this;
            }
            $amountDesc = json_decode($vPayment->getItemWiseAmountDesc(), true);
            foreach ($amountDesc as $orderId => $vorderItems) {
                foreach ($vorderItems as $itemId => $amount) {
                    $requestedModel = $this->_requestedFactory->create();
                    $this->_requestedResource->load($requestedModel, $itemId, 'vorder_item_id');
                    if (!$requestedModel->getId()) {
                        continue;
                    }
                    if ($vPayment->getStatus() == Requested::PAYMENT_STATUS_PROCESSED) {
                        $requestedModel->setStatus(Requested::PAYMENT_STATUS_PROCESSED);
                        $this->_requestedResource->save($requestedModel);
                    } elseif ($vPayment->getStatus() == Requested::PAYMENT_STATUS_CANCELED) {
                        $requestedModel->setStatus(Requested::PAYMENT_STATUS_CANCELED);
                        $this->_requestedResource->save($requestedModel);
                    }
                }
            }
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        }
    }
}
