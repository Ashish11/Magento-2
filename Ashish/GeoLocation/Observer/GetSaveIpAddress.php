<?php
/*
 * Created By: Ashish Ranade On : Aug 16, 2017 3:42:56 PM
 * Project: magento2-develop
 * File: Observer.php
 */

/**
 * Description of Observer
 */
namespace Ashish\GeoLocation\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\Client\Curl;

class GetSaveIpAddress
        extends Curl
        implements ObserverInterface
{
    /**
     * Array of local host and white 
     * listed IP addresses 
     * @var array
     */
    protected $_whitelist = array(
        '127.0.0.1',
        '::1'
    );

    /**
     * Host Name
     * @var string
     */
    protected $_host = 'freegeoip.net';

    /**
     * Logger instance
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    /**
     * Variable to set IP address
     * @var string
     */
    protected $_remoteAddress;

    /**
     * Model instance
     * @var array
     */
    protected $_geoLocationModel;

    /**
     * Constructor
     * @param \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress
     * @param \Ashish\GeoLocation\Model\GeoLocation $geoLocation
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(\Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress,
            \Ashish\GeoLocation\Model\GeoLocation $geoLocation,
            \Psr\Log\LoggerInterface $logger)
    {
        $this->_remoteAddress = $remoteAddress;
        $this->_geoLocationModel = $geoLocation;

        $this->_logger = $logger;
    }

    /**
     * Observer on every request
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $remoteAddress = $this->_remoteAddress->getRemoteAddress();
        $visitorsCountry = $this->getCountryByIp($remoteAddress);

        if (!in_array($remoteAddress, $this->_whitelist)) {
            $this->_geoLocationModel->setData('visitors_ip', $remoteAddress);
            $this->_geoLocationModel->setData('visitors_country',
                    $visitorsCountry);
            $this->_geoLocationModel->save();
        }
    }

    /**
     * Get the country name
     * @param type $ip
     * @return string
     */
    public function getCountryByIp($ip)
    {
        try {
            $this->get($this->_host . '/json/' . $ip);
            $data = json_decode($this->getBody());
            return $data->country_name;
        } catch (\Exception $e) {
            $this->_logger->critical($e->getMessage());
        }
    }

}