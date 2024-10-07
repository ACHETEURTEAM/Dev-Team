<?php


namespace Ced\CsMarketplace\Model\Vendor\Address\Source;

/**
 * Class Region
 * @package Ced\CsMarketplace\Model\Vendor\Address\Source
 */
class Region extends \Magento\Eav\Model\Entity\Attribute\Source\Table
{

    /**
     * @param bool $withEmpty
     * @param bool $defaultValues
     * @return array
     */
    public function getAllOptions($withEmpty = true, $defaultValues = false)
    {
        return [['label' => 'Please select region, state or province', 'value' => '']];
    }
}

