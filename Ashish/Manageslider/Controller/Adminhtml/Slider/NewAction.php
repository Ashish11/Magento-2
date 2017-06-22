<?php
/*
 * Created By: Ashish Ranade On : Jun 9, 2017 3:55:09 PM
 * Project: magento2-develop
 * File: NewAction.php
 */
namespace Ashish\Manageslider\Controller\Adminhtml\Slider;

/**
 * Class NewAction
 */
class NewAction
        extends \Magento\Backend\App\Action
{
    /**
     * result factory object
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $_resultForwardFactory;

    /**
     * Constructor
     * @param Context $context
     * @param ForwardFactory $forwardFactory
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context,
            \Magento\Backend\Model\View\Result\ForwardFactory $forwardFactory)
    {
        $this->_resultForwardFactory = $forwardFactory;
        parent::__construct($context);
    }

    /**
     * forward action to edit
     */
    public function execute()
    {
        $this->_forward('edit', 'slider', 'manageslider');
    }

    /**
     * check if allow for admin
     * @return type
     */
    protected function _isAllowed()
    {
        return $this->_authorization
                        ->isAllowed('Ashish_Manageslider::manage_slider');
    }

}