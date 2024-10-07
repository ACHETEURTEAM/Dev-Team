<?php


namespace Ced\CsProAssign\Block\Adminhtml;
/**
 * Class AddPro
 * @package Ced\CsProAssign\Block\Adminhtml
 */
class AddPro extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * Contains button descriptions to be shown at the top of accordion
     *
     * @var array
     */
    protected $_buttons = [];

    /**
     * Define block ID
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('items.phtml');
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getGridHtml()
    {
        return $this->getLayout()->createBlock('Ced\CsProAssign\Block\Adminhtml\Items\Grid')->toHtml();
    }

    /**
     * Accordion header text
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Assign products');
    }

    /**
     * Add button to the items header
     *
     * @param  array $args
     * @return void
     */
    public function addButton($args)
    {
        $this->_buttons[] = $args;
    }

    /**
     * Render buttons and return HTML code
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getAddButtonsHtml()
    {
        $html = '';
        $addButtonData = [
            'label' => 'Assign Product',
            'class' => 'add',
            'onclick' => 'addProduct()'
        ];
        $html .= $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Button'
        )->setData(
            $addButtonData
        )->toHtml();

        return $html;
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getAssignButtonsHtml()
    {
        $assignButtonData = [
            'label' => __('Assign Selected Product(s) to Vendor'),
            'onclick' => 'assignProduct()',
            'class' => 'add',
        ];
        return $this->getLayout()
            ->createBlock('Magento\Backend\Block\Widget\Button')->setData($assignButtonData)->toHtml();
    }

}

