<?php
declare(strict_types=1);

namespace ASolutions\RabbitMQTutorial\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\MessageQueue\PublisherInterface;

/**
 * Controller for the 'rqdemo/index/index' URL route.
 */
class Index extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{
    /**
     * @var mixed SerializerInterface
     */
    protected $serializer;

    /**
     * @var mixed PublisherInterface
     */
    protected $publisher;

    /**
     * constructor
     * @param Context $context
     * @param SerializerInterface $serializer
     * @param PublisherInterface $publisher
     */
    public function __construct(Context $context, SerializerInterface $serializer, PublisherInterface $publisher)
    {
        parent::__construct($context);
        $this->serializer = $serializer;
        $this->publisher = $publisher;
    }

    /**
     * Execute controller action.
     */
    public function execute()
    {
        // TODO: Write your code to push data into publisher
        $publishData = array('ASolutions' => 'Testing consumer data');
        $this->publisher->publish('rqdemo.topic', $this->serializer->serialize($publishData));
        echo "Data has been push to RabbitMQ for further processing";
        exit;
    }
}
