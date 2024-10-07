<?php


namespace Ced\CsVendorProductAttribute\Model\View\Element;

use Magento\Framework\View\Element\Template as FrameworkTemplate;
/**
 * Class Template
 * @package Ced\CsVendorProductAttribute\Model\View\Element
 */
class Template extends FrameworkTemplate
{
    /**
     * @param null $template
     * @return mixed
     */
    public function getTemplateFile($template = null)
    {
        $params = ['module' => $this->getModuleName()];
        $area = $this->getArea();
        if ($area) {
            $params['area'] = $area;
        }

        if($this->getTemplate()=="Magento_ProductVideo::product/edit/base_image.phtml" ||
            $this->getTemplate()=="Magento_Catalog::catalog/wysiwyg/js.phtml" ||
        	$this->getTemplate()=="Magento_Backend::widget/button.phtml" ||
			$this->getTemplate()=="Magento_Backend::widget/grid/extended.phtml" ||
            $this->getTemplate()=="Magento_Backend::pageactions.phtml" ||
			$this->getTemplate()=="Magento_ConfigurableProduct::product/configurable/stock/disabler.phtml" ||
			$this->getTemplate()=="Magento_ConfigurableProduct::product/configurable/affected-attribute-set-selector/form.phtml")
        {
        	$params['area'] = 'adminhtml';
        }
        return $this->resolver->getTemplateFileName($template ?: $this->getTemplate(), $params);
    }
}
