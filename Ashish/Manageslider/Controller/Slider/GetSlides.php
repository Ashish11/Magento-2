<?php
/*
 * Created By: Ashish Ranade On : Jun 15, 2017 4:49:14 PM
 * Project: magento2-develop
 * File: GetSlides.php
 */
namespace Ashish\Manageslider\Controller\Slider;

/**
 * Class GetSlides
 */
class GetSlides
        extends \Magento\Framework\App\Action\Action
{
    /**
     *
     * @var type \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     *
     * @var type \Ashish\Manageslider\Model\SliderFactory
     */
    protected $_sliderFactory;

    /**
     *
     * @var type \Magento\Framework\Controller\ResultFactory
     */
    protected $_resultFactory;

    /**
     * Constructor
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \Ashish\Manageslider\Model\SliderFactory $sliderFactory
     * @return type
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $pageFactory,
            \Ashish\Manageslider\Model\SliderFactory $sliderFactory,
            \Magento\Framework\Controller\ResultFactory $resultFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_sliderFactory = $sliderFactory;
        $this->_resultFactory = $resultFactory;
        return parent::__construct($context);
    }

    /**
     * Displays slider page
     * @return type
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

}