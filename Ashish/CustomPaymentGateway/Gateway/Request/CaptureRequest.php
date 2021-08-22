<?php
/**
 * Created by Ashish Ranade
 * Developed by Ashish Ranade
 * File: CaptureRequest.php
 * Date: 5/9/2021
 * Time: 12:08 PM
 */

namespace Ashish\CustomPaymentGateway\Gateway\Request;

use Magento\Payment\Gateway\ConfigInterface;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Sales\Api\Data\OrderPaymentInterface;

class CaptureRequest implements \Magento\Payment\Gateway\Request\BuilderInterface
{
    /**
     * Created By: Ashish Ranade
     * @var ConfigInterface
     */
    private $config;

    /**
     * CaptureRequest constructor.
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

        $paymentDO = $buildSubject['payment'];
        $order = $paymentDO->getOrder();
        $payment = $paymentDO->getPayment();

        if (!$payment instanceof OrderPaymentInterface) {
            throw new \LogicException('Order payment should be provided.');
        }

        return [
            'TXN_TYPE' => 'S',
            'TXN_ID' => $payment->getLastTransId(),
            'MERCHANT_KEY' => $this->config->getValue(
                'merchant_gateway_key',
                $order->getStoreId()
            )
        ];
    }
}
