<?php
namespace Ced\CsMarketplace\Controller\Router;

/**
 * Interceptor class for @see \Ced\CsMarketplace\Controller\Router
 */
class Interceptor extends \Ced\CsMarketplace\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Ced\CsMarketplace\Helper\Data $csmarketplaceHelper, \Magento\Framework\Module\Manager $manager)
    {
        $this->___init();
        parent::__construct($csmarketplaceHelper, $manager);
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
