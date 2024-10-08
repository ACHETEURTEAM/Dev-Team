<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vorders\Grid\Renderer;


use Magento\Framework\DataObject;

/**
 * Class Paynow
 * @package Ced\CsMarketplace\Block\Adminhtml\Vorders\Grid\Renderer
 */
class Paynow extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Options
{

    /**
     * Return the Order Id Link
     *
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $html = "";
        foreach ($this->_getOptions() as $key => $value) {
            if ($key == $row->getPaymentState()) {
                $html = is_object($value) ? $value->getText() : $value;
                break;
            }
        }

        if ($row->getVendorId() != '') {
            if ($row->canPay()) {

                $url = $this->getUrl('csmarketplace/vpayments/new/',
                    ['vendor_id' => $row->getVendorId(), 'order_ids' => $row->getId(),
                        'type' => \Ced\CsMarketplace\Model\Vpayment::TRANSACTION_TYPE_CREDIT]);
                $html .= "&nbsp;" . $this->getPayNowButtonHtml($url);
            } 
            // elseif ($row->canRefund()) {
            //     $url = $this->getUrl('csmarketplace/vpayments/new/',
            //         array('vendor_id' => $row->getVendorId(), 'order_ids' => $row->getId(),
            //             'type' => \Ced\CsMarketplace\Model\Vpayment::TRANSACTION_TYPE_DEBIT));
            //     $html = $this->getRefundButtonHtml($url, $html);
            // }
        }

        return $html;
    }

    /**
     * get pay now button html
     *
     * @param string $url
     * @return string
     */
    protected function getPayNowButtonHtml($url = '')
    {
        return '<input class="button sacalable save" 
                        style = "cursor: pointer; 
                                background: #ffac47 url("images/btn_bg.gif") repeat-x scroll 0 100%;
                                border-color: #ed6502 #a04300 #a04300 #ed6502;
                                border-style: solid;
                                border-width: 1px;
                                color: #fff;
                                cursor: pointer; 
                                font: bold 12px arial,helvetica,sans-serif;    
                                padding: 1px 7px 2px;
                                text-align: center !important; 
                                white-space: nowrap;" 
                                type="button" 
                                onclick="setLocation(\'' .
            $url . '\')" 
                                value="PayNow">';
    }

    /**
     * Get refund button html
     *
     * @param string $url
     * @param string $label
     * @return string
     */
    protected function getRefundButtonHtml($url = '', $label = '')
    {
        return '<input class="button sacalable save" 
                        style="cursor: pointer; 
                                background: #ffac47 url("images/btn_bg.gif") repeat-x scroll 0 100%;
                                border-color: #ed6502 #a04300 #a04300 #ed6502;    
                                border-style: solid;   
                                border-width: 1px;    
                                color: #fff;    
                                cursor: pointer;    
                                font: bold 12px arial,helvetica,sans-serif;    
                                padding: 1px 7px 2px;
                                text-align: center !important; 
                                white-space: nowrap;" 
                                type="button" 
                                onclick="setLocation(\'' .
            $url . '\')" 
                                value="RefundNow">';
    }
}