<?php



namespace Ced\CsMarketplace\Controller\Adminhtml\Vproducts;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class ChangeStatus
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vproducts
 */
class ChangeStatus extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Ced\CsMarketplace\Model\VproductsFactory
     */
    public $vproductsFactory;

    /**
     * ChangeStatus constructor.
     * @param Context $context
     * @param \Ced\CsMarketplace\Model\VproductsFactory $vproductsFactory
     */
    public function __construct(
        Context $context,
        \Ced\CsMarketplace\Model\VproductsFactory $vproductsFactory
    ) {
        $this->vproductsFactory = $vproductsFactory->create();
        parent::__construct($context);
    }

    /**
     * Update product(s) status action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {

        $checkstatus = $this->getRequest()->getParam('status');
        $reason = $this->getRequest()->getParam('reason');

        if ($this->getRequest()->getParam('id') > 0 && $checkstatus != '') {
            try {
                if ($reason) {
                    $this->vproductsFactory->load($this->getRequest()->getParam('id'), 'product_id')->setReason($reason)
                        ->save();
                } else {
                    $this->vproductsFactory->load($this->getRequest()->getParam('id'), 'product_id')->setReason('')
                        ->save();
                }
                $errors = $this->vproductsFactory->changeVproductStatus([$this->getRequest()->getParam('id')],
                    $checkstatus);
                if ($errors['success']) {
                    $this->messageManager->addSuccessMessage(__("Status changed Successfully"));
                }
                if ($errors['error']) {
                    $this->messageManager->addErrorMessage(__("Can't process approval/disapproval for the Product.The Product's vendor is disapproved or not exist."));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
            }
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
