<?php



namespace Ced\CsVendorReview\Block\Adminhtml\Review;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Ced_CsVendorReview';
        $this->_controller = 'adminhtml_review';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Review'));
        $this->buttonList->update('delete', 'label', __('Delete Review'));

        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']]
                ]
            ],
            -100
        );

        $this->_formScripts[] = '
            require(["jquery", "loader", "domReady!"], function($){
                \'use strict\';
                $("#edit_form").on("submit", function(e){
                if(jQuery(\'#edit_form\').valid()){
                        jQuery(\'body\').loader(\'show\');
                     } else {
                        jQuery(\'body\').loader(\'hide\');
                     }
                });

            });
        ';
    }

    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('checkmodule_checkmodel')->getId()) {
            return __(
                "Edit Review '%1'",
                $this->escapeHtml($this->_coreRegistry->registry('checkmodule_checkmodel')->getTitle())
            );
        } else {
            return __('New Review');
        }
    }
}
