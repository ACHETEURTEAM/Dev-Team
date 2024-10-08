<?php


namespace Ced\CsMarketplace\Model;

use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Model\AbstractExtensibleModel;


/**
 * Sales abstract model
 * Provide date processing functionality
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class FlatAbstractModel extends AbstractExtensibleModel
{

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory
     * @param AttributeValueFactory $customAttributeFactory
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        AttributeValueFactory $customAttributeFactory,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * Returns _eventObject
     *
     * @return string
     */
    public function getEventObject()
    {
        return $this->_eventObject;
    }

    public function getResourceCollection()
    {
        return $this->_resourceCollection ? clone $this
            ->_resourceCollection : \Magento\Framework\App\ObjectManager::getInstance()
            ->create(
                $this->_collectionName
            );
    }

    /**
     * Load entity by field
     * @param $field
     * @param $value
     * @param string $additionalAttributes
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function loadByField($field, $value, $additionalAttributes = '*')
    {
        $collection = $this->getResourceCollection()
            ->addFieldToSelect($additionalAttributes);

        if (is_array($field) && is_array($value)) {
            foreach ($field as $key => $f) {
                if (isset($value[$key])) {
                    $collection->addFieldToFilter($f, $value[$key]);
                }
            }
        } else {
            $collection->addFieldToFilter($field, $value);
        }

        $collection->setCurPage(1)
            ->setPageSize(1);

        foreach ($collection as $object) {
            $this->load($object->getId());
            return $this;
        }

        return $this;
    }
}
