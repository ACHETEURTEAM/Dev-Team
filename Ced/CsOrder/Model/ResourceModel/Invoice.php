<?php


namespace Ced\CsOrder\Model\ResourceModel;

class Invoice extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $_resource;

    /**
     * Invoice constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param null $connectionName
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\App\ResourceConnection $resource,
        $connectionName = null
    ) {
        $this->_resource = $resource;
        parent::__construct($context, $connectionName);
    }

    /**
     * Initialize resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ced_csorder_invoice', 'id');
    }

    /**
     * @param $attributes
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function loadByColumns($attributes)
    {
        $connection = $this->_resource->getConnection(
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
