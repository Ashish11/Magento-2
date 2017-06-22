<?php
/*
 * Created By: Ashish Ranade On : May 30, 2017 2:04:20 PM
 * Project: magento2-develop
 * File: Featuredproduct.php
 */
namespace Ashish\Featuredproduct\Model;

/**
 * Class Featured Product
 */
class Featuredproduct
{
    /**
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * Product factory object
     * @var type \Magento\Catalog\Model\ProductFactory
     */
    protected $_productFactory;

    /**
     * Constructor
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager,
            \Magento\Catalog\Model\ProductFactory $productFactory)
    {
        $this->_productFactory = $productFactory;
        $this->_objectManager = $objectManager;
    }

    /**
     * Return featured products
     * @return array
     */
    public function getFeaturedProducts()
    {
        $productCollection = $this->_objectManager->create('\Magento\Catalog\Model\Product');
        /** Apply filters here */
        $products = $productCollection->getResourceCollection();
        return $products;
    }

}