define([
    'jquery',
    'Magento_Payment/js/view/payment/cc-form'
],
        function ($, Component) {
            'use strict';
            return Component.extend({
                defaults: {
                    template: 'Ashish_Payment/payment/form'
                },
                context: function () {
                    return this;
                },
                getCode: function () {
                    return 'ashish_payment';
                },
                isActive: function () {
                    return true;
                }
            });
        }
);
 