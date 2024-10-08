<?php


namespace Ced\CsMarketplace\Block;

use Ced\CsMarketplace\Model\VendorFactory;
use Magento\Checkout\Block\Cart\Additional\Info as AdditionalBlockInfo;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template as ViewTemplate;
use Magento\Framework\View\Element\Template\Context;


/**
 * Class CartItemVendorBlock
 * @package Ced\CsMarketplace\Block
 */
class CartItemVendorBlock extends ViewTemplate
{

    /**
     * Vendor Factory
     *
     * @var VendorFactory
     */
    protected $vendorFactory;

    /**
     * CartItemVendorBlock constructor
     *
     * @param Context $context
     * @param VendorFactory $vendorFactory
     */
    public function __construct(
        Context $context,
        VendorFactory $vendorFactory
    ) {
        parent::__construct($context);
        $this->vendorFactory = $vendorFactory;
    }

    /**
     * Get vendor Name
     *
     * @return string
     */
    public function getVendorName()
    {
        $vendorId = $this->getVendorId();
        $vendorName = '';
        if ($vendorId) {
            /** @var Vendor $Vendor */
            $vendor = $this->vendorFactory->create();
            $vendor->load($vendorId);
            if (count($vendor->getData()) > 0) {
                $vendorName = $vendor->getPublicName();
            }
        }

        return $vendorName;
    }

    /**
     * Get vendor id from quote item
     *
     * @return int | bool
     */
    public function getVendorId()
    {
        try {
            $layout = $this->getLayout();
        } catch (LocalizedException $e) {
            return false;
        }

        /** @var AdditionalBlockInfo $block */
        $block = $layout->getBlock('additional.product.info');

        $vendorId = false;

        if ($block instanceof AdditionalBlockInfo) {
            $item = $block->getItem();
            $vendorId = $item->getVendorId();
        }

        return $vendorId;
    }
}
