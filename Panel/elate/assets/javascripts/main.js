// MAIN.JS
//--------------------------------------------------------------------------------------------------------------------------------
//This is main JS file that contains custom JS scipts and initialization used in this template*/
// -------------------------------------------------------------------------------------------------------------------------------
// Template Name: DIGNITY.
// Author: Designova.
// Version 1.0 - Initial Release
// Website: http://www.designova.net 
// Copyright: (C) 2013 
// -------------------------------------------------------------------------------------------------------------------------------

/*global $:false */
/*global window: false */

(function(){
  "use strict";


$(function ($) {

     //Detecting viewpot dimension
     var vH = $(window).height();
     var vW = $(window).width();

     //Adjusting Intro Components Spacing based on detected screen resolution
     $('#intro').css('height',vH);
  
   
    //Vertical Centering of natural content spcific elements (non-images)
     $(function ($) {
              /*if your element is an image then please use $(window).load() instead tha above function wrap, because we want the coding to take
              effect when the image is loaded. */
              
              //get the width of the parent
              var parent_height = $('.vertical-center').parent().height();
              var image_height = $('.vertical-center').height();
              
              var top_margin = (parent_height - image_height)/2;
              
              //center it
              $('.vertical-center').css( 'padding-top' , top_margin);
              //uncomment the following if ithe element to be centered is an image
              $('.vertical-center-img').css( 'margin-top' , top_margin);
       });



     //Portfolio Engine
    $('#grid').mixitup({
      transitionSpeed : 800
    });

    //Portfolio Filter Active State
    $('ul#portfolioFilter li').click(function(){
      $('ul#portfolioFilter li').removeClass('active-filter');
      $(this).addClass('active-filter');
    });

    
    //Parallax Init
    $(window).stellar({
        responsive: true,
        horizontalScrolling: false,
        parallaxBackgrounds: true,
        parallaxElements: true,
        hideDistantElements: false
    });


    //Waypoint Interaction
    $('.waypoint-out').waypoint(function() {
      $('#masthead').removeClass('sub');
    });
    $('.waypoint-in').waypoint(function() {
      $('#masthead').addClass('sub');
    },{offset:100});


    //Text Rotation on intro
    // Text Rotate 
            var TxtRotate = function (el, toRotate, period) {
                    this.toRotate = toRotate;
                    this.el = el;
                    this.loopNum = 0;
                    this.period = parseInt(period, 10) || 2000;
                    this.txt = '';
                    this.tick();
                    this.isDeleting = false;
                };
            TxtRotate.prototype.tick = function () {
                var i = this.loopNum % this.toRotate.length;
                var fullTxt = this.toRotate[i];
                if (this.isDeleting) {
                    this.txt = fullTxt.substring(0, this.txt.length - 1);
                } else {
                    this.txt = fullTxt.substring(0, this.txt.length + 1);
                }
                this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';
                var that = this;
                var delta = 300 - Math.random() * 100;
                if (this.isDeleting) {
                    delta /= 2;
                }
                if (!this.isDeleting && this.txt === fullTxt) {
                    delta = this.period;
                    this.isDeleting = true;
                } else if (this.isDeleting && this.txt === '') {
                    this.isDeleting = false;
                    this.loopNum++;
                    delta = 500;
                }
                setTimeout(function () {
                    that.tick();
                }, delta);
            };
            window.onload = function () {
                var elements = document.getElementsByClassName('txt-rotate');
                for (var i = 0; i < elements.length; i++) {
                    var toRotate = elements[i].getAttribute('data-rotate');
                    var period = elements[i].getAttribute('data-period');
                    if (toRotate) {
                        new TxtRotate(elements[i], JSON.parse(toRotate), period);
                    }
                }
                // INJECT CSS
                var css = document.createElement("style");
                css.type = "text/css";
                css.innerHTML = ".txt-rotate> .wrap { border-right: 2px solid #D8322B }";
                document.body.appendChild(css);
            };


     //TWITTER INIT (Updated with compatibility on Twitter's new API):
     //PLEASE READ DOCUMENTATION FOR INFO ABOUT SETTING UP YOUR OWN TWITTER CREDENTIALS:
      $(function ($) {
          $('#ticker').tweet({
              modpath: './twitter/',
              count: 1,
              loading_text: 'loading twitter update...',
              username:'designovastudio'
              /* etc... */
          });
        }); 



    

    //Carousels
     $("#feature-carousel").owlCarousel({
        slideSpeed : 2000,
		navigation : false,
        pagination: true,
        responsive: true,
        items: 4,
        touchDrag: true,
        mouseDrag: true,
        itemsDesktop: [3000,6],
        itemsDesktopSmall: [1440,4],
        itemsTablet:[1024,3],
        itemsTabletSmall: [600,2],
        itemsMobile: [360,1],
        autoPlay: true,
      });
     $("#project-carousel").owlCarousel({
        navigation : false,
        pagination: false,
        responsive: true,
        items: 2,
        touchDrag: true,
        mouseDrag: true,
        itemsDesktop: [3000,4],
        itemsDesktopSmall: [1440,3],
        itemsTablet:[1024,3],
        itemsTabletSmall: [600,2],
        itemsMobile: [360,1],
        autoPlay: true
      });
      $(".testimonial-carousel").owlCarousel({
        navigation : true,
        pagination: false,
        responsive: true,
        items: 1,
        autoHeight: true,
        navigationText: ["&lt;","&gt;"],
        touchDrag: true,
        mouseDrag: true,
        itemsDesktop: [3000,1],
        itemsDesktopSmall: [1440,1],
        itemsTablet:[800,1],
        autoPlay: true
      });
      $(".quote-carousel").owlCarousel({
        navigation : true,
        pagination: false,
        responsive: true,
        items: 1,
        autoHeight: true,
        navigationText: ["&lt;","&gt;"],
        touchDrag: true,
        mouseDrag: true,
        itemsDesktop: [3000,1],
        itemsDesktopSmall: [1440,1],
        itemsTablet:[800,1],
        autoPlay: true
      });


    //Magnific Pop (Lightbox for Modal Window)
$('.open-popup-link').magnificPopup({
  type:'inline',
  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
});

 //Magnific Pop (Lightbox for images)
    $('.image-lightbox-link').magnificPopup({ 
    type: 'image',
    mainClass: 'mfp-with-zoom', // this class is for CSS animation below

    zoom: {
      enabled: true, // By default it's false, so don't forget to enable it

      duration: 300, // duration of the effect, in milliseconds
      easing: 'ease-in-out', // CSS transition easing function 

      // The "opener" function should return the element from which popup will be zoomed in
      // and to which popup will be scaled down
      // By defailt it looks for an image tag:
      opener: function(openerElement) {
        // openerElement is the element on which popup was initialized, in this case its <a> tag
        // you don't need to add "opener" option if this code matches your needs, it's defailt one.
        return openerElement.is('img') ? openerElement : openerElement.find('img');
      }
    }

  });


//manually adjusting icon-wrap heights inside service blocks
if(vW>1000){
var blockHt = $('.service-short-info').height();
$('.service-short-icon').css('height',blockHt+60);
}

});
// $(function ($)  : ends

})();
//  JSHint wrapper $(function ($)  : ends







  

