<?php


namespace Ced\CsMarketplace\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action;

/**
 * Class Country
 * @package Ced\CsMarketplace\Controller\Adminhtml\Vendor
 */
class Country extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    public $resultJsonFactory;

    /**
     * @var \Magento\Directory\Model\ResourceModel\Region\CollectionFactory
     */
    public $regionCollection;

    /**
     * Country constructor.
     * @param Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollection
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollection
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->regionCollection = $regionCollection;
    }

    /**
     * Country action
     *
     * @return \Magento\Framework\Controller\Result\JsonFactory
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $regionCollection = $this->regionCollection->create()
            ->addCountryFilter($this->getRequest()->getParam('cid'));

        if ($regionCollection->getData() != null) {
            $resultJson->setData('true');
        } else {
            $resultJson->setData('false');
        }
        return $resultJson;
    }
}
