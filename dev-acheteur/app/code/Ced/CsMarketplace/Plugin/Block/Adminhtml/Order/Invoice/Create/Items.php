<?php


namespace Ced\CsMarketplace\Plugin\Block\Adminhtml\Order\Invoice\Create;

use Ced\CsMarketplace\Helper\InvoiceShipment As InvoiceShipmentHelper;
use Magento\Framework\UrlInterface;

/**
 * Class Items
 * @package Ced\CsMarketplace\Plugin\Block\Adminhtml\Order\Invoice\Create
 */
class Items
{

    /**
     * @var InvoiceShipmentHelper
     */
    private $invoiceShipmentHelper;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * Items constructor.
     * @param InvoiceShipmentHelper $invoiceShipmentHelper
     * @param UrlInterface $url
     */
    public function __construct(
        InvoiceShipmentHelper $invoiceShipmentHelper,
        UrlInterface $url
    ) {
        $this->invoiceShipmentHelper = $invoiceShipmentHelper;
        $this->url = $url;
    }

    /**
     * @param $subject
     * @param $updateUrl
     * @return string
     */
    public function afterGetUpdateUrl($subject, $updateUrl) {
        if ($this->invoiceShipmentHelper->isModuleEnable() && $this->invoiceShipmentHelper->canSeparateInvoiceAndShipment()) {
            $updateUrl = $this->url->getUrl('sales/*/updateQty',['_current' => true]);
        }
        return $updateUrl;
    }
}