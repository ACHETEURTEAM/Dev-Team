<?php


namespace Ced\CsMarketplace\Block\Vpayments\View;

use Magento\Framework\Data\Form\Element\AbstractElement;


/**
 * Class Element
 * @package Ced\CsMarketplace\Block\Vpayments\View
 */
class Element extends \Ced\CsMarketplace\Block\Widget\Form\Renderer\Fieldset\Element
{

    /**
     * @var
     */
    protected $_element;

    /**
     * @return mixed
     */
    public function getElement()
    {
        return $this->_element;
    }

    /**
     * @param AbstractElement $element
     * @return mixed
     */
    public function render(AbstractElement $element)
    {
        $this->_element = $element;
        return $this->toHtml();
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->setTemplate('Ced_CsMarketplace::vpayments/view/element.phtml');
    }
}
