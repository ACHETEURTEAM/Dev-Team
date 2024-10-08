<?php


namespace Ced\CsMarketplace\Model\Config;

/**
 * Class SchemaLocator
 * @package Ced\CsMarketplace\Model\Config
 */
class SchemaLocator extends \Magento\Config\Model\Config\SchemaLocator
{

    /**
     * Path to corresponding XSD file with validation rules for merged config
     *
     * @var string
     */
    protected $_schema = null;

    /**
     * Path to corresponding XSD file with validation rules for separate config files
     *
     * @var string
     */
    protected $_perFileSchema = null;

    /**
     * @param \Magento\Framework\Module\Dir\Reader $moduleReader
     * @param \Magento\Framework\Module\Manager $moduleManager
     */
    public function __construct(
        \Magento\Framework\Module\Dir\Reader $moduleReader,
        \Magento\Framework\Module\Manager $moduleManager
    ) {
        parent::__construct($moduleReader);

        if ($moduleManager->isEnabled('Ced_CsMarketplace')) {
            $etcDir = $moduleReader->getModuleDir(\Magento\Framework\Module\Dir::MODULE_ETC_DIR, 'Ced_CsMarketplace');
            $this->_schema = $etcDir . '/system.xsd';
            $this->_perFileSchema = $etcDir . '/system_file.xsd';
        }
    }

    /**
     * Get path to merged config schema
     *
     * @return string|null
     */
    public function getSchema()
    {
        return $this->_schema;
    }

    /**
     * Get path to pre file validation schema
     *
     * @return string|null
     */
    public function getPerFileSchema()
    {
        return $this->_perFileSchema;
    }
}
