<?php

/**
 * Module namespace
 */
namespace MyFirstModule\Mymodule\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use MyFirstModule\Mymodule\Model\MymoduleStorage;

/**
 * Index block
 *
 * @author Ashish
 *        
 */
class Index extends Template
{

    /**
     * My Cache storage class
     *
     * @var mixed
     */
    private $_mymoduleStorage;

    /**
     * Construct
     *
     * @param Context $context
     * @param MymoduleStorage $mymoduleStorage
     */
    public function __construct(Context $context, MymoduleStorage $mymoduleStorage)
    {
        $this->_mymoduleStorage = $mymoduleStorage;
        parent::__construct($context);
    }

    /**
     * Sample function
     */
    public function getMyName()
    {
        if ($this->getMyModuleStorage()->isExists(MymoduleStorage::CACHE_TAG)) {
            return $this->getMyModuleStorage()->load(MymoduleStorage::CACHE_TAG);
        } else {
            $name = 'Welcome To ASolutions!';
            $this->setMyName($name);
            return $this->getMyModuleStorage()->load(MymoduleStorage::CACHE_TAG);
        }
    }

    /**
     * Set Value for Cache
     */
    public function setMyName($name)
    {
        $this->getMyModuleStorage()->add(MymoduleStorage::CACHE_ID, $name);
    }

    /**
     * Get Storage Class
     *
     * @return mixed|\MyFirstModule\Mymodule\Model\MymoduleStorage
     */
    private function getMyModuleStorage()
    {
        return $this->_mymoduleStorage;
    }
}

