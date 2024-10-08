<?php


namespace Ced\CsMarketplace\Controller\Adminhtml\Vendor;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class MassCsvExport
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vendor
 */
class MassCsvExport extends \Magento\Framework\App\Action\Action
{
    const FILE_NAME = 'vendors.csv';
    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $fileFactory;

    /**
     * MassCsvExport constructor.
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
        $content = $this->_view->getLayout()->createBlock(
            \Ced\CsMarketplace\Block\Adminhtml\Vendor\Entity\Grid::class
        );

        return $this->fileFactory->create(
            self::FILE_NAME,
            $content->getCsvFile(self::FILE_NAME),
            DirectoryList::VAR_DIR
        );
    }
}
