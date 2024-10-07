<?php


namespace Ced\CsMarketplace\Model\System\Config\Backend\Vproducts;

/**
 * Class Category
 * @package Ced\CsMarketplace\Model\System\Config\Backend\Vproducts
 */
class Category extends \Magento\Framework\App\Config\Value
{

    /**
     * @return \Magento\Framework\App\Config\Value
     * @throws \Exception
     */
    public function save()
    {
        if ($value = $this->getValue()) {
            $value = implode(',', array_unique(explode(',', $this->getValue())));
        }
        $this->setValue($value);
        return parent::save();
    }
}
