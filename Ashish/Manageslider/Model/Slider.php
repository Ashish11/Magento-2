<?php
/*
 * Created By: Ashish Ranade On : Jun 7, 2017 7:05:03 PM
 * Project: magento2-develop
 * File: Slider.php
 */
namespace Ashish\Manageslider\Model;

/**
 * Class Slider
 */
class Slider
        extends \Magento\Framework\Model\AbstractModel
{
    /**
     * 
     * @var string
     */
    protected $_subDir = 'ashish/manageslider/slider';

    /**
     * set cache tag value
     */
    const CACHE_TAG = 'ashish_manageslider';

    /**
     * cache tag
     * @var string
     */
    protected $_cacheTag = 'ashish_manageslider';

    /**
     * event prefix
     * @var string
     */
    protected $_eventPrefix = 'ashish_manageslider';

    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init('Ashish\Manageslider\Model\ResourceModel\Slider');
    }

    /**
     * cache value
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * get default value
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

    /**
     * Return slider array
     * @return array
     */
    public function getSliders()
    {
        $collection = $this->getCollection();
        $sliders = array();

        foreach ($collection as $slides) {
            $imageName = $slides->getSliderImage();
            $tmp = array(
                'name' => $slides->getName(),
                'url_key' => $slides->getUrlKey(),
                'banner_text' => $slides->getBannerText(),
                'image' => $this->getImageUrl($imageName)
            );

            array_push($sliders, $tmp);
        }

        return $sliders;
    }

    /**
     * Get Image URL
     * @param $imageName
     * @return type
     */
    private function getImageUrl($imageName)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $mediaDir = $objectManager->get('Magento\Store\Model\StoreManagerInterface')
                ->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        return $mediaDir . $this->_subDir . '/image/' . $imageName;
    }

}