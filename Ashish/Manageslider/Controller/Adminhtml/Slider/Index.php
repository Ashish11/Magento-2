<?php
/*
 * Created By: Ashish Ranade On : Jun 5, 2017 4:42:37 PM
 * Project: magento2-develop
 * File: Index.php
 */
namespace Ashish\Manageslider\Controller\Adminhtml\Slider;

/**
 * Class Index
 */
class Index
        extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Load the page defined in view/adminhtml/layout/manageslider_slider_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ashish_Manageslider::manage_slider');
        $resultPage->addBreadcrumb(__('Manage Slider'), __('Manage Slider'));
        $resultPage->addBreadcrumb(__('Manage Slider'), __('Manage Slider'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Slider'));

        return $resultPage;
    }

    /**
     * 
     * @return \Magento\Framework\AuthorizationInterface
     */
    protected function _isAllowed()
    {
        return $this->_authorization
                        ->isAllowed('Ashish_Manageslider::manage_slider');
    }

}