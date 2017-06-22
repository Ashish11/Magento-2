<?php
/*
 * Created By: Ashish Ranade On : Jun 14, 2017 11:26:36 AM
 * Project: magento2-develop
 * File: Delete.php
 */
namespace Ashish\Manageslider\Controller\Adminhtml\Slider;

/**
 * Class Delete
 */
class Delete
        extends \Ashish\Manageslider\Controller\Adminhtml\Slider
{

    /**
     * Delete Slider
     * @return \Magento\Backend\Model\View\Result\RedirectFactory
     */
    public function execute()
    {
        $resultRedirect = $this->_resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('slider_id');
        if ($id) {
            try {
                $slider = $this->_sliderFactory->create();
                $slider->load($id);
                $name = $slider->getName();
                $slider->delete();

                $this->messageManager->addSuccess(__('The ' . $name . ' has been deleted.'));
                $resultRedirect->setPath('manageslider/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('manageslider/*/edit',
                        ['slider_id' => $id]);
                return $resultRedirect;
            }
        }

        $this->messageManager->addError(__('Slider to delete was not found.'));
        // go to grid
        $resultRedirect->setPath('manageslider/*/');
        return $resultRedirect;
    }

}