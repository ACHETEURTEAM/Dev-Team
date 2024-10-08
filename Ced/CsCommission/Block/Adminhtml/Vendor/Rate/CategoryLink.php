<?php



namespace Ced\CsCommission\Block\Adminhtml\Vendor\Rate;

class CategoryLink extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _renderValue(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $button = $this->getLayout()->createBlock(
            \Ced\CsCommission\Block\Adminhtml\Vendor\Rate\Category\Button::class
        );
        if ($element->getTooltip()) {
            $html = '<td class="value with-tooltip">';
            $html .= $this->_getElementHtml($element);
            $html .= '<div class="tooltip"><span class="help"><span></span></span>';
            $html .= '<div class="tooltip-content">' . $element->getTooltip() . '</div></div>';
        } else {
            $html = '<td class="value">';
            $html .= $button->toHtml();
        }
        if ($element->getComment()) {
            $html .= '<p class="note"><span>' . $element->getComment() . '</span></p>';
        }
        $html .= '</td>';
        return $html;
    }
}
