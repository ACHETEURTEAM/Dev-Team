<?php


namespace Ced\CsOrder\Block\Adminhtml\Vorders;

class View extends \Magento\Sales\Block\Adminhtml\Order\View
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'order_id';
        $this->_controller = 'adminhtml_order';
        $this->_mode = 'view';
        $this->buttonList->remove('delete');
        $this->buttonList->remove('reset');
        $this->buttonList->remove('save');
        $this->buttonList->remove('order_reorder');
        $this->buttonList->remove('order_ship');
        $this->buttonList->remove('order_invoice');
        $this->buttonList->remove('accept_payment');
        $this->buttonList->remove('deny_payment');
        $this->buttonList->remove('order_edit');
        $this->buttonList->remove('send_notification');
        $this->buttonList->remove('void_payment');
        $this->buttonList->remove('order_creditmemo');
        $this->buttonList->remove('order_unhold');
        $this->buttonList->remove('order_cancel');

        $this->buttonList->add(
            'back',
            [
                   'label' => __('Back'),
                   'onclick' => 'setLocation(\'' . $this->getBackUrl() . '\')',
                   'class' => 'back'
               ]
        );
    }

    /**
     * Return back url for view grid
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('csmarketplace/*/');
    }
}
