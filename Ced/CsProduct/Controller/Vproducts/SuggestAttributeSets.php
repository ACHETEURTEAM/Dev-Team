<?php


namespace Ced\CsProduct\Controller\Vproducts;

class SuggestAttributeSets extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Magento\Catalog\Model\Product\AttributeSet\SuggestedSet
     */
    protected $suggestedSet;

    /**
     * SuggestAttributeSets constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Catalog\Model\Product\AttributeSet\SuggestedSet $suggestedSet
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Catalog\Model\Product\AttributeSet\SuggestedSet $suggestedSet
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->suggestedSet = $suggestedSet;
    }

    /**
     * Action for attribute set selector
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setData(
            $this->suggestedSet->getSuggestedSets($this->getRequest()->getParam('label_part'))
        );
        return $resultJson;
    }
}
