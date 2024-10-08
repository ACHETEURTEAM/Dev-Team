<?php


namespace Ced\CsEnhancement\Helper;

use Magento\Framework\App\Helper\Context;

/**
 * Class File
 * @package Ced\CsEnhancement\Helper
 */
class File extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var \Magento\Framework\File\Size
     */
    protected $fileSize;

    /**
     * File constructor.
     * @param \Magento\Framework\File\Size $fileSize
     * @param Context $context
     */
    public function __construct(
        \Magento\Framework\File\Size $fileSize,
        Context $context
    ) {
        parent::__construct($context);
        $this->fileSize = $fileSize;
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getMaxFileSizeMessage()
    {
        $maxImageSize = $this->fileSize->getFileSizeInMb($this->getMaxFileSize());
        return __('Make sure your file isn\'t more than %1 MB.', (($maxImageSize) ? $maxImageSize : 100));
    }

    /**
     * @return float
     */
    public function getMaxFileSize()
    {
        return $this->fileSize->getMaxFileSize();
    }
}
