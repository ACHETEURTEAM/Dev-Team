<?php



namespace Ced\CsMarketplace\Controller\Vorders;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class ExportOrderCSV
 * @package Ced\CsMarketplace\Controller\Vorders
 */
class ExportOrderCSV extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Ced\CsMarketplace\Helper\Order
     */
    protected $orderHelper;

    /**
     * ExportOrderCSV constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param \Ced\CsMarketplace\Helper\Order $orderHelper
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Ced\CsMarketplace\Helper\Order $orderHelper
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_fileFactory = $fileFactory;
        $this->orderHelper = $orderHelper;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $filename = 'vendor_orders.csv';
        $content = $this->orderHelper->getCSvData();

        return $this->_fileFactory->create($filename, $content, DirectoryList::VAR_DIR);
    }
}
