<?php
/**
 * Created by Ashish Ranade
 * Developed by Ashish Ranade
 * File: TxnIdHandler.php
 * Date: 5/9/2021
 * Time: 12:11 PM
 */

namespace Ashish\CustomPaymentGateway\Gateway\Response;

use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Sales\Model\Order\Payment;

class TxnIdHandler implements \Magento\Payment\Gateway\Response\HandlerInterface
{
    const TXN_ID = 'TXN_ID';

    /**
     * @inheritDoc
     */
    public function handle(array $handlingSubject, array $response)
    {
        if (!isset($handlingSubject['payment'])
            || !$handlingSubject['payment'] instanceof PaymentDataObjectInterface
        ) {
            throw new \InvalidArgumentException('Payment data object should be provided');
        }

        $paymentDO = $handlingSubject['payment'];
        $payment = $paymentDO->getPayment();

        /** @var $payment Payment */
        $payment->setTransactionId($response[self::TXN_ID]);
        $payment->setIsTransactionClosed(false);
    }
}
