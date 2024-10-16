<?php


namespace Ced\CsTransaction\Ui\Component\Listing\Columns\VPaymentsRequested;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class VendorEditLink extends Column
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * VendorEditLink constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->_urlBuilder = $urlBuilder;
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
                $html = "";
                if ($item['vendor_id'] != '') {
                    $url = $this->_urlBuilder->getUrl(
                        "csmarketplace/vendor/edit/",
                        ['vendor_id' => $item['vendor_id']]
                    );
                    $target = "target='_blank'";
                }
                $html = "<a href='" . $url . "' " . $target . " >" . $item['vendor_name'] . "</a>";
                $item['vendor_name']= $html;
            }
        }
        return $dataSource;
    }
}
