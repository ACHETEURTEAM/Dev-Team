<?php


namespace Ced\CsMarketplace\Ui\Component\Listing\Columns;


use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Ced\CsMarketplace\Model\VendorFactory;
use Ced\CsMarketplace\Model\ResourceModel\Vendor;
use Magento\Sales\Model\Order;

/**
 * Class OrderLink
 * @package Ced\CsMarketplace\Ui\Component\Listing\Columns
 */
class OrderLink extends Column
{


    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StoreManagerInterface $storeManager
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        UrlInterface $urlBuilder,
        VendorFactory $vendorFactory,
        Vendor $vendorResourceModel,
        Order $salesOrder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager = $storeManager;
        $this->urlBuilder = $urlBuilder;
        $this->vendorFactory = $vendorFactory;
        $this->vendorResourceModel = $vendorResourceModel;
        $this->salesOrder = $salesOrder;
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
                $orderLink = '';
                if ($item['real_order_id']){
                    $orderLink = $this->urlBuilder->getUrl('sales/order/view', ['order_id' => $item['real_order_id']]);
                    $orderLink = '<a href="'.$orderLink.'">'.$item['order_id'].'</a>';
                } else{
                    $orderLink = $item['order_id'];
                }
                $item[$this->getData('name')] = $orderLink;
            }
        }
        return $dataSource;
    }

}
