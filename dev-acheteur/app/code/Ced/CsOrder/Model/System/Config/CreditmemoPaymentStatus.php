<?php


namespace Ced\CsOrder\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;
use Magento\Sales\Api\CreditmemoRepositoryInterface;

class CreditmemoPaymentStatus implements ArrayInterface
{
    /**
     * @var CreditmemoRepositoryInterface
     */
    protected $_creditmemoRepository;

    /**
     * CreditmemoPaymentStatus constructor.
     * @param CreditmemoRepositoryInterface $creditmemoRepository
     */
    public function __construct(CreditmemoRepositoryInterface $creditmemoRepository)
    {
        $this->_creditmemoRepository=$creditmemoRepository;
    }

    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        $options=[];
        foreach ($this->_creditmemoRepository->create()->getStates() as $id => $state) {
            $options[] = ['value' => $id, 'label' => __($state->render())];
        }
        return $options;
    }
}
