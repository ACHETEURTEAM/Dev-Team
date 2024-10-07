<?php


namespace Ced\VendorsocialLogin\Controller;

/**
 * Class ConnectResponse
 * @package Ced\VendorsocialLogin\Controller
 */
abstract class ConnectResponse extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Customer\Model\SessionFactory
     */
    protected $_customerSessionFactory;

    /**
     * ConnectResponse constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Customer\Model\SessionFactory $customerSessionFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\SessionFactory $customerSessionFactory
    ) {
        $this->_customerSessionFactory = $customerSessionFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    protected function _sendResponse()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $customerSession = $this->_customerSessionFactory->create();
        $url = $customerSession->getRefererUrl();
        $resultRedirect->setPath('customer/account/login');
        if (strpos($url, 'csmarketplace')!==false) {
            $resultRedirect->setPath('csmarketplace/account/login');
        }
        $customerSession->unsRefererUrl();
        return $resultRedirect;
    }
}
