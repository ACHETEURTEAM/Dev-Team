<?php

namespace Ced\CsMarketplace\Controller\Vpayments;

/**
 * Class Grid
 * @package Ced\CsMarketplace\Controller\Vpayments
 */
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
