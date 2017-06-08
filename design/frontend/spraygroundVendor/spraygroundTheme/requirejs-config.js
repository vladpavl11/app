var config = {

  // When load 'requirejs' always load the following files also
  deps: [
    "js/main",
  ],
   paths: {
    'TweenMax': 'js/gsap/TweenMax',
    'bootstrap': 'js/boot/bootstrap',
    'checkout-cart': 'Magento_Checkout/js/cart',
     "fabMiniCartToggle": "scripts/fabMiniCartToggle",
  },
    map: {
        '*': {
            catalogAddToCart: 'Magento_Catalog/js/catalog-add-to-cart'
        }
    }
};



