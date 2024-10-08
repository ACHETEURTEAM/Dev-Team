<?php


namespace Ced\CsTransaction\Block\Adminhtml\Vpayments\Edit\Tab\Addorder;

class Search extends \Magento\Sales\Block\Adminhtml\Order\Create\Search
{
    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getButtonsHtml()
    {
        $addButtonData = [
                'label' => __('Add Selected Amount(s) for Payment'),
                'onclick' => 'addorder()',
                'class' => 'add',
        ];
        return $this->getLayout()->createBlock(\Magento\Backend\Block\Widget\Button::class)
            ->setData($addButtonData)->toHtml();
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Please Select Amount(s) to Add');
    }
}
