<?php



namespace Ced\CsVendorReview\Controller\Adminhtml\Rating;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Ced\CsVendorReview\Model\Rating
     */
    protected $rating;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Backend\Model\Session
     */
    protected $session;

    /**
     * Edit constructor.
     * @param \Ced\CsVendorReview\Model\Rating $rating
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\Model\Session $session
     * @param Action\Context $context
     */
    public function __construct(
        \Ced\CsVendorReview\Model\Rating $rating,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\Session $session,
        Action\Context $context
    ) {
        $this->rating = $rating;
        $this->registry = $registry;
        $this->session = $session;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->rating;
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This row no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register('csvendorreview_rating', $model);
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->getPage()->getConfig()->getTitle()->set((__('Manage Rating')));
        $this->_view->renderLayout();
    }

    /**
     * ACL check
     *
     * @return bool
     */
    protected function _isAllowed()
    {

        switch ($this->getRequest()->getControllerName()) {
            case 'rating':
                return $this->ratingAcl();
            default:
                return $this->_authorization->isAllowed('Ced_CsMarketplace::csmarketplace');
        }
    }

    /**
     * ACL check for Rating
     *
     * @return bool
     */
    protected function ratingAcl()
    {
        switch ($this->getRequest()->getActionName()) {
            default:
                return $this->_authorization->isAllowed('Ced_CsVendorReview::manage_rating');
        }
    }
}
