<?php

namespace MyFirstModule\Mymodule\Model;

/**
 * Used classed
 */

use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\Cache\Frontend\Decorator\TagScope;

/**
 * Cache Type class
 * @author Ashish
 *
 */
class CacheType extends TagScope
{

    /**
     * Cache type code unique among all cache types
     */
    const TYPE_IDENTIFIER = 'mymodule_custom_cache';

    /**
     * The tag name that limits the cache cleaning scope within a particular tag
     */
    const CACHE_TAG = 'MYMODULE_CUSTOM_CACHE';

    /**
     * Construct
     *
     * @param FrontendPool $frontend
     */
    public function __construct(FrontendPool $frontend)
    {
        parent::__construct($frontend->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
    }
}

