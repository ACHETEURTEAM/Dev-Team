<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vendor\Entity\Grid\Renderer;


/**
 * Class Reason
 * @package Ced\CsMarketplace\Block\Adminhtml\Vendor\Entity\Grid\Renderer
 */
class Reason extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{

    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        return ($row->getId() && $row->getStatus() == "disapproved") ? $row->getReason() : "N/A";
    }

}
