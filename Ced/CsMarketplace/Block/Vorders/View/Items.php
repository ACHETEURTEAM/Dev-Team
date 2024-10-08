<?php


namespace Ced\CsMarketplace\Block\Vorders\View;


use Magento\Backend\Block\Template\Context;
use Magento\CatalogInventory\Api\StockConfigurationInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Registry;
use Magento\Sales\Block\Adminhtml\Order\View\Items as MagentoOrderItems;

/**
 * Class Items
 * @package Ced\CsMarketplace\Block\Vorders\View
 */
class Items extends MagentoOrderItems
{

    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * Items constructor.
     * @param Context $context
     * @param StockRegistryInterface $stockRegistry
     * @param StockConfigurationInterface $stockConfiguration
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        StockRegistryInterface $stockRegistry,
        StockConfigurationInterface $stockConfiguration,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $stockRegistry, $stockConfiguration, $registry, $data);
        $this->_coreRegistry = $registry;
    }

    /**
     * @return mixed
     */
    public function getVorder()
    {
        return $this->_coreRegistry->registry('current_vorder');
    }
}
