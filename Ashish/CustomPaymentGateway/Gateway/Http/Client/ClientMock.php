<?php
/**
 * Created by Ashish Ranade
 * Developed by Ashish Ranade
 * File: ClientMock.php
 * Date: 5/9/2021
 * Time: 10:46 AM
 */

namespace Ashish\CustomPaymentGateway\Gateway\Http\Client;

use Magento\Payment\Gateway\Http\TransferInterface;
use Magento\Payment\Model\Method\Logger;

class ClientMock implements \Magento\Payment\Gateway\Http\ClientInterface
{
    const SUCCESS = 1;
    const FAILURE = 0;

    /**
     * @var array
     */
    private $results = [
        self::SUCCESS,
        self::FAILURE
    ];
    /**
     * Created By: Ashish Ranade
     * @var Logger
     */
    private $logger;

    /**
     * ClientMock constructor.
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function placeRequest(TransferInterface $transferObject)
    {
        $response = $this->generateResponseForCode(
            $this->getResultCode(
                $transferObject
            )
        );

        $this->logger->debug(
            [
                'request' => $transferObject->getBody(),
                'response' => $response
            ]
        );

        return $response;
    }

    /**
     * Created By: Ashish Ranade
     * generateResponseForCode
     * @param $resultCode
     * @return array
     */
    protected function generateResponseForCode($resultCode)
    {

        return array_merge(
            [
                'RESULT_CODE' => $resultCode,
                'TXN_ID' => $this->generateTxnId()
            ],
            $this->getFieldsBasedOnResponseType($resultCode)
        );
    }

    /**
     * @return string
     */
    protected function generateTxnId()
    {
        return md5(mt_rand(0, 1000));
    }

    /**
     * Created By: Ashish Ranade
     * getResultCode
     * @param TransferInterface $transfer
     * @return int|mixed
     */
    private function getResultCode(TransferInterface $transfer)
    {
        $headers = $transfer->getHeaders();

        if (isset($headers['force_result'])) {
            return (int)$headers['force_result'];
        }

        return $this->results[mt_rand(0, 1)];
    }

    /**
     * Created By: Ashish Ranade
     * getFieldsBasedOnResponseType
     * @param $resultCode
     * @return array
     */
    private function getFieldsBasedOnResponseType($resultCode)
    {
        switch ($resultCode) {
            case self::FAILURE:
                return [
                    'FRAUD_MSG_LIST' => [
                        'Stolen card',
                        'Customer location differs'
                    ]
                ];
        }

        return [];
    }
}
