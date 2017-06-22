<?php
/*
 * Created By: Ashish Ranade On : Jun 9, 2017 3:55:09 PM
 * Project: magento2-develop
 * File: uploader.php
 */
namespace Ashish\Manageslider\Controller\Adminhtml\Slider\Image;

/**
 * Class Upload
 */
class Upload
        extends \Magento\Backend\App\Action
{
    /**
     * Image model
     *
     * @var \Ashish\Manageslider\Model\Slider\ImageModel
     */
    protected $_imageUploader;

    /**
     * Upload constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Catalog\Model\ImageUploader $imageUploader
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context,
            \Ashish\Manageslider\Model\Slider\ImageModel $imageUploader
    )
    {
        parent::__construct($context);
        $this->_imageUploader = $imageUploader;
    }

    /**
     * Check admin permissions for this controller
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ashish_Manageslider::manage_slider');
    }

    /**
     * Upload file controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $imageId = $this->_request->getParam('param_name', 'slider_image');

        try {
            $result = $this->_imageUploader->saveFileToTmpDir($imageId);
            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }

        return $this->resultFactory->create(
                                \Magento\Framework\Controller\ResultFactory::TYPE_JSON)
                        ->setData($result);
    }

}