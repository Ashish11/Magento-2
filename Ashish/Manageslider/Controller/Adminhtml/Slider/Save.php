<?php
/*
 * Created By: Ashish Ranade On : Jun 9, 2017 3:55:09 PM
 * Project: magento2-develop
 * File: Save.php
 */
namespace Ashish\Manageslider\Controller\Adminhtml\Slider;

/**
 * Class Save
 */
class Save
        extends \Ashish\Manageslider\Controller\Adminhtml\Slider
{
    /**
     * upload model
     * @var \Ashish\Manageslider\Model\Upload
     */
    protected $_uploadModel;

    /**
     * image model
     * @var \Ashish\Manageslider\Model\Slider\ImageModel
     */
    protected $_imageModel;

    /**
     * session variable
     * @var \Magento\Backend\Model\Session
     */
    protected $_backendSession;

    /**
     * slider object
     * @var \Ashish\Manageslider\Model\SliderFactory
     */
    protected $_sliderFactory;

    /**
     * constructor
     * @param Upload $uploadModel
     * @param ImageModel $imageModel
     * @param Session $backendSession
     * @param SliderFactory $sliderFactory
     * @param Registry $registry
     * @param RedirectFactory $resultRedirectFactory
     * @param Context $context
     */
    public function __construct(
    \Ashish\Manageslider\Model\Upload $uploadModel,
            \Ashish\Manageslider\Model\Slider\ImageModel $imageModel,
            \Magento\Backend\Model\Session $backendSession,
            \Ashish\Manageslider\Model\SliderFactory $sliderFactory,
            \Magento\Framework\Registry $registry,
            \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
            \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_sliderFactory = $sliderFactory;
        $this->_uploadModel = $uploadModel;
        $this->_imageModel = $imageModel;
        $this->_backendSession = $backendSession;
        parent::__construct($sliderFactory, $registry, $resultRedirectFactory,
                $context
        );
    }

    /**
     * Save action
     * @return \Magento\Backend\Model\View\Result\RedirectFactory
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $slider = $this->_initSlider();
            $sliderData = $this->getSliderData($data);
            $slider->setData($sliderData);

            try {
                $slider->save();
                $this->messageManager->addSuccess(__('The Slider has been saved.'));
                $this->_backendSession->setManageslider(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                            'manageslider/*/edit',
                            [
                        'slider_id' => $slider->getId(),
                        '_current' => true
                            ]
                    );

                    return $resultRedirect;
                }
                $resultRedirect->setPath('manageslider/*/');

                return $resultRedirect;
            } catch (\Exception $e) {
                $this->messageManager->addException($e,
                        __('Something went wrong while saving the Slider.')
                );
            }
            $this->_getSession()->setManageslider($data);
            $resultRedirect->setPath(
                    'manageslider/*/edit',
                    [
                'slider_id' => $slider->getId(),
                '_current' => true
                    ]
            );

            return $resultRedirect;
        }
        $resultRedirect->setPath('manageslider/*/');

        return $resultRedirect;
    }

    /**
     * set post data to save
     * @param $data
     * @return array
     */
    private function getSliderData($data)
    {
        $newData = array();

        if (empty($data['slider_id'])) {
            $data['slider_id'] = null;
        }

        $newData['slider_id'] = $data['slider_id'];
        $newData['name'] = $data['name'];
        $newData['url_key'] = $data['url_key'];
        $newData['status'] = $data['status'];
        $newData['banner_text'] = $data['banner_text'];

        if (isset($data['slider_image'][0]['name']) && !empty($data['slider_image'][0]['name'])) {
            $newData['slider_image'] = $data['slider_image'][0]['name'];
        }

        return $newData;
    }

}