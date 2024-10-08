<?php


namespace Ced\CsOrder\Controller\Invoice;

class Grid extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * Grid action
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout(false);
        $this->_view->renderLayout();
    }
}
