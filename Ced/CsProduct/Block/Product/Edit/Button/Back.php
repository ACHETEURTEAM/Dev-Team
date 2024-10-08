<?php

namespace Ced\CsProduct\Block\Product\Edit\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Back as BackButton;

class Back extends BackButton
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('*/*/')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}
