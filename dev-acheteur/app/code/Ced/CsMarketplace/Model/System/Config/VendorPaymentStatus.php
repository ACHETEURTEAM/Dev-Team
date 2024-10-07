<?php


namespace Ced\CsMarketplace\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class VendorPaymentStatus
 * @package Ced\CsMarketplace\Model\System\Config
 */
class VendorPaymentStatus implements ArrayInterface
{
    /**#@+
     * Constants defined for keys of  options array
     */
    const STATE_OPEN = 1;

    const STATE_PAID = 2;

    const STATE_CANCELED = 3;

    const STATE_REFUND = 4;

    const STATE_REFUNDED = 5;


    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => self::STATE_OPEN, 'label' => __('Pending')],
            ['value' => self::STATE_PAID, 'label' => __('Paid')],
            ['value' => self::STATE_CANCELED, 'label' => __('Canceled')],
            // ['value' => self::STATE_REFUND, 'label' => __('Refund')],
            // ['value' => self::STATE_REFUNDED, 'label' => __('Refunded')],
        ];
        return $options;
    }
}
