<?php


namespace Ced\CsOrder\Block\Adminhtml\Vendor\Products;

/**
 * Class Grid
 * @package Ced\CsOrder\Block\Adminhtml\Vendor\Products
 */
class Grid extends \Ced\CsMarketplace\Block\Adminhtml\Vendor\Entity\Edit\Tab\Vproducts
{
    /**
     * @return \Ced\CsMarketplace\Block\Adminhtml\Vendor\Entity\Edit\Tab\Vproducts|\Ced\CsMarketplace\Block\Adminhtml\Vproducts\Grid
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumnAfter(
            'remove',
            [
                'header' => __('Remove'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Remove'),
                        'url' => [
                            'base' => 'csassign/assign/remove'
                        ],
                        'field' => 'id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ], 'status'
        );

        return parent::_prepareColumns();
    }

    /**
     * @return \Ced\CsMarketplace\Block\Adminhtml\Vendor\Entity\Edit\Tab\Vproducts|\Ced\CsMarketplace\Block\Adminhtml\Vproducts\Grid|void
     */
    protected function _prepareMassaction()
    {
        $this->getMassactionBlock()->addItem(
            'remove', array(
                'label' => __('Remove'),
                'url' => $this->getUrl('csassign/assign/massDelete'),
                'confirm' => __('Are you sure?')
            )
        );
    }
}
