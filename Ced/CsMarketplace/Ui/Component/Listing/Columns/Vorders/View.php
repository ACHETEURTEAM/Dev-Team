<?php


namespace Ced\CsMarketplace\Ui\Component\Listing\Columns\Vorders;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;


/**
 * Class View
 * @package Ced\CsMarketplace\Ui\Component\Listing\Columns\Vorders
 */
class View extends Column
{
    const ORDER_VIEW_ROUTE_PATH = 'csmarketplace/vorders/view';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
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
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
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
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        $this->getOrderViewRoutePath(),
                        $this->getOrderViewRouteParams($item)
                    ),
                    'label' => __('View'),
                    'hidden' => false,
                ];
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
        return [
            'vorder_id' => $item['id']
        ];
    }
}
