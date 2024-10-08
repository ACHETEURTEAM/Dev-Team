<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vorders\View\Button;


use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class ViewOrder
 * @package Ced\CsMarketplace\Block\Adminhtml\Vorders\View\Button
 */
class ViewOrder extends Column
{

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * ViewOrder constructor.
     * @param UrlInterface $urlBuilder
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        UrlInterface $urlBuilder,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'sales/order/view',
                        ['order_id' => $item['order_id'], '_secure' => true, '_nosid' => true]
                    ),
                    'target' => '_blank',
                    'label' => __($item['order_id']),
                    'hidden' => false,
                ];
            }
        }
        return $dataSource;
    }
}
