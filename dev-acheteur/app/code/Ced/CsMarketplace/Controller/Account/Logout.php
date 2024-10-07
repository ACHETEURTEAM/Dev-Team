<?php


namespace Ced\CsMarketplace\Controller\Account;

use Magento\Framework\App\RequestInterface;

/**
 * Class Logout
 * @package Ced\CsMarketplace\Controller\Account
 */
class Logout extends \Magento\Customer\Controller\Account\Logout
{

    /**
     * Dispatch request
     * @param RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function dispatch(RequestInterface $request)
    {
        $result = parent::dispatch($request);
        $this->_eventManager->dispatch(
            'ced_csmarketplace_predispatch_action', [
                'session' => $this->session,
            ]
        );
        return $result;
    }


    /**
     * Customer logout action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $lastCustomerId = $this->session->getId();
        $this->session->logout()->setBeforeVendorAuthUrl($this->_redirect->getRefererUrl())
            ->setLastCustomerId($lastCustomerId);
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/logoutSuccess');
        return $resultRedirect;
    }
}
