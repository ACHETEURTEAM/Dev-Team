<?php


namespace Ced\CsMarketplace\Block\Adminhtml\Vendor\Entity\Grid\Renderer;


/**
 * Class ShopStatus
 * @package Ced\CsMarketplace\Block\Adminhtml\Vendor\Entity\Grid\Renderer
 */
class ShopStatus extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{

    /**
     * @var \Ced\CsMarketplace\Model\Vshop
     */
    protected $vshop;

    /**
     * ShopStatus constructor.
     * @param \Ced\CsMarketplace\Model\Vshop $vshop
     */
    public function __construct(
        \Ced\CsMarketplace\Model\Vshop $vshop
    ) {
        $this->vshop = $vshop;
    }

    /**
     * shows shop status
     * @param \Magento\Framework\DataObject $row
     * @return String
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $html = '';
        $model = $this->vshop->loadByField('vendor_id', [$row->getEntityId()]);
        if ($model->getId() != '' && $model->getShopDisable() == \Ced\CsMarketplace\Model\Vshop::ENABLED) {
            $html .= __('Enabled');
        } else if ($model->getId() != '' && $model->getShopDisable() == \Ced\CsMarketplace\Model\Vshop::DISABLED) {
            $html .= __('Disabled');
        } else {
            $html .= __('Enabled');
        }
        return $html;
    }
}

