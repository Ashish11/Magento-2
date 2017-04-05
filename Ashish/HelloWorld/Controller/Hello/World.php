<?php

namespace Ashish\HelloWorld\Controller\Hello;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class World 
    extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory) 
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    
    public function execute()
    {
        $pageObject = $this->_pageFactory->create();
        return $pageObject;
    }

}
