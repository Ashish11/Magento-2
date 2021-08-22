<?php
/**
 * Created by Ashish Ranade
 * Developed by Ashish Ranade
 * File: ConfigProvider.php
 * Date: 5/9/2021
 * Time: 10:43 AM
 */

namespace Ashish\CustomPaymentGateway\Model\Ui;

use Ashish\CustomPaymentGateway\Gateway\Http\Client\ClientMock;

class ConfigProvider implements \Magento\Checkout\Model\ConfigProviderInterface
{
    /**
     * Payment Gateway Code
     */
    const CODE = 'customPaymentGateway';

    /**
     * @inheritDoc
     */
    public function getConfig()
    {
        return [
            'payment' => [
                self::CODE => [
                    'transactionResults' => [
                        ClientMock::SUCCESS => __('Success'),
                        ClientMock::FAILURE => __('Fraud')
                    ]
                ]
            ]
        ];
    }
}
