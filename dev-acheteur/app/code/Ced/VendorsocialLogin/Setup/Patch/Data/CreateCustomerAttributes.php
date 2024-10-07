<?php

declare(strict_types=1);

namespace Ced\VendorsocialLogin\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Setup\EavSetupFactory;

/**
 * Patch is mechanism, that allows to do atomic upgrade data changes
 */
class CreateCustomerAttributes implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return CreateCustomerAttributes|void
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        /**
         * Add attributes to the eav/attribute
         */
        $attributes = [
            'ced_sociallogin_gid' => 'ced Google id',
            'ced_sociallogin_gtoken' => 'ced Google token',
            'ced_sociallogin_fid' => 'ced Facebook id',
            'ced_sociallogin_ftoken' => 'ced Facebook token',
            'ced_sociallogin_tid' => 'ced Twitter id',
            'ced_sociallogin_ttoken' => 'ced Twitter token',
            'ced_sociallogin_lid' => 'ced Linkedin id',
            'ced_sociallogin_ltoken' => 'ced Linkedin token',
        ];

        foreach ($attributes as $code => $label) {
            $eavSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                $code,
                [
                    'type' => 'text',
                    'visible' => false,
                    'required' => false,
                    'user_defined' => false,
                    'label' => $label,
                    'system' => false,
                ]
            );
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
