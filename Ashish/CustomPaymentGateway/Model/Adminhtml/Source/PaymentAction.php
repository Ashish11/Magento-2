<?php
/**
 * Created by Ashish Ranade
 * Developed by Ashish Ranade
 * File: PaymentAction.php
 * Date: 5/9/2021
 * Time: 10:07 AM
 */

namespace Ashish\CustomPaymentGateway\Model\Adminhtml\Source;
use Magento\Payment\Model\MethodInterface;

class PaymentAction implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        return [
            [
                'value' => MethodInterface::ACTION_AUTHORIZE,
                'label' => __('Authorize')
            ]
        ];
    }
}
