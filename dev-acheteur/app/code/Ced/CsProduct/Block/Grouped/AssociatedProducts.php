<?php


namespace Ced\CsProduct\Block\Grouped;

use Magento\GroupedProduct\Block\Product\Grouped\AssociatedProducts as GroupedAssociatedProducts;

class AssociatedProducts extends GroupedAssociatedProducts
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('grouped_product_container');
        $this->setData('area', 'adminhtml');
    }
}
