<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vproducts\Renderer;


/**
 * Class Reason
 * @package Ced\CsMarketplace\Block\Adminhtml\Vproducts\Renderer
 */
class Reason extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{

    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        return ($row->getId() && $row->getCheckStatus() == 0) ? $row->getReason() : "N/A";
    }
}
