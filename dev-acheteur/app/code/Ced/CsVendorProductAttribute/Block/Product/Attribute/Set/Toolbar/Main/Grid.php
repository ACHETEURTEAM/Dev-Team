<?php


namespace Ced\CsVendorProductAttribute\Block\Product\Attribute\Set\Toolbar\Main;

/**
 * Class Grid
 * @package Ced\CsVendorProductAttribute\Block\Product\Attribute\Set\Toolbar\Main
 */
class Grid extends \Magento\Backend\Block\Widget\Grid
{
    public function _construct()
    {
        parent::_construct();
        $this->setData('area','adminhtml');
    }

    protected function _prepareFilterButtons()
    {
        $this->setChild(
            'reset_filter_button',
            $this->getLayout()->createBlock(
                'Magento\Backend\Block\Widget\Button'
            )->setData(
                [
                    'label' => __('Reset Filter'),
                    'onclick' => $this->getJsObjectName() . '.resetFilter()',
                    'class' => 'action-reset action-tertiary',
                    'area' => 'adminhtml'
                ]
            )->setDataAttribute(['action' => 'grid-filter-reset'])
        );
        $this->setChild(
            'search_button',
            $this->getLayout()->createBlock(
                'Magento\Backend\Block\Widget\Button'
            )->setData(
                [
                    'label' => __('Search'),
                    'onclick' => $this->getJsObjectName() . '.doFilter()',
                    'class' => 'action-secondary',
                    'area' => 'adminhtml'
                ]
            )->setDataAttribute(['action' => 'grid-filter-apply'])
        );
    }
}
