<?php


namespace Ced\CsMarketplace\Block\Vpayments\Vpayments\Renderer;


use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;

/**
 * Class Action
 * @package Ced\CsMarketplace\Block\Vpayments\Vpayments\Renderer
 */
class Action extends AbstractRenderer
{

    /**
     * Action constructor.
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $html = '';
        $html .= '<span class="number"><a class="btn btn-info btn-outline btn-circle" title="View" href="' .
            $this->getUrl("csmarketplace/vpayments/view", array("payment_id" => $row->getId())) .
            '"><i style="font-size:15px;" class="fa fa-info"></i></a></span>';
        return $html;
    }
}
