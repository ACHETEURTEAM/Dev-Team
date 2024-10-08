<?php


namespace Ced\CsMarketplace\Model\System\Config\Source;

/**
 * Class LoginPageBanner
 * @package Ced\CsMarketplace\Model\System\Config\Source
 */
class LoginPageBanner implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['value' => 'image', 'label' => __('Image')];
        $options[] = ['value' => 'video', 'label' => __('Video')];
        return $options;
    }
}
