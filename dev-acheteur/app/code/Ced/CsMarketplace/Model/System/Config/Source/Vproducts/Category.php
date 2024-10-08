<?php


namespace Ced\CsMarketplace\Model\System\Config\Source\Vproducts;

/**
 * Class Category
 * @package Ced\CsMarketplace\Model\System\Config\Source\Vproducts
 */
class Category extends \Ced\CsMarketplace\Model\System\Config\Source\AbstractBlock
{

    /**
     * Supported Product Type by Ced_CsMarketplace extension.
     */
    const XML_PATH_CED_CSMARKETPLACE_VPRODUCTS_CATEGORY_MODE = 'global/ced_csmarketplace/vproducts/category_mode';
    const XML_PATH_CED_CSMARKETPLACE_VPRODUCTS_CATEGORY = 'global/ced_csmarketplace/vproducts/category';

    /**
     * Retrieve Option values array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        $options[] = ['value' => '0', 'label' => __('All Allowed Categories')];
        $options[] = ['value' => '1', 'label' => __('Specific Categories')];
        return $options;
    }
}
