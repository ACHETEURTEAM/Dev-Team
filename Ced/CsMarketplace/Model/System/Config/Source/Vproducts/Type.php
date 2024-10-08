<?php


namespace Ced\CsMarketplace\Model\System\Config\Source\Vproducts;

use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Type
 * @package Ced\CsMarketplace\Model\System\Config\Source\Vproducts
 */
class Type implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * Supported Product Type by Ced_CsMarketplace extension.
     */
    const XML_PATH_CED_CSMARKETPLACE_VPRODUCTS_TYPE = 'ced_csmarketplace/vproducts/types';

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Catalog\Model\Product\Type
     */
    protected $_producttype;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Type constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Catalog\Model\Product\Type $producttype
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Catalog\Model\Product\Type $producttype,
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
        $this->request = $request;
        $this->scopeConfig = $scopeConfig;
        $this->_producttype = $producttype;
    }

    /**
     * Retrieve Option values array
     *
     * @param boolean $defaultValues
     * @param boolean $withEmpty
     * @param null $storeId
     * @return array
     */
    public function toOptionArray($defaultValues = false, $withEmpty = false, $storeId = null)
    {
        $options = $stores = $allowedType = [];

        if (!$defaultValues) {
            if ($storeId == null) {
                $stores = $this->storeManager->getStores(false, true);
            }
            $storeId = current($stores)->getId();
            $allowedType = $this->getAllowedType($storeId);
        }

        $types = $this->scopeConfig->getValue(self::XML_PATH_CED_CSMARKETPLACE_VPRODUCTS_TYPE);
        $types = array_keys((array)$types);

        foreach ($this->_producttype->getOptionArray() as $value => $label) {
            if (in_array($value, $types)) {
                if (!$defaultValues && !in_array($value, $allowedType)) {
                    continue;
                }
                $options[] = array('value' => $value, 'label' => $label);
            }
        }

        if ($withEmpty) {
            array_unshift($options, array('label' => '', 'value' => ''));
        }
        return $options;
    }

    /**
     * Get Allowed product type
     *
     * @param  int $storeId
     * @return array
     */
    public function getAllowedType($storeId = 0)
    {
        if ($storeId) {
            if ($this->request->getParam('store')) {
                $type = $this->scopeConfig->getValue(
                    'ced_vproducts/general/type',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                    $this->request->getParam('store')
                );
                return explode(',', $type);
            }
            return explode(',', $this->scopeConfig->getValue('ced_vproducts/general/type'));
        }
        return explode(',', $this->scopeConfig->getValue('ced_vproducts/general/type'));
    }
}
