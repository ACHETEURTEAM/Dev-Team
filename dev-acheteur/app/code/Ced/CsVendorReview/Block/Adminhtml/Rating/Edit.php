<?php



namespace Ced\CsVendorReview\Block\Adminhtml\Rating;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{

    /**
     *
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Ced_CsVendorReview';
        $this->_controller = 'adminhtml_rating';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Rating'));
        $this->buttonList->update('delete', 'label', __('Delete Rating'));

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
                if($(\'#edit_form\').valid()){
                        $(\'body\').loader(\'show\');
                     } else {
                        $(\'body\').loader(\'hide\');
                     }
                });

            });
        ';
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('checkmodule_checkmodel')->getId()) {
            return __(
                "Edit Rating '%1'",
                $this->escapeHtml($this->_coreRegistry->registry('checkmodule_checkmodel')->getTitle())
            );
        } else {
            return __('New Rating');
        }
    }
}
