define(
    [
        'Magento_Checkout/js/view/payment/default'
    ],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Ashish_CustomPaymentGateway/payment/form',
                transactionResult: ''
            },

            initObservable: function () {
                this._super()
                    .observe([
                        'transactionResult'
                    ]);
                return this;
            },

            getCode: function () {
                return 'customPaymentGateway';
            },

            getData: function () {
                return {
                    'method': this.item.method,
                    'additional_data': {
                        'transaction_result': this.transactionResult()
                    }
                };
            },

            getTransactionResults: function () {
                return _.map(window.checkoutConfig.payment.customPaymentGateway.transactionResults, function (value, key) {
                    return {
                        'value': key,
                        'transaction_result': value
                    }
                });
            }
        });
    }
);
