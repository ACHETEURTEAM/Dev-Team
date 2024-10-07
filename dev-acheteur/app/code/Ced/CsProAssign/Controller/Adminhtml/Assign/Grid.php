<?php

namespace Ced\CsProAssign\Controller\Adminhtml\Assign;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Grid
 * @package Ced\CsProAssign\Controller\Adminhtml\Assign
 */
class Grid extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {
        $this->getResponse()->setBody($this->resultPageFactory->create(true)->getLayout()->createBlock('Ced\CsProAssign\Block\Adminhtml\Items\Grid')->toHtml());
    }
}
