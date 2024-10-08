<?php


namespace Ced\CsMarketplace\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;


/**
 * Class TransactionIdOptions
 * @package Ced\CsMarketplace\Model\System\Config\Source
 */
class TransactionIdOptions implements OptionSourceInterface
{

    const MANUAL = 0;
    const AUTO = 1;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => self::AUTO, 'label' => __('Auto')],
            ['value' => self::MANUAL, 'label' => __('Manual')]
        ];
        return $options;
    }
}
