<?php

namespace ASolutions\RabbitMQTutorial\Model;

use Psr\Log\LoggerInterface;

class ProcessQueue
{
    /**
     * @var mixxed LoggerInterface
     */
    private $logger;

    /**
     * construct
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Process queue message
     * @param $message
     * @return true
     */
    public function process($message)
    {
        $this->logger->info($message);
        return true;
    }

}
