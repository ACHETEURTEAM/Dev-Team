<?php



namespace Ced\CsUpsShipping\Helper;

/**
 * Class Data
 * @package Ced\CsUpsShipping\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Ced\CsMarketplace\Helper\Data
     */
    protected $csmarketplaceHelper;

    /**
     * Data constructor.
     * @param \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Ced\CsMarketplace\Helper\Data $csmarketplaceHelper,
        \Magento\Framework\App\Helper\Context $context
    )
    {
        parent::__construct($context);
        $this->csmarketplaceHelper = $csmarketplaceHelper;
    }

    /**
     * @param int $storeId
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function isEnabled($storeId = 0)
    {
        if ($storeId == 0) {
            $storeId = $this->csmarketplaceHelper->getStore()->getId();
        }
        return $this->csmarketplaceHelper->getStoreConfig('ced_csupsshipping/general/active', $storeId);
    }
}