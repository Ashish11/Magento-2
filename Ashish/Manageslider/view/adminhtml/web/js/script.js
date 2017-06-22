/* 
 * Created By: Ashish Ranade On : Jun 15, 2017 3:39:39 PM
 * Project: magento2-develop
 * File: Script.js
 */

require([
    'jquery',
    'tinymce',
    'Magento_Ui/js/modal/confirm',
    'Magento_Ui/js/modal/alert',
    'loadingPopup',
    'mage/backend/floating-header'
], function (jQuery, tinyMCE, confirm) {
    'use strict';

    function sliderDelete(url) {
        confirm({
            content: 'Are you sure you want to delete this slider?',
            actions: {
                confirm: function () {
                    location.href = url;
                }
            }
        });
    }

    function displayLoadingMask() {
        jQuery('body').loadingPopup();
    }

    window.sliderDelete = sliderDelete;
    window.displayLoadingMask = displayLoadingMask;
});
