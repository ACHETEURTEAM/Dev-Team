<?php


namespace Ced\CsMarketplace\Model\System\Config\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class ThemeColor
 * @package Ced\CsMarketplace\Model\System\Config\Source
 */
class ThemeColor implements \Magento\Framework\Data\OptionSourceInterface
{

    const XML_PATH_CED_CSMARKETPLACE_VENDOR_THEMECOLOR = 'ced_csmarketplace/vendor/themecolor';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * ThemeColor constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        if (is_array($this->getThemeColor())) {
            $options = [];
            foreach ($this->getThemeColor() as $color => $theme_color) {
                $options[] = [
                    'value' => $theme_color,
                    'label' => ucfirst($color)
                ];
            }
        }
        return $options;
    }

    /**
     * Retrieve theme color data form config.xml
     *
     * @return array
     */
    public function getThemeColor()
    {
        $themeColor = $this->scopeConfig->getValue(self::XML_PATH_CED_CSMARKETPLACE_VENDOR_THEMECOLOR);
        return json_decode(json_encode($themeColor), true);
    }
}
