<?php



namespace Ced\CsMarketplace\Controller\Adminhtml\Vendor;

/**
 * Class CheckAvailability
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vendor
 */
class CheckAvailability extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var \Ced\CsMarketplace\Model\VendorFactory
     */
    protected $vendorFactory;

    /**
     * CheckAvailability constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Ced\CsMarketplace\Model\VendorFactory $vendorFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Ced\CsMarketplace\Model\VendorFactory $vendorFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        $this->vendorFactory = $vendorFactory;
    }

    /**
     * CheckAvailability action
     *
     * @return \Magento\Framework\Controller\Result\JsonFactory
     */
    public function execute()
    {
        $response = new \Magento\Framework\DataObject();
        $response->setError(false);

        $id = $this->getRequest()->getParam('vendor_id', 0);
        $venderData = $this->request->getParam('vendor', []);
        $array = $this->vendorFactory->create()->checkAvailability($venderData, $id);

        if (!$array ['success']) {
            $response->setError(true);
            $response->setMessage(
                __($array ['message'] . $array ['suggestion'])
            );
        }

        return $this->resultJsonFactory->create()->setJsonData($response->toJson());
    }
}