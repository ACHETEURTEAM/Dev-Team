<?php


namespace Ced\CsMarketplace\Block\Widget\Form\Renderer\Fieldset;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;
use Magento\Framework\View\Element\Template;


/**
 * Class Element
 * @package Ced\CsMarketplace\Block\Widget\Form\Renderer\Fieldset
 */
class Element extends Template implements RendererInterface
{

    /**
     * @var
     */
    protected $_element;

    /**
     * @var string
     */
    protected $_template = 'Ced_CsMarketplace::widget/form/renderer/fieldset/element.phtml';


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
}
