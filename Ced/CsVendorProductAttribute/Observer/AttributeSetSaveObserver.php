<?php


namespace Ced\CsVendorProductAttribute\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class AttributeSetSaveObserver
 * @package Ced\CsVendorProductAttribute\Observer
 */
class AttributeSetSaveObserver implements ObserverInterface
{
    /**
     * @var \Ced\CsVendorProductAttribute\Model\Attributeset
     */
    protected $attributeset;

    /**
     * AttributeSetSaveObserver constructor.
     * @param \Ced\CsVendorProductAttribute\Model\Attributeset $attributeset
     */
    public function __construct(\Ced\CsVendorProductAttribute\Model\Attributeset $attributeset)
    {
        $this->attributeset = $attributeset;
    }

    /**
     * Update Attribute Set in Vendor's table
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $attribute_set = $observer->getEvent()->getObject();
        $attribute_set_id = $attribute_set->getId();
        $attribute_set_name = $attribute_set->getAttributeSetName();
        $attr_set_model = $this->attributeset->getCollection()
            ->addFieldToFilter('attribute_set_id', $attribute_set_id)->getFirstItem();
        $attr_set_model->setData('attribute_set_code', $attribute_set_name)
            ->setData('attribute_set_id', $attribute_set_id)->save();
        return $this;
    }
}
