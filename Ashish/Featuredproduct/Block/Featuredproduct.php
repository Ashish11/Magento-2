<?php

/* 
 * Created By: Ashish Ranade On : May 30, 2017 1:43:00 PM
 * Project: magento2-develop
 * File: Featuredproduct.php
 */

namespace Ashish\Featuredproduct\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Featuredproduct 
    extends Template
{
    protected $layoutProcessors;
    
    public function __construct(Context $context,
        array $layoutProcessors = [],
        array $data = [])
    {
        parent::__construct($context);
        $this->layoutProcessors = $layoutProcessors;
    }

    public function getFeaturedProducts()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $model = $objectManager->create('\Ashish\Featuredproduct\Model\Featuredproduct');
        return $model->getFeaturedProducts();
    }
    
    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }

        return parent::getJsLayout();
    }
}