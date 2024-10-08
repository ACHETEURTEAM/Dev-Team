<?php


namespace Ced\CsOrder\Controller\Shipment;

class Grid extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * Grid action
     * @return void
     */
    public function execute()
    {
        $this->getResponse()->setBody($this->resultPageFactory->create(true)->getLayout()
            ->createBlock(\Ced\CsOrder\Block\ListShipment\Grid::class)->toHtml());
    }
}
