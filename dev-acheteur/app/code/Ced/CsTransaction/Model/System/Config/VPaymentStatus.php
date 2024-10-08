<?php


namespace Ced\CsTransaction\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

class VPaymentStatus implements ArrayInterface
{
    /**
     * @var \Ced\CsMarketplace\Model\Vpayment\Requested
     */
    protected $_vpaymentRequested;

    /**
     * VPaymentStatus constructor.
     * @param \Ced\CsMarketplace\Model\Vpayment\Requested $vpaymentRequested
     */
    public function __construct(\Ced\CsMarketplace\Model\Vpayment\Requested $vpaymentRequested)
    {
        $this->_vpaymentRequested = $vpaymentRequested;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->_vpaymentRequested->getStatuses() as $id => $state) {
            $options[] = ['value' => $id, 'label' => __($state->render())];
        }
        return $options;
    }
}
