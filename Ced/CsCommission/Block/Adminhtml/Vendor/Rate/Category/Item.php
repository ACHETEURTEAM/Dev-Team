<?php


namespace Ced\CsCommission\Block\Adminhtml\Vendor\Rate\Category;

class Item extends \Magento\Framework\View\Element\Html\Select
{
    /**
     * Item constructor.
     * @param \Magento\Framework\View\Element\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Framework\Escaper $escaper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->_escaper = $escaper;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        $this->setExtraParams('style="width: 150px;"');
        if (!$this->getOptions()) {
            $collection = $this->categoryCollectionFactory
                ->create()
                ->addAttributeToSelect(['name'])
                ->addFieldToFilter('entity_id', ['neq' => '1'])
                ->load();
            if ($collection->getSize() > 0) {
                foreach ($collection as $category) {
                    $this->addOption(
                        $category->getId(),
                        $category->getName() != '' ? $this->_escaper
                            ->escapeHtml($category->getName()) : 'Default Category'
                    );
                }
            }
        }
        return parent::_toHtml();
    }
}
