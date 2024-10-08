<?php



namespace Ced\CsMarketplace\Controller\Vreports;

use Ced\CsMarketplace\Helper\Vreports\Vorders;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class ExportVordersCsv
 * @package Ced\CsMarketplace\Controller\Vreports
 */
class ExportVordersCsv extends \Magento\Framework\App\Action\Action
{

    /**
     * @var Vorders
     */
    public $reportOrder;
    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory;
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var \Magento\Framework\Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * ExportVordersCsv constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param \Ced\CsMarketplace\Helper\Vreports\Vorders $reportorder
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        Vorders $reportorder
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->_fileFactory = $fileFactory;
        $this->reportOrder = $reportorder;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     * @throws \Exception
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function execute()
    {
        $filename = 'vendor_orders_report.csv';
        $content = $this->reportOrder->getCSvData();

        if (!$content)
            $content = '';

        return $this->_fileFactory->create($filename, $content, DirectoryList::VAR_DIR);

    }
}
