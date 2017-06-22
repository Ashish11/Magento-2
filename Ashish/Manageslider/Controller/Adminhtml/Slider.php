<?php
/*
 * Created By: Ashish Ranade On : Jun 8, 2017 11:32:37 AM
 * Project: magento2-develop
 * File: Slider.php
 */
namespace Ashish\Manageslider\Controller\Adminhtml;

/**
 * Class Slider
 */
abstract class Slider
        extends \Magento\Backend\App\Action
{
    /**
     * slider factory
     * @var type \Ashish\Manageslider\Model\SliderFactory
     */
    protected $_sliderFactory;

    /**
     * code registry
     * @var type \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Redirect factory
     * @var type \Magento\Backend\Model\View\Result\RedirectFactory
     */
    protected $_resultRedirectFactory;

    /**
     * constructor
     * @param SliderFactory $sliderFactory
     * @param Registry $coreRegistry
     * @param RedirectFactory $resultRedirectFactory
     * @param Context $context
     */
    public function __construct(
    \Ashish\Manageslider\Model\SliderFactory $sliderFactory,
            \Magento\Framework\Registry $coreRegistry,
            \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
            \Magento\Backend\App\Action\Context $context)
    {
        $this->_sliderFactory = $sliderFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_resultRedirectFactory = $resultRedirectFactory;

        parent::__construct($context);
    }

    /**
     * Initialize slider class
     * @return type
     */
    protected function _initSlider()
    {
        $sliderId = $this->getRequest()->getParam('slider_id');
        $slider = $this->_sliderFactory->create();
        if ($sliderId) {
            $slider->load($sliderId);
        }
        return $slider;
    }

}