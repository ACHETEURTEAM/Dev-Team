<?php


namespace Ced\CsOrder\Ui\Component\Listing\Columns\Vshipment;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Totalqty extends Column
{
    /**
     * @var \Ced\CsOrder\Model\Shipment
     */
    protected $csOrderShipment;

    /**
     * @var \Magento\Sales\Model\Order\Shipment
     */
    protected $shipment;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Shipment
     */
    protected $shipmentResource;

    /**
     * Totalqty constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Sales\Model\Order\Shipment $shipment
     * @param \Magento\Sales\Model\ResourceModel\Order\Shipment $shipmentResource
     * @param \Ced\CsOrder\Model\ShipmentFactory $csOrderShipment
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Sales\Model\Order\Shipment $shipment,
        \Magento\Sales\Model\ResourceModel\Order\Shipment $shipmentResource,
        \Ced\CsOrder\Model\ShipmentFactory $csOrderShipment,
        array $components = [],
        array $data = []
    ) {
        $this->shipment = $shipment;
        $this->shipmentResource = $shipmentResource;
        $this->csOrderShipment = $csOrderShipment;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $shipment = $this->shipment;
                $this->shipmentResource->load($shipment, $item['shipment_id'], 'entity_id');
                $shipment = $this->csOrderShipment->create()->updateTotalqty($shipment);
                $item['total_qty']= $shipment;
            }
        }
        return $dataSource;
    }
}
