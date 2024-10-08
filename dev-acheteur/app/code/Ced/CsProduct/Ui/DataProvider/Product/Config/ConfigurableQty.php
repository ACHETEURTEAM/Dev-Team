<?php


namespace Ced\CsProduct\Ui\DataProvider\Product\Config;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;

class ConfigurableQty extends AbstractModifier
{
    const CODE_QUANTITY = 'qty';
    const CODE_QTY_CONTAINER = 'quantity_and_stock_status_qty';

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        if ($groupCode = $this->getGroupCodeByField($meta, self::CODE_QTY_CONTAINER)) {
            $parentChildren = &$meta[$groupCode]['children'];
            if (!empty($parentChildren[self::CODE_QTY_CONTAINER])) {
                $parentChildren[self::CODE_QTY_CONTAINER] = array_replace_recursive(
                    $parentChildren[self::CODE_QTY_CONTAINER],
                    [
                        'children' => [
                            self::CODE_QUANTITY => [
                                'arguments' => [
                                    'data' => [
                                        'config' => [
                                            'imports' => [
                                                'disabled' => '!ns = ${ $.ns }, index = '
                                                    . ConfigurablePanel::CONFIGURABLE_MATRIX . ':isEmpty',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ]
                );
            }
        }

        return $meta;
    }
}
