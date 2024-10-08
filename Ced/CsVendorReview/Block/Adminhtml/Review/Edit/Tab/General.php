<?php



namespace Ced\CsVendorReview\Block\Adminhtml\Review\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class General extends Generic implements TabInterface
{
    /**
     * @var \Ced\CsVendorReview\Model\ResourceModel\Rating\CollectionFactory
     */
    protected $ratingCollection;

    /**
     * General constructor.
     * @param \Ced\CsVendorReview\Model\ResourceModel\Rating\CollectionFactory $ratingCollection
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Ced\CsVendorReview\Model\ResourceModel\Rating\CollectionFactory $ratingCollection,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        $this->ratingCollection = $ratingCollection;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('csvendorreview_review');
        $isElementDisabled = false;
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('General')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $rating_item = $this->ratingCollection->create()->getData();
        $fieldset->addField(
            'vendor_name',
            'text',
            [
                'name' => 'vendor_name',
                'label' => __('Vendor Name'),
                'title' => __('Vendor Name'),
                'readonly' => 'true'

            ]
        );
        $fieldset->addField(
            'customer_name',
            'text',
            [
                'name' => 'customer_name',
                'label' => __('Customer Name'),
                'title' => __('Customer Name'),
            ]
        );
        foreach ($rating_item as $key => $valu) {
            $fieldset->addField(
                $valu['rating_code'],
                'select',
                [
                    'name' => $valu['rating_code'],
                    'label' => __($valu['rating_label']),
                    'title' => __($valu['rating_label']),
                    'options' => $this->getRatingOption(),

                ]
            );
        }
        $fieldset->addField(
            'subject',
            'text',
            [
                'name' => 'subject',
                'label' => __('Subject'),
                'title' => __('Subject'),
                'after_element_html' => '<style>.admin__field.field.field-service {
				  width: 100% !important;
				  float: none !important;
				}</style>',

            ]
        );
        $fieldset->addField(
            'review',
            'text',
            [
                'name' => 'review',
                'label' => __('Review'),
                'title' => __('Review'),

            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'options' => $this->getStatusOption(),
            ]
        );
        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('General');
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('General');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * @param $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * @return array
     */
    public function getRatingOption()
    {
        return [
            '0' => __('Please Select Option'),
            '20' => __('1 OUT OF 5'),
            '40' => __('2 OUT OF 5'),
            '60' => __('3 OUT OF 5'),
            '80' => __('4 OUT OF 5'),
            '100' => __('5 OUT OF 5')
        ];
    }

    /**
     * @return array
     */
    public function getStatusOption()
    {
        return [
            '0' => __('Pending'),
            '1' => __('Approved'),
            '2' => __('Disapproved')
        ];
    }
}
