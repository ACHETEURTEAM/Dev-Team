<?php


namespace Ced\CsMarketplace\Controller\Account;

/**
 * Class Denied
 * @package Ced\CsMarketplace\Controller\Account
 */
class Denied extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * Forgot customer account information page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $this->_forward('noRoute');

        /**
         * @var \Magento\Framework\View\Result\Page $resultPage
         */
        $resultPage = $this->resultPageFactory->create();

        $block = $resultPage->getLayout()->getBlock('customer_edit');
        if ($block) {
            $block->setRefererUrl($this->_redirect->getRefererUrl());
        }

        $data = $this->_getSession()->getCustomerFormData(true);
        $customerId = $this->_getSession()->getCustomerId();
        $customerDataObject = $this->customerRepository->getById($customerId);
        if (!empty($data)) {
            $this->dataObjectHelper->populateWithArray(
                $customerDataObject,
                $data,
                '\Magento\Customer\Api\Data\CustomerInterface'
            );
        }
        $this->_getSession()->setCustomerData($customerDataObject);
        $this->_getSession()->setChangePassword($this->getRequest()->getParam('changepass') == 1);

        $resultPage->getConfig()->getTitle()->set(__('Account Information'));
        $resultPage->getLayout()->getBlock('messages')->setEscapeMessageFlag(true);
        return $resultPage;
    }
}
