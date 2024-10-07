<?php

namespace Ced\VendorsocialLogin\Model\Twitter\Oauth2;

use Laminas\OAuth\OAuthConsumer;
use Laminas\Http\Client as HttpClient;
use Magento\Framework\Serialize\SerializerInterface;


/**
 * Class Client
 * @package Ced\VendorsocialLogin\Model\Twitter\Oauth2
 */
class Client extends \Magento\Framework\DataObject
{
    const REDIRECT_URI_ROUTE = 'cedvendorsociallogin/twitter/connect';
    const REQUEST_TOKEN_URI_ROUTE = 'cedvendorsociallogin/twitter/request';
    const OAUTH_URI = 'https://api.twitter.com/oauth';
    const OAUTH2_SERVICE_URI = 'https://api.twitter.com/1.1';
    const XML_PATH_ENABLED = 'ven_social/ced_sociallogin_twitter/enabled';
    const XML_PATH_CLIENT_ID = 'ven_social/ced_sociallogin_twitter/client_id';
    const XML_PATH_CLIENT_SECRET = 'ven_social/ced_sociallogin_twitter/client_secret';

    protected $_config;
    protected $_url;
    protected $_customerSession;
    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;
    protected $client;
    protected $token = null;
    protected $_serializer;

    /**
     * Client constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $config
     * @param \Magento\Framework\UrlInterface $url
     * @param \Magento\Customer\Model\Session $customerSession
     * @param SerializerInterface $serializerInterface
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\UrlInterface $url,
        \Magento\Customer\Model\Session $customerSession,
        SerializerInterface $serializerInterface,
        array $data = []
    ) {
        $this->_config = $config;
        $this->_url = $url;
        $this->_customerSession = $customerSession;
        $this->_serializer = $serializerInterface;
     

        $this->redirectUri = $this->_url->sessionUrlVar(
            $this->_url->getUrl(self::REDIRECT_URI_ROUTE)
        );
        $this->clientId = $this->_getClientId();
        $this->clientSecret = $this->_getClientSecret();

        // Initialize the OAuth consumer
        $this->client = new OAuthConsumer($this->clientId, $this->clientSecret);

        parent::__construct($data);
    }

    protected function _getClientId()
    {
        return $this->_getStoreConfig(self::XML_PATH_CLIENT_ID);
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    protected function _getStoreConfig($xmlPath)
    {
        return $this->_config->getValue($xmlPath);
    }

    protected function _getClientSecret()
    {
        return $this->_getStoreConfig(self::XML_PATH_CLIENT_SECRET);
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function isEnabled()
    {
        return (bool)$this->_isEnabled();
    }

    protected function _isEnabled()
    {
        return $this->_getStoreConfig(self::XML_PATH_ENABLED);
    }

    public function getAccessToken()
    {
        if (empty($this->token)) {
            $this->fetchAccessToken();
        }
        return $this->_serializer->serialize($this->token);
    }

    protected function fetchAccessToken($code = null)
    {
        if (!($params = $this->getRequest()->getParams())
            || !($requestToken = $this->_customerSession->getTwitterRequestToken())
        ) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Unable to retrieve access code.')
            );
        }

        // Use the OAuthConsumer to fetch the access token
        $token = $this->client->getAccessToken($params, $this->_serializer->unserialize($requestToken));
        if (!$token) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Unable to retrieve access token.'));
        }

        $this->_customerSession->unsTwitterRequestToken();
        return $this->token = $token;
    }

    public function createAuthUrl()
    {
        return $this->_url->getUrl(self::REQUEST_TOKEN_URI_ROUTE);
    }

    public function api($endpoint, $method = 'GET', $params = [])
    {
        if (empty($this->token)) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Unable to proceed without an access token.'));
        }

        $url = self::OAUTH2_SERVICE_URI . $endpoint;
        $response = $this->_httpRequest($url, strtoupper($method), $params);

        return $response;
    }

    protected function _httpRequest($url, $method = 'GET', $params = [])
    {
        // Prepare the HTTP client
        $client = new HttpClient();
        $client->setConfig(['timeout' => 30]); // Optional: set timeout
        $client->setUri($url);
        $client->setMethod(strtoupper($method));

        // Set parameters based on method
        if ($method === 'GET') {
            $client->setParameterGet($params);
        } elseif ($method === 'POST') {
            $client->setParameterPost($params);
        }

        $response = $client->request();

        // Decode the response
        $decoded_response = json_decode($response->getBody(), true); // Added true to get associative array

        if ($response->isError()) {
            $status = $response->getStatus();
            $message = ($decoded_response['error']['message'] ?? __('Unspecified OAuth error occurred.'));
            throw new \Magento\Framework\Exception\LocalizedException(sprintf(__('HTTP error %d occurred: %s'), $status, $message));
        }

        return $decoded_response;
    }

    public function fetchRequestToken()
    {
        if (!($requestToken = $this->client->getRequestToken())) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Unable to retrieve request token.'));
        }
        $this->_customerSession->setTwitterRequestToken($this->_serializer->serialize($requestToken));
        $this->client->redirect();
    }
}
