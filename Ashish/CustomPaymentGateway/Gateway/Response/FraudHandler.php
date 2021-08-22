<?php
/**
 * Created by Ashish Ranade
 * Developed by Ashish Ranade
 * File: FraudHandler.php
 * Date: 5/9/2021
 * Time: 10:58 AM
 */

namespace Ashish\CustomPaymentGateway\Gateway\Response;

use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Sales\Model\Order\Payment;

class FraudHandler implements \Magento\Payment\Gateway\Response\HandlerInterface
{
    const FRAUD_MSG_LIST = 'FRAUD_MSG_LIST';

    /**
     * @inheritDoc
     */
    public function handle(array $handlingSubject, array $response)
    {
        if (!isset($response[self::FRAUD_MSG_LIST]) || !is_array($response[self::FRAUD_MSG_LIST])) {
            return;
        }

        if (!isset($handlingSubject['payment'])
            || !$handlingSubject['payment'] instanceof PaymentDataObjectInterface
        ) {
            throw new \InvalidArgumentException('Payment data object should be provided');
        }

        $paymentDO = $handlingSubject['payment'];
        $payment = $paymentDO->getPayment();

        $payment->setAdditionalInformation(
            self::FRAUD_MSG_LIST,
            (array)$response[self::FRAUD_MSG_LIST]
        );

        /** @var $payment Payment */
        $payment->setIsTransactionPending(true);
        $payment->setIsFraudDetected(true);
    }
}
