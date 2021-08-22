<?php
/**
 * Created by Ashish Ranade
 * Developed by Ashish Ranade
 * File: DataAssignObserver.php
 * Date: 5/9/2021
 * Time: 12:32 PM
 */

namespace Ashish\CustomPaymentGateway\Observer;


use Magento\Framework\Event\Observer;

class DataAssignObserver extends \Magento\Payment\Observer\AbstractDataAssignObserver
{

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $method = $this->readMethodArgument($observer);
        $data = $this->readDataArgument($observer);

        $paymentInfo = $method->getInfoInstance();

        if ($data->getDataByKey('transaction_result') !== null) {
            $paymentInfo->setAdditionalInformation(
                'transaction_result',
                $data->getDataByKey('transaction_result')
            );
        }
    }
}
