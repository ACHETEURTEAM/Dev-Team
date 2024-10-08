<?php


namespace Ced\CsEnhancement\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Ced\CsMarketplace\Setup\CsMarketplaceSetupFactory;

class ShopUrlUnique implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface 
     */
    private $moduleDataSetup;

    /**
     * @var CsMarketplaceSetupFactory 
     */
    private $csMarketplaceSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CsMarketplaceSetupFactory $csMarketplaceSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CsMarketplaceSetupFactory $csMarketplaceSetupFactory
    ){
        $this->moduleDataSetup = $moduleDataSetup;
        $this->csMarketplaceSetupFactory = $csMarketplaceSetupFactory;
    }

    /**
     * @return ShopUrlUnique|void
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $csMarketplaceSetup = $this->csMarketplaceSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $csMarketplaceSetup->updateAttribute(
            'csmarketplace_vendor',
            'shop_url',
            [
                'is_unique' => true,
            ]
        );
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }
}
