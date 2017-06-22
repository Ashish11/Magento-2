<?php
/*
 * Created By: Ashish Ranade On : Jun 6, 2017 2:09:45 PM
 * Project: magento2-develop
 * File: DataProvider.php
 */
namespace Ashish\Manageslider\Model;

/**
 * Class DataProvider
 */
class DataProvider
        extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * image directory
     * @var string
     */
    protected $_subDir = 'ashish/manageslider/slider/image/';

    /**
     * return slider data
     * @var array
     */
    protected $_loadedData;

    /**
     * registry
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * storage manager
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * get resource
     * @var \Ashish\Manageslider\Controller\Adminhtml\Slider
     */
    protected $_action;

    /**
     * 
     * @param $name
     * @param $primaryFieldName
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param $requestFieldName
     * @param Registry $coreRegistry
     * @param Slider $slider
     * @param CollectionFactory $sliderCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
    $name, $primaryFieldName, $requestFieldName,
            \Magento\Store\Model\StoreManagerInterface $storeManager,
            \Magento\Framework\Registry $coreRegistry,
            \Ashish\Manageslider\Controller\Adminhtml\Slider $slider,
            \Ashish\Manageslider\Model\ResourceModel\Slider\CollectionFactory $sliderCollectionFactory,
            array $meta = [], array $data = []
    )
    {
        $this->collection = $sliderCollectionFactory->create();
        $this->_coreRegistry = $coreRegistry;
        $this->_action = $slider;
        $this->_storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta,
                $data);
    }

    /**
     * get slider data
     * @return array
     */
    public function getData()
    {
        $id = $this->_action->getRequest()->getParam('slider_id');
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $sliders = $this->collection->getItems();

        foreach ($sliders as $slider) {
            $this->_loadedData[$slider->getId()] = $slider->getData();
        }

        if (!is_null($id)) {
            $imageName = $this->_loadedData[$id]['slider_image'];
            $imageUrl = $this->getImageUrl($imageName);
            unset($this->_loadedData[$id]['slider_image']);

            $this->_loadedData[$id]['slider_image'][0]['name'] = $imageName;
            $this->_loadedData[$id]['slider_image'][0]['url'] = $imageUrl;
        }

        return $this->_loadedData;
    }

    /**
     * Get Image URL
     * @param $imageName
     * @return string
     */
    private function getImageUrl($imageName)
    {
        $mediaUrl = $this->_storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $imageUrl = $mediaUrl . $this->_subDir . $imageName;

        return $imageUrl;
    }

}