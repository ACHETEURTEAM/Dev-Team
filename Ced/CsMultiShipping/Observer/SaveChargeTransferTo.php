<?php


namespace Ced\CsMultiShipping\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveChargeTransferTo implements ObserverInterface
{
    const XML_PATH_CHARGE_TRANSFER_TO = 'ced_csmultishipping/general/charge_transfer_to';

    /**
     * @var \Ced\CsMarketplace\Helper\Data
     */
    protected $dataHelper;

    /**
     * SaveChargeTransferTo constructor.
     * @param \Ced\CsMarketplace\Helper\Data $dataHelper
     */
    public function __construct(
        \Ced\CsMarketplace\Helper\Data $dataHelper
    ) {
        $this->dataHelper = $dataHelper;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        $chargeTransferTo = $this->dataHelper->getStoreConfig(
            self::XML_PATH_CHARGE_TRANSFER_TO
        );
        $quote->setChargeTransferTo($chargeTransferTo);
        $order->setChargeTransferTo($chargeTransferTo);
    }
}
