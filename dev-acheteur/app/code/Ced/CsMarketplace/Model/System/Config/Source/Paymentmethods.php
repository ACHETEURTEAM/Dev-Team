<?php


namespace Ced\CsMarketplace\Model\System\Config\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\CollectionFactory;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Paymentmethods
 * @package Ced\CsMarketplace\Model\System\Config\Source
 */
class Paymentmethods extends \Ced\CsMarketplace\Model\System\Config\Source\AbstractBlock
{

    const XML_PATH_CED_CSMARKETPLACE_VENDOR_PAYMENT_METHODS = 'ced_csmarketplace/vendor/payment_methods';

    /**
     * @var \Magento\Framework\App\Helper\Context
     */
    protected $scopeConfig;

    /**
     * Paymentmethods constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param CollectionFactory $attrOptionCollectionFactory
     * @param OptionFactory $attrOptionFactory
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        CollectionFactory $attrOptionCollectionFactory,
        OptionFactory $attrOptionFactory
    ) {
        parent::__construct($attrOptionCollectionFactory, $attrOptionFactory);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Retrieve Option values array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $payment_methods = $this->scopeConfig->getValue(self::XML_PATH_CED_CSMARKETPLACE_VENDOR_PAYMENT_METHODS);
        $options = [];
        foreach ($payment_methods as $payment_method => $model_class) {
            $payment_method = strtolower(trim($payment_method));
            $options[] = [
                'value' => $payment_method,
                'label' => __(ucfirst($payment_method)),
                'model_class' => $model_class
            ];
        }
        return $options;
    }
}
