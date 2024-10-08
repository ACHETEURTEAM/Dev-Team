<?php


namespace Ced\CsTransaction\Block\Adminhtml\Vorder\Items\Grid\Renderer;

class Orderid extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        if ($row->getOrderId() != '') {
            $url = $this->getUrl("csorder/vendororder/view", ['vorder_id' => $row->getParentId()]);

            $html = '<a href="#popup" onClick="window.open(\'' .
                $url .
                '\',\'apiwizard,toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes,
                resizable=yes, ,left=100, top=100, width=1024, height=640\')" >' .
                $row->getOrderIncrementId() . '</a>';
            return $html;
        } else {
            return '';
        }
    }
}
