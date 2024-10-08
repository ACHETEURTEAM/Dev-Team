<?php


namespace Ced\CsMarketplace\Plugin;

use Ced\CsMarketplace\Model\Vproducts;
use Closure;
use Magento\Framework\Exception\LocalizedException;
use Magento\Quote\Model\Quote\Item\AbstractItem;
use Magento\Quote\Model\Quote\Item\ToOrderItem;


/**
 * Class SetVendorIdInOrderItem
 * @package Ced\CsMarketplace\Plugin
 */
class SetVendorIdInOrderItem
{

    /**
     * @var Vproducts
     */
    protected $vproducts;

    /**
     * SetVendorIdInOrderItem constructor.
     * @param Vproducts $vproducts
     */
    public function __construct(Vproducts $vproducts)
    {
        $this->vproducts = $vproducts;
    }

    /**
     * @param ToOrderItem $subject
     * @param Closure $proceed
     * @param AbstractItem $item
     * @param array $additional
     * @return Item
     * @throws LocalizedException
     */
    public function aroundConvert(
        ToOrderItem $subject,
        Closure $proceed,
        AbstractItem $item,
        $additional = []
    ) {
        /** @var Item $orderItem */
        $orderItem = $proceed($item, $additional);

        if (!$item->getVendorId()) {
            $productId = $item->getProductId();
            $id = $this->vproducts->loadByField('product_id', $productId)->getVendorId();
            $orderItem->setVendorId($id);
            return $orderItem;
        }
        $orderItem->setVendorId($item->getVendorId());
        return $orderItem;
    }
}
