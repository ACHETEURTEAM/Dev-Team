<?php


namespace Ced\CsProduct\Block\Product\Edit\Tab\Options;

use Magento\Catalog\Model\Product;
use \Magento\Catalog\Block\Adminhtml\Product\Edit\Tab\Options\Option as OptionsOption;
use Magento\Framework\DataObject;
use Magento\Framework\Registry;

class Option extends OptionsOption
{
    /**
     * @var Product
     */
    protected $_productInstance;

    /**
     * @var DataObject[]
     */
    protected $_values;

    /**
     * @var int
     */
    protected $_itemCount = 1;

    /**
     * @var string
     */
    protected $_template = 'Magento_Catalog::catalog/product/edit/options/option.phtml';

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();

        $this->setCanReadPrice(true);
        $this->setCanEditPrice(true);
        $this->setData('area', 'adminhtml');
    }

    /**
     * Return product grid url for custom options import popup
     *
     * @return string
     */
    public function getProductGridUrl()
    {
        return $this->getUrl('csproduct/*/optionsImportGrid');
    }

    /**
     * Return custom options getter URL for ajax queries
     *
     * @return string
     */
    public function getCustomOptionsUrl()
    {
        return $this->getUrl('csproduct/*/customOptions');
    }
}
