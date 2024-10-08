<?php


namespace Ced\CsVendorProductAttribute\Block\Product\Attribute\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Framework\Data\Form as DataForm;

/**
 * Class Form
 * @package Ced\CsVendorProductAttribute\Block\Product\Attribute\Edit
 */
class Form extends Generic
{
    /**
     * set area adminhtml
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setData('area','adminhtml');
    }

    /**
     * @return mixed
     */
    protected function _prepareForm()
    {
        /** @var DataForm $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
