<?php



namespace Ced\CsVendorReview\Block\Adminhtml\Review\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var
     */
    protected $_customerAccountService;

    /**
     * @return Form
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save'),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                ]
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
