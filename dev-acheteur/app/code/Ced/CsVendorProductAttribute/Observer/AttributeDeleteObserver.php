<?php


namespace Ced\CsVendorProductAttribute\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class AttributeDeleteObserver
 * @package Ced\CsVendorProductAttribute\Observer
 */
class AttributeDeleteObserver implements ObserverInterface
{
    /**
     * @var \Ced\CsVendorProductAttribute\Model\Attribute
     */
    protected $attribute;

    /**
     * AttributeDeleteObserver constructor.
     * @param \Ced\CsVendorProductAttribute\Model\Attribute $attribute
     */
    public function __construct(\Ced\CsVendorProductAttribute\Model\Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * Delete Attribute From Vendor's table
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $attribute = $observer->getEvent()->getAttribute();
        $attr_id = $attribute->getId();
        $attr_model = $this->attribute->getCollection()
            ->addFieldToFilter('attribute_id', $attr_id)->getFirstItem();
        $attr_model->delete();
        return $this;
    }
}
