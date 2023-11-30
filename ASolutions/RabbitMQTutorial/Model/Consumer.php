<?php

namespace ASolutions\RabbitMQTutorial\Model;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\MessageQueue\MessageLockException;
use Magento\Framework\MessageQueue\ConnectionLostException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\MessageQueue\CallbackInvoker;
use Magento\Framework\MessageQueue\ConsumerConfigurationInterface;
use Magento\Framework\MessageQueue\EnvelopeInterface;
use Magento\Framework\MessageQueue\QueueInterface;
use Magento\Framework\MessageQueue\LockInterface;
use Magento\Framework\MessageQueue\MessageController;
use Magento\Framework\MessageQueue\ConsumerInterface;
use ASolutions\RabbitMQTutorial\Model\ProcessQueue;

class Consumer implements ConsumerInterface
{
    /**
     * @var mixed CallbackInvoker
     */
    private $invoker;
    /**
     * @var mixed ResourceConnection
     */
    private $resource;
    /**
     * @var mixed ConsumerConfigurationInterface
     */
    private $configuration;
    /**
     * @var mixed MessageController
     */
    private $messageController;
    /**
     * @var mixed OperationProcessor
     */
    private $operationProcessor;
    /**
     * @var mixed ProcessQueue
     */
    private $processQueueMsg;

    /**
     * @param CallbackInvoker $invoker
     * @param ResourceConnection $resource
     * @param MessageController $messageController
     * @param ConsumerConfigurationInterface $configuration
     * @param ProcessQueue $processQueueMsg
     * @param Logger $logger
     */
    public function __construct(
        CallbackInvoker                $invoker,
        ResourceConnection             $resource,
        MessageController              $messageController,
        ConsumerConfigurationInterface $configuration,
        ProcessQueue                   $processQueueMsg
    )
    {
        $this->invoker = $invoker;
        $this->resource = $resource;
        $this->messageController = $messageController;
        $this->configuration = $configuration;
        $this->processQueueMsg = $processQueueMsg;
    }

    /**
     * {@inheritdoc}
     */
    public function process($maxNumberOfMessages = null)
    {
        $queue = $this->configuration->getQueue();
        if (!isset($maxNumberOfMessages)) {
            $queue->subscribe($this->getTransactionCallback($queue));
        } else {
            $this->invoker->invoke($queue, $maxNumberOfMessages, $this->getTransactionCallback($queue));
        }
    }

    /**
     * Get transaction callback. This handles the case of async.
     *
     * @param QueueInterface $queue
     * @return \Closure
     */
    private function getTransactionCallback(QueueInterface $queue): \Closure
    {
        return function (EnvelopeInterface $message) use ($queue) {
            /** @var LockInterface $lock */
            $lock = null;
            try {
                $lock = $this->messageController->lock($message, $this->configuration->getConsumerName());
                $processMsg = $message->getBody();
                $data = $this->processQueueMsg->process($processMsg);
                if ($data === false) {
                    $queue->reject($message); // if get error in message process
                }
                $queue->acknowledge($message); // send acknowledge to queue
            } catch (MessageLockException $exception) {
                $queue->acknowledge($message);
            } catch (ConnectionLostException $e) {
                $queue->acknowledge($message);
                if ($lock) {
                    $this->resource->getConnection()
                        ->delete($this->resource->getTableName('queue_lock'), ['id = ?' => $lock->getId()]);
                }
            } catch (NotFoundException $e) {
                $queue->acknowledge($message);
                $this->logger->warning($e->getMessage());
            } catch (\Exception $e) {
                $queue->reject($message, false, $e->getMessage());
                $queue->acknowledge($message);
                if ($lock) {
                    $this->resource->getConnection()
                        ->delete($this->resource->getTableName('queue_lock'), ['id = ?' => $lock->getId()]);
                }
            }
        };
    }
}
