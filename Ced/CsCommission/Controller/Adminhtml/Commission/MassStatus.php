<?php



namespace Ced\CsCommission\Controller\Adminhtml\Commission;

use Magento\Backend\App\Action;

class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * @var \Ced\CsCommission\Model\Commission
     */
    protected $commission;

    /**
     * MassStatus constructor.
     * @param Action\Context $context
     * @param \Ced\CsCommission\Model\Commission $commission
     */
    public function __construct(
        Action\Context $context,
        \Ced\CsCommission\Model\Commission $commission
    ) {
        parent::__construct($context);
        $this->commission = $commission;
    }

    /**
     * Execute action.
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $ids = $this->getRequest()->getParam('id');
        $status = $this->getRequest()->getParam('status');
        if (!is_array($ids) || empty($ids)) {
            $this->messageManager->addErrorMessage(__('Please select product(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $row = $this->commission->load($id);
                    $row->setData('status', $status)
                        ->save();
                }
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 record(s) have been deleted.', count($ids))
                );
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }
}
