<?php


namespace Ced\CsMarketplace\Model\ResourceModel;

/**
 * Class Vsettings
 * @package Ced\CsMarketplace\Model\ResourceModel
 */
class Vsettings extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Model Initialization
     */
    protected function _construct()
    {
        $this->_init('ced_csmarketplace_vendor_settings', 'setting_id');
    }
}
