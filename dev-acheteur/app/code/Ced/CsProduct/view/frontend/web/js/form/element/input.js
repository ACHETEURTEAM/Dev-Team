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
    'underscore',
    'Magento_Ui/js/form/element/abstract'
], function (_, Acstract) {
    'use strict';

    return Acstract.extend({
        defaults: {
            prefixName: '',
            prefixElementName: '',
            elementName: '',
            suffixName: ''
        },

        /**
         * Parses options and merges the result with instance
         *
         * @returns {Object} Chainable.
         */
        initConfig: function () {
            this._super();
            this.configureDataScope();

            return this;
        },

        /**
         * Configure data scope.
         */
        configureDataScope: function () {
            var recordId,
                prefixName,
                suffixName;

            // Get recordId
            recordId = this.parentName.split('.').last();

            prefixName = this.dataScopeToHtmlArray(this.prefixName);
            this.elementName = this.prefixElementName + recordId;

            suffixName = '';

            if (!_.isEmpty(this.suffixName) || _.isNumber(this.suffixName)) {
                suffixName = '[' + this.suffixName + ']';
            }
            this.inputName = prefixName + '[' + this.elementName + ']' + suffixName;

            suffixName = '';

            if (!_.isEmpty(this.suffixName) || _.isNumber(this.suffixName)) {
                suffixName = '.' + this.suffixName;
            }
            this.dataScope = 'data.' + this.prefixName + '.' + this.elementName + suffixName;

            this.links.value = this.provider + ':' + this.dataScope;
        },

        /**
         * Get HTML array from data scope.
         *
         * @param {String} dataScopeString
         * @returns {String}
         */
        dataScopeToHtmlArray: function (dataScopeString) {
            var dataScopeArray, dataScope, reduceFunction;

            /**
             * Add new level of nesting.
             *
             * @param {String} prev
             * @param {String} curr
             * @returns {String}
             */
            reduceFunction = function (prev, curr) {
                return prev + '[' + curr + ']';
            };

            dataScopeArray = dataScopeString.split('.');

            dataScope = dataScopeArray.shift();
            dataScope += dataScopeArray.reduce(reduceFunction, '');

            return dataScope;
        }
    });
});
