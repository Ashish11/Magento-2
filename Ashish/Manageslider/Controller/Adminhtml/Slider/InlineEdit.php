<?php
/*
 * Created By: Ashish Ranade On : Jun 15, 2017 2:40:37 PM
 * Project: magento2-develop
 * File: InlineEdit.php
 */
namespace Ashish\Manageslider\Controller\Adminhtml\Slider;

/**
 * Class InlineEdit
 */
class InlineEdit
        extends \Magento\Backend\App\Action
{
    /**
     * JSON Factory
     * 
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_jsonFactory;

    /**
     * Slider Factory
     * 
     * @var \Ashish\Manageslider\Model\SliderFactory
     */
    protected $_sliderFactory;

    /**
     * constructor
     * 
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Ashish\Manageslider\Model\SliderFactory $sliderFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
    \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
            \Ashish\Manageslider\Model\SliderFactory $sliderFactory,
            \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_jsonFactory = $jsonFactory;
        $this->_sliderFactory = $sliderFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->_jsonFactory->create();
        $error = false;
        $messages = [];
        $sliderItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($sliderItems))) {
            return $resultJson->setData([
                        'messages' => [__('Please correct the data sent.')],
                        'error' => true,
            ]);
        }
        foreach (array_keys($sliderItems) as $sliderId) {
            /** @var \Ashish\Manageslider\Model\Slider $slider */
            $slider = $this->_sliderFactory->create()->load($sliderId);
            try {
                $sliderData = $sliderItems[$sliderId]; //todo: handle dates
                $slider->addData($sliderData);
                $slider->save();
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithSliderId($slider,
                        $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithSliderId($slider,
                        $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithSliderId(
                        $slider,
                        __('Something went wrong while saving the Slider.')
                );
                $error = true;
            }
        }
        return $resultJson->setData([
                    'messages' => $messages,
                    'error' => $error
        ]);
    }

    /**
     * Add Slider id to error message
     *
     * @param \Ashish\Manageslider\Model\Slider $slider
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithSliderId(\Ashish\Manageslider\Model\Slider $slider,
            $errorText)
    {
        return '[Slider ID: ' . $slider->getId() . '] ' . $errorText;
    }

}