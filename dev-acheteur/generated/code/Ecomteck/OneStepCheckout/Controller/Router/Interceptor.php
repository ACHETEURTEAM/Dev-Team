<?php
namespace Ecomteck\OneStepCheckout\Controller\Router;

/**
 * Interceptor class for @see \Ecomteck\OneStepCheckout\Controller\Router
 */
class Interceptor extends \Ecomteck\OneStepCheckout\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory, \Magento\Framework\App\ResponseInterface $response, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\UrlRewrite\Model\UrlFinderInterface $urlFinder, \Magento\Framework\UrlInterface $url, \Ecomteck\OneStepCheckout\Helper\Config $configHelper)
    {
        $this->___init();
        parent::__construct($actionFactory, $response, $storeManager, $urlFinder, $url, $configHelper);
    }

    /**
     * {@inheritdoc}
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'match');
        return $pluginInfo ? $this->___callPlugins('match', func_get_args(), $pluginInfo) : parent::match($request);
    }
}
