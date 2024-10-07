<?php



namespace Ced\CsMarketplace\Block\Adminhtml\System\Config\Frontend\Vproducts;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Category
 * @package Ced\CsMarketplace\Block\Adminhtml\System\Config\Frontend\Vproducts
 */
class Category extends Field
{

    /**
     * Return element html
     * @param AbstractElement $element
     * @return string
     * @throws LocalizedException
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->getLayout()
            ->createBlock(
                'Ced\CsMarketplace\Block\Adminhtml\System\Config\Frontend\Vproducts\Categories',
                'csmarketplace_system_config_categories'
            )->setElement($element)->toHtml();
    }
}
