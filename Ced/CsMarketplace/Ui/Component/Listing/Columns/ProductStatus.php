<?php


namespace Ced\CsMarketplace\Ui\Component\Listing\Columns;

use Magento\Framework\Data\OptionSourceInterface;
use Ced\CsMarketplace\Model\Vproducts;

/**
 * Class ProductStatus
 */
class ProductStatus implements OptionSourceInterface
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
            'label' => __('Approved'),
            'value' => Vproducts::APPROVED_STATUS,
        ];

        $options[] = [
            'label' => __('Pending'),
            'value' => Vproducts::PENDING_STATUS,
        ];
        $options[] = [
            'label' => __('Disapproved'),
            'value' => Vproducts::NOT_APPROVED_STATUS,
        ];
                     
        return $options;
    }
}
