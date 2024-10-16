<?php


namespace Ced\CsMarketplace\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class OrderPaymentStatus
 * @package Ced\CsMarketplace\Model\System\Config
 */
class OrderPaymentStatus implements ArrayInterface
{
    /**#@+
     * Constants defined for keys of  options array
     */
    const STATE_OPEN = 1;

    const STATE_PAID = 2;

    const STATE_CANCELED = 3;

    const STATE_PARTIALLY_PAID = 6;
    /**#@-*/

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => self::STATE_OPEN, 'label' => __('Pending')],
            ['value' => self::STATE_PAID, 'label' => __('Paid')],
            ['value' => self::STATE_CANCELED, 'label' => __('Canceled')],
            ['value' => self::STATE_PARTIALLY_PAID, 'label' => __('Partially Paid')],
        ];
        return $options;
    }
}
