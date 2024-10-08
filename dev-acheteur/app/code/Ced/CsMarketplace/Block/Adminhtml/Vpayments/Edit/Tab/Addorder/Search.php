<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vpayments\Edit\Tab\Addorder;


/**
 * Class Search
 * @package Ced\CsMarketplace\Block\Adminhtml\Vpayments\Edit\Tab\Addorder
 */
class Search extends \Magento\Sales\Block\Adminhtml\Order\Create\Search
{
    /**
     * @return mixed
     */
    public function getButtonsHtml()
    {
        $addButtonData = array(
            'label' => __('Add Selected Amount(s) for Payment'),
            'onclick' => 'addorder()',
            'class' => 'add',
        );
        return $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')->setData($addButtonData)
            ->toHtml();
    }

    /**
     * @return mixed
     */
    public function getHeaderText()
    {
        return __('Please Select Amount(s) to Add');
    }
}
