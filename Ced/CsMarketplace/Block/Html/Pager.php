<?php


namespace Ced\CsMarketplace\Block\Html;


/**
 * Class Pager
 * @package Ced\CsMarketplace\Block\Html
 */
class Pager extends \Magento\Theme\Block\Html\Pager
{

    /**
     * @var
     */
    protected $_moduleManager;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $store;

    /**
     * Pager constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        parent::__construct($context);
        $this->store = $context->getStoreManager();
    }

    /**
     * @param int $limit
     * @return string
     */
    public function getLimitUrl($limit)
    {
        return $this->getPagerUrl(array($this->getLimitVarName() => $limit));
    }

    /**
     * @param array $params
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getPagerUrl($params = array())
    {
        $urlParams = array();
        $urlParams['_current'] = true;
        $urlParams['_escape'] = true;
        $urlParams['_use_rewrite'] = true;
        if ($this->store->getStore()->isCurrentlySecure()) {
            $urlParams['_secure'] = true;
        }
        $urlParams['_query'] = $params;
        return $this->getUrl('*/*/*', $urlParams);
    }

    /**
     * Set pager data
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setData('show_amounts', true);
        $this->setData('use_container', true);
    }
}
