<?php


namespace Ced\CsMarketplace\Block\Vendor\Form;


use Ced\CsMarketplace\Model\Url;
use Magento\Framework\View\Element\Template;

/**
 * Customer account navigation sidebar
 */
class Confirmation extends Template
{

    /**
     * @var Url
     */
    protected $vendorUrl;

    /**
     * @param Template\Context $context
     * @param Url $vendorUrl
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Url $vendorUrl,
        array $data = []
    ) {
        $this->vendorUrl = $vendorUrl;
        parent::__construct($context, $data);
    }

    /**
     * Get login URL
     *
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->vendorUrl->getLoginUrl();
    }
}
