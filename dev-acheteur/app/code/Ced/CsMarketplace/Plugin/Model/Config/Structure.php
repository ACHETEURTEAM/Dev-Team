<?php


namespace Ced\CsMarketplace\Plugin\Model\Config;


use Ced\CsMarketplace\Helper\Feed;
use Magento\Config\Model\Config\Structure as MagentoConfigStructure;

/**
 * Class Structure
 * @package Ced\CsMarketplace\Plugin\Model\Config
 */
class Structure
{

    /**
     * @var Feed
     */
    protected $feedHelper;

    /**
     * Structure constructor.
     * @param Feed $feedHelper
     */
    public function __construct(
        Feed $feedHelper
    ) {
        $this->feedHelper = $feedHelper;
    }

    /**
     * @param MagentoConfigStructure $subject
     * @param $result
     * @return array
     * @throws \Exception
     */
    public function afterGetFieldPaths(MagentoConfigStructure $subject, $result)
    {
        $modules = $this->feedHelper->getAllModules();
        $config_paths = [];
        //groups[extensions][fields][extension_' . strtolower($moduleName) . '][value]
        foreach ($modules as $moduleName => $children) {
            $path = 'cedcore/extensions/extension_' . strtolower($moduleName);
            $config_paths[$path] = [$path];
        }

        if (!empty($config_paths))
            $result = array_merge($result, $config_paths);

        return $result;
    }
}
