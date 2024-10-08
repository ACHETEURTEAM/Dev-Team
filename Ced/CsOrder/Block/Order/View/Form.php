<?php


namespace Ced\CsOrder\Block\Order\View;

class Form extends \Magento\Backend\Block\Template
{
    /**
     * Template
     * @var string
     */
    protected $_template = 'order/view/form.phtml';

    /**
     * Form constructor.
     */
    public function __construct()
    {
        $this->setData('area', 'adminhtml');
    }
}
