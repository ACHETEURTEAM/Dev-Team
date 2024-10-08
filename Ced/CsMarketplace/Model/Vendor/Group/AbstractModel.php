<?php


namespace Ced\CsMarketplace\Model\Vendor\Group;

/**
 * Class AbstractModel
 * @package Ced\CsMarketplace\Model\Vendor\Group
 */
class AbstractModel extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Get the commission setting
     *
     * @param  \Ced\CsMarketplace\Model\Vendor|null $vendor
     * @return boolean
     */
    public function getCommissionSettings($vendor = null)
    {
        return false;
    }
}
