<?php


namespace Ced\CsOrder\Block\Order;

use Magento\Payment\Model\Info;

class Payment extends \Magento\Sales\Block\Adminhtml\Order\Payment
{
    /**
     * Payment data
     * @var \Magento\Payment\Helper\Data
     */
    protected $_paymentData = null;

    /**
     * Payment constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Payment\Helper\Data $paymentData
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Payment\Helper\Data $paymentData,
        array $data = []
    ) {
        $this->_paymentData = $paymentData;
        parent::__construct($context, $paymentData, $data);
    }

    /**
     * Retrieve required options from parent
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {
        if (!$this->getParentBlock()) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Invalid parent block for this block'));
        }
        $this->setPayment($this->getParentBlock()->getOrder()->getPayment());
        parent::_beforeToHtml();
    }

    /**
     * Set payment
     * @param Info $payment
     * @return $this|Payment
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function setPayment($payment)
    {
        $paymentInfoBlock = $this->_paymentData->getInfoBlock($payment, $this->getLayout());
        $this->setChild('info', $paymentInfoBlock);
        $this->setData('payment', $payment);
        return $this;
    }

    /**
     * Prepare html output
     * @return string
     */
    protected function _toHtml()
    {
        return $this->getChildHtml('info');
    }
}
