<?php


namespace Ced\CsOrder\Block\Order\Totals;

class Tax extends \Magento\Sales\Block\Adminhtml\Order\Totals\Tax
{
    /**
     * Tax helper
     * @var \Magento\Tax\Helper\Data
     */
    protected $_taxHelper;

    /**
     * Tax calculation
     * @var \Magento\Tax\Model\Calculation
     */
    protected $_taxCalculation;

    /**
     * Tax factory
     * @var \Magento\Tax\Model\Sales\Order\TaxFactory
     */
    protected $_taxOrderFactory;

    /**
     * Sales admin helper
     * @var \Magento\Sales\Helper\Admin
     */
    protected $_salesAdminHelper;

    /**
     * Tax constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Tax\Model\Config $taxConfig
     * @param \Magento\Tax\Helper\Data $taxHelper
     * @param \Magento\Tax\Model\Calculation $taxCalculation
     * @param \Magento\Tax\Model\Sales\Order\TaxFactory $taxOrderFactory
     * @param \Magento\Sales\Helper\Admin $salesAdminHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Tax\Model\Config $taxConfig,
        \Magento\Tax\Helper\Data $taxHelper,
        \Magento\Tax\Model\Calculation $taxCalculation,
        \Magento\Tax\Model\Sales\Order\TaxFactory $taxOrderFactory,
        \Magento\Sales\Helper\Admin $salesAdminHelper,
        array $data = []
    ) {
        $this->_taxHelper = $taxHelper;
        $this->_taxCalculation = $taxCalculation;
        $this->_taxOrderFactory = $taxOrderFactory;
        $this->_salesAdminHelper = $salesAdminHelper;
        parent::__construct(
            $context,
            $taxConfig,
            $taxHelper,
            $taxCalculation,
            $taxOrderFactory,
            $salesAdminHelper,
            $data
        );
    }

    /**
     * Display tax amount
     * @param  string $amount
     * @param  string $baseAmount
     * @return string
     */
    public function displayAmount($amount, $baseAmount)
    {
        return $this->_salesAdminHelper->displayPrices(
            $this->getSource(),
            $baseAmount,
            $amount,
            false,
            '<br />'
        );
    }

    /**
     * Get full information about taxes applied to order
     * @return array
     */
    public function getFullTaxInfo()
    {
        $source = $this->getSource();
        if (!$source instanceof \Magento\Sales\Model\Order\Invoice
            && !$source instanceof \Magento\Sales\Model\Order\Creditmemo
        ) {
            $source = $this->getOrder();
        }

        $taxClassAmount = [];
        if (empty($source)) {
            return $taxClassAmount;
        }

        $taxClassAmount = $this->_taxHelper->getCalculatedTaxes($source);
        if (empty($taxClassAmount)) {
            $rates = $this->_taxOrderFactory->create()->getCollection()->loadByOrder($source)->toArray();
            $taxClassAmount = $this->_taxCalculation->reproduceProcess($rates['items']);
        }

        return $taxClassAmount;
    }

    /**
     * Get store object for process configuration settings
     * @return \Magento\Store\Api\Data\StoreInterface|\Magento\Store\Model\Store
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStore()
    {
        return $this->_storeManager->getStore();
    }
}
