<?php


namespace Ced\CsOrder\Controller\Creditmemo;

class Exportexcel extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * Grid action
     * @return void
     */
    public function execute()
    {
        $fileName   = 'creditmemos.xml';
        $grid       = $this->resultPageFactory->create(true)->getLayout()
                      ->createBlock(\Ced\CsOrder\Block\ListCreditmemo\Grid::class);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }
}
