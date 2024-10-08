<?php


namespace Ced\CsMarketplace\Model\System\Config\Source;

/**
 * Class Dob
 * @package Ced\CsMarketplace\Model\System\Config\Source
 */
class Dob extends \Ced\CsMarketplace\Model\System\Config\Source\AbstractBlock
{

    /**
     * Retrieve Option values array
     *
     * @return array
     */
    public function toOptionArray()
    {
        /*   return [
             ['value' => 1, 'label'=>__('Male')],
             ['value' => 2, 'label'=>__('Female')],
             ['value' => 3, 'label'=>__('Common')]
         ]; */
        return ['1' => __('Male'), '2' => __('Female'), '3' => __('Other')];
    }
}
