<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vorders\Grid\Renderer;


use Magento\Framework\DataObject;

/**
 * Class View
 * @package Ced\CsMarketplace\Block\Adminhtml\Vorders\Grid\Renderer
 */
class View extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{

    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;

    /**
     * View constructor.
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
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        if ($row->getVendorId() != '') {
            $order = $this->orderFactory->create()->loadByIncrementId($row->getOrderId());
            $url = $this->getUrl('adminhtml/sales_order/view', array('order_id' => $order->getId()));
            return "<a href='" . $url . "' target='_blank' >" . $this->__('View') . "</a>";
        }

        return "";
    }
}