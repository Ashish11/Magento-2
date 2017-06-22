/* 
 * Created By: Ashish Ranade On : May 31, 2017 11:15:41 AM
 * Project: magento2-develop
 * File: list.js
 */
define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
    'use strict';
    var listFeaturedProduct = ko.observableArray([]);
    return Component.extend({
        initialize: function () {
            this._super();
        },
        getListFeaturedProduct: function () {
            if (!listFeaturedProduct().length) {
                jQuery.ajax({
                    url: '/magento2-develop/featuredproduct/featured/product',
                    type: 'GET',
                    complete: function (data) {
                        listFeaturedProduct(JSON.parse(data.responseText));
                    },
                });
            }
            return listFeaturedProduct;
        }
    });
});
