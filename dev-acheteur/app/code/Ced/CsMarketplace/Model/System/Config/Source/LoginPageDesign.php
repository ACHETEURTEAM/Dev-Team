<?php


namespace Ced\CsMarketplace\Model\System\Config\Source;

use Ced\CsMarketplace\Helper\Data;

/**
 * Class LoginPageDesign
 * @package Ced\CsMarketplace\Model\System\Config\Source
 */
class LoginPageDesign implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['value' => Data::LOGIN_DEFAULT_DESIGN, 'label' => __('Basic')];
        $options[] = ['value' => Data::LOGIN_ADVANCE_DESIGN, 'label' => __('Advanced')];
        return $options;
    }
}
