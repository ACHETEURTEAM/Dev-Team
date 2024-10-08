<?php

namespace Ced\CsMarketplace\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Vpaymentsgrid
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vendor
 */
class Vpaymentsgrid extends \Ced\CsMarketplace\Controller\Adminhtml\Vendor
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
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return PageFactory
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}