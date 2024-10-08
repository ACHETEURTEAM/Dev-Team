<?php


namespace Ced\CsTransaction\Controller\Adminhtml\Vpayments;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Grid extends \Ced\CsMarketplace\Controller\Adminhtml\Vendor
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Grid constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
