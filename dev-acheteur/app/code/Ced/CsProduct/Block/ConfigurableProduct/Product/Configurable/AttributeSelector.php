<?php


namespace Ced\CsProduct\Block\ConfigurableProduct\Product\Configurable;

use Magento\ConfigurableProduct\Block\Product\Configurable\AttributeSelector as ConfigurableAttributeSelector;

class AttributeSelector extends ConfigurableAttributeSelector
{
    protected function _construct()
    {
        parent::_construct();
        $this->setData(
            'area',
            'adminhtml'
        );
    }

    /**
     * Attribute set creation action URL
     *
     * @return string
     */
    public function getAttributeSetCreationUrl()
    {
        return $this->getUrl('*/product_set/save');
    }

    /**
     * Get options for suggest widget
     *
     * @return array
     */
    public function getSuggestWidgetOptions()
    {
        return [
            'source' => $this->getUrl('*/product_attribute/suggestConfigurableAttributes'),
            'minLength' => 0,
            'className' => 'category-select',
            'showAll' => true
        ];
    }
}
