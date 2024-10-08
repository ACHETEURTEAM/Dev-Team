<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vorders\Grid\Renderer;


/**
 * Class Orderid
 * @package Ced\CsMarketplace\Block\Adminhtml\Vorders\Grid\Renderer
 */
class Orderid extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{

    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;

    /**
     * Orderid constructor.
     * @param \Magento\Backend\Block\Context $context
     * @param \Magento\Sales\Model\OrderFactory $orderFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        array $data = []
    ) {
        $this->orderFactory = $orderFactory;
        parent::__construct($context, $data);
    }

    /**
     * Return the Order Id Link
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        if ($row->getOrderId() != '') {
            $order = $this->orderFactory->create()->loadByIncrementId($row->getOrderId());

            $orderId = $order->getId();
            $url = $this->getUrl("sales/order/view/", array('order_id' => $orderId));
            $html = '<a target="_blank" href=' . $url . '>' . $row->getOrderId() . '</a>';
            return $html;
        }

        return '';
    }
}
