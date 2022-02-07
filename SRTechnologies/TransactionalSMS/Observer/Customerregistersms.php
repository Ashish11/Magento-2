<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace SRTechnologies\TransactionalSMS\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Customerregistersms implements ObserverInterface
{
    const XML_URL_MULTISELCT_VALUES = 'sms/smsgeneral/vendor_multiselect';
    const XML_CUSTOMER_REGISTRATION_MESSAGE_VALUES = 'sms/smsgeneral/customer_registration_template';
    protected $scopeConfig;
    
    /**
     * @var \Magento\Framework\HTTP\Client\Curl
     */
    protected $_curl;
    protected $data;

    public function __construct(
        \SRTechnologies\TransactionalSMS\Helper\Data $data,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->_curl = $curl;
        $this->data = $data;
    }
    public function getConfigValue($path)
    {
        //fetch config value using $path
        // return store config value
        return $this->scopeConfig->getValue($path);
    }

    public function execute(Observer $observer)
    {

         $customer = $observer->getEvent()->getCustomer();
         $Orderregistrationsms = $this->getConfigValue(self::XML_URL_MULTISELCT_VALUES);
         $orderregistrationcondition =  $Orderregistrationsms['Customer_register_Sms'];

        if ($orderregistrationcondition) {
        // Message details
            $mess = ltrim($customer->getId(), "0");
            $messages = $this->getConfigValue(self::XML_CUSTOMER_REGISTRATION_MESSAGE_VALUES);
            $messss = str_replace("{{order_id}}", $mess, $messages);
            $message = rawurlencode($messages);
            $numbers = [$customer->getTelephone()];

        // Send the POST request with cURL
            $data->sendRequest($message, $numbers, 'Customer_register_Sms');
        }
    }
}
