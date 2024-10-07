<?php

namespace Ced\CsVendorProductAttribute\Model\System\Config\Source;

/**
 * Class Inputtype
 * @package Ced\CsVendorProductAttribute\Model\System\Config\Source
 */
class Inputtype implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    private $optionsArray;

    /**
     * Inputtype constructor.
     * @param array $optionsArray
     */
    public function __construct(array $optionsArray = [])
    {
        $this->optionsArray = $optionsArray;
    }

    /**
     * Return array of options
     *
     * @return array
     */
    public function toOptionArray()
    {
        //sort array elements using key value
        ksort($this->optionsArray);
        return $this->optionsArray;
    }

    /**
     * Get volatile input types.
     *
     * @return array
     */
    public function getVolatileInputTypes()
    {
        return [
            ['textarea']
        ];
    }
}
