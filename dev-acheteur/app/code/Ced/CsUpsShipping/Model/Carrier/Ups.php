<?php

namespace Ced\CsUpsShipping\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;
use Magento\Ups\Helper\Config;
use Magento\Framework\Xml\Security;
use Magento\Framework\HTTP\AsyncClientInterface;
use Magento\Shipping\Model\Rate\Result\ProxyDeferredFactory;
use Magento\Ups\Model\UpsAuth; // Importing the required class

/**
 * Class Ups
 * @package Ced\CsUpsShipping\Model\Carrier
 */
class Ups extends \Magento\Ups\Model\Carrier
{
    const CODE = 'ups';

    const DELIVERY_CONFIRMATION_SHIPMENT = 1;
    const DELIVERY_CONFIRMATION_PACKAGE = 2;

    protected $_code = self::CODE;
    protected $_request;
    protected $_result;
    protected $_baseCurrencyRate;
    protected $_xmlAccessRequest;

    protected $_defaultCgiGatewayUrl = 'https://www.ups.com:80/using/services/rave/qcostcgi.cgi';

    protected $_defaultUrls = [
        'ShipConfirm' => 'https://wwwcie.ups.com/ups.app/xml/ShipConfirm',
        'ShipAccept' => 'https://wwwcie.ups.com/ups.app/xml/ShipAccept',
    ];

    protected $_liveUrls = [
        'ShipConfirm' => 'https://onlinetools.ups.com/ups.app/xml/ShipConfirm',
        'ShipAccept' => 'https://onlinetools.ups.com/ups.app/xml/ShipAccept',
    ];

    protected $_customizableContainerTypes = ['CP', 'CSP'];

    protected $_localeFormat;
    protected $_vendorFactory;
    protected $csmultishippingHelper;
    protected $upshippingHelper;
    protected $upsconfigHelper;
    private $asyncHttpClient;
    private $deferredProxyFactory;

    /**
     * Ups constructor.
     */
    public function __construct(
        \Ced\CsMarketplace\Model\VendorFactory $vendorFactory,
        \Ced\CsMultiShipping\Helper\Data $csmultishippingHelper,
        \Ced\CsUpsShipping\Helper\Data $upshippingHelper,
        Config $upsconfigHelper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        Security $xmlSecurity,
        \Magento\Shipping\Model\Simplexml\ElementFactory $xmlElFactory,
        \Magento\Shipping\Model\Rate\ResultFactory $rateFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \Magento\Shipping\Model\Tracking\ResultFactory $trackFactory,
        \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory,
        \Magento\Shipping\Model\Tracking\Result\StatusFactory $trackStatusFactory,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Directory\Helper\Data $directoryData,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        Config $configHelper,
        UpsAuth $upsAuth, // Added this parameter
        \Magento\Framework\HTTP\ClientFactory $clientfactory,
        ?AsyncClientInterface $asyncHttpClient = null,
        ?ProxyDeferredFactory $proxyDeferredFactory = null,
        array $data = []
    )
    {
        $this->_localeFormat = $localeFormat;
        $this->_vendorFactory = $vendorFactory;
        $this->csmultishippingHelper = $csmultishippingHelper;
        $this->upshippingHelper = $upshippingHelper;
        $this->upsconfigHelper = $upsconfigHelper;

        parent::__construct(
            $scopeConfig,
            $rateErrorFactory,
            $logger,
            $xmlSecurity,
            $xmlElFactory,
            $rateFactory,
            $rateMethodFactory,
            $trackFactory,
            $trackErrorFactory,
            $trackStatusFactory,
            $regionFactory,
            $countryFactory,
            $currencyFactory,
            $directoryData,
            $stockRegistry,
            $localeFormat,
            $configHelper,
            $upsAuth, // Pass the upsAuth parameter
            $clientfactory,
            $data,
            $asyncHttpClient,
            $proxyDeferredFactory
        );
    }

    /**
     * @param RateRequest $request
     * @return bool|\Magento\Quote\Model\Quote\Address\RateResult\Error|Result
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */



    public function collectRates(RateRequest $request)
    {
        $is_multishipping = $this->csmultishippingHelper->isEnabled();
        if (!$is_multishipping)
            return parent::collectRates($request);

        if (!$this->upshippingHelper->isEnabled()) {
            return parent::collectRates($request);
        }

        $this->setRequest($request);
        if (!$this->canCollectRates()) {
            return $this->getErrorMessage();
        }

        $this->setRequest($request);
        $this->_result = $this->_getQuotes();
        $this->_updateFreeMethodQuote($request);

        return $this->getResult();
    }

    /**
     * @return Mage_Shipping_Model_Rate_Result|Result|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function _getQuotes()
    {

        if (!$this->csmultishippingHelper->isEnabled()) {
            return parent::_getQuotes();
        }
        if (!$this->upshippingHelper->isEnabled()) {
            return parent::_getQuotes();
        }
        switch ($this->getConfigData('type')) {
            case 'UPS':
                return $this->_getCgiQuotes();

            case 'UPS_XML':
                return $this->_getXmlQuotes();
        }
        return null;
    }

    /**
     * Get cgi rates
     *
     * @return Mage_Shipping_Model_Rate_Result
     */
    protected function _getCgiQuotes()
    {

        if (!$this->csmultishippingHelper->isEnabled()) {
            return parent::_getCgiQuotes();
        }
        if (!$this->upshippingHelper->isEnabled()) {
            return parent::_getCgiQuotes();
        }

        $vendorId = $this->_request->getVendorId();
        if (!$vendorId) {
            return;
        }
        $items = $this->_request->getVendorItems();
        $vendor = array();
        $upsSpecificConfig = array();
        if ($vendorId != "admin") {
            $upsSpecificConfig = $this->_request->getVendorShippingSpecifics();
        }
        if ($vendorId != "admin") {
            $vendor = $this->_vendorFactory->create()->load($vendorId);
        } else {
            $vendor = $this->_vendorFactory->create();
        }

        $r = $this->_rawRequest;

        $weight = 0;
        foreach ($items as $item) {
            $weight += $item->getRowWeight();
        }
        $weight = $this->getTotalNumOfBoxes($weight);
        $weight = $this->_getCorrectWeight($weight);
        $params = [
            'accept_UPS_license_agreement' => 'yes',
            '10_action' => $r->getAction(),
            '13_product' => $r->getProduct(),
            '14_origCountry' => $r->getOrigCountry(),
            '15_origPostal' => $r->getOrigPostal(),
            'origCity' => $r->getOrigCity(),
            '19_destPostal' => 'US' == $r->getDestCountry() ? substr($r->getDestPostal(), 0, 5) : $r->getDestPostal(), // UPS returns error for zip+4 US codes
            '22_destCountry' => $r->getDestCountry(),
            '23_weight' => $weight,
            '47_rate_chart' => $r->getPickup(),
            '48_container' => $r->getContainer(),
            '49_residential' => $r->getDestType(),
            'weight_std' => strtolower($r->getUnitMeasure()),
        ];
        $params['47_rate_chart'] = $params['47_rate_chart']['label'];

        $responseBody = $this->_getCachedQuotes($params);
        if ($responseBody === null) {
            $debugData = array('request' => $params);
            try {
                $url = $this->getConfigData('gateway_url');
                if (!$url) {
                    $url = $this->_defaultCgiGatewayUrl;
                }
                $client = new \Zend_Http_Client();
                $client->setUri($url);
                $client->setConfig(array('maxredirects' => 0, 'timeout' => 30));
                $client->setParameterGet($params);
                $response = $client->request();
                $responseBody = $response->getBody();
                $debugData['result'] = $responseBody;
                $this->_setCachedQuotes($params, $responseBody);
            } catch (\Exception $e) {
                $debugData['result'] = ['error' => $e->getMessage(), 'code' => $e->getCode()];
                $responseBody = '';
            }
            $this->_debug($debugData);
        }

        return $this->_parseCgiResponseNew($responseBody, $vendor, $upsSpecificConfig);
    }

    /**
     * Prepare shipping rate result based on response
     *
     * @param mixed $response
     * @return Mage_Shipping_Model_Rate_Result
     */
    protected function _parseCgiResponseNew($response, \Ced\CsMarketplace\Model\Vendor $vendor, $upsSpecificConfig)
    {
        if (!$this->csmultishippingHelper->isEnabled()) {
            return parent::_parseCgiResponseNew($response);
        }
        if (!$this->upshippingHelper->isEnabled()) {
            return parent::_parseCgiResponseNew($response);
        }

        $costArr = array();
        $priceArr = array();
        $errorTitle = 'Unknown error';

        if (strlen(trim($response)) > 0) {
            $rRows = explode("\n", $response);
            $allowedMethods = array();
            if ($vendor->getId()) {
                if (isset($upsSpecificConfig['allowed_methods'])) {
                    $allowedMethods = explode(',', $upsSpecificConfig['allowed_methods']);
                } else {
                    //$arr = $this->getCode('method');
                    $arr = $this->upsconfigHelper->getCode('method');
                    $allowedMethods = array_keys($arr);
                }
            } else {
                $allowedMethods = explode(",", $this->getConfigData('allowed_methods'));
            }

            foreach ($rRows as $rRow) {
                $r = explode('%', $rRow);
                switch (substr($r[0], -1)) {
                    case 3:
                    case 4:
                        if (in_array($r[1], $allowedMethods)) {
                            $responsePrice = $this->_localeFormat->getNumber($r[10]);
                            $costArr[$r[1]] = $responsePrice;
                            $priceArr[$r[1]] = $this->getMethodPrice($responsePrice, $r[1]);
                        }
                        break;
                    case 5:
                        $errorTitle = $r[1];
                        break;
                    case 6:
                        if (in_array($r[3], $allowedMethods)) {
                            $responsePrice = $this->_localeFormat->getNumber($r[10]);
                            $costArr[$r[3]] = $responsePrice;
                            $priceArr[$r[3]] = $this->getMethodPrice($responsePrice, $r[3]);
                        }
                        break;
                }
            }
            asort($priceArr);
        }
        $result = $this->_rateFactory->create();
        $defaults = $this->getDefaults();
        if (empty($priceArr)) {
            $error = $this->_rateErrorFactory->create();
            $error->setCarrier('ups');
            $error->setCarrierTitle($this->getConfigData('title'));
            $error->setErrorMessage($this->getConfigData('specificerrmsg'));
            $result->append($error);
        } else {
            foreach ($priceArr as $method => $price) {

                $rate = $this->_rateMethodFactory->create();
                if ($vendor->getId()) {
                    $rate->setVendorId($vendor->getId());
                } else {
                    $rate->setVendorId("admin");
                }
                $rate->setCarrier('ups');
                $rate->setCarrierTitle($this->getConfigData('title'));
                if ($vendor->getId()) {
                    $custom_method = $method . \Ced\CsMultiShipping\Model\Shipping::SEPARATOR . $vendor->getId();
                } else {
                    $custom_method = $method;
                }
                $rate->setMethod($custom_method);
                $method_arr = $this->upsconfigHelper->getCode('method', $method);
                //$method_arr = $this->getCode('method', $method);
                $rate->setMethodTitle($method_arr);
                $rate->setCost($costArr[$method]);
                $rate->setPrice($price);
                $result->append($rate);
            }


        }
        return $result;
    }

    /**
     * Get xml rates
     *
     * @return Mage_Shipping_Model_Rate_Result
     */
    protected function _getXmlQuotes()
    {

        if (!$this->csmultishippingHelper->isEnabled()) {
            return parent::_getXmlQuotes();
        }
        if (!$this->upshippingHelper->isEnabled()) {
            return parent::_getXmlQuotes();
        }

        $vendorId = $this->_request->getVendorId();
        if (!$vendorId) {
            return;
        }
        $items = $this->_request->getVendorItems();
        $upsSpecificConfig = array();
        if ($vendorId != "admin") {
            $upsSpecificConfig = $this->_request->getVendorShippingSpecifics();
        }
        $vendor = array();
        if ($vendorId != "admin") {
            $vendor = $this->_vendorFactory->create()->load($vendorId);
        } else {
            $vendor = $this->_vendorFactory->create();
        }

        $weight = 0;
        foreach ($items as $item) {
            $weight += $item->getRowWeight();
        }
        $weight = $this->getTotalNumOfBoxes($weight);
        $weight = $this->_getCorrectWeight($weight);

        $url = $this->getConfigData('gateway_xml_url');
        if (!$url) {
            $url = $this->_defaultUrls['Rate'];
        }

        $this->setXMLAccessRequest();
        $xmlRequest = $this->_xmlAccessRequest;

        $r = $this->_rawRequest;

        //Vendor Weight Unit//
        if ($vendorId != "admin" && isset($upsSpecificConfig['unit_of_measure'])) {
            $r->setUnitMeasure($upsSpecificConfig['unit_of_measure']);
        }

        /* @FIX Code */
        if ($r->getOrigCountry() == "US" && $r->getUnitMeasure() != "LBS") {
            $unitMeasure = "LBS";
        } else {
            $unitMeasure = $r->getUnitMeasure();
        }
        /* @FIX Code END */


        if (self::USA_COUNTRY_ID == $r->getDestCountry()) {
            $destPostal = substr($r->getDestPostal(), 0, 5);
        } else {
            $destPostal = $r->getDestPostal();
        }


        $params = [
            'accept_UPS_license_agreement' => 'yes',
            '10_action' => $r->getAction(),
            '13_product' => $r->getProduct(),
            '14_origCountry' => $r->getOrigCountry(),
            '15_origPostal' => $r->getOrigPostal(),
            'origCity' => $r->getOrigCity(),
            'origRegionCode' => $r->getOrigRegionCode(),
            '19_destPostal' => $destPostal,
            '22_destCountry' => $r->getDestCountry(),
            'destRegionCode' => $r->getDestRegionCode(),
            '23_weight' => $weight,
            '47_rate_chart' => $r->getPickup(),
            '48_container' => $r->getContainer(),
            '49_residential' => $r->getDestType(),
        ];

        if ($params['10_action'] == '4') {
            $params['10_action'] = 'Shop';
            $serviceCode = null; // Service code is not relevant when we're asking ALL possible services' rates
        } else {
            $params['10_action'] = 'Rate';
            $serviceCode = $r->getProduct() ? $r->getProduct() : '';
        }
        $serviceDescription = $serviceCode ? $this->getShipmentByCode($serviceCode) : '';

        $xmlRequest .= <<< XMLRequest
<?xml version="1.0"?>
<RatingServiceSelectionRequest xml:lang="en-US">
  <Request>
    <TransactionReference>
      <CustomerContext>Rating and Service</CustomerContext>
      <XpciVersion>1.0</XpciVersion>
    </TransactionReference>
    <RequestAction>Rate</RequestAction>
    <RequestOption>{$params['10_action']}</RequestOption>
  </Request>
  <PickupType>
          <Code>{$params['47_rate_chart']['code']}</Code>
          <Description>{$params['47_rate_chart']['label']}</Description>
  </PickupType>
	
  <Shipment>
XMLRequest;

        if ($serviceCode !== null) {
            $xmlRequest .= "<Service>" .
                "<Code>{$serviceCode}</Code>" .
                "<Description>{$serviceDescription}</Description>" .
                "</Service>";
        }

        $xmlRequest .= <<< XMLRequest
      <Shipper>
XMLRequest;

        if ($this->getConfigFlag('negotiated_active') && ($shipper = $this->getConfigData('shipper_number'))) {
            $xmlRequest .= "<ShipperNumber>{$shipper}</ShipperNumber>";
        }

        if ($r->getIsReturn()) {
            $shipperCity = '';
            $shipperPostalCode = $params['19_destPostal'];
            $shipperCountryCode = $params['22_destCountry'];
            $shipperStateProvince = $params['destRegionCode'];
        } else {
            $shipperCity = $params['origCity'];
            $shipperPostalCode = $params['15_origPostal'];
            $shipperCountryCode = $params['14_origCountry'];
            $shipperStateProvince = $params['origRegionCode'];
        }

        $xmlRequest .= <<< XMLRequest
      <Address>
          <City>{$shipperCity}</City>
          <PostalCode>{$shipperPostalCode}</PostalCode>
          <CountryCode>{$shipperCountryCode}</CountryCode>
          <StateProvinceCode>{$shipperStateProvince}</StateProvinceCode>
      </Address>
    </Shipper>
    <ShipTo>
      <Address>
          <PostalCode>{$params['19_destPostal']}</PostalCode>
          <CountryCode>{$params['22_destCountry']}</CountryCode>
          <ResidentialAddress>{$params['49_residential']}</ResidentialAddress>
          <StateProvinceCode>{$params['destRegionCode']}</StateProvinceCode>
XMLRequest;

        $xmlRequest .= ($params['49_residential'] === '01'
            ? "<ResidentialAddressIndicator>{$params['49_residential']}</ResidentialAddressIndicator>"
            : ''
        );

        $xmlRequest .= <<< XMLRequest
		</Address>
    			</ShipTo>
	    			<ShipFrom>
	    			<Address>
	    			<PostalCode>{$params['15_origPostal']}</PostalCode>
	    			<CountryCode>{$params['14_origCountry']}</CountryCode>
	    			<StateProvinceCode>{$params['origRegionCode']}</StateProvinceCode>
	    			</Address>
	    			</ShipFrom>
	
	    			<Package>
	    			<PackagingType><Code>{$params['48_container']}</Code></PackagingType>
      <PackageWeight>
	      <UnitOfMeasurement><Code>{$unitMeasure}</Code></UnitOfMeasurement>
	      <Weight>{$params['23_weight']}</Weight>
	      </PackageWeight>
    </Package>
XMLRequest;
        if ($this->getConfigFlag('negotiated_active')) {
            $xmlRequest .= "<RateInformation><NegotiatedRatesIndicator/></RateInformation>";
        }

        $xmlRequest .= <<< XMLRequest
	        		</Shipment>
	        		</RatingServiceSelectionRequest>
XMLRequest;

        $xmlResponse = $this->_getCachedQuotes($xmlRequest);
        if ($xmlResponse === null) {
            $debugData = ['request' => $xmlRequest];
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, (boolean)$this->getConfigFlag('mode_xml'));
                $xmlResponse = curl_exec($ch);

                $debugData['result'] = $xmlResponse;
                $this->_setCachedQuotes($xmlRequest, $xmlResponse);
            } catch (\Exception $e) {
                $debugData['result'] = ['error' => $e->getMessage(), 'code' => $e->getCode()];
                $xmlResponse = '';
            }
            $this->_debug($debugData);
        }

        return $this->_parseXmlResponseNew($xmlResponse, $vendor, $upsSpecificConfig);
    }


    /**
     * Prepare shipping rate result based on response
     *
     * @param mixed $response
     * @return Mage_Shipping_Model_Rate_Result
     */
    protected function _parseXmlResponseNew($xmlResponse, $vendor, $upsSpecificConfig = array())
    {
        if (!$this->csmultishippingHelper->isEnabled()) {
            return parent::_parseXmlResponseNew();
        }
        if (!$this->upshippingHelper->isEnabled()) {
            return parent::_parseXmlResponseNew();
        }

        $vendorId = $this->_request->getVendorId();
        if (!$vendorId) {
            return;
        }

        $costArr = array();
        $priceArr = array();
        if (strlen(trim($xmlResponse)) > 0) {
            $xml = new \Magento\Framework\Simplexml\Config();
            $xml->loadString($xmlResponse);
            $arr = $xml->getXpath("//RatingServiceSelectionResponse/Response/ResponseStatusCode/text()");
            $success = (int)$arr[0];
            if ($success === 1) {
                $arr = $xml->getXpath("//RatingServiceSelectionResponse/RatedShipment");
                $allowedMethods = array();

                /*ALLOWED METHODS CODE  */
                if ($vendor->getId()) {
                    if (isset($upsSpecificConfig['allowed_methods'])) {
                        $allowedMethods = explode(",", $upsSpecificConfig['allowed_methods']);
                    } else {

                        $arr = $this->upsconfigHelper->getCode('originShipment', 'Shipments Originating in United States');
                        //$arr = $this->getCode('originShipment','Shipments Originating in United States');
                        $allowedMethods = array_keys($arr);
                    }
                } else {
                    $allowedMethods = explode(",", $this->getConfigData('allowed_methods'));
                }
                /*ALLOWED METHODS CODE END*/

                // Negotiated rates
                $negotiatedArr = $xml->getXpath("//RatingServiceSelectionResponse/RatedShipment/NegotiatedRates");
                $negotiatedActive = $this->getConfigData('negotiated_active')
                    && $this->getConfigData('shipper_number')
                    && !empty($negotiatedArr);

                $allowedCurrencies = $this->_currencyFactory->create()->getConfigAllowCurrencies();
                foreach ($arr as $shipElement) {
                    $code = (string)$shipElement->Service->Code;
                    if (in_array($code, $allowedMethods)) {

                        if ($negotiatedActive) {
                            $cost = $shipElement->NegotiatedRates->NetSummaryCharges->GrandTotal->MonetaryValue;
                        } else {
                            $cost = $shipElement->TotalCharges->MonetaryValue;
                        }

                        //convert price with Origin country currency code to base currency code
                        $successConversion = true;
                        $responseCurrencyCode = (string)$shipElement->TotalCharges->CurrencyCode;

                        /* @FIX Code */
                        if ($responseCurrencyCode == "RMB") {
                            $responseCurrencyCode = "CNY";
                        }
                        /* @FIX Code */

                        if ($responseCurrencyCode) {
                            if (in_array($responseCurrencyCode, $allowedCurrencies)) {
                                $cost = (float)$cost * $this->_getBaseCurrencyRate($responseCurrencyCode);
                            } else {
                                $errorTitle = $errorTitle = __(
                                    'We can\'t convert a rate from "%1-%2".',
                                    $responseCurrencyCode,
                                    $this->_request->getPackageCurrency()->getCode()
                                );
                                $error = $this->_rateErrorFactory->create();
                                $error->setCarrier('ups');
                                $error->setCarrierTitle($this->getConfigData('title'));
                                $error->setErrorMessage($errorTitle);
                                $successConversion = false;
                            }
                        }

                        if ($successConversion) {
                            $costArr[$code] = $cost;
                            $priceArr[$code] = $this->getMethodPrice(floatval($cost), $code);
                        }
                    }
                }
            } else {
                $arr = $xml->getXpath("//RatingServiceSelectionResponse/Response/Error/ErrorDescription/text()");
                $errorTitle = (string)$arr[0][0];
                $error = $this->_rateErrorFactory->create();
                $error->setCarrier('ups');
                $error->setCarrierTitle($this->getConfigData('title'));
                $error->setErrorMessage($this->getConfigData('specificerrmsg'));
            }
        }
        $result = $this->_rateFactory->create();
        $defaults = $this->getDefaults();
        if (empty($priceArr)) {
            $error = $this->_rateErrorFactory->create();
            $error->setCarrier('ups');
            $error->setCarrierTitle($this->getConfigData('title'));
            if (!isset($errorTitle)) {
                $errorTitle = __('Cannot retrieve shipping rates');
            }
            $error->setErrorMessage($this->getConfigData('specificerrmsg'));
            $result->append($error);
        } else {
            foreach ($priceArr as $method => $price) {
                $rate = $this->_rateMethodFactory->create();
                if ($vendor->getId()) {
                    $rate->setVendorId($vendor->getId());
                } else {
                    $rate->setVendorId("admin");
                }
                $rate->setCarrier('ups');
                $rate->setCarrierTitle($this->getConfigData('title'));
                if ($vendor->getId()) {
                    $custom_method = $method . \Ced\CsMultiShipping\Model\Shipping::SEPARATOR . $vendor->getId();
                } else {
                    $custom_method = $method;
                }
                $rate->setMethod($custom_method);
                if ($vendor->getId()) {
                    if (isset($upsSpecificConfig['origin_shipment'])) {
                        $origin = $upsSpecificConfig['origin_shipment'];
                    } else {
                        $origin = 'Shipments Originating in United States';
                    }
                    $arr = $this->upsconfigHelper->getCode('originShipment', $origin);
                    //$arr = $this->getCode('originShipment',$origin);
                    if (isset($arr[$method])) {
                        $method_arr = $arr[$method];
                    }
                } else {
                    $method_arr = $this->getShipmentByCode($method);
                }
                $rate->setMethodTitle($method_arr);
                $rate->setCost($costArr[$method]);

                $rate->setPrice($price);
                $result->append($rate);
            }
        }
        return $result;
    }
}
