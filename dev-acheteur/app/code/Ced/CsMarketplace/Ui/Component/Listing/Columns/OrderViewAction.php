<?php


namespace Ced\CsMarketplace\Ui\Component\Listing\Columns;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Sales\Model\Order;

/**
 * Class OrderViewAction
 * @package Ced\CsMarketplace\Ui\Component\Listing\Columns
 */
class OrderViewAction extends Column
{
    const ORDER_VIEW_ROUTE_PATH = 'csmarketplace/vendororder/view';
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        Order $salesOrder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->salesOrder = $salesOrder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['order_id'])) {
                    $item[$this->getData('name')] = [
                        'view' => [
                            'href' => $this->urlBuilder->getUrl(
                                $this->getOrderViewRoutePath(),
                                $this->getOrderViewRouteParams($item)
                            ),
                            'label' => __('View Order')
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }

    /**
     * @return string
     */
    public function getOrderViewRoutePath()
    {
        return self::ORDER_VIEW_ROUTE_PATH;
    }

    /**
     * @param $item
     * @return array
     */
    public function getOrderViewRouteParams($item)
    {
        $orderId = $this->salesOrder->loadByIncrementId($item['order_id'])->getId();
        return [
            'order_id' => $orderId
        ];
    }
}
