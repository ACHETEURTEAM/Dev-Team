<?php


namespace Ced\CsOrder\Observer;

use Magento\Framework\Event\ObserverInterface;

class ChangeViewLink implements ObserverInterface
{
    /**
     * @var \Ced\CsOrder\Helper\Data
     */
    protected $helper;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlManager;

    /**
     * ChangeViewLink constructor.
     * @param \Magento\Framework\UrlInterface $urlManager
     * @param \Ced\CsOrder\Helper\Data $helper
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlManager,
        \Ced\CsOrder\Helper\Data $helper
    ) {
        $this->_urlManager = $urlManager;
        $this->helper = $helper;
    }

    /**
     * Redirect on advance order link
     * @param $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->helper->isActive()) {
            $controller = $observer->getControllerAction();
            $url = $this->_urlManager->getUrl('csorder/vorders/view', $controller->getRequest()->getParams());
            $controller->getResponse()->setRedirect($url);
        }
    }
}
