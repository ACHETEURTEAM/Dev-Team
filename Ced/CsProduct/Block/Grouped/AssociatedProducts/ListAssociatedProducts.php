<?php


namespace Ced\CsProduct\Block\Grouped\AssociatedProducts;

use Magento\GroupedProduct\Block\Product\Grouped\AssociatedProducts\ListAssociatedProducts
    as GroupedListAssociatedProducts;

class ListAssociatedProducts extends GroupedListAssociatedProducts
{
    protected function _construct()
    {
        parent::_construct();
        $this->setData('area', 'adminhtml');
    }
}
