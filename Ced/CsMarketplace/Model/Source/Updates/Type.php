<?php


namespace Ced\CsMarketplace\Model\Source\Updates;

/**
 * Class Type
 * @package Ced\CsMarketplace\Model\Source\Updates
 */
class Type extends \Magento\Framework\Model\AbstractModel
{

    const TYPE_PROMO = 'PROMO';
    const TYPE_NEW_RELEASE = 'NEW_RELEASE';
    const TYPE_UPDATE_RELEASE = 'UPDATE_RELEASE';
    const TYPE_INFO = 'INFO';
    const TYPE_INSTALLED_UPDATE = 'INSTALLED_UPDATE';

    /**
     * Returns label for value
     *
     * @param  string $value
     * @return string
     */
    public function getLabel($value)
    {
        $options = $this->toOptionArray();
        foreach ($options as $v) {
            if ($v['value'] == $value) {
                return $v['label'];
            }
        }
        return '';
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::TYPE_INSTALLED_UPDATE, 'label' => __('Only Installed Extension(s) Updates')],
            ['value' => self::TYPE_UPDATE_RELEASE, 'label' => __('All Extensions Updates')],
            ['value' => self::TYPE_NEW_RELEASE, 'label' => __('New Releases')],
            ['value' => self::TYPE_PROMO, 'label' => __('Special Offers')],
            ['value' => self::TYPE_INFO, 'label' => __('Other Information')]
        ];
    }

    /**
     * Returns array ready for use by grid
     *
     * @return array
     */
    public function getGridOptions()
    {
        $items = $this->getAllOptions();
        $out = array();
        foreach ($items as $item) {
            $out[$item['value']] = $item['label'];
        }
        return $out;
    }

    /**
     * Retrieve all attribute options
     *
     * @return array
     */
    public function getAllOptions()
    {
        return $this->toOptionArray();
    }
}
