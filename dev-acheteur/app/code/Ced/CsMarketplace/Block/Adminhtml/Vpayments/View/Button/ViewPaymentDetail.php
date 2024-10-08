<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vpayments\View\Button;


use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class ViewPaymentDetail
 * @package Ced\CsMarketplace\Block\Adminhtml\Vpayments\View\Button
 */
class ViewPaymentDetail extends Column
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
                        'csmarketplace/vpayments/details',
                        ['id' => $item['entity_id'], '_secure' => true, '_nosid' => true]
                    ),
                    'target' => '_blank',
                    'label' => __("View"),
                    'hidden' => false,
                ];
            }
        }
        return $dataSource;
    }

}