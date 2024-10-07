<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vproducts\Renderer;


/**
 * Class View
 * @package Ced\CsMarketplace\Block\Adminhtml\Vproducts\Renderer
 */
class View extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{

    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $id = $row->getId();

        $html =
            '<a href="#popup" onClick="javascript:window.open(\'' . $this->getUrl('catalog/product/edit/id/' . $id) .
            '\')" title="' . __("Click to View") . '">' . __("View") . '</a>';
        return $html;
    }
}
