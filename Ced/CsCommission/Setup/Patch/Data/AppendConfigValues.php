<?php

declare(strict_types=1);

namespace Ced\CsCommission\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Config\Model\ResourceModel\Config\Data\CollectionFactory;

/**
 * Patch is mechanism, that allows to do atomic upgrade data changes
 */
class AppendConfigValues implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CollectionFactory $collectionFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $path = '/ced_vpayments/general/';
        $config = $this->collectionFactory->create()->addFieldToFilter('path', ['like' => '%' . $path . '%']);
        foreach ($config as $key => $value) {
            $data = $value->getData();
            $pathParts = explode('/', $data['path']);

            if (strpos($pathParts[0], 'v') === false) {
                $pathParts[0] = 'v' . $pathParts[0];
                $pathParts = implode('/', $pathParts);
                $value->setPath($pathParts)->save();
            }
        }
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }
}
