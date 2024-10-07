<?php


namespace Ced\CsProduct\Block\Product\Edit\Tab;

use Magento\Backend\Block\Widget;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;

class Options extends Widget
{
    /**
     * @var string
     */
    protected $_template = 'Ced_CsProduct::product/edit/options.phtml';

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * Options constructor.
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        $data = []
    ) {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return Widget
     */
    protected function _prepareLayout()
    {
        if (!$this->registry->registry('block_exist')) {
            $this->addChild(
                'add_button',
                \Magento\Backend\Block\Widget\Button::class,
                ['label' => __('Add New Option'), 'class' => 'add', 'id' => 'add_new_defined_option']
            );

            $this->addChild('options_box', \Ced\CsProduct\Block\Product\Edit\Tab\Options\Option::class);

            $this->addChild(
                'import_button',
                \Magento\Backend\Block\Widget\Button::class,
                ['label' => __('Import Options'), 'class' => 'add', 'id' => 'import_new_defined_option']
            );
            $this->registry->register('block_exist', true);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getAddButtonHtml()
    {
        return $this->getChildHtml('add_button');
    }

    /**
     * @return string
     */
    public function getOptionsBoxHtml()
    {
        return $this->getChildHtml('options_box');
    }
}
