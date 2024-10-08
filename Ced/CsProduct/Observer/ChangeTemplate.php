<?php


namespace Ced\CsProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class ChangeTemplate implements ObserverInterface
{
    /**
     * @param mixed $observer
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $observer->getBlock()->setTemplate('Ced_CsProduct::helper/gallery.phtml');
    }
}
