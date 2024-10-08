<?php


namespace Ced\CsVendorProductAttribute\Block\Product\Attribute\Set\Toolbar\Main\Grid;

/**
 * Class ColumnSet
 * @package Ced\CsVendorProductAttribute\Block\Product\Attribute\Set\Toolbar\Main\Grid
 */
class ColumnSet extends \Magento\Backend\Block\Widget\Grid\ColumnSet
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlFactory;

    /**
     * @var \Magento\Framework\UrlInterface|mixed
     */
    protected $_urlModel;

    /**
     * @var string
     */
    protected $_path;

    /**
     * @var array
     */
    protected $_params = [];

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Backend\Model\Widget\Grid\Row\UrlGeneratorFactory $generatorFactory
     * @param \Magento\Backend\Model\Widget\Grid\SubTotals $subtotals
     * @param \Magento\Backend\Model\Widget\Grid\Totals $totals
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Backend\Model\Widget\Grid\Row\UrlGeneratorFactory $generatorFactory,
        \Magento\Backend\Model\Widget\Grid\SubTotals $subtotals,
        \Magento\Backend\Model\Widget\Grid\Totals $totals,
        array $data = []
    ) {
        parent::__construct($context, $generatorFactory, $subtotals, $totals, $data);
        if (!isset($data['rowUrl']['path'])) {
            throw new \InvalidArgumentException('Not all required parameters passed');
        }

        $this->_urlFactory = $this->_urlBuilder;
        $this->_urlModel = isset($data['rowUrl']['urlModel']) ? $data['rowUrl']['urlModel'] : $this->_urlFactory;
        $this->_path = (string)$data['rowUrl']['path'];
        if (isset($data['rowUrl']['params'])) {
            $this->_params = (array)$data['rowUrl']['params'];
        }
        if (isset($data['rowUrl']['extraParamsTemplate'])) {
            $this->_extraParamsTemplate = (array)$data['rowUrl']['extraParamsTemplate'];
        }
    }

    public function _construct()
    {
        parent::_construct();
        $this->setData('area','adminhtml');
    }

    /**
     * Return row url for js event handlers
     *
     * @param \Magento\Framework\DataObject $item
     * @return string
     */
    public function getRowUrl($item)
    {
        $url = '#';
        if (!empty($this->_path)) {
            $params = $this->_prepareParameters($item);
            $url = $this->_urlFactory->getUrl('csvendorproductattribute/set/add', $params);
        }
        return $url;
    }

    protected function _prepareParameters($item)
    {
        $params = [];
        foreach ($this->_extraParamsTemplate as $paramKey => $paramValueMethod) {
            $params[$paramKey] = $item->{$paramValueMethod}();
        }
        return array_merge($this->_params, $params);
    }
}
