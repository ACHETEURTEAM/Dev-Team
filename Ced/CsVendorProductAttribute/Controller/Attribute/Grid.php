<?php


namespace Ced\CsVendorProductAttribute\Controller\Attribute;

class Grid extends \Magento\Framework\App\Action\Action
{
    /*
     * Load all the grid action through Ajax
     */
    public function execute()
    {

        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('csvendorproductattribute/attribute_grid')->toHtml()
        );

    }
}
