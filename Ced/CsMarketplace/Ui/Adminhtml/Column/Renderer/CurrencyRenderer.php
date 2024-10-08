<?php


namespace Ced\CsMarketplace\Ui\Adminhtml\Column\Renderer;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Directory\Model\CurrencyFactory;

/**
 * Class CurrencyRenderer
 * @package Ced\CsMarketplace\Ui\Adminhtml\Column\Renderer
 */
class CurrencyRenderer extends Column
{

    /**
     * @var \Magento\Directory\Model\Currency
     */
    private $currencyCode;

    /**
     * @var StoreManagerInterface
     */
    private $storeConfig;

    /**
     * @var \Magento\Framework\Locale\Currency
     */
    private $_localeCurrency;

    /**
     * CurrencyRenderer constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StoreManagerInterface $storeConfig
     * @param CurrencyFactory $currencyFactory
     * @param \Magento\Framework\Locale\Currency $localeCurrency
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory
        $uiComponentFactory,
        StoreManagerInterface $storeConfig,
        CurrencyFactory $currencyFactory,
        \Magento\Framework\Locale\Currency $localeCurrency,
        array $components = [],
        array $data = []
    ) {
        $this->_localeCurrency = $localeCurrency;
        $this->storeConfig = $storeConfig;
        $this->currencyCode = $currencyFactory->create();
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function prepareDataSource(array $dataSource)
    {
        foreach ($dataSource['data']['items'] as $key => $item)
        {
            $dataSource['data']['items'][$key]['base_order_total'] = $this->getToCurrency($item['base_order_total']);
            $dataSource['data']['items'][$key]['order_total'] = $this->getToCurrency($item['order_total']);
            $dataSource['data']['items'][$key]['shop_commission_fee'] =
                $this->getToCurrency($item['shop_commission_fee']);
            $dataSource['data']['items'][$key]['vendor_payment'] = $this->getToCurrency($item['vendor_payment']);
        }
        return $dataSource;
    }

    /**
     * @param $amt
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Zend_Currency_Exception
     */
    public function getToCurrency($amt)
    {
        return $this->_localeCurrency->getCurrency($this->storeConfig->getStore(null)
            ->getBaseCurrencyCode())->toCurrency($amt);
    }
}
