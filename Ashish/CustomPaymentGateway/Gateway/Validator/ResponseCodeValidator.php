<?php
/**
 * Created by Ashish Ranade
 * Developed by Ashish Ranade
 * File: ResponseCodeValidator.php
 * Date: 5/9/2021
 * Time: 12:14 PM
 */

namespace Ashish\CustomPaymentGateway\Gateway\Validator;

use Magento\Payment\Gateway\Validator\ResultInterface;
use Magento\SamplePaymentGateway\Gateway\Http\Client\ClientMoc;

class ResponseCodeValidator extends \Magento\Payment\Gateway\Validator\AbstractValidator
{
    const RESULT_CODE = 'RESULT_CODE';

    /**
     * @inheritDoc
     */
    public function validate(array $validationSubject)
    {
        if (!isset($validationSubject['response']) || !is_array($validationSubject['response'])) {
            throw new \InvalidArgumentException('Response does not exist');
        }
        $response = $validationSubject['response'];
        if ($this->isSuccessfulTransaction($response)) {
            return $this->createResult(
                true,
                []
            );
        } else {
            return $this->createResult(
                false,
                [__('Gateway rejected the transaction.')]
            );
        }
    }

    /**
     * @param array $response
     * @return bool
     */
    private function isSuccessfulTransaction(array $response)
    {
        return isset($response[self::RESULT_CODE])
            && $response[self::RESULT_CODE] !== ClientMock::FAILURE;
    }
}
