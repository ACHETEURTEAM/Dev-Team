/**
 * CedCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End User License Agreement (EULA)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * httpS://cedcommerce.com/license-agreement.txt
 *
 * @category    Ced
 * @package     Ced_CsProduct
 * @author      CedCommerce Core Team <connect@cedcommerce.com>
 * @copyright   Copyright CedCommerce (httpS://cedcommerce.com/)
 * @license      httpS://cedcommerce.com/license-agreement.txt
 */
/*jshint browser:true jquery:true*/
/*global FORM_KEY*/
define([
    'jquery',
    'jquery/ui',
    'Magento_Ui/js/modal/modal',
    'mage/translate',
    'mage/backend/tree-suggest',
    'mage/backend/validation'
], function ($) {
    'use strict';

    var clearParentCategory = function () {
        $('#new_category_parent').find('option').each(function () {
            $('#new_category_parent-suggest').treeSuggest('removeOption', null, this);
        });
    };

    $.widget('mage.newCategoryDialog', {
        _create: function () {
            var widget = this;
            $('#new_category_parent').before($('<input>', {
                id: 'new_category_parent-suggest',
                placeholder: $.mage.__('start typing to search category')
            }));

            $('#new_category_parent-suggest').treeSuggest(this.options.suggestOptions)
                .on('suggestbeforeselect', function (event) {
                    clearParentCategory();
                    $(event.target).treeSuggest('close');
                });

            $.validator.addMethod('validate-parent-category', function () {
                return $('#new_category_parent').val() || $('#new_category_parent-suggest').val() === '';
            }, $.mage.__('Choose existing category.'));
            var newCategoryForm = $('#new_category_form');
            newCategoryForm.mage('validation', {
                errorPlacement: function (error, element) {
                    error.insertAfter(element.is('#new_category_parent') ?
                        $('#new_category_parent-suggest').closest('.mage-suggest') :
                        element);
                }
            }).on('highlight.validate', function (e) {
                var options = $(this).validation('option');
                if ($(e.target).is('#new_category_parent')) {
                    options.highlight($('#new_category_parent-suggest').get(0),
                        options.errorClass, options.validClass || '');
                }
            });
            this.element.modal({
                type: 'slide',
                modalClass: 'mage-new-category-dialog form-inline',
                title: $.mage.__('Create Category'),
                opened: function () {
                    var enteredName = $('#category_ids-suggest').val();

                    $('#new_category_name').val(enteredName);
                    if (enteredName === '') {
                        $('#new_category_name').focus();
                    }
                    $('#new_category_messages').html('');
                },
                closed: function () {
                    var validationOptions = newCategoryForm.validation('option');

                    $('#new_category_name, #new_category_parent-suggest').val('');
                    validationOptions.unhighlight($('#new_category_parent-suggest').get(0),
                        validationOptions.errorClass, validationOptions.validClass || '');
                    newCategoryForm.validation('clearError');
                    $('#category_ids-suggest').focus();
                },
                buttons: [{
                    text: $.mage.__('Create Category'),
                    class: 'action-primary',
                    click: function (e) {
                        if (!newCategoryForm.valid()) {
                            return;
                        }
                        var thisButton = $(e.currentTarget);

                        thisButton.prop('disabled', true);
                        $.ajax({
                            type: 'POST',
                            url: widget.options.saveCategoryUrl,
                            data: {
                                name: $('#new_category_name').val(),
                                parent: $('#new_category_parent').val(),
                                is_active: 1,
                                include_in_menu: 1,
                                use_config: ['available_sort_by', 'default_sort_by'],
                                form_key: FORM_KEY,
                                return_session_messages_only: 1
                            },
                            dataType: 'json',
                            context: $('body')
                        }).success(function (data) {
                            if (!data.error) {
                                var $suggest = $('#category_ids-suggest');

                                $suggest.trigger('selectItem', {
                                    id: data.category.entity_id,
                                    label: data.category.name
                                });
                                $('#new_category_name, #new_category_parent-suggest').val('');
                                $suggest.val('');
                                clearParentCategory();
                                $(widget.element).modal('closeModal');
                            } else {
                                $('#new_category_messages').html(data.messages);
                            }
                        }).complete(
                            function () {
                                thisButton.prop('disabled', false);
                            }
                        );
                    }
                }]
            });
        }
    });

    return $.mage.newCategoryDialog;
});
