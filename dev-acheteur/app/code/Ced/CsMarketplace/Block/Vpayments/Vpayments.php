<?php


namespace Ced\CsMarketplace\Block\Vpayments;

/**
 * Class Vpayments
 * @package Ced\CsMarketplace\Block\Vpayments
 */
class Vpayments extends \Magento\Backend\Block\Widget\Container
{

    /**
     * @var string
     */
    protected $_template = 'vpayments/vpayments/list.phtml';

    /**
     * @return mixed
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('transaction_grid');
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'vpayments_listblock';
        $this->_blockGroup = 'Ced_CsMarketplace';
        $this->_headerText = __('Request Transaction List');
        parent::_construct();
        $this->removeButton('add');

    }

    /**
     * @return mixed
     */
    protected function _prepareLayout()
    {
        $this->setChild(
            'transaction_grid',
            $this->getLayout()
                ->createBlock('Ced\CsMarketplace\Block\Vpayments\Vpayments\Grid', 'marketplace.transaction.grid')
        );
        return parent::_prepareLayout();
    }
}
