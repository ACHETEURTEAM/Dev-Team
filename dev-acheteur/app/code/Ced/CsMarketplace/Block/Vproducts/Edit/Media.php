<?php


namespace Ced\CsMarketplace\Block\Vproducts\Edit;


/**
 * Class Media
 * @package Ced\CsMarketplace\Block\Vproducts\Edit
 */
class Media extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    protected $image;

    /**
     * Media constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Catalog\Helper\Image $image
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Helper\Image $image
    ) {
        parent::__construct($context);
        $this->_registry = $registry;
        $this->image = $image;
    }

    /**
     * @return \Magento\Framework\Registry
     */
    public function getRegistry()
    {
        return $this->_registry;
    }

    /**
     * @return \Magento\Catalog\Helper\Image
     */
    public function getProductImageHelper()
    {
        return $this->image;
    }
}
