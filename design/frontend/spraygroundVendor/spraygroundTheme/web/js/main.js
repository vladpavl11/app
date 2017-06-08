require([
  "jquery",
  "TweenMax",
], 

function($) {

 // $(document).on('click', '.navigation li.level-top.parent>a', function(e){
 // 	console.log('click');
 //        e.preventDefault();
 //        if($(this).parents('li.level-top').hasClass('open')){
 //            $('li.level-top').removeClass('open');
 //        }else{
 //            $('li.level-top').removeClass('open');
 //            $(this).parents('li.level-top').addClass('open');
 //        }
 //    });

 //    $(document).on('click', '.navigation li.level1.parent>a', function(e){
 //        e.preventDefault();
 //        e.stopPropagation();
 //        e.stopImmediatePropagation();
 //        if($(this).parents('li.level1').hasClass('open')){
 //            $('li.level1').removeClass('open');
 //        }else{
 //            $('li.level1').removeClass('open');
 //            $(this).parents('li.level1').addClass('open');
 //        }
 //        return false;
 //    });

var nav_bar = TweenMax.to('.nav-toggle', 0.2, {rotation:90});
nav_bar.pause();
var timeline = TweenMax.to({}, 0.4, {
  onUpdateParams:["{self}"],
  onUpdate:function(tl){
    var tlp = (tl.progress()*10)>>0;
    // TweenMax.set('.page-wrapper ',{'-webkit-filter':'blur(' + tlp + 'px' + ')','filter':'blur(' + tlp + 'px' + ')'});
  }
});
timeline.pause();
 
var prodPageHeight = $('.product-media').height();
$('.leftDescriptionwrapper ,.product-price-wrapper').css("height", prodPageHeight);


$(".hamburger").on("click", function() {
  var hamburger = document.querySelectorAll(".hamburger");
    if (hamburger.length > 0) {
          this.classList.toggle("is-active");
       
      
    }
	if ($("html").hasClass("nav-open")) {
	  timeline.reverse();
	  nav_bar.reverse();
	}else{
		timeline.play();
		nav_bar.play();
	}
});


//////////////// scroll events detail page ///////////////

var scrollerswitch_active = false;
var scrollerswitch_instance = 0;
var scrollerswitch_follow = false;
jQuery('.bottom-of-scroller').each(function(){
  scrollerswitch_active = true;
});

//scrollerswitch_active = false;
function resetScroller(){
  if(scrollerswitch_instance == 0){
    scrollerswitch_instance = 1;
    scrollerswitch_follow = false;
    jQuery('.leftDescriptiocontainer.follow').each(function(){
      scrollerswitch_follow=true;
    });
    var previous_scrollerswitch_follow = scrollerswitch_follow;
    resetScroller_helper();
    
    if(scrollerswitch_follow != previous_scrollerswitch_follow){
      //if scroller has changed.
      if (typeof resetAllHeightCompensation === "function") { 
        //re-adjust any heights during the scroller switch
        resetAllHeightCompensation();
      }
      resetScroller_helper();
    }

    scrollerswitch_instance = 0;
  }
}

function resetScroller_helper(){
  if(jQuery('.bottom-of-scroller').offset().top < jQuery(window).scrollTop() + jQuery(window).innerHeight()){
    jQuery('.leftDescriptiocontainer.follow').each(function(){
      jQuery(this).removeClass('follow');
    });
    jQuery('.product-price.followRight').each(function(){
      jQuery(this).removeClass('followRight');
    });
    scrollerswitch_follow = true;
  }
  else if(!scrollerswitch_follow){
    jQuery('.leftDescriptiocontainer').each(function(){
      jQuery(this).addClass('follow');
    });
    jQuery('.product-price').each(function(){
      jQuery(this).addClass('followRight');
    });
    scrollerswitch_follow = false;
  }
}

if(scrollerswitch_active){
  var scroller_time = 0;
  for(scroller_time = 10; scroller_time < 900000; scroller_time = scroller_time * 2){
    //exponential algorithm want something that would update if not all the elements were loaded on the page yet
    setTimeout(function(){resetScroller();}, scroller_time);
    //console.log(scroller_time);
  }
  jQuery( document ).ready(function() {
    resetScroller();
  });
  jQuery( window ).resize(function() {
    resetScroller();
  });

  jQuery(window).on("orientationchange",function(){
    for(scroller_time = 10; scroller_time < 60000; scroller_time = scroller_time * 2){
      //exponential algorithm want something that would update if not all the elements were loaded on the page yet
      setTimeout(function(){resetScroller();}, scroller_time);
      //console.log(scroller_time);
    }
  });
  jQuery(window).on("scroll",function(){
    resetScroller();
  });
}
///////////////////////////// hover actions /////////////////////

  TweenMax.to($('.product-item-details > .price-box'), 0, {y:"15"});
  TweenMax.to($('.add-to-cart-stickersWrapper'), 0, {y:"15"});


$('.add-to-cart-stickers-hover-target').hover(function ()  {
  TweenMax.to($('.product-add-form').find('.add-to-cart-stickersWrapper'), 0.4, {y:"5",autoAlpha:1, ease:Power1.easeInOut});
},function ()  {
    TweenMax.to($('.product-add-form').find('.add-to-cart-stickersWrapper'), 0.4, {y:"15",autoAlpha:0,ease:Power1.easeInOut});
});

$('.product-item-info').hover(function ()  {

    TweenMax.to($(this).find('.price-box'), 0.4, {y:"0",autoAlpha:1, ease:Power1.easeInOut});
},function ()  {
    TweenMax.to($(this).find('.price-box'), 0.4, {y:"15",autoAlpha:0,ease:Power1.easeInOut});
});
////////////////////// hover actions end ///////////////////

  return;
});
