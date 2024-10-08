<?php


namespace Ced\CsUpsShipping\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    public $_scopeConfig;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    )
    {
        $this->_scopeConfig = $context->getScopeConfig();
        // parent::__construct($context, $data);
    }
}
