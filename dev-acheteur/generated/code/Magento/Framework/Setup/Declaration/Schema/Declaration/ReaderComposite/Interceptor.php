<?php
namespace Magento\Framework\Setup\Declaration\Schema\Declaration\ReaderComposite;

/**
 * Interceptor class for @see \Magento\Framework\Setup\Declaration\Schema\Declaration\ReaderComposite
 */
class Interceptor extends \Magento\Framework\Setup\Declaration\Schema\Declaration\ReaderComposite implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\DeploymentConfig $deploymentConfig, array $readers = [])
    {
        $this->___init();
        parent::__construct($deploymentConfig, $readers);
    }

    /**
     * {@inheritdoc}
     */
    public function read($scope = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'read');
        return $pluginInfo ? $this->___callPlugins('read', func_get_args(), $pluginInfo) : parent::read($scope);
    }
}
