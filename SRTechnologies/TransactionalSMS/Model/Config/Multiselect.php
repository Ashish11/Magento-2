<?php

namespace SRTechnologies\TransactionalSMS\Model\Config;

class Multiselect implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'Order_place_Sms', 'label' => __('Order SMS')],
            ['value' => 'Customer_register_Sms', 'label' => __('Customer Register SMS')],
            ['value' => 'Order_invoice_Sms', 'label' => __('Order Invoice SMS')],
        ];
    }
}
