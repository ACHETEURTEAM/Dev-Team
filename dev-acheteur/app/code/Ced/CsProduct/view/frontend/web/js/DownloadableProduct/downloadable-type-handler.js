/**
 * CedCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End User License Agreement (EULA)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://cedcommerce.com/license-agreement.txt
 *
 * @category    Ced
 * @package     Ced_CsProduct
 * @author      CedCommerce Core Team <connect@cedcommerce.com>
 * @copyright   Copyright CedCommerce (https://cedcommerce.com/)
 * @license      https://cedcommerce.com/license-agreement.txt
 */
/*jshint browser:true jquery:true expr:true*/
define([
    'jquery',
    'Magento_Catalog/js/product/weight-handler',
    'Magento_Catalog/catalog/type-events'
], function ($, weight, productType) {
    'use strict';

    return {
        $checkbox: $('[data-action=change-type-product-downloadable]'),
        $items: $('#product_info_tabs_downloadable_items'),
        $tab: null,
        isDownloadable: false,

        /**
         * Show
         */
        show: function () {
            this.$checkbox.prop('checked', true);
            this.$items.show();
        },

        /**
         * Hide
         */
        hide: function () {
            this.$checkbox.prop('checked', false);
            this.$items.hide();
        },

        /**
         * Constructor component
         * @param {Object} data - this backend data
         */
        'Magento_Downloadable/downloadable-type-handler': function (data) {
            this.$tab = $('[data-tab=' + data.tabId + ']');
            this.isDownloadable = data.isDownloadable;
            this.bindAll();
            this._initType();
        },

        /**
         * Bind all
         */
        bindAll: function () {
            this.$checkbox.on('change', function (event) {
                $(document).trigger('setTypeProduct', $(event.target).prop('checked') ? 'downloadable' : null);
            });

            $(document).on('changeTypeProduct', this._initType.bind(this));
        },

        /**
         * Init type
         * @private
         */
        _initType: function () {
            if (productType.type.current === 'downloadable') {
                weight.change(false);
                weight.$weightSwitcher.one('change', function () {
                    $(document).trigger('setTypeProduct', null);
                });
                this.show();
            } else {
                this.hide();
            }
        }
    };
});
