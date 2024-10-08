<?php


namespace Ced\CsProduct\Plugin\Model\ResourceModel\Attribute;

use Magento\CatalogInventory\Model\ResourceModel\Stock\Status;
use Magento\ConfigurableProduct\Model\ResourceModel\Attribute\OptionSelectBuilderInterface;
use Magento\Framework\DB\Select;

class InStockOptionSelectBuilder
{
    /**
     * CatalogInventory Stock Status Resource Model.
     *
     * @var Status
     */
    private $stockStatusResource;

    /**
     * @var \Ced\CsMarketplace\Helper\Data
     */
    protected $csmarketplaceHelper;

    /**
     * @param Status $stockStatusResource
     */
    public function __construct(Status $stockStatusResource, \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper)
    {
        $this->stockStatusResource = $stockStatusResource;
        $this->csmarketplaceHelper = $csmarketplaceHelper;
    }

    /**
     * Add stock status filter to select.
     *
     * @param OptionSelectBuilderInterface $subject
     * @param Select $select
     * @return Select
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetSelect(OptionSelectBuilderInterface $subject, Select $select)
    {

        $showOutofStock = $this->csmarketplaceHelper->getStoreConfig('cataloginventory/options/show_out_of_stock');
        if (!$showOutofStock) {
            $select->joinInner(
                ['stock' => $this->stockStatusResource->getMainTable()],
                'stock.product_id = entity.entity_id',
                []
            )->where(
                'stock.stock_status = ?',
                \Magento\CatalogInventory\Model\Stock\Status::STATUS_IN_STOCK
            );

        }
        return $select;
    }
}
