<?php
namespace Magento\Theme\Model\View\Design;

/**
 * Interceptor class for @see \Magento\Theme\Model\View\Design
 */
class Interceptor extends \Magento\Theme\Model\View\Design implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\View\Design\Theme\FlyweightFactory $flyweightFactory, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Theme\Model\ThemeFactory $themeFactory, \Magento\Framework\ObjectManagerInterface $objectManager, \Magento\Framework\App\State $appState, array $themes)
    {
        $this->___init();
        parent::__construct($storeManager, $flyweightFactory, $scopeConfig, $themeFactory, $objectManager, $appState, $themes);
    }

    /**
     * {@inheritdoc}
     */
    public function setArea($area)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setArea');
        return $pluginInfo ? $this->___callPlugins('setArea', func_get_args(), $pluginInfo) : parent::setArea($area);
    }

    /**
     * {@inheritdoc}
     */
    public function getArea()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getArea');
        return $pluginInfo ? $this->___callPlugins('getArea', func_get_args(), $pluginInfo) : parent::getArea();
    }

    /**
     * {@inheritdoc}
     */
    public function setDesignTheme($theme, $area = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setDesignTheme');
        return $pluginInfo ? $this->___callPlugins('setDesignTheme', func_get_args(), $pluginInfo) : parent::setDesignTheme($theme, $area);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigurationDesignTheme($area = null, array $params = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getConfigurationDesignTheme');
        return $pluginInfo ? $this->___callPlugins('getConfigurationDesignTheme', func_get_args(), $pluginInfo) : parent::getConfigurationDesignTheme($area, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultDesignTheme()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setDefaultDesignTheme');
        return $pluginInfo ? $this->___callPlugins('setDefaultDesignTheme', func_get_args(), $pluginInfo) : parent::setDefaultDesignTheme();
    }

    /**
     * {@inheritdoc}
     */
    public function getDesignTheme()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDesignTheme');
        return $pluginInfo ? $this->___callPlugins('getDesignTheme', func_get_args(), $pluginInfo) : parent::getDesignTheme();
    }

    /**
     * {@inheritdoc}
     */
    public function getThemePath(\Magento\Framework\View\Design\ThemeInterface $theme)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getThemePath');
        return $pluginInfo ? $this->___callPlugins('getThemePath', func_get_args(), $pluginInfo) : parent::getThemePath($theme);
    }

    /**
     * {@inheritdoc}
     */
    public function getLocale()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLocale');
        return $pluginInfo ? $this->___callPlugins('getLocale', func_get_args(), $pluginInfo) : parent::getLocale();
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale(\Magento\Framework\Locale\ResolverInterface $locale)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setLocale');
        return $pluginInfo ? $this->___callPlugins('setLocale', func_get_args(), $pluginInfo) : parent::setLocale($locale);
    }

    /**
     * {@inheritdoc}
     */
    public function getDesignParams()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDesignParams');
        return $pluginInfo ? $this->___callPlugins('getDesignParams', func_get_args(), $pluginInfo) : parent::getDesignParams();
    }
}
