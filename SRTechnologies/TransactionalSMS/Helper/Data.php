<?php

namespace SRTechnologies\TransactionalSMS\Helper;

use Magento\Framework\HTTP\Client\Curl;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    const XML_API_VALUES = 'sms/smsgeneral/apikey';
    const XML_SENDERNAME_VALUES = 'sms/smsgeneral/sendername';
    const XML_ADMIN_ORDER_MESSAGE_VALUES = 'sms/smsgeneral/admin_order_message_template';
    const XML_ADMIN_ORDER_INVOICE_MESSAGE_VALUES = 'sms/smsgeneral/admin_order_invoice_template';
    const XML_ADMIN_CUSTOMER_REGISTRATION_MESSAGE_VALUES = 'sms/smsgeneral/admin_customer_registration_template';
    const XML_URL_VALUES = 'sms/smsgeneral/url';
    const XML_URL_ADMIN_NUM_VALUES = 'sms/smsgeneral/adminnumber';
    protected $scopeConfig;
    protected $_curl;
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        Curl $curl,
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->curl = $curl;
    }

    public function getConfigValue($path)
    {
           //fetch config value using $path
           // return store config value
           return $this->scopeConfig->getValue($path);
    }

/**
 * Get order details ( order status, total, items, total invoiced )
 * return Json Param
 **/
    public function sendRequest($message, $numbers, $type = null)
    {
        if (!is_null($type)) {
            switch ($type) {
                case 'Order_place_Sms':
                   // fetch template using $path
                    $this->makeCurl($message, $numbers);

                    $adminorderplacemsge = $this->getConfigValue(self::XML_ADMIN_ORDER_MESSAGE_VALUES);
                    $adminorderplacenumber = $this->getConfigValue(self::XML_URL_ADMIN_NUM_VALUES);
                    $this->makeCurl($adminorderplacemsge, $adminorderplacenumber);
                    //send admin()
                    // Send curl request using make curl function()
                    break;
        
                case 'Customer_register_Sms':
                    $this->makeCurl($message, $numbers);
        
                    $admincustomerregmsge = $this->getConfigValue(self::XML_ADMIN_CUSTOMER_REGISTRATION_MESSAGE_VALUES);
                    $admincustregnumber = $this->getConfigValue(self::XML_URL_ADMIN_NUM_VALUES);
                    $this->makeCurl($admincustomerregmsge, $admincustregnumber);
                    break;

                case 'Order_invoice_Sms':
                    $this->makeCurl($message, $numbers);

                    $adminorderinvoicemsge = $this->getConfigValue(self::XML_ADMIN_ORDER_INVOICE_MESSAGE_VALUES);
                    $adminorderinvoicenumber = $this->getConfigValue(self::XML_URL_ADMIN_NUM_VALUES);
                    $this->makeCurl($adminorderinvoicemsge, $adminorderinvoicenumber);
                    break;
            }
        }
    }
    public function makeCurl($message, $numbers)
    {

        $apiKey = urlencode($this->getConfigValue(self::XML_API_VALUES));
        $url = $this->getConfigValue(self::XML_URL_VALUES);
        // Message details
        
        $sender = urlencode($this->getConfigValue(self::XML_SENDERNAME_VALUES));
 
        $numbers = implode(',', $numbers);
 
         // Prepare data for POST request
        $data = ['apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message];
        // Send the POST request with cURL
    //if the method is post
        $this->_curl->post($url, $data);
        //response will contain the output in form of JSON string
        $response = $this->_curl->getBody();
    }
}
