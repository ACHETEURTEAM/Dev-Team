<?php


namespace Ced\CsUpsShipping\Model\Vsettings\Shipping\Methods;

/**
 * Class Ups
 * @package Ced\CsUpsShipping\Model\Vsettings\Shipping\Methods
 */
class Ups extends \Ced\CsMultiShipping\Model\Vsettings\Shipping\Methods\AbstractModel
{
    /**
     * @var string
     */
    protected $_code = 'ups';

    /**
     * @var array
     */
    protected $_fields = array();

    /**
     * @var string
     */
    protected $_codeSeparator = '-';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Ups\Model\Config\Source\OriginShipment
     */
    protected $originShipment;

    /**
     * @var \Magento\Ups\Model\Config\Source\Method
     */
    protected $sourceMethod;

    /**
     * @var \Magento\Ups\Model\Config\Source\Unitofmeasure
     */
    protected $unitofmeasure;

    /**
     * Ups constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Ups\Model\Config\Source\OriginShipment $originShipment
     * @param \Magento\Ups\Model\Config\Source\Method $sourceMethod
     * @param \Magento\Ups\Model\Config\Source\Unitofmeasure $unitofmeasure
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Ups\Model\Config\Source\OriginShipment $originShipment,
        \Magento\Ups\Model\Config\Source\Method $sourceMethod,
        \Magento\Ups\Model\Config\Source\Unitofmeasure $unitofmeasure
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->originShipment = $originShipment;
        $this->sourceMethod = $sourceMethod;
        $this->unitofmeasure = $unitofmeasure;
    }


    /**
     * @return array|mixed
     */
    public function getFields()
    {
        $fields['active'] = array('type' => 'select',
            'required' => true,
            'values' => array(
                array('label' => __('Yes'), 'value' => 1),
                array('label' => __('No'), 'value' => 0)
            )
        );

        if ($this->scopeConfig->getValue('carriers/ups/type', \Magento\Store\Model\ScopeInterface::SCOPE_STORE) == "UPS_XML") {
            $fields['origin_shipment'] = array('type' => 'select', 'required' => true,
                'values' => $this->originShipment->toOptionArray());
            $fields['origin_shipment']['after_element_html'] = '<span style="color:red;">' . __('Please ensure you have selected right Origin of Shipment according to your Shipping Origin Address otherwise your Shipping Methods will not be visible in Checkout.') . '</span>';
        }
        $fields['allowed_methods'] = array('type' => 'multiselect', 'required' => true,
            'values' => $this->sourceMethod->toOptionArray());

        $is_ups_xml = $this->scopeConfig->getValue('carriers/ups/type',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE) == "UPS_XML" ? 1 : 0;

        $fields['allowed_methods']['after_element_html'] = '<input type="hidden" name="groups[ups][is_ups_xml]" value="'
            . $is_ups_xml . '" />';

        if ($this->scopeConfig->getValue('carriers/ups/type',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE) == "UPS_XML") {

            $fields['unit_of_measure'] = array('type' => 'select', 'required' => true,
                'values' => $this->unitofmeasure->toOptionArray());
        }
        return $fields;
    }

    /**zc
     * Retreive labels
     *
     * @param string $key
     * @return string
     */
    public function getLabel($key)
    {
        switch ($key) {
            case 'label' :
                return __('UPS');
                break;
            case 'origin_shipment':
                return __('Origin of the Shipment');
                break;
            case 'allowed_methods':
                return __('Allowed Methods');
                break;
            case 'unit_of_measure':
                return __('Weight Unit');
                break;
            default :
                return parent::getLabel($key);
                break;
        }
    }

    /**
     * @param $methodData
     * @return bool
     */
    public function validateSpecificMethod($methodData)
    {
        if (count($methodData) > 0) {
            if (isset($methodData['is_ups_xml'])) {
                $is_ups_xml = $this->scopeConfig->getValue('carriers/ups/type',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE) == "UPS_XML" ? 1 : 0;
                if ($methodData['is_ups_xml'] != $is_ups_xml) {
                    return false;
                }
            }
            if (!isset($methodData['allowed_methods'])) {
                return false;
            }
            if (isset($methodData['allowed_methods'])) {
                if (!strlen($methodData['allowed_methods']) > 0) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
