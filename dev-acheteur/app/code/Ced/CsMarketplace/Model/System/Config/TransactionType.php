<?php



namespace Ced\CsMarketplace\Model\System\Config;
use Magento\Framework\Option\ArrayInterface;

/**
 * Class TransactionType
 * @package Ced\CsMarketplace\Model\System\Config
 */
class TransactionType implements ArrayInterface
{

    const TRANSACTION_TYPE_CREDIT = 0;

   // const TRANSACTION_TYPE_DEBIT = 1;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => self::TRANSACTION_TYPE_CREDIT, 'label' => __('Credit')]
          //  ,['value' => self::TRANSACTION_TYPE_DEBIT, 'label' => __('Debit')]
        ];
        return $options;
    }

}