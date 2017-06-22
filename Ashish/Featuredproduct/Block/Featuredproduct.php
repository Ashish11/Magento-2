<?php
/*
 * Created By: Ashish Ranade On : May 30, 2017 1:43:00 PM
 * Project: magento2-develop
 * File: Featuredproduct.php
 */
namespace Ashish\Featuredproduct\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Featured Product
 */
class Featuredproduct
        extends Template
{
    /**
     *
     * @var type array
     */
    protected $layoutProcessors;

    /**
     * Constructor
     * @param Context $context
     * @param array $layoutProcessors
     * @param array $data
     */
    public function __construct(Context $context, array $layoutProcessors = [],
            array $data = [])
    {
        parent::__construct($context);
        $this->layoutProcessors = $layoutProcessors;
    }

    /**
     * return featured products
     * @return array
     */
    public function getFeaturedProducts()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $model = $objectManager->create('\Ashish\Featuredproduct\Model\Featuredproduct');
        return $model->getFeaturedProducts();
    }

    /**
     * return JSON layout data
     * @return string
     */
    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }

        return parent::getJsLayout();
    }

}