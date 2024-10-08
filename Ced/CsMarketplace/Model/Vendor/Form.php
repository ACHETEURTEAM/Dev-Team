<?php


namespace Ced\CsMarketplace\Model\Vendor;

/**
 * Class Form
 * @package Ced\CsMarketplace\Model\Vendor
 */
class Form extends \Magento\Framework\Model\AbstractModel
{

    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $resourceConnection;

    /**
     * Form constructor.
     * @param \Magento\Framework\App\ResourceConnection $resourceConnection
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Ced\CsMarketplace\Model\ResourceModel\Vendor\Form|null $resource
     * @param \Ced\CsMarketplace\Model\ResourceModel\Vendor\Form\Collection|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Ced\CsMarketplace\Model\ResourceModel\Vendor\Form $resource = null,
        \Ced\CsMarketplace\Model\ResourceModel\Vendor\Form\Collection $resourceCollection = null,
        array $data = []
    ) {
        $this->resourceConnection = $resourceConnection;
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * @param array $feedData
     * @return bool
     */
    public function insertMultiple($feedData = [])
    {
        $feedTable = $this->resourceConnection->getTableName('ced_csmarketplace_vendor_form_attribute');
        $conn = $this->resourceConnection->getConnection('write');
        return ($conn->insertMultiple($feedTable, $feedData)) ? true : false;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\ResourceModel\Vendor\Form');
    }
}
