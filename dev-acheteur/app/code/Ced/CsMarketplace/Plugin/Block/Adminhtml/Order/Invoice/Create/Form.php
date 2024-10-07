<?php


namespace Ced\CsMarketplace\Plugin\Block\Adminhtml\Order\Invoice\Create;

use Ced\CsMarketplace\Helper\InvoiceShipment As InvoiceShipmentHelper;
use Magento\Framework\UrlInterface;

/**
 * Class Form
 * @package Ced\CsMarketplace\Plugin\Block\Adminhtml\Order\Invoice\Create
 */
class Form
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
     * Form constructor.
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
     * @param $saveUrl
     * @return string
     */
    public function afterGetSaveUrl($subject, $saveUrl) {
        if ($this->invoiceShipmentHelper->isModuleEnable() && $this->invoiceShipmentHelper->canSeparateInvoiceAndShipment()) {
            $saveUrl = $this->url->getUrl('sales/*/save',['_current' => true]);
        }
        return $saveUrl;
    }
}