<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Vendor\Form;

/**
 * Class Collection
 * @package Ced\CsMarketplace\Model\ResourceModel\Vendor\Form
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\Vendor\Form', 'Ced\CsMarketplace\Model\ResourceModel\Vendor\Form');
        $this->_map['fields']['id'] = 'main_table.id';
    }
}
