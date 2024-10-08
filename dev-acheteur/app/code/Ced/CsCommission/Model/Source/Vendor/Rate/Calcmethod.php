<?php


namespace Ced\CsCommission\Model\Source\Vendor\Rate;

class Calcmethod extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Returns label for value
     * @param string $value
     * @return string
     */
    public function getLabel($value)
    {
        $label = '';
        $options = $this->toOptionArray();
        foreach ($options as $v) {
            if ($v['value'] == $value) {
                $label = $v['label'];
            }
        }
        return $label;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => \Ced\CsCommission\Block\Adminhtml\Vendor\Rate\Method::METHOD_FIXED,
                'label' => __('Fixed')
            ],
            [
                'value' => \Ced\CsCommission\Block\Adminhtml\Vendor\Rate\Method::METHOD_PERCENTAGE,
                'label' => __('Percentage')
            ]
        ];
    }

    /**
     * Retrive all attribute options
     *
     * @return array
     */
    public function getAllOptions()
    {
        return $this->toOptionArray();
    }
}
