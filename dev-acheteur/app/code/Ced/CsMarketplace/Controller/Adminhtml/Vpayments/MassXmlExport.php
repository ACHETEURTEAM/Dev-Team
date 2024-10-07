<?php



namespace Ced\CsMarketplace\Controller\Adminhtml\Vpayments;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class MassXmlExport
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vpayments
 */
class MassXmlExport extends \Magento\Framework\App\Action\Action
{
    const FILE_NAME = 'vendor_transaction.xml';
    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $fileFactory;

    /**
     * MassXmlExport constructor.
     * @param Context $context
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory
    ) {
        $this->fileFactory = $fileFactory;
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $content = $this->_view->getLayout()->createBlock('Ced\CsMarketplace\Block\Adminhtml\Vpayments\Grid');

        return $this->fileFactory->create(
            self::FILE_NAME,
            $content->getExcelFile(self::FILE_NAME),
            DirectoryList::VAR_DIR
        );
    }
}
