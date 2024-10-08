<?php


namespace Ced\CsProduct\Controller\Configurable\Attribute;

use Magento\Framework\View\Result\PageFactory;

class NewAction extends \Ced\CsProduct\Controller\Configurable\Attribute
{
    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * NewAction constructor.
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\App\Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param \Magento\Eav\Model\Entity $entity
     * @param \Magento\Catalog\Model\Product\Url $productUrl
     */
    public function __construct(
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\App\Action\Context $context,
        PageFactory $resultPageFactory,
        \Magento\Eav\Model\Entity $entity,
        \Magento\Catalog\Model\Product\Url $productUrl
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context, $resultPageFactory, $entity, $productUrl);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        return $this->resultForwardFactory->create()->forward('edit');
    }
}
