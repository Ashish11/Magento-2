<?php
/*
 * Created By: Ashish Ranade On : Jun 15, 2017 1:10:22 PM
 * Project: magento2-develop
 * File: MassDelete.php
 */
namespace Ashish\Manageslider\Controller\Adminhtml\Slider;

/**
 * Class MassDelete
 */
class MassEnable
        extends \Magento\Backend\App\Action
{
    /**
     * Mass Action Filter
     * 
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $_filter;

    /**
     * Collection Factory
     * 
     * @var \Mageplaza\HelloWorld\Model\ResourceModel\Post\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * constructor
     * 
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Mageplaza\HelloWorld\Model\ResourceModel\Post\CollectionFactory $collectionFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
    \Magento\Ui\Component\MassAction\Filter $filter,
            \Ashish\Manageslider\Model\ResourceModel\Slider\CollectionFactory $collectionFactory,
            \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * 
     */
    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());

        $disable = 0;
        foreach ($collection as $item) {
            $item->setStatus(1);
            $item->save();
            $disable++;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been updated.',
                        $disable));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }

}