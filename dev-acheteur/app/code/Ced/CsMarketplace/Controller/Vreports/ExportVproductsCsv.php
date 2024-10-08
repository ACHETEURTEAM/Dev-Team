<?php



namespace Ced\CsMarketplace\Controller\Vreports;

use Ced\CsMarketplace\Helper\Vreports\Vproducts;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class ExportVproductsCsv
 * @package Ced\CsMarketplace\Controller\Vreports
 */
class ExportVproductsCsv extends \Magento\Framework\App\Action\Action
{

    /**
     * @var Vproducts
     */
    public $reportProduct;
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
     * ExportVproductsCsv constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param Vproducts $reportproduct
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        Vproducts $reportproduct
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->_fileFactory = $fileFactory;
        $this->reportProduct = $reportproduct;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function execute()
    {
        $filename = 'vendor_product_report.csv';
        $content = $this->reportProduct->getCSvData();

        if (!$content)
            $content = '';

        return $this->_fileFactory->create($filename, $content, DirectoryList::VAR_DIR);
    }
}
