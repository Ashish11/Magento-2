<?php

/* 
 * Created By: Ashish Ranade On : May 30, 2017 2:04:20 PM
 * Project: magento2-develop
 * File: Featuredproduct.php
 */

namespace Ashish\Featuredproduct\Model;

use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ProductFactory;

class Featuredproduct
{
    protected $_objectManager;
    protected $_productFactory;
    
    public function __construct(ObjectManagerInterface $objectManager, ProductFactory $productFactory)
    {
        $this->_productFactory = $productFactory;
        $this->_objectManager = $objectManager;
    }
    
    public function getFeaturedProducts()
    {
        //$obj = $this->_productFactory->create()->getCollection();
        $productCollection = $this->_objectManager->create('\Magento\Catalog\Model\Product');
        /** Apply filters here */
        $products = $productCollection->getResourceCollection();
        return $products;
    }
}