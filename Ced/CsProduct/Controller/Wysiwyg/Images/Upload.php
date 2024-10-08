<?php


namespace Ced\CsProduct\Controller\Wysiwyg\Images;

class Upload extends \Ced\CsProduct\Controller\Wysiwyg\Images
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * Upload constructor.
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Cms\Model\Wysiwyg\Images\Storage $storage
     */
    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Cms\Model\Wysiwyg\Images\Storage $storage
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context, $coreRegistry, $storage);
    }

    /**
     * Files upload processing
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $this->_initAction();
            $targetPath = $this->getStorage()->getSession()->getCurrentPath();
            $result = $this->getStorage()->uploadFile($targetPath, $this->getRequest()->getParam('type'));
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($result);
    }
}
