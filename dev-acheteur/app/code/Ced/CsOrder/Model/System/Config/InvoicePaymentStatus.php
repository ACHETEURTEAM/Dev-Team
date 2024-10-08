<?php


namespace Ced\CsOrder\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;
use Magento\Sales\Api\InvoiceRepositoryInterface;

class InvoicePaymentStatus implements ArrayInterface
{
    /**
     * @var InvoiceRepositoryInterface
     */
    protected $_invoiceRepository;

    /**
     * InvoicePaymentStatus constructor.
     * @param InvoiceRepositoryInterface $invoiceRepository
     */
    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->_invoiceRepository =$invoiceRepository;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options=[];
        foreach ($this->_invoiceRepository->create()->getStates() as $id => $state) {
            $options[] = ['value' => $id, 'label' => __($state->render())];
        }
        return $options;
    }
}
