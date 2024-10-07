<?php



namespace Ced\CsProAssign\Block\Adminhtml\Vendor\Products\Renderer;

/**
 * Class Remove
 * @package Ced\CsMarketplace\Block\Adminhtml\Vendor\Products\Renderer
 */
class Remove extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{

    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $id = $row->getId();
        $html = '<a href="'.$this->getUrl('csassign/assign/remove',['id'=>$id,'vendor_id'=>$this->getRequest()->getParam('vendor_id')]).'">'.__("Remove").'</a>';
        return $html;
    }
}
