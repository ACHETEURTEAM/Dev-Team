<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Extensions;


use Ced\CsMarketplace\Helper\Feed;
use Magento\Backend\Block\Widget\Container;
use Magento\Backend\Block\Widget\Context;

/**
 * Class Details
 * @package Ced\CsMarketplace\Block\Adminhtml\Extensions
 */
class Details extends Container
{

    /**
     * @var Feed
     */
    protected $feedHelper;

    /**
     * Details constructor.
     * @param Context $context
     * @param Feed $feedHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Feed $feedHelper,
        array $data = []
    )
    {
        $this->feedHelper = $feedHelper;
        parent::__construct($context, $data);
    }

    /**
     * @return $this|string
     * @throws \Exception
     */
    public function getModules()
    {
        $args = $this->feedHelper->getModules();
        return $args;
    }

    /**
     * @throws \Exception
     */
    public function checkLicense(){
        $this->feedHelper->checkLicense();
    }
}
