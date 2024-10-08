<?php



namespace Ced\CsMarketplace\Controller;
/**
 * Class Main
 * @package Ced\CsMarketplace\Controller
 */
class Main implements \Magento\Framework\App\RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * Response
     *
     * @var \Magento\Framework\App\ResponseInterface
     */
    protected $_response;

    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Magento\Framework\App\ResponseInterface $response
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\App\ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->_response = $response;
    }

    /**
     * Validate and Match
     *
     * @param \Magento\Framework\App\RequestInterface $request
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');
        if (strpos($identifier, 'cedcommerce/main') !== false) {
            $info = explode('/', $identifier);
            $info[0] = 'csmarketplace';
            $identifier = implode('/', $info);
            $request->setPathInfo($identifier)->setModuleName('csmarketplace')->setControllerName('main')
                ->setActionName($info[2]);
            $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $identifier);
            return;
        }

    }

}
