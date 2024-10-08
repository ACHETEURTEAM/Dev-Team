<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vendor\Entity\Edit\Tab\Vpayments;

/**
 * Class Grid
 * @package Ced\CsMarketplace\Block\Adminhtml\Vendor\Entity\Edit\Tab\Vpayments
 */
class Grid extends \Ced\CsMarketplace\Block\Adminhtml\Vpayments\Grid
{
    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/vpaymentsgrid', array('_secure' => true, '_current' => true));
    }

    /**
     * @return $this|\Ced\CsMarketplace\Block\Adminhtml\Vpayments\Grid
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $this->removeColumn('vendor_id');
        $this->getColumn('action')->setActions(array(
            array(
                'caption' => __('View'),
                'url' => array('base' => 'csmarketplace/vpayments/details'),
                'onClick' => "javascript:openMyPopup(this.href); return false;",
                'field' => 'id'
            )
        ));
        return $this;
    }

    /**
     * Remove existing column
     *
     * @param string $columnId
     * @return Grid
     */
    public function removeColumn($columnId)
    {
        if (isset($this->_columns[$columnId])) {
            unset($this->_columns[$columnId]);
            if ($this->_lastColumnId == $columnId) {
                $this->_lastColumnId = key($this->_columns);
            }
        }
        return $this;
    }
}
