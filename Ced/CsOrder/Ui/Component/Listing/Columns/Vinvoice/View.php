<?php


namespace Ced\CsOrder\Ui\Component\Listing\Columns\Vinvoice;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class View extends Column
{
    const INVOICE_VIEW_ROUTE_PATH = 'csorder/invoice/view';
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
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        $this->getInvoiceViewRoutePath(),
                        ['invoice_id' => $item['invoice_id']]
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
    public function getInvoiceViewRoutePath()
    {
        return self::INVOICE_VIEW_ROUTE_PATH;
    }
}
