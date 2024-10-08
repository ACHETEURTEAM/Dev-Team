<?php



namespace Ced\CsMarketplace\Model\ResourceModel;

/**
 * Class Vorders
 * @package Ced\CsMarketplace\Model\ResourceModel
 */
class Vorders extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ced_csmarketplace_vendor_sales_order', 'id');
    }

    /**
     * @param $attributes
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function loadByColumns($attributes)
    {
        $connection = $this->_resources->getConnection(
            \Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION
        );

        $where   = [];
        foreach ($attributes as $attributeCode => $value) {
            $where[] = $connection->prepareSqlCondition($attributeCode, $value);
        }
        $select = $connection->select()
            ->from($this->getMainTable())
            ->where(implode(' AND ', $where));
        return $connection->fetchRow($select);
    }
}
