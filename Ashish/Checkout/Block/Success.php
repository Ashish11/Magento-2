<?php
/*
 * Created By: Ashish Ranade On : Aug 17, 2017 3:34:50 PM
 * Project: magento2-develop
 * File: Success.php
 */
namespace Ashish\Checkout\Block;

/**
 * Description of Success
 */
class Success
        extends \Magento\Checkout\Block\Onepage\Success
{

    /**
     * Get the order
     * @return array
     */
    public function getOrderStatus()
    {
        $incrementId = $this->_checkoutSession->getLastRealOrder()->getIncrementId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $order = $objectManager->create('Magento\Sales\Model\Order')->load($incrementId);

        return $order->getStatus();
    }

    /**
     * Get grand total
     * @return string
     */
    public function getOrderGrandTotal()
    {
        $incrementId = $this->_checkoutSession->getLastRealOrder()->getIncrementId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $order = $objectManager->create('Magento\Sales\Model\Order')->load($incrementId);

        $priceHelper = $objectManager->create('Magento\Framework\Pricing\Helper\Data');
        $grandTotal = $order->getGrandTotal(); //Your Price
        $formattedGrandTotal = $priceHelper->currency($grandTotal, true, false);

        return $formattedGrandTotal;
    }

}