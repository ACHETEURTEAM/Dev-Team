<?php


namespace Ced\CsMarketplace\Model\Product;

use Magento\Framework\Data\OptionSourceInterface;
use Ced\CsMarketplace\Model\Vproducts;

/**
 * Class ProductStatus
 */
class Type implements OptionSourceInterface
{

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];

        $options[] = [
            'label' => __('Simple Product'),
            'value' => 'simple',
        ];

        $options[] = [
            'label' => __('Virtual Product'),
            'value' => 'virtual',
        ];
        $options[] = [
            'label' => __('Downloadable Product'),
            'value' => 'downloadable',
        ];
                     
        return $options;
    }
}