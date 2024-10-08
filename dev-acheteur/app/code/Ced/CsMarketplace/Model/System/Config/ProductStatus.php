<?php


namespace Ced\CsMarketplace\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Status
 * @package Ced\Brand\Model\System\Config
 */
class ProductStatus implements ArrayInterface
{
    /**#@+
     * Constants defined for keys of  options array
     */
    const NOT_APPROVED_STATUS = 0;

    const APPROVED_STATUS = 1;

    const PENDING_STATUS = 2;
    /**#@-*/

    /**
     * @param bool $isMultiselect
     * @return array
     */
    public function toOptionArray($isMultiselect = false)
    {
        $options = [
            ['value' => self::APPROVED_STATUS, 'label' => __('Approved')],
            ['value' => self::PENDING_STATUS, 'label' => __('Pending')],
            ['value' => self::NOT_APPROVED_STATUS, 'label' => __('Disapproved')],
        ];
        return $options;
    }
}
