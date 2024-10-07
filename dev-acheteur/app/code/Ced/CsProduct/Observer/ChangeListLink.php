<?php


namespace Ced\CsProduct\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class ChangeListLink implements ObserverInterface
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlManager;

    /**
     * @var \Ced\CsProduct\Helper\Data
     */
    protected $csproductHelper;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * ChangeListLink constructor.
     * @param RequestInterface $request
     * @param \Magento\Framework\UrlInterface $urlManager
     * @param \Ced\CsProduct\Helper\Data $csproductHelper
     */
    public function __construct(
        RequestInterface $request,
        \Magento\Framework\UrlInterface $urlManager,
        \Ced\CsProduct\Helper\Data $csproductHelper
    ) {
        $this->request = $request;
        $this->_urlManager = $urlManager;
        $this->csproductHelper = $csproductHelper;
    }

    /**
     * redirect on advance product link
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->csproductHelper->isActive()) {
            $controller = $observer->getControllerAction();
            $url = $this->_urlManager->getUrl('csproduct/vproducts/index');
            $this->request->setModuleName('csproduct');
            $controller->getResponse()->setRedirect($url);
        }
    }
}
