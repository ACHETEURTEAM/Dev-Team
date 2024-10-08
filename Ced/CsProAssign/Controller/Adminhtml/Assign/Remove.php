<?php

namespace Ced\CsProAssign\Controller\Adminhtml\Assign;

use Magento\Backend\App\Action\Context;

/**
 * Class Remove
 * @package Ced\CsProAssign\Controller\Adminhtml\Assign
 */
class Remove extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Ced\CsMarketplace\Model\ResourceModel\Vproducts\CollectionFactory
     */
    protected $collection;

    /**
     * @var \Ced\CsMarketplace\Model\ResourceModel\Vproducts
     */
    protected $vproductsResource;

    /**
     * Remove constructor.
     * @param Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Ced\CsMarketplace\Model\Vproducts $vproducts
     * @param \Ced\CsMarketplace\Model\ResourceModel\Vproducts $vproductsResource
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Ced\CsMarketplace\Model\Vproducts $vproducts,
        \Ced\CsMarketplace\Model\ResourceModel\Vproducts $vproductsResource
    )
    {
        parent::__construct($context);
        $this->_scopeConfig = $scopeConfig;
        $this->vproducts = $vproducts;
        $this->vproductsResource = $vproductsResource;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {
        $enable = $this->_scopeConfig->getValue(
            'ced_csmarketplace/general/csproassignactivation',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        if ($enable) {
            $vendor_id = $this->getRequest()->getParam('vendor_id');
            $product_ids = $this->getRequest()->getParam('id');
            if ($product_ids) {
                try {
                    $this->vproductsResource->deleteVendorProduct($vendor_id, $product_ids);
                    $this->messageManager->addSuccessMessage(__("Product is successfully removed from vendor"));
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            } else {
                $this->messageManager->addErrorMessage(__("Please select product(s)"));
            }
            return $this->_redirect('csmarketplace/vendor/edit', ['vendor_id' => $vendor_id]);
        }
    }
}
