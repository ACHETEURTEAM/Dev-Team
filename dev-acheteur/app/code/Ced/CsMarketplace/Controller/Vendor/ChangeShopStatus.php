<?php



namespace Ced\CsMarketplace\Controller\Vendor;

use Ced\CsMarketplace\Model\VshopFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class DisableShop
 * @package Ced\CsMarketplace\Controller\Vendor
 */
class ChangeShopStatus extends Action
{

    /**
     * @var VshopFactory
     */
    protected $vshopFactory;

    /**
     * DisableShop constructor.
     * @param Context $context
     * @param VshopFactory $vshopFactory
     */
    public function __construct(
        Context $context,
        VshopFactory $vshopFactory
    ) {
        $this->vshopFactory = $vshopFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     * @throws LocalizedException
     */
    public function execute()
    {
        $id[] = $this->getRequest()->getParam('id');
        $status = $this->getRequest()->getParam('status');

        $model = $this->vshopFactory->create();
        $model->saveShopStatus($id, $status);
        if ($status==1) {
            $this->messageManager->addSuccessMessage(__('Shop has been enabled'));
            $this->_redirect('*/*/index', ['_secure'=>true]);
        }
        if ($status==2) {
            $this->messageManager->addSuccessMessage(__('Shop has been disabled'));
            $this->_redirect('*/*/index', ['_secure'=>true]);
        }
    }
}