<?php
namespace MyFirstModule\Mymodule\Model;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Cache\FrontendInterface;
use Magento\Framework\Serialize\SerializerInterface;

class MymoduleStorage
{

    /**
     * Cache id
     *
     * @var string
     */
    const CACHE_ID = 'mymodule_custom_cache';

    /**
     * Cache tag
     *
     * @var string
     */
    const CACHE_TAG = 'data';

    /**
     *
     * @var FrontendInterface
     */
    private $cache;

    /**
     *
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Constructor.
     *
     * @param FrontendInterface $cache
     * @param SerializerInterface $serializer
     */
    public function __construct(FrontendInterface $cache, SerializerInterface $serializer = null)
    {
        $this->cache = $cache;
        $this->serializer = $serializer ?: ObjectManager::getInstance()->get(SerializerInterface::class);
    }

    /**
     * Save cache value
     *
     * @param string $cacheId
     * @param string $data
     */
    public function add($cacheId, $data)
    {
        $serializedData = $this->serializer->serialize($data);
        $this->cache->save($serializedData, self::CACHE_TAG, [
            self::CACHE_ID
        ]);
    }

    /**
     * Check whether cache exist
     *
     * @param string $cacheId
     * @param string $data
     * @return number|boolean
     */
    public function isExists($cacheId)
    {
        return $this->cache->test($cacheId);
    }

    /**
     * Remove cache
     *
     * @param string $cacheId
     * @param string $data
     */
    public function remove($cacheId, $data)
    {
        $this->cache->remove($this->getCacheKey($cacheId, $data));
    }

    /**
     * Get Cache key
     *
     * @param string $cacheId
     * @param string $data
     * @return string
     */
    private function getCacheKey($cacheId, $data)
    {
        return 'mymodule_cache_type_' . $cacheId . '_' . $data;
    }

    /**
     * Load data from cache
     *
     * @param string $cacheId
     * @param string $data
     * @return string
     */
    public function load($cacheId)
    {
        return $this->cache->load($cacheId);
    }
}