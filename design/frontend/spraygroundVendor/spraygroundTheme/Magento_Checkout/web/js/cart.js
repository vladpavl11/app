/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*jshint browser:true jquery:true*/
/*global confirm:true*/
define([
    'jquery'
], function ($) {

    $.widget('mage.cart', {
      _create: function () {
          this._initContent();
      },

      _updateItemOption: function(elem) {
        var requestData = {
          item_id: elem.data('cart-item'),
          super_attribute_id: elem.data('super-attribute-id'),
          product_sku: elem.data('cart-item-sku'),
          item_option: elem.val()
        };
        this._ajax(window.checkout.updateItemOptionUrl, requestData, elem, this._updateItemOptionAfter);
      },

      _updateItemOptionAfter: function (elem) {
          location.reload();
      },

      _initContent: function () {
        var self = this;
        var events = {};
        events['optionselect select.js-checkout-cart-option'] = function (event) {
            event.stopPropagation();
            self._updateItemOption($(event.currentTarget));
        };

        events['optionselect select.js-checkout-cart-qty'] = function (event) {
            event.stopPropagation();
            $('.form-cart').submit()
        };

        this._on(this.element, events);
      },

      /**
       * @param {String} url - ajax url
       * @param {Object} data - post data for ajax call
       * @param {Object} elem - element that initiated the event
       * @param {Function} callback - callback method to execute after AJAX success
       */
      _ajax: function (url, data, elem, callback) {
          $.extend(data, {
              'form_key': $.mage.cookies.get('form_key')
          });

          $.ajax({
              url: url,
              data: data,
              type: 'post',
              dataType: 'json',
              context: this,
              beforeSend: function () {
                  elem.attr('disabled', 'disabled');
              },
              complete: function () {
                  elem.attr('disabled', null);
              }
          })
              .done(function (response) {
                  if (response.success) {
                      callback.call(this, elem, response);
                  } else {
                      var msg = response.error_message;

                      if (msg) {
                          alert({
                              content: $.mage.__(msg)
                          });
                      }
                  }
              })
              .fail(function (error) {
                  console.log(JSON.stringify(error));
              });
      }
    });

    return $.mage.cart;
});
