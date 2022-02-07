<?php

namespace SRTechnologies\Shipping\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;
use Magento\Checkout\Model\Session;

class Express extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'express';

    /**
     * @var \Magento\Shipping\Model\Rate\ResultFactory
     */
    protected $rateResultFactory;

    /**
     * @var \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory
     */
    protected $rateMethodFactory;

    protected $scopeConfig;
    protected $logger;
    protected $session;
    const XML_STORE_PICKUP_DELIEVERY_ZIPCODE = 'general/store_information/postcode';
    const XML_SHIP_LOGIN_POST_URL_API_CURRIOR = 'sms/smsgeneral/shiploginposturlapicurrior';
    const XML_SHIP_GET_URL_API_CURRIOR = 'sms/smsgeneral/shipgeturlapicurrior';
    const XML_SHIP_API_LOGIN_CURRIOR_EMAIL = 'sms/smsgeneral/shipapilogincurrioremail';
    const XML_SHIP_API_LOGIN_CURRIOR_PASSWORD = 'sms/smsgeneral/shipapilogincurriorpassword';

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param array $data
     */
     public function __construct(
        Session $session,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        $this->rateResultFactory = $rateResultFactory;
        $this->rateMethodFactory = $rateMethodFactory;
        $this->session = $session;
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
       
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }



    public function getGeneralConfig($field)
    {
        return $this->scopeConfig->getValue($field);
    }

    /**
     * @return array
     */
    public function getAllowedMethods()
    {
        return ['express' => $this->getConfigData('name')];
    }
    
    /**
     * @param RateRequest $request
     * @return bool|Result
     */
    public function collectRates(RateRequest $request)       
         
    {
         // $this->getRate('123');
         
         $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
         $logger = new \Zend\Log\Logger();
         $logger->addWriter($writer);
         $logger->info('Your text message');
         // $logger = \Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class);
         // $logger->info('message');
        
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->rateResultFactory->create();

        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $method = $this->rateMethodFactory->create();

        $method->setCarrier('express');
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod('express');
        $method->setMethodTitle($this->getConfigData('name'));
        
        //
        $amount = $this->getConfigData('price');

        $method->setPrice($amount);
        $method->setCost($amount);

        $result->append($method);

        return $result;


    }

 
// function login get token here


    public function getLogin($tokens){
        // fetch login post url here
        // $postlogincurriorapiurl = $this->getConfigValue(self::XML_SHIP_LOGIN_POST_URL_API_CURRIOR);
        // //fetch email and password
        // $logincurriorapiemail = $this->getConfigValue(self::XML_SHIP_API_LOGIN_CURRIOR_EMAIL);
        // $logincurriorapipassword = $this->getConfigValue(self::XML_SHIP_API_LOGIN_CURRIOR_PASSWORD);

        // $data_array = array($logincurriorapiemail, $logincurriorapipassword);
        // $data = http_build_query($data_array);

        // //and curl login functionality
        // $ch = curl_init($postlogincurriorapiurl);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $response = curl_exec($ch);
        // curl_close($ch);
    
        // // Process your response here
        // $resultabc = $response;
        // //get token here
        // return $tokens = $resultabc->token;
        

        
        // retuen token and call this token in getRate as parameter
    }


//function getrate title method

   private function getRate($tokens){

           // echo "shubham ";
           // exit;
          //get here all parameters like weight, length, breadth, height, cod->product, shiping delivery zip code  id from collectRates()

        // product dimension cart id cartid or Quoteid  and load it here getData lenth width  ship customer zip code and pass it in getRate

        // $getproductfromcart = $this->session->getQuote()->getAllVisibleItems();
         
        // $ProductID = $getproductfromcart->getProductId();
        // $Product = $getproductfromcart->getProduct();
        // $cartProductqty = $getproductfromcart->getProductQty();
        // $deliveryaddresszipcode = $getproductfromcart->getShippingAddress()->getPostcode();

        // $ProductFull = $Product->load($ProductID);  
                                                   
        // $productweight = $ProductFull->getWeight();
        // $productlength = $ProductFull->getLength();
        // $productbreadth = $ProductFull->getBreadth();
        // $productheight = $ProductFull->getHeight();

        // $productprice = $ProductFull->getPrice();
         
        //  // echo "<pre>";
        //  // print_r($cartid);
        //  // exit;

        // // product1 = qty1 currior cost =14
        // // product2 = qty2 currior cost = 10*2=20
        //  $productcost =$cartProductqty * $productprice;
         //20 +14 and then pass it in price



          // and take all parameters over here that get over here from collectRates()
          // and pass it in array

          
          //getapi all curl functionality come over here
        //and get the data from this get api fetch the courier_name and freight_charge from the object of curl execute

      //set the data in setCarrier() -> set the title , and  then setMethod()-> courier_name , and then setPrice and return all parameter through array
     // and do other functionailty over here shipping in UI 

    //and then call this function in collectRates()
        

    }


      
}