<?php


namespace Ced\CsOrder\Block\Order\Invoice;

class Create extends \Magento\Sales\Block\Adminhtml\Order\Invoice\Create
{
    /**
     * Constructor
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->buttonList->remove('reset');
    }

    /**
     * Retrieve back url
     * @return string
     */
    public function getBackUrl()
    {
        $vOrder = $this->_coreRegistry->registry('current_vorder');
        $order = $this->_coreRegistry->registry('current_order');
        return $this->getUrl(
            'csorder/vorders/view',
            [
                'order_id' => $order->getId(),
                'vorder_id' => $vOrder->getId()
            ]
        );
    }
}
