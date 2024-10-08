<?php


namespace Ced\CsProduct\Block\Product\Attribute\Edit\Tab;

/**
 * Class Options
 * @package Ced\CsProduct\Block\Product\Attribute\Edit\Tab
 */
class Options extends \Magento\Eav\Block\Adminhtml\Attribute\Edit\Options\AbstractOptions
{

    /**
     * @return mixed
     */
    protected function _prepareLayout()
    {
        $this->addChild('labels', 'Magento\Eav\Block\Adminhtml\Attribute\Edit\Options\Labels');
        $this->addChild('options', 'Magento\Eav\Block\Adminhtml\Attribute\Edit\Options\Options');
        return parent::_prepareLayout();
    }
}
