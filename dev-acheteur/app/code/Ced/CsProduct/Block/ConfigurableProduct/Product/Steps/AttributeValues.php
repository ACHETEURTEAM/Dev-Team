<?php


namespace Ced\CsProduct\Block\ConfigurableProduct\Product\Steps;

use Magento\ConfigurableProduct\Block\Adminhtml\Product\Steps\AttributeValues as StepsAttributeValues;

class AttributeValues extends StepsAttributeValues
{
    /**
     * {@inheritdoc}
     */
    public function getCaption()
    {
        return __('Attribute Values');
    }
}
