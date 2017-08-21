<?php
/*
 * Created By: Ashish Ranade On : Aug 18, 2017 10:44:17 AM
 * Project: magento2-develop
 * File: OrderHold.php
 */
namespace Ashish\OrderHold\Observer;

/**
 * Description of OrderHold
 *
 * @author Ashish Ranade <ashish.ranade@satincorp.com>
 */
class OrderHold
        implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Order model instance
     * @var array
     */
    protected $_order;

    /**
     * Get store configuration
     * @var array
     */
    protected $_shipconfig;

    /**
     * Get store configuration
     * @var array
     */
    protected $_scopeConfig;

    /**
     * Default configuration value
     * @var array
     */
    protected $_config;

    /**
     * order total weight
     * @var integer
     */
    protected $_orderWeight;

    /**
     * Constructor
     * @param \Magento\Sales\Model\Order $orderModel
     */
    public function __construct(\Magento\Sales\Model\Order $orderModel,
            \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
            \Magento\Framework\App\Config $config)
    {
        $this->_order = $orderModel;
        $this->_scopeConfig = $scopeConfig;
        $this->_config = $config;
    }

    /**
     * Observer to change order status
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $orderIds = $observer->getOrderIds();
        foreach ($orderIds as $orderId) {
            $order = $this->_order->load($orderId);
            $grandTotal = $order->getGrandTotal();
            $this->_orderWeight = $order->getWeight();
            $canHold = false;

            $path = 'general/locale/weight_unit';
            $storeLbs = $this->_scopeConfig->getValue($path);
            $defaultLbs = $this->_scopeConfig->getValue($path);

            if (isset($storeLbs) && !empty($storeLbs)) {
                $canHold = $this->compareWeight($storeLbs);
            } else {
                $canHold = $this->compareWeight($defaultLbs);
            }

            if ($grandTotal > 1000) {
                $canHold = true;
            }

            if ($canHold) {
                $orderState = Order::ACTION_FLAG_HOLD;
                $order->setState($orderState)->setStatus(Order::ACTION_FLAG_HOLD);
                $order->save();
            }
        }
    }

    /**
     * Compare weight
     * @param type string
     * @return boolean
     */
    protected function compareWeight($weighUnit)
    {
        switch ($weighUnit) {
            case 'kgs';
                if ($this->_orderWeight > 22.7) {
                    return true;
                } else {
                    return false;
                }
                break;
            case 'lbs';
                if ($this->_orderWeight > 50) {
                    return true;
                } else {
                    return false;
                }
                break;
        }
    }

}