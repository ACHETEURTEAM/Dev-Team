<?php

namespace Ced\CsMarketplace\Model\ResourceModel;

use Magento\Eav\Model\ResourceModel\Entity\AttributeFactory;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;
use Ced\CsMarketplace\Model\Session; // Ensure this points to your correct Session model

/**
 * Vendor Product Collection
 */
class VendorProductCollection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    /**
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute
     */
    protected $eavAttribute;

    /**
     * @var Http
     */
    protected $request;

    /**
     * @var Session
     */
    protected $session; // Declare the session property

    /**
     * Initialize dependencies.
     *
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param AttributeFactory $eavAttribute
     * @param Session $customerSession // Inject the customer session
     * @param Http $request
     * @param string $mainTable
     * @param string $resourceModel
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        AttributeFactory $eavAttribute,
        Session $customerSession, // Injected Session
        Http $request,
        $mainTable = 'ced_csmarketplace_vendor_products',
        $resourceModel = 'Ced\CsMarketplace\Model\ResourceModel\Vproducts'
    ) {
        $this->eavAttribute = $eavAttribute;
        $this->request = $request;
        $this->session = $customerSession; // Assign injected session directly
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }

    /**
     * @return $this|\Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult|void
     */
    protected function _initSelect()
    {
        parent::_initSelect();

        $check_status = $this->request->getParam('check_status');
        if ($check_status) {
            $this->addFieldToFilter('check_status', $check_status);
        }

        $vendorId = $this->session->getVendorId(); // Use the injected session directly
        if ($vendorId) {
            $this->addFieldToFilter('vendor_id', $vendorId);
        }

        $catalogProductEntity = $this->getTable('catalog_product_entity');
        $marketplaceVendorVarchar = $this->getTable('ced_csmarketplace_vendor_varchar');
        $vendorAttributeId = $this->eavAttribute->create()->getIdByCode('csmarketplace_vendor', 'public_name');

        $this->getSelect()->joinLeft(
            $catalogProductEntity,
            "main_table.product_id = {$catalogProductEntity}.entity_id",
            ['attribute_set_id', 'type_id', 'entity_id']
        );

        $this->getSelect()->joinLeft(
            $marketplaceVendorVarchar,
            "main_table.vendor_id = {$marketplaceVendorVarchar}.entity_id AND " .
            "{$marketplaceVendorVarchar}.attribute_id = {$vendorAttributeId}",
            ['vendor_name' => 'value']
        );

        $cataloginventoryStockItem = $this->getTable('cataloginventory_stock_item');
        $this->getSelect()->joinLeft(
            $cataloginventoryStockItem,
            "main_table.product_id={$cataloginventoryStockItem}.product_id",
            ['qty' => "{$cataloginventoryStockItem}.qty"]
        );

        $this->addFilterToMap(
            'type_id',
            $catalogProductEntity . '.type_id'
        );

        $this->addFilterToMap(
            'attribute_set_id',
            $catalogProductEntity . '.attribute_set_id'
        );

        $this->addFilterToMap(
            'vendor_name',
            $marketplaceVendorVarchar . '.value'
        );

        $this->addFilterToMap(
            'entity_id',
            $catalogProductEntity . '.entity_id'
        );

        $this->addFilterToMap(
            'sku',
            $catalogProductEntity . '.sku'
        );

        $this->addFilterToMap(
            'qty',
            $cataloginventoryStockItem . '.qty'
        );

        $this->addFilterToMap(
            'website_id',
            'main_table.website_id'
        );

        return $this;
    }
}
