<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace SRTechnologies\TransactionalSMS\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class OrderinvoiceSms implements ObserverInterface
{
    const XML_URL_MULTISELCT_VALUES = 'sms/smsgeneral/vendor_multiselect';
    const XML_ORDER_INVOICE_MESSAGE_VALUES = 'sms/smsgeneral/order_invoice_template';
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

         $invoice = $observer->getEvent()->getInvoice();
         $orderdata = $invoice->getOrder();
         $Orderinvoicesms = $this->getConfigValue(self::XML_URL_MULTISELCT_VALUES);
         $orderinvoicecondition =  $Orderinvoicesms['Order_invoice_Sms'];
        if ($orderinvoicecondition) {
        // Message details
            $mess = ltrim($invoice->getIncrementId(), "0");
            $messages = $this->getConfigValue(self::XML_ORDER_INVOICE_MESSAGE_VALUES);
            $messss = str_replace("{{order_id}}", $mess, $messages);
            $message = rawurlencode($messages);
            $numbers = [$orderdata->getCustomerTelephone()];

         // Send the POST request with cURL
            $data->sendRequest($message, $numbers, 'Order_invoice_Sms');
        }
    }
}
