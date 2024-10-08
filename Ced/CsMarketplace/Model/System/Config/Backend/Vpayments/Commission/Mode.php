<?php


namespace Ced\CsMarketplace\Model\System\Config\Backend\Vpayments\Commission;

/**
 * Class Mode
 * @package Ced\CsMarketplace\Model\System\Config\Backend\Vpayments\Commission
 */
class Mode extends \Magento\Framework\App\Config\Value
{
    /**
     * @return mixed
     */
    protected function _afterSave()
    {
        return parent::_afterSave();
    }
}
