<?php


namespace Ced\CsCommission\Block\Adminhtml\Commission\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @return \Magento\Backend\Block\Widget\Form\Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        if ($this->getRequest()->getParam('popup')) {
            $action = $this->getUrl('*/*/save', ['popup' => true]);
        } else {
            $action = $this->getUrl('*/*/save');
        }
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $action,
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                    'onsubmit' => 'disableButton()'
                ]
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
