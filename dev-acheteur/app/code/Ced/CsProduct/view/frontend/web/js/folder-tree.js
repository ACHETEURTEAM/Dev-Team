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
    "jquery",
    "jquery/ui",
    "jquery/jstree/jquery.jstree"
], function ($) {
    'use strict';

    $.widget("mage.folderTree", {
        options: {
            root: 'root',
            rootName: 'Root',
            url: '',
            currentPath: ['root'],
            tree: {
                "plugins": ["themes", "json_data", "ui", "hotkeys"],
                "themes": {
                    "theme": "default",
                    "dots": false,
                    "icons": true
                }
            }
        },
        _create: function () {
            var options = this.options;
            var treeOptions = $.extend(
                true,
                {},
                options.tree,
                {
                    json_data: {
                        data: {
                            data: options.rootName,
                            state: "closed",
                            metadata: {node: {id: options.root, text: options.rootName}},
                            attr: {"data-id": options.root, id: options.root}
                        },
                        ajax: {
                            url: options.url,
                            data: function (node) {
                                return {
                                    node: node.data('id'),
                                    form_key: window.FORM_KEY
                                };
                            },
                            success: this._convertData
                        }
                    }
                }
            );
            this.element.jstree(treeOptions).on('loaded.jstree', $.proxy(this.treeLoaded, this));
        },

        treeLoaded: function (event) {
            var path = this.options.currentPath;
            var tree = this.element;
            var recursiveOpen = function () {
                var el = $("[data-id=\"" + path.pop() + "\"]");
                if (path.length > 1) {
                    tree.jstree('open_node', el, recursiveOpen);
                } else {
                    tree.jstree('open_node', el, function () {
                        tree.jstree('select_node', el);
                    });
                }
            };
            recursiveOpen();
        },

        _convertData: function (data) {
            return $.map(data, function (node) {
                var codeCopy = $.extend({}, node);
                return {
                    data: node.text,
                    attr: {"data-id": node.id, id: node.id},
                    metadata: {node: codeCopy},
                    state: "closed"
                };
            });
        }
    });

    return $.mage.folderTree;
});
