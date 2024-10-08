<?php

namespace Ced\CsProduct\Ui\DataProvider\Product\Related;

class CrossSellDataProvider extends AbstractDataProvider
{
    /**
     * {@inheritdoc}
     */
    protected function getLinkType()
    {
        return 'cross_sell';
    }
}
