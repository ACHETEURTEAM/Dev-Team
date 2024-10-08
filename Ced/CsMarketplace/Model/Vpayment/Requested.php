<?php


namespace Ced\CsMarketplace\Model\Vpayment;

/**
 * Class Requested
 * @package Ced\CsMarketplace\Model\Vpayment
 */
class Requested extends \Ced\CsMarketplace\Model\FlatAbstractModel
{

    const PAYMENT_STATUS_REQUESTED = 1;
    const PAYMENT_STATUS_PROCESSED = 2;
    const PAYMENT_STATUS_CANCELED = 3;

    /**
     * @var null
     */
    public static $_statuses = null;

    /**
     * @var string
     */
    protected $_eventPrefix = 'csmarketplace_vpayments_requested';
    /**
     * @var string
     */
    protected $_eventObject = 'vpayment_requested';

    /**
     * Retrieve vendor payment status array
     *
     * @return array
     */
    public function getStatuses()
    {
        if (self::$_statuses === null) {
            self::$_statuses = array(
                self::PAYMENT_STATUS_REQUESTED => __('Requested'),
                self::PAYMENT_STATUS_PROCESSED => __('Processed'),
                self::PAYMENT_STATUS_CANCELED => __('Canceled'),
            );
        }
        return self::$_statuses;
    }

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('Ced\CsMarketplace\Model\ResourceModel\Requested');
    }
}
