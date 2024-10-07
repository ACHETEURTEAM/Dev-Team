<?php


namespace Ced\CsProduct\Controller\Vproducts;

class Grid extends \Ced\CsMarketplace\Controller\Vendor
{

    /**
     * Grid action
     *
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout(false);
        $this->_view->renderLayout();
    }
}
