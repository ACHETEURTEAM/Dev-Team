<?php


namespace Ced\CsProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class SetAttributeTabBlockObserver implements ObserverInterface
{
    /**
     * Catalog helper
     *
     * @var \Magento\Catalog\Helper\Catalog
     */
    protected $helperCatalog;

    /**
     * @param \Magento\Catalog\Helper\Catalog $helperCatalog
     */
    public function __construct(\Magento\Catalog\Helper\Catalog $helperCatalog)
    {
        $this->helperCatalog = $helperCatalog;
    }

    /**
     * Setting attribute tab block for bundle
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        if ($product->getTypeId() == \Magento\Catalog\Model\Product\Type::TYPE_BUNDLE) {
            $this->helperCatalog->setAttributeTabBlock(
                \Ced\CsProduct\Block\Bundle\Product\Edit\Tab\Attributes::class
            );
        }
        return $this;
    }
}
