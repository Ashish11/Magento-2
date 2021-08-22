<?php
/**
 * Created by Ashish Ranade
 * Developed by Ashish Ranade
 * File: AuthorizationRequest.php
 * Date: 5/9/2021
 * Time: 12:00 PM
 */

namespace Ashish\CustomPaymentGateway\Gateway\Request;

use Magento\Payment\Gateway\ConfigInterface;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;

class AuthorizationRequest implements \Magento\Payment\Gateway\Request\BuilderInterface
{
    /**
     * Created By: Ashish Ranade
     * @var ConfigInterface
     */
    private $config;

    /**
     * AuthorizationRequest constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        if (!isset($buildSubject['payment'])
            || !$buildSubject['payment'] instanceof PaymentDataObjectInterface
        ) {
            throw new \InvalidArgumentException('Payment data object should be provided');
        }

        $payment = $buildSubject['payment'];
        $order = $payment->getOrder();
        $address = $order->getShippingAddress();

        return [
            'TXN_TYPE' => 'A',
            'INVOICE' => $order->getOrderIncrementId(),
            'AMOUNT' => $order->getGrandTotalAmount(),
            'CURRENCY' => $order->getCurrencyCode(),
            'EMAIL' => $address->getEmail(),
            'MERCHANT_KEY' => $this->config->getValue(
                'merchant_gateway_key',
                $order->getStoreId()
            )
        ];
    }
}
