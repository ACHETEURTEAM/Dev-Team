<?php


namespace Ced\CsTransaction\Block\Adminhtml\Vorder\Items\Grid\Renderer;

class Selected extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        if ($row->getOrderId() != '') {
            $params = $this->getRequest()->getParams();
            $orderIds = $params['order_ids'];
            $html = '<input type="checkbox" class="csmarketplace_relation_id checkbox" value="' . $orderIds .
                '" name="in_orders">';
            return $html;
        } else {
            return '';
        }
    }
}
