<?php


namespace Ced\CsOrder\Controller\Shipment;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\UrlFactory;
use Magento\Framework\View\Result\PageFactory;

class Exportcsv extends \Ced\CsMarketplace\Controller\Vendor
{
    const CSV_FILE_NAME   = 'creditmemos.csv';

    /**
     * Grid action
     * @return void
     */
    public function execute()
    {
        $grid = $this->resultPageFactory->create(true)->getLayout()->createBlock(
            \Ced\CsOrder\Block\ListShipment\Grid::class
        );
        $this->_prepareDownloadResponse(self::CSV_FILE_NAME, $grid->getCsvFile());
    }
}
