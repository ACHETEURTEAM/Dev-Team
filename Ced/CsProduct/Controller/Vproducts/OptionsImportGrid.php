<?php


namespace Ced\CsProduct\Controller\Vproducts;

class OptionsImportGrid extends AbstractProductGrid
{
    /**
     * Show product grid for custom options import popup
     *
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        return $this->resultLayoutFactory->create();
    }
}
