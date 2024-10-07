<?php

namespace Ced\VendorsocialLogin\Model\Facebook\Oauth2;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\HTTP\ZendClientFactory;
use Magento\Framework\UrlInterface;
use Laminas\Uri\Uri;

/**
 * Class Client
 * @package Ced\VendorsocialLogin\Model\Facebook\Oauth2
 */
class Client extends \Magento\Framework\DataObject
{
    const REDIRECT_URI_ROUTE = 'cedvendorsociallogin/facebook/connect';
    const XML_PATH_ENABLED = 'ven_social/ced_sociallogin_facebook/enabled';
    const XML_PATH_CLIENT_ID = 'ven_social/ced_sociallogin_facebook/client_id';
    const XML_PATH_CLIENT_SECRET = 'ven_social/ced_sociallogin_facebook/client_secret';
    const OAUTH2_SERVICE_URI = 'https://graph.facebook.com';
    const OAUTH2_AUTH_URI = 'https://graph.facebook.com/oauth/authorize';
    const OAUTH2_TOKEN_URI = 'https://graph.facebook.com/oauth/access_token';

    protected $scopeConfig;
    protected $_httpClientFactory;
    protected $_url;
    protected $_request;
    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;
    protected $state;
    protected $scope = ['public_profile', 'email'];
    protected $token;

    /**
     * Client constructor.
     */
    public function __construct(
        ZendClientFactory $httpClientFactory,
        ScopeConfigInterface $scopeConfig,
        UrlInterface $url,
        Uri $laminasUri,
        RequestInterface $request,
        array $data = []
    ) {
        $this->_httpClientFactory = $httpClientFactory;
        $this->_url = $url;
        $this->_request = $request;
        $this->laminasUri = $laminasUri;
        $this->scopeConfig = $scopeConfig;

        $this->redirectUri = $this->_url->sessionUrlVar(
            $this->_url->getUrl(self::REDIRECT_URI_ROUTE)
        );
        $this->clientId = $this->_getClientId();
        $this->clientSecret = $this->_getClientSecret();

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
        return $this->scopeConfig->getValue($xmlPath);
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
        return json_encode($this->token);
    }

    protected function fetchAccessToken($code = null)
    {
        if (empty($this->_request->getParam('code'))) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Unable to retrieve access code.')
            );
        }

        $response = $this->_httpRequest(
            self::OAUTH2_TOKEN_URI,
            'POST',
            [
                'code' => $this->_request->getParam('code'),
                'redirect_uri' => $this->getRedirectUri(),
                'client_id' => $this->getClientId(),
                'client_secret' => $this->getClientSecret(),
                'grant_type' => 'authorization_code'
            ]
        );

        $this->setAccessToken($response);

        return $this->getAccessToken();
    }

    protected function _httpRequest($url, $method = 'GET', $params = [])
    {
        $client = $this->_httpClientFactory->create();
        $client->setUri($url);

        switch (strtoupper($method)) {
            case 'GET':
                $client->setParameterGet($params);
                break;
            case 'POST':
                $client->setParameterPost($params);
                break;
            case 'DELETE':
                $client->setParameterGet($params);
                break;
            default:
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Required HTTP method is not supported.')
                );
        }

        $response = $client->request($method);
        $decodedResponse = json_decode($response->getBody(), true); // Decode as associative array

        if ($response->isError()) {
            $this->handleErrorResponse($response, $decodedResponse);
        }

        return $decodedResponse;
    }

    protected function handleErrorResponse($response, $decodedResponse)
    {
        $status = $response->getStatus();
        $message = isset($decodedResponse['error']['message']) 
            ? $decodedResponse['error']['message'] 
            : __('Unspecified OAuth error occurred.');

        throw new \Magento\Framework\Exception\LocalizedException(
            sprintf(__('HTTP error %d occurred: %s'), $status, $message)
        );
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    public function setAccessToken(\StdClass $token)
    {
        $this->token = $token;
    }

    public function createAuthUrl()
    {
        return self::OAUTH2_AUTH_URI . '?' . http_build_query([
            'client_id' => $this->getClientId(),
            'redirect_uri' => $this->getRedirectUri(),
            'state' => $this->getState(),
            'scope' => implode(',', $this->getScope())
        ]);
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function api($endpoint, $method = 'GET', $params = [])
    {
        if (empty($this->token)) {
            $this->fetchAccessToken();
        }

        $url = self::OAUTH2_SERVICE_URI . $endpoint;

        $params = array_merge([
            'access_token' => $this->token->access_token
        ], $params);

        return $this->_httpRequest($url, strtoupper($method), $params);
    }
}
