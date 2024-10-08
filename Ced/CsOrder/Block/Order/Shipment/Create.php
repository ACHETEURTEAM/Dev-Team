<?php


namespace Ced\CsOrder\Block\Order\Shipment;

class Create extends \Magento\Shipping\Block\Adminhtml\Create
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'order_id';
        $this->_mode = 'create';

        parent::_construct();

        $this->buttonList->remove('reset');
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl(
            'csorder/vorders/view',
            [
                'order_id' => $this->getShipment() ? $this->getRequest()->getParam('order_id') : null,
                'vorder_id' => $this->getShipment() ? $this->getRequest()->getParam('vorder_id') : null
            ]
        );
    }
}
