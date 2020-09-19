<?php
/*
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * File : Ashish\AdminSso\Helper - Data.php
 * User : ashish
 * Created at : 15/09/20 - 1:14 PM
 * Project : magento
 */

namespace Ashish\AdminSso\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Backend\Model\Session\AdminConfig;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Security\Model\AdminSessionsManager;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Setup\Exception;
use Magento\Framework\Encryption\EncryptorInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var CookieManagerInterface
     */
    private $cookieManager;

    /**
     * @var AdminConfig
     */
    private $sessionConfig;

    /**
     * @var CookieMetadataFactory
     */
    private $cookieMetadata;

    /**
     * @var AdminSessionsManager
     */
    private $adminSessionsManager;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var DeploymentConfig
     */
    private $deploymentConfig;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var $scopeConfig
     */
    protected $scopeConfig;

    /**
     * @var encryptor
     */
    protected $encryptor;

    /**
     * check module is enable or not
     */
    const IS_ENABLE = 'adminsso/general/enable';

    /**
     * Get decryption key
     */
    const DECRYPT_KEY = 'adminsso/general/decryption_key';

    /**
     * Get decryption IV value
     */
    const DECRYPT_IV = 'adminsso/general/decryption_iv';

    /**
     * Get decryption method
     */
    const DECRYPT_METHOD = 'adminsso/general/ciphering';

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param CookieManagerInterface $cookieManager
     * @param AdminConfig $sessionConfig
     * @param CookieMetadataFactory $cookieMetadata
     * @param AdminSessionsManager $adminSessionsManager
     * @param UrlInterface $url
     * @param DeploymentConfig $deploymentConfig
     * @param RequestInterface $request
     * @param ScopeConfigInterface $scopeConfig
     * @param EncryptorInterface $encryptor
     */
    public function __construct(Context $context,
                                CookieManagerInterface $cookieManager,
                                AdminConfig $sessionConfig,
                                CookieMetadataFactory $cookieMetadata,
                                AdminSessionsManager $adminSessionsManager,
                                UrlInterface $url,
                                DeploymentConfig $deploymentConfig,
                                RequestInterface $request,
                                ScopeConfigInterface $scopeConfig,
                                EncryptorInterface $encryptor)
    {
        parent::__construct($context);
        $this->cookieManager = $cookieManager;
        $this->sessionConfig = $sessionConfig;
        $this->cookieMetadata = $cookieMetadata;
        $this->adminSessionsManager = $adminSessionsManager;
        $this->url = $url;
        $this->deploymentConfig = $deploymentConfig;
        $this->request = $request;
        $this->scopeConfig = $scopeConfig;
        $this->encryptor = $encryptor;
    }

    /**
     * Option value
     */
    const OPTION = 0;

    /**
     * Decrypt string
     *
     * @param $string
     * @return false|string
     */
    public function decrypt($string)
    {
        $decryptionIv = $this->encryptor->decrypt(
            $this->getConfigValue(self::DECRYPT_IV));
        $decryptionKey = $this->encryptor->decrypt(
            $this->getConfigValue(self::DECRYPT_KEY));
        $ciphering = $this->getConfigValue(self::DECRYPT_METHOD);

        return openssl_decrypt($string, $ciphering,
            $decryptionKey, self::OPTION, $decryptionIv);
    }

    /**
     * Set admin cookies
     *
     * @param \Magento\Backend\Model\Auth\Session $session
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Stdlib\Cookie\CookieSizeLimitReachedException
     * @throws \Magento\Framework\Stdlib\Cookie\FailureToSendException
     */
    public function setCookies(\Magento\Backend\Model\Auth\Session $session)
    {
        if ($session->isLoggedIn()) {
            $cookie = $session->getSessionId();
            if ($cookie) {
                $cookiePath = $this->sessionConfig->getCookiePath();
                $metadata = $this->cookieMetadata
                    ->createPublicCookieMetadata()
                    ->setDuration(3600)
                    ->setPath($cookiePath)
                    ->setDomain($this->sessionConfig->getCookieDomain())
                    ->setSecure($this->sessionConfig->getCookieSecure())
                    ->setHttpOnly($this->sessionConfig->getCookieHttpOnly());
                $this->cookieManager->setPublicCookie($session->getName(), $cookie, $metadata);
                $this->adminSessionsManager->processLogin();
            }
        }
    }

    /**
     * Get admin URL
     *
     * @return string
     */
    public function getAdminUrl()
    {
        $url = $this->url->getUrl()
            . $this->deploymentConfig->get('backend/frontName')
            . '/admin/dashboard/';
        return $url;
    }

    /**
     * clear session cookie data
     */
    public function clearSsoCookie()
    {
        try {
            $serverCookies = $this->request->getServer('HTTP_COOKIE');
            if (isset($serverCookies)) {
                $cookies = explode(';', $serverCookies);
                foreach ($cookies as $cookie) {
                    $parts = explode('=', $cookie);
                    $name = trim($parts[0]);
                    setcookie($name, '', time() - 1000);
                    setcookie($name, '', time() - 1000, '/');
                }
            }
            $this->cookieManager->deleteCookie('admin');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

    }

    /**
     * Get store config value
     *
     * @param $path
     * @return mixed
     */
    public function getConfigValue($path)
    {
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
