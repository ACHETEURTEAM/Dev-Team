<?php



namespace Ced\CsVendorReview\Controller\Rating;

class Post extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Ced\CsVendorReview\Model\Review
     */
    protected $model;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Post constructor.
     * @param \Ced\CsVendorReview\Model\Review $model
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Ced\CsVendorReview\Model\Review $model,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\Action\Context $context
    ) {
        $this->model = $model;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        if ($data) {
            if ($this->scopeConfig->getValue('ced_csmarketplace/vendorreview/vendorapprval')) {
                $msg = 'Your review has been submited for approval';
                $data['status'] = 0;
            } else {
                $msg = 'Your review has been submitted successfully';
                $data['status'] = 1;
            }

            $this->model->setData($data);
            try {
                $this->model->save();
                $this->messageManager->addSuccessMessage(__($msg), 'message_manager_example');
                $this->_redirect('*/*/lists', ['id' => $data['vendor_id']]);
                return;
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while submitting review'));
            }
        }
    }
}
