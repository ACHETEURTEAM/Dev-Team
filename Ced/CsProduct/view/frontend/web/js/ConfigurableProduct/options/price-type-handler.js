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

define([
    'jquery',
    'Magento_Catalog/catalog/type-events',
    'notification',
    'mage/translate'
], function ($, productType) {
    'use strict';

    return {
        isConfigurable: false,
        messageInited: false,
        messageSelector: '[data-role=product-custom-options-content]',
        isPercentPriceTypeExist: function () {
            var productOptionsContainer = $('#product_options_container_top');

            return !!productOptionsContainer.length;
        },
        showWarning: function () {
            if (!this.messageInited) {
                $(this.messageSelector).notification();
                this.messageInited = true;
            }
            this.hideWarning();
            $(this.messageSelector).notification('add', {
                message: $.mage.__('We can\'t save custom-defined options with price type "percent" for ' +
                    'configurable product.'),
                error: true,
                messageContainer: this.messageSelector
            });
        },
        hideWarning: function () {
            $(this.messageSelector).notification('clear');
        },
        init: function () {
            $(document).on('changeTypeProduct', this._initType.bind(this));

            $('#product-edit-form-tabs').on('change', '.opt-type > select', function () {
                var selected = $('.opt-type > select :selected'),
                    optGroup = selected.parent().attr('label');

                if (optGroup === 'Select') {
                    $('#product-edit-form-tabs').on(
                        'click',
                        '[data-ui-id="admin-product-options-options-box-select-option-type-add-select-row-button"]',
                        function () {
                            this.percentPriceTypeHandler();
                        }.bind(this)
                    );
                } else {
                    this.percentPriceTypeHandler();
                }
            }.bind(this));

            this._initType();
        },
        _initType: function () {
            this.isConfigurable = productType.type.current === 'configurable';
            if (this.isPercentPriceTypeExist()) {
                this.percentPriceTypeHandler();
            }
        },
        percentPriceTypeHandler: function () {
            var priceType = $('[data-attr="price-type"]'),
                optionPercentPriceType = priceType.find('option[value="percent"]');

            if (this.isConfigurable) {
                this.showWarning();
                optionPercentPriceType.hide();
                optionPercentPriceType.parent().val() === 'percent' ? optionPercentPriceType.parent().val('fixed') : '';
            } else {
                $(this.messageSelector).notification();
                optionPercentPriceType.show();
                this.hideWarning();
            }
        }
    };
});
