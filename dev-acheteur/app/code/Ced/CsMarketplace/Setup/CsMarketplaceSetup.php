<?php

namespace Ced\CsMarketplace\Setup;

use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class CsMarketplaceSetup
 */
class CsMarketplaceSetup extends EavSetup
{
    protected $eavConfig;
    protected $_vendorAttributeFactory;
    private $setup;

    public function __construct(
        ModuleDataSetupInterface $setup,
        Context $context,
        CacheInterface $cache,
        CollectionFactory $attrGroupCollectionFactory,
        Config $eavConfig,
        \Ced\CsMarketplace\Model\Vendor\FormFactory $vendorAttributeFactory
    ) {
        $this->eavConfig = $eavConfig;
        $this->setup = $setup;
        $this->_vendorAttributeFactory = $vendorAttributeFactory;
        parent::__construct($setup, $context, $cache, $attrGroupCollectionFactory);
    }

    public function getDefaultEntities()
    {
        return [
            'csmarketplace_vendor' => [
                'entity_model' => 'Ced\CsMarketplace\Model\ResourceModel\Vendor',
                'table' => 'ced_csmarketplace_vendor',
                'increment_model' => 'Magento\Eav\Model\Entity\Increment\NumericValue',
                'attributes' => [
                    'customer_id' => [
                        'group' => 'General Information',
                        'visible' => false,
                        'position' => 0,
                        'type' => 'int',
                        'label' => 'Associated Customer',
                        'input' => 'select',
                        'adminhtml_only' => 1,
                        'source' => 'Ced\CsMarketplace\Model\System\Config\Source\Customers',
                        'required' => true,
                        'user_defined' => false,
                        'unique' => true,
                        'note' => "After selecting customer association can't be changed."
                    ],
                ],
            ],
        ];
    }

    public function getEavConfig()
    {
        return $this->eavConfig;
    }

    public function addAttribute($entityTypeId, $code, array $attr)
    {
        parent::addAttribute($entityTypeId, $code, $attr);
        $is_visible = isset($attr['visible']) ? (int)$attr['visible'] : 0;
        $position = isset($attr['position']) ? (int)$attr['position'] : 0;
        $this->updateVendorForms($this->getAttributeId($entityTypeId, $code), $code, $is_visible, $position);
        return $this;
    }

    public function updateVendorForms($attributeId, $code, $is_visible = 0, $position = 0)
    {
        $joinFields = $this->_vendorForm($attributeId, $code);
        if (count($joinFields) > 0) {
            foreach ($joinFields as $joinField) {
                $joinField->setData('is_visible', $is_visible);
                $joinField->setData('sort_order', $position);
                $joinField->save();
            }
        }
    }

    public function _vendorForm($attributeId, $code)
    {
        $store = 0;
        $fields = $this->_vendorAttributeFactory->create()->getCollection()
            ->addFieldToFilter('attribute_id', ['eq' => $attributeId])
            ->addFieldToFilter('attribute_code', ['eq' => $code])
            ->addFieldToFilter('store_id', ['eq' => $store]);
        
        if (count($fields) == 0) {
            $data[] = [
                'attribute_id' => $attributeId,
                'attribute_code' => $code,
                'is_visible' => 0,
                'sort_order' => 0,
                'store_id' => $store
            ];
            $this->setup->getConnection()
                ->insertMultiple($this->setup->getTable('ced_csmarketplace_vendor_form_attribute'), $data);
            return $this->_vendorForm($attributeId, $code);
        }
        return $fields;
    }
}
