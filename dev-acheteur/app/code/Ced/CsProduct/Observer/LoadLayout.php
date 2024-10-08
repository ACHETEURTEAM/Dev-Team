<?php


namespace Ced\CsProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class LoadLayout implements ObserverInterface
{
    /**
     * @var \Ced\CsProduct\Helper\Data
     */
    protected $helper;

    /**
     * LoadLayout constructor.
     * @param \Ced\CsProduct\Helper\Data $helper
     */
    public function __construct(
        \Ced\CsProduct\Helper\Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->helper->cleanCache();
        return $this;
    }
}
