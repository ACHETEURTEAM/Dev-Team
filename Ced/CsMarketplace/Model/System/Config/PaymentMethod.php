<?php


namespace Ced\CsMarketplace\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class PaymentMethod
 * @package Ced\CsMarketplace\Model\System\Config
 */
class PaymentMethod implements ArrayInterface
{
    const OFFLINE = 0;
    const ONLINE = 1;
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => self::OFFLINE, 'label' => __('Offline')],
            ['value' => self::ONLINE, 'label' => __('Online')]
        ];
        return $options;
    }
}