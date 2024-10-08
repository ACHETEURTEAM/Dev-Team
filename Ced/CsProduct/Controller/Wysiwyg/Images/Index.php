<?php


namespace Ced\CsProduct\Controller\Wysiwyg\Images;

class Index extends \Ced\CsProduct\Controller\Wysiwyg\Images
{
    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * @var \Magento\Cms\Helper\Wysiwyg\Images
     */
    protected $images;

    /**
     * Index constructor.
     * @param \Magento\Cms\Helper\Wysiwyg\Images $images
     * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Cms\Model\Wysiwyg\Images\Storage $storage
     */
    public function __construct(
        \Magento\Cms\Helper\Wysiwyg\Images $images,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Cms\Model\Wysiwyg\Images\Storage $storage
    ) {
        $this->resultLayoutFactory = $resultLayoutFactory;
        $this->images = $images;
        parent::__construct($context, $coreRegistry, $storage);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $storeId = (int)$this->getRequest()->getParam('store');

        try {
            $this->images->getCurrentPath();
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $this->_initAction();

        $resultLayout = $this->resultLayoutFactory->create();
        $resultLayout->addHandle('overlay_popup');
        $block = $resultLayout->getLayout()->getBlock('wysiwyg_images.js');
        if ($block) {
            $block->setStoreId($storeId);
        }
        return $resultLayout;
    }
}
