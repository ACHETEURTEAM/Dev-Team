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
    'Magento_Ui/js/form/components/html'
], function (Html) {
    'use strict';

    return Html.extend({
        defaults: {
            isConfigurable: false
        },

        /**
         * Updates component visibility state.
         *
         * @param {Boolean} variationsEmpty
         * @returns {Boolean}
         */
        updateVisibility: function (variationsEmpty) {
            var isVisible = this.isConfigurable || !variationsEmpty;

            this.visible(isVisible);

            return isVisible;
        }
    });
});
