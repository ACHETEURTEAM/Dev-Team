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
    'underscore',
    'uiRegistry',
    'jquery/ui'
], function ($, _, registry) {
    'use strict';

    $.widget('mage.productAttributes', {
        _create: function () {
            this._on({
                'click': '_showPopup'
            });
        },

        _initModal: function () {
            var self = this;

            this.modal = $('<div id="create_new_attribute"></div>').modal({
                title: $.mage.__('New Attribute'),
                type: 'slide',
                buttons: [],
                opened: function () {
                    $(this).parent().addClass('modal-content-new-attribute');
                    self.iframe = $('<iframe id="create_new_attribute_container">').attr({
                        src: self._prepareUrl(),
                        frameborder: 0
                    });
                    self.modal.append(self.iframe);
                    self._changeIframeSize();
                    $(window).off().on('resize.modal', _.debounce(self._changeIframeSize.bind(self), 400));
                },
                closed: function () {
                    var doc = self.iframe.get(0).document;

                    if (doc && $.isFunction(doc.execCommand)) {
                        //IE9 break script loading but not execution on iframe removing
                        doc.execCommand('stop');
                        self.iframe.remove();
                    }
                    self.modal.data('modal').modal.remove();
                    $(window).off('resize.modal');
                }
            });
        },

        _getHeight: function () {
            var modal = this.modal.data('modal').modal,
                modalHead = modal.find('header'),
                modalHeadHeight = modalHead.outerHeight(),
                modalHeight = modal.outerHeight(),
                modalContentPadding = this.modal.parent().outerHeight() - this.modal.parent().height();

            return modalHeight - modalHeadHeight - modalContentPadding;
        },

        _getWidth: function () {
            return this.modal.width();
        },

        _changeIframeSize: function () {
            this.modal.parent().outerHeight(this._getHeight());
            this.iframe.outerHeight(this._getHeight());
            this.iframe.outerWidth(this._getWidth());

        },

        _prepareUrl: function () {
            var productSource,
                attributeSetId = '';

            if (this.options.dataProvider) {
                try {
                    productSource = registry.get(this.options.dataProvider);
                    attributeSetId = productSource.data.product['attribute_set_id'];
                } catch (e) {
                }
            }

            return this.options.url +
                (/\?/.test(this.options.url) ? '&' : '?') +
                'set=' + attributeSetId;
        },

        _showPopup: function () {
            this._initModal();
            this.modal.modal('openModal');
        }
    });

    return $.mage.productAttributes;
});
