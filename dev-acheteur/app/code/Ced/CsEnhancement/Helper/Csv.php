<?php


namespace Ced\CsEnhancement\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\FileSystemException;

/**
 * Class Csv
 * @package Ced\CsEnhancement\Helper
 */
class Csv extends AbstractHelper
{
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;

    /**
     * Csv constructor.
     * @param \Magento\Framework\Filesystem $filesystem
     * @param Context $context
     */
    public function __construct(
        \Magento\Framework\Filesystem $filesystem,
        Context $context
    ) {
        parent::__construct($context);
        $this->filesystem = $filesystem;
    }

    /**
     * @param $filename
     * @param array $csv_row
     * @param string $folder
     * @return array
     */
    public function createCsv($filename, $csv_row = [], $folder = 'csenhancement')
    {
        try {
            $filename .= '.csv';
            $filePath = $folder . '/' . $filename;

            $directory = $this->filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
            $directory->create($folder);

            /* Open file */
            $stream = $directory->openFile($filePath, 'w+');
            $stream->lock();

            foreach ($csv_row as $row) {
                $stream->writeCsv($row);
            }

            $stream->unlock();
            $stream->close();

            $return = [
                'success' => true,
                'path' => $filePath,
                'filename' => $filename,
            ];
        } catch (FileSystemException $e) {
            $return = ['success' => false, 'error_code' => $e->getCode(), 'error' => $e->getMessage()];
        }

        return $return;
    }
}
