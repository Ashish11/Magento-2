<?php

/*
 * Created By: Ashish Ranade On : 17 Dec, 2019 9:06:20 PM
 * Project: Training
 * File: Indexer.php
 */

namespace Ashish\CheckoutStep\Model;

use Magento\Framework\Indexer\CacheContext;

/**
 * Description of Indexer
 *
 * @author Ashish
 */
class Flat
        implements \Magento\Framework\Indexer\ActionInterface,
        \Magento\Framework\Mview\ActionInterface
{
    
    public function execute($ids)
    {
        echo 'EXECUTED IN: '.__FUNCTION__.PHP_EOL;
    }

    public function executeFull()
    {
        echo 'EXECUTED IN: '.__FUNCTION__.PHP_EOL;
    }

    public function executeList(array $ids)
    {
        echo 'EXECUTED IN: '.__FUNCTION__.PHP_EOL;
    }

    public function executeRow($id)
    {
        echo 'EXECUTED IN: '.__FUNCTION__.PHP_EOL;
    }

}
