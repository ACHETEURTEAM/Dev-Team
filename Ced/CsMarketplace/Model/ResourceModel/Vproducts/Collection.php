<?php


namespace Ced\CsMarketplace\Model\ResourceModel\Vproducts;

/**
 * Class Collection
 * @package Ced\CsMarketplace\Model\ResourceModel\Vproducts
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{


    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\Vproducts', 'Ced\CsMarketplace\Model\ResourceModel\Vproducts');
        $this->_map['fields']['id'] = 'main_table.id';
    }
}
