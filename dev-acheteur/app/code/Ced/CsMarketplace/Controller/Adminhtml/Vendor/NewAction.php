<?php


namespace Ced\CsMarketplace\Controller\Adminhtml\Vendor;

/**
 * Class NewAction
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vendor
 */
class NewAction extends \Ced\CsMarketplace\Controller\Adminhtml\Vendor
{
    /**
     * New action
     *
     * @return void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
