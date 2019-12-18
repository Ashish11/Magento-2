<?php

/*
 * Created By: Ashish Ranade On : 17 Dec, 2019 9:06:20 PM
 * Project: Training
 * File: Indexer.php
 */

namespace Ashish\IndexerExample\Model;

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

    /**
     * Execute
     * @param type $ids
     */
    public function execute($ids)
    {
        echo 'EXECUTED IN: ' . __FUNCTION__ . PHP_EOL;
    }

    /**
     * Execute Full
     */
    public function executeFull()
    {
        echo 'EXECUTED IN: ' . __FUNCTION__ . PHP_EOL;
    }

    /**
     * Execute list
     * @param array $ids
     */
    public function executeList(array $ids)
    {
        echo 'EXECUTED IN: ' . __FUNCTION__ . PHP_EOL;
    }

    /**
     * Execute row
     * @param type $id
     */
    public function executeRow($id)
    {
        echo 'EXECUTED IN: ' . __FUNCTION__ . PHP_EOL;
    }

}
