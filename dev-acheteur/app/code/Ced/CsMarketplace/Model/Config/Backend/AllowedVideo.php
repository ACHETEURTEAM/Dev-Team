<?php


namespace Ced\CsMarketplace\Model\Config\Backend;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class AllowedVideo
 * @package Ced\CsMarketplace\Model\Config\Backend
 */
class AllowedVideo extends \Magento\Config\Model\Config\Backend\File
{

    /**
     * Save uploaded file before saving config value
     *
     * @return $this
     * @throws LocalizedException
     */
    public function beforeSave()
    {
        $file = $this->getFileData();
        $cedValue = $this->getValue();
        if (!empty($file)) {
            $cedUploadDir = $this->_getUploadDir();
            try {
                /** @var Uploader $cedUploader */
                $cedUploader = $this->_uploaderFactory->create(['fileId' => $file]);
                $cedUploader->setAllowedExtensions($this->_getAllowedExtensions());
                $cedUploader->setAllowRenameFiles(true);
                $cedUploader->addValidateCallback('size', $this, 'validateMaxSize');
                $result = $cedUploader->save($cedUploadDir);
            } catch (\Exception $e) {
                throw new LocalizedException(__('%1', $e->getMessage()));
            }

            $cedFilename = $result['file'];
            if ($cedFilename) {
                if ($this->_addWhetherScopeInfo()) {
                    $cedFilename = $this->_prependScopeInfo($cedFilename);
                }
                $this->setValue($cedFilename);
            }
        } else {
            if (is_array($cedValue) && !empty($cedValue['delete'])) {
                $this->setValue('');
            } elseif (is_array($cedValue) && !empty($cedValue['value'])) {
                $this->setValue($cedValue['value']);
            } else {
                $this->unsValue();
            }
        }

        return $this;
    }

    /**
     * Getter for allowed extensions of uploaded files
     *
     * @return string[]
     */
    protected function _getAllowedExtensions()
    {
        return ['mp4', 'webm', 'mov'];
    }
}
