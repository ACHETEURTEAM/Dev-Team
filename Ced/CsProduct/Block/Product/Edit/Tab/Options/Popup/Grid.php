<?php


namespace Ced\CsProduct\Block\Product\Edit\Tab\Options\Popup;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Tab\Options\Popup\Grid as PopupGrid;

class Grid extends PopupGrid
{
    protected function _construct()
    {
        parent::_construct();
        $this->setData('area', 'adminhtml');
    }

    /**
     * Define grid update URL for ajax queries
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('csproduct/*/optionsimportgrid');
    }

    /**
     * @return string
     */
    public function getMainButtonsHtml()
    {
        $html = '';
        if ($this->getFilterVisibility()) {
            $html .= $this->getSearchButtonHtml();
            $html .= $this->getResetFilterButtonHtml();
        }
        return $html;
    }

    /**
     * @return mixed
     */
    public function getSearchButtonHtml()
    {
        return $this->getChildHtml('search_button');
    }

    /**
     * @return mixed
     */
    public function getResetFilterButtonHtml()
    {
        return $this->getChildHtml('reset_filter_button');
    }

    protected function _prepareFilterButtons()
    {
        $this->setChild(
            'reset_filter_button',
            $this->getLayout()->createBlock(
                \Magento\Backend\Block\Widget\Button::class
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
                \Magento\Backend\Block\Widget\Button::class
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
