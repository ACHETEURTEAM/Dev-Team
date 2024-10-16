<?php

namespace Ced\VendorsocialLogin\Controller\Twitter;

/**
 * Class Request
 * @package Ced\VendorsocialLogin\Controller\Twitter
 */
class Request extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Ced\VendorsocialLogin\Model\Twitter\Oauth2\Client
     */
    protected $client;

    /**
     * Request constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Ced\VendorsocialLogin\Model\Twitter\Oauth2\Client $client
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Ced\VendorsocialLogin\Model\Twitter\Oauth2\Client $client
    ) {
        parent::__construct($context);
        $this->client = $client;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $client = $this->client;
        try {
            $client->fetchRequestToken();
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __($e->getMessage()));
            $this->_redirect('/');
        }
    }
}
