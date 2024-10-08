<?php


namespace Ced\CsOrder\Controller\Creditmemo;

class Grid extends \Ced\CsMarketplace\Controller\Vendor
{
    /**
     * Grid action
     * @return void
     */
    public function execute()
    {
        $this->getResponse()->setBody(
            $this->resultPageFactory->create(true)->getLayout()
                 ->createBlock(\Ced\CsOrder\Block\ListCreditmemo\Grid::class)->toHtml()
        );
    }
}
