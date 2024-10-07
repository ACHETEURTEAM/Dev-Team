<?php


namespace Ced\CsProduct\Ui\DataProvider\Modifier;

interface PoolInterface
{
    /**
     * Retrieve modifiers
     *
     * @return array
     */
    public function getModifiers();

    /**
     * Retrieve modifiers instantiated
     *
     * @return ModifierInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getModifiersInstances();
}
