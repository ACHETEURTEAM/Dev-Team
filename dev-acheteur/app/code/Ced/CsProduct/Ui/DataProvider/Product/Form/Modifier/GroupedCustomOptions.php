<?php

namespace Ced\CsProduct\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions as CustomOptionsModifier;

class GroupedCustomOptions extends \Magento\GroupedProduct\Ui\DataProvider\Product\Form\Modifier\CustomOptions
{
    const PRODUCT_TYPE_GROUPED = 'grouped';

    /**
     * @var LocatorInterface
     */
    private $locator;

    /**
     * @var ArrayManager
     */
    private $arrayManager;

    /**
     * @param LocatorInterface $locator
     * @param ArrayManager $arrayManager
     */
    public function __construct(LocatorInterface $locator, ArrayManager $arrayManager)
    {
        parent::__construct($locator, $arrayManager);
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        $product = $this->locator->getProduct();

        if ($product->getTypeId() === static::PRODUCT_TYPE_GROUPED) {
            $data = $this->arrayManager->remove(
                $this->arrayManager->findPath(CustomOptionsModifier::FIELD_ENABLE, $data),
                $data
            );
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        if ($this->locator->getProduct()->getTypeId() === static::PRODUCT_TYPE_GROUPED) {
            $meta = $this->arrayManager->remove(CustomOptionsModifier::GROUP_CUSTOM_OPTIONS_NAME, $meta);
        }

        return $meta;
    }
}
