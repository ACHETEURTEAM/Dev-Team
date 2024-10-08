<?php


namespace Ced\CsProduct\Block\ConfigurableProduct\Product\Steps;

use Magento\ConfigurableProduct\Block\Adminhtml\Product\Steps\Summary as StepsSummary;

class Summary extends StepsSummary
{

    /**
     * {@inheritdoc}
     */
    public function getCaption()
    {
        return __('Summary');
    }

    /**
     * Get url to upload files
     *
     * @return string
     */
    public function getImageUploadUrl()
    {
        return $this->getUrl('csproduct/product_gallery/upload');
    }
}
