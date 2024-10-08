<?php


namespace Ced\CsProduct\Model;

class Attributeset extends \Magento\Framework\Model\AbstractModel
{

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Ced\CsMarketplace\Model\System\Config\Source\Vproducts\Set
     */
    protected $vproductsSet;

    /**
     * @var \Magento\Eav\Model\Entity\Attribute\SetFactory
     */
    protected $attributeSetFactory;

    /**
     * Attributeset constructor.
     * @param \Magento\Store\Model\StoreManagerInterface $_storeManager
     * @param \Ced\CsMarketplace\Model\System\Config\Source\Vproducts\Set $vproductsSet
     * @param \Magento\Eav\Model\Entity\Attribute\SetFactory $attributeSetFactory
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $_storeManager,
        \Ced\CsMarketplace\Model\System\Config\Source\Vproducts\Set $vproductsSet,
        \Magento\Eav\Model\Entity\Attribute\SetFactory $attributeSetFactory,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->_storeManager = $_storeManager;
        $this->vproductsSet = $vproductsSet;
        $this->attributeSetFactory = $attributeSetFactory;
        parent::__construct($context, $registry);
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getAllowedAttributeSets()
    {
        if ($this->_scopeConfig == null) {
            $allowedSet = $this->vproductsSet->getAllowedSet($this->_storeManager->getStore()->getId());
        }
        $allowed_attr_sets = [];
        foreach ($allowedSet as $setId) {
            $set = $this->attributeSetFactory->create()->load($setId);
            if ($set && $set->getId()) {
                $set->getData();
                $allowed_attr_sets[] = ['value' => $set['attribute_set_id'], 'label' => $set['attribute_set_name']];
            }
        }
        return $allowed_attr_sets;
    }
}
