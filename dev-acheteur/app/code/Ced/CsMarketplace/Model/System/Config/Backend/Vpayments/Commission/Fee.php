<?php


namespace Ced\CsMarketplace\Model\System\Config\Backend\Vpayments\Commission;

/**
 * Class Fee
 * @package Ced\CsMarketplace\Model\System\Config\Backend\Vpayments\Commission
 */
class Fee extends \Magento\Framework\App\Config\Value
{
    /**
     * @return \Magento\Framework\App\Config\Value
     * @throws \Exception
     */
    public function save()
    {
        $commission = (float)$this->getValue();
        $this->setValue($commission);
        return parent::save();
    }
}
