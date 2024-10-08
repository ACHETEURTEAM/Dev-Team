<?php


namespace Ced\CsMarketplace\Block\Vpayments\View\Button;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class View
 * @package Ced\CsMarketplace\Block\Vpayments\View\Button
 */
class View extends Column
{

    /**
     * @var UrlInterface
     */
    protected $urlInterfaceBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlInterfaceBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlInterfaceBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlInterfaceBuilder = $urlInterfaceBuilder;
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
        if (!empty($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'hidden' => false,
                    'href' => $this->urlInterfaceBuilder->getUrl(
                        'csmarketplace/vpayments/view',
                        ['payment_id' => $item['entity_id']]
                    ),
                    'label' => __('View'),
                ];
            }
        }

        return $dataSource;
    }
}
