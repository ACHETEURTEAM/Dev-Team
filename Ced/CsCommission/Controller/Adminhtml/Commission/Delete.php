<?php


namespace Ced\CsCommission\Controller\Adminhtml\Commission;

use Magento\Backend\App\Action;
use Ced\CsCommission\Model\Commission;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var Commission
     */
    protected $commission;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param Commission $commission
     */
    public function __construct(
        Action\Context $context,
        Commission $commission
    ) {
        parent::__construct($context);
        $this->commission = $commission;
    }

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        try {
            $banner = $this->commission->load($id);
            $banner->delete();
            $this->messageManager->addSuccessMessage(
                __('Delete successfully !')
            );
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        if ($this->getRequest()->getParam('popup')) {
            $this->_redirect('*/*/', ['popup' => true]);
        } else {
            $this->_redirect('*/*/');
        }
    }
}
