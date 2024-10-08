<?php


namespace Ced\CsCommission\Block\Adminhtml\Vendor\Rate;

class Method extends \Magento\Framework\View\Element\Html\Select
{

    const METHOD_FIXED = 'fixed';
    const METHOD_PERCENTAGE = 'percentage';

    /**
     * @param $value
     * @return mixed
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        $this->setExtraParams('style="width: 110px;"');
        if (!$this->getOptions()) {
            $this->addOption(self::METHOD_FIXED, __('Fixed'));
            $this->addOption(self::METHOD_PERCENTAGE, __('Percentage'));
        }
        return parent::_toHtml();
    }
}
