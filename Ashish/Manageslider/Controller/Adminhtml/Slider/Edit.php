<?php
/*
 * Created By: Ashish Ranade On : Jun 8, 2017 11:30:10 AM
 * Project: magento2-develop
 * File: Edit.php
 */
namespace Ashish\Manageslider\Controller\Adminhtml\Slider;

/**
 * Class Edit
 */
class Edit
        extends \Ashish\Manageslider\Controller\Adminhtml\Slider
{
    /**
     *
     * @var type \Magento\Backend\Model\Session
     */
    protected $_backendSession;

    /**
     *
     * @var type \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     *
     * @var type \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * Constructor
     * @param Session $backendSession
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     * @param SliderFactory $sliderFactory
     * @param Registry $registry
     * @param RedirectFactory $resultRedirectFactory
     * @param Context $context
     */
    public function __construct(
    \Magento\Backend\Model\Session $backendSession,
            \Magento\Framework\View\Result\PageFactory $resultPageFactory,
            \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
            \Ashish\Manageslider\Model\SliderFactory $sliderFactory,
            \Magento\Framework\Registry $registry,
            \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
            \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_backendSession = $backendSession;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($sliderFactory, $registry, $resultRedirectFactory,
                $context);
    }

    /**
     * Edit action
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('slider_id');

        $slider = $this->_initSlider();

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Ashish_Manageslider::manage_slider');
        $resultPage->getConfig()->getTitle()->set(__('Sliders'));

        if ($id) {
            $slider->load($id);
            if (!$slider->getId()) {
                $this->messageManager->addError(__('This Slider no longer exists.'));
                $resultRedirect = $this->_resultRedirectFactory->create();
                $resultRedirect->setPath(
                        'manageslider/*/edit',
                        [
                    'slider_id' => $slider->getId(),
                    '_current' => true
                        ]
                );
                return $resultRedirect;
            }

            $this->_coreRegistry->register('manage_slider', $slider->getData());
        }
        $title = $slider->getId() ? $slider->getName() : __('New Slider');
        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }

}