<?php


namespace Ced\CsOrder\Controller\Shipment;

class Exportexcel extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * Grid action
     * @return void
     */
    public function execute()
    {
        $fileName   = 'creditmemos.xml';
        $grid       = $this->resultPageFactory->create(true)->getLayout()->createBlock(
            \Ced\CsOrder\Block\ListShipment\Grid::class
        );
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }
}
