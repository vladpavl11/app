/*
 * Custom Minicart toggle
 */

(function(window, factory) {
  if (typeof define == 'function' && define.amd) {
    // AMD
    define( [], function() {
      return factory(window);
    });
  } else if (typeof module == 'object' && module.exports) {
    // CommonJS
    module.exports = factory(window);
  }
}(window, function factory(window) {
  /*
   * Custom cart handling
   */
   // Don't open the cart of res. smaller or equal to
   var BREAKPOINT = 1023;

   function closeCart(ev) {
     if (ev && ev.preventDefault) {
       ev.preventDefault();
     }
     document.body.classList.remove('minicart-open');
   }

   function toggleCart(ev) {
     if (window.matchMedia('(max-width: ' + BREAKPOINT + 'px)').matches) {
       document.body.classList.remove('minicart-open');
       return true;
     }
     if (ev && ev.preventDefault) {
       ev.preventDefault();
     }

     document.body.classList.toggle('minicart-open');

     return false;
   }

   function init() {
     var cartToggle = document.querySelectorAll('.action.showcart');
     Array.prototype.forEach.call(cartToggle, function(_el) {
       _el.addEventListener('click', toggleCart);
     });

     var cartCloser = document.querySelectorAll('.fab__minicart .action.close');
     Array.prototype.forEach.call(cartCloser, function(_el) {
       _el.addEventListener('click', closeCart);
     });
   }

   return {
     close: closeCart,
     init: init
   };
}));
