<?php

/**
 * File : MyFirstModule\Mymodule\Cron - Test.php
 * User : ashish
 * Created at : 26/07/20 - 8:11 PM
 * Project : magento
 */
namespace MyFirstModule\Mymodule\Cron;

class Test
{
    private $logger;

    /**
     * Test constructor.
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Execute Custom Code
     */
    public function execute()
    {
        $this->logger->info(time());
    }

}
