<?php



namespace Ced\CsVendorReview\Controller\Adminhtml\Review;

use Magento\Backend\App\Action;

class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * @var \Ced\CsVendorReview\Model\Review
     */
    protected $review;

    /**
     * MassStatus constructor.
     * @param \Ced\CsVendorReview\Model\Review $review
     * @param Action\Context $context
     */
    public function __construct(
        \Ced\CsVendorReview\Model\Review $review,
        Action\Context $context
    ) {
        $this->review = $review;
        parent::__construct($context);
    }

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $ids = $this->getRequest()->getParam('id');
        $status = $this->getRequest()->getParam('status');
        if (!is_array($ids) || empty($ids)) {
            $this->messageManager->addErrorMessage(__('Please select review(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $this->review->load($id)->setData('status', $status)->save();
                }
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 record(s) have been updated.', count($ids))
                );
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * ACL check
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        switch ($this->getRequest()->getControllerName()) {
            case 'review':
                return $this->reviewAcl();
            default:
                return $this->_authorization->isAllowed('Ced_CsMarketplace::csmarketplace');
        }
    }

    /**
     * ACL check for Review
     *
     * @return bool
     */
    protected function reviewAcl()
    {
        switch ($this->getRequest()->getActionName()) {
            default:
                return $this->_authorization->isAllowed('Ced_CsVendorReview::manage_review');
        }
    }
}
