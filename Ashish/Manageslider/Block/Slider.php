<?php
/*
 * Created By: Ashish Ranade On : Jun 15, 2017 5:57:51 PM
 * Project: magento2-develop
 * File: Slider.php
 */
namespace Ashish\Manageslider\Block;

/**
 * Class Slider
 */
class Slider
        extends \Magento\Framework\View\Element\Template
{
    /**
     *
     * @var type 
     */
    protected $_layoutProcessors;

    /**
     *
     * @var type \Ashish\Manageslider\Model\SliderFactory
     */
    protected $_sliderFactory;

    /**
     * 
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $layoutProcessors
     * @param array $data
     */
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
            \Ashish\Manageslider\Model\SliderFactory $sliderFactory,
            array $layoutProcessors = [], array $data = [])
    {
        parent::__construct($context);
        $this->_sliderFactory = $sliderFactory;
        $this->_layoutProcessors = $layoutProcessors;
    }

    /**
     * Get Slider List
     * @return type
     */
    public function getSliders()
    {
        $slider = $this->_sliderFactory->create();
        $slides = $slider->getSliders();
        return $slides;
    }

}