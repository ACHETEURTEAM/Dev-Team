<?php


namespace Ced\CsMarketplace\Controller\Adminhtml\Vpayments;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class AddOrders
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vpayments
 */
class AddOrders extends \Ced\CsMarketplace\Controller\Adminhtml\Vendor
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
     * @return void
     */
    public function execute()
    {
        $this->getResponse()
            ->setBody(
                $this->resultPageFactory->create(true)
                    ->getLayout()
                    ->createBlock(
                        \Ced\CsMarketplace\Block\Adminhtml\Vpayments\Edit\Tab\Addorder::class
                    )->getAddOrderBlock()
            );
    }
}
