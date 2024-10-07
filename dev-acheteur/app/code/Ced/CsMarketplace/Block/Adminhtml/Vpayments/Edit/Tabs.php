<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vpayments\Edit;


/**
 * Class Tabs
 * @package Ced\CsMarketplace\Block\Adminhtml\Vpayments\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('payment_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Payment Information'));
    }

    /**
     * @return $this
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {
        $back = $this->getRequest()->getParam('back', '');
        $vendorId = $this->getRequest()->getParam('vendor_id', 0);
        $amount = $this->getRequest()->getPost('total', 0);
        if ($back == 'edit' && $vendorId && $amount > 0) {
            $this->addTab('form_section', array(
                'label' => __('Payment Information'),
                'title' => __('Payment Information'),
                'content' => $this->getLayout()
                    ->createBlock('Ced\CsMarketplace\Block\Adminhtml\Vpayments\Edit\Tab\Paymentinformation')
                    ->setVendorId($vendorId)->toHtml(),
            ));
        } else {
            $this->addTab('order_section', [
                'label' => __('Payment Selection'),
                'title' => __('Payment Selection'),
                'content' => $this->getLayout()
                    ->createBlock('Ced\CsMarketplace\Block\Adminhtml\Vpayments\Edit\Tab\Addorder')->toHtml(),
            ]);
        }

        return parent::_beforeToHtml();
    }
}