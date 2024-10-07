<?php



namespace Ced\CsMarketplace\Controller\Index;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;

/**
 * Class Index
 * @package Ced\CsMarketplace\Controller\Index
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Index constructor.
     * @param Context $context
     * @param Session $customerSession
     * @param \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->session = $customerSession;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->registry = $registry;
        if (!$this->registry->registry('vendorPanel'))
            $this->registry->register('vendorPanel', 1);

        if (!$this->registry->registry('vendor'))
            $this->registry->register('vendor', $this->session->getVendor());

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\Result\ForwardFactory
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->setController('account')->forward('login');
    }
}
