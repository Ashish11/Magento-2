define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'customPaymentGateway',
                component: 'Ashish_CustomPaymentGateway/js/view/payment/method-renderer/customPaymentGateway'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);
