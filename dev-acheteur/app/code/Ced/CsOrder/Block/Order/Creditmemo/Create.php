<?php


namespace Ced\CsOrder\Block\Order\Creditmemo;

class Create extends \Magento\Sales\Block\Adminhtml\Order\Creditmemo\Create
{
    /**
     * Create constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $registry, $data);
        $this->buttonList->remove('reset');
    }

    /**
     * Get back url
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl(
            'csorder/vorders/view',
            [
                'order_id' => $this->getCreditmemo() ? $this->getRequest()->getParam('order_id') : null,
                'vorder_id' => $this->getCreditmemo() ? $this->getRequest()->getParam('vorder_id') : null,
            ]
        );
    }
}
