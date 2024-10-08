<?php


namespace Ced\CsCommission\Observer;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Element\Context;
use Magento\Framework\Event\Observer;

class AddCommissionTab implements ObserverInterface
{
    const VENDOR_EDIT_ACTION = 'edit';

    /** @var Context */
    protected $context;

    /** @var Http */
    protected $_request;

    /**
     * AddCommissionTab constructor.
     * @param Context $context
     * @param Http $request
     */
    public function __construct(Context $context, Http $request)
    {
        $this->context = $context;
        $this->_request = $request;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if ($this->_request->getParam('vendor_id') &&
            $this->_request->getActionName() == self::VENDOR_EDIT_ACTION) {
            $block = $observer->getEvent()->getTabs();
            $block->addTabAfter(
                'commission',
                [
                    'label' => __('Commission Configurations'),
                    'title' => __('Commission Configurations'),
                    'content' => $this->context->getLayout()
                        ->createBlock(\Ced\CsCommission\Block\Adminhtml\Vendor\Entity\Edit\Tab\Configurations::class)
                        ->toHtml()
                ],
                'vpayments'
            );
        }
    }
}
