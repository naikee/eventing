/*global $:false */

jQuery(document).ready(function(){'use strict';

	// Sticky Nav
	jQuery(window).on('scroll', function(){'use strict';

		var headerHeight = 0;

		if ( jQuery('header').hasClass('has-topheader') ) {
			headerHeight = jQuery('header .topheader-container').innerHeight() + jQuery('header > div.site-header').innerHeight();
		} else {
			headerHeight = jQuery('header > div.site-header').innerHeight();
		}

		headerHeight = headerHeight + 30;

		if ( jQuery(window).scrollTop() > headerHeight ) {
			jQuery('#stickyhead').addClass('animated fadeInDown sticky');
			//jQuery('header > div.site-header').find('.search_popout').removeClass('search_popup');
		} else {
			jQuery('#stickyhead').removeClass('animated fadeInDown sticky');
			//jQuery('header > div.site-header').find('.search_popout').addClass('search_popup');
		}

		if (jQuery(window).scrollTop() > 300) {
			jQuery('.back-to-top.dc-scrolltop').css('opacity', 1);
		} else {
			jQuery('.back-to-top.dc-scrolltop').css('opacity', 0);
		}
	});

	jQuery('.featured-wrap .share-btn').on('click',function(){
		jQuery('.share-btn-pop').slideToggle(500);
	});


	/* -------------------------------------- */
	// 		RTL Support Visual Composer
	/* -------------------------------------- */	
	var delay = 1;
	function adeetheming_rtl() {
		if( jQuery("html").attr("dir") == 'rtl' ){
			if( jQuery( ".entry-content > div" ).attr( "data-vc-full-width" ) =='true' )	{
				jQuery('.entry-content > div').css({'left':'auto','right':jQuery('.entry-content > div').css('left')});	
			}
		}
	}
	setTimeout( adeetheming_rtl , delay);

	jQuery( window ).resize(function() {
		setTimeout( adeetheming_rtl , delay);
	});


	/* --------------------------------------
	*		Scroll Back to Top 
	*  -------------------------------------- */ 
	jQuery('.back-to-top.dc-scrolltop').on('click', function() {
		jQuery.smoothScroll({
			offset : 0,
			direction : 'top',
			scrollTarget : null,
			easing : 'swing',
			speed : 500,
		});
	});


	//image popup
    jQuery('.plus-icon').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom',
        zoom: {
            enabled: true,
            duration: 300,
            easing: 'ease-in-out',
            opener: function (openerElement) {
                return openerElement.next('img') ? openerElement : openerElement.find('img');
            }
        },
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
        }

    });
    jQuery('.plus-icon').on('click', function () {
        jQuery('html').css('overflow', 'inherit');
    });	

	/* --------------------------------------
	*		Shortcode hover color effect 
	*  -------------------------------------- */
	var clr = '';
	var clr_bg = '';
	jQuery(".thm-color").on({
	    mouseenter: function () {
	     	clr = jQuery(this).css('color');
			clr_bg = jQuery(this).css('backgroundColor');
			jQuery(this).css("color", jQuery(this).data("hover-color"));
			jQuery(this).css("background-color", jQuery(this).data("hover-bg-color"));
	    },
	    mouseleave: function () {
	        jQuery(this).css("color", clr );
			jQuery(this).css("background-color", clr_bg );
	    }
	});


	/* --------------------------------------
	*		Header Search
	*  ------------------------------------*/
	jQuery('.search_button').on('click', function(event){
		event.preventDefault();
		jQuery(this).parents('body')
		.find('.dc-search-modal-outer').fadeToggle()
			.find('.searchfield').focus();
		jQuery(this).parents('html').css('overflow', 'hidden');		
	});
	jQuery('.dc-search-modal-close').on('click', function(event){
		event.preventDefault();
		jQuery(this).parents('.dc-search-modal-outer').fadeToggle();
		jQuery(this).parents('html').removeAttr('style');
	})

	/* --------------------------------------
	*		Masonry Isotope
	*  ------------------------------------*/
	jQuery('.masonry-element').isotope({
  		// options
  		itemSelector: '.masonry-item',
  		columnWidth: '.masonry-item',
  		percentPosition: true,
	});

	jQuery('.grid-element').isotope({
  		itemSelector: '.grid-item',
  		layoutMode: 'fitRows',
	})

	if ( jQuery('.portfolio-item').hasClass('flat_grid_layout') ) {
    	//jQuery( 'div.content-wrapper' ).each( function() {
    	    jQuery( 'div.content-wrapper' ).hoverdir();
    	//} );
	} // /hoverdir

	/* --------------------------------------
	*		Portfolio Gallery Slide
	*  ------------------------------------*/
	jQuery('#portfolio_thumb').flexslider({
    	animation: "slide",
    	controlNav: false,
    	animationLoop: false,
    	slideshow: false,
    	itemWidth: 210,
    	itemMargin: 5,
    	asNavFor: '#portfolio_gallery'
  	});
 
  	jQuery('#portfolio_gallery').flexslider({
    	animation: "slide",
    	controlNav: false,
    	animationLoop: false,
    	slideshow: false,
    	directionNav: false,
    	sync: "#portfolio_thumb"
  	});


  	jQuery('.featured-inner-image').magnificPopup({
  		type: 'image'
	});


	/* --------------------------------------
	*		Image Hover
	*  ------------------------------------*/
	jQuery('div.featured-cover').mouseenter( function () {
		jQuery(this).parent().find('img.img-responsive').addClass('active');
	});
	jQuery('div.featured-cover').mouseleave( function () {
		jQuery(this).parent().find('img.img-responsive').removeClass('active');
	});


	// filter items when filter link is clicked
	var $container = jQuery('.content-filter');

    jQuery('.adeetheming-filter a').click(function(){
        
        var selector = jQuery(this).attr('data-filter');
        $container.isotope({ filter: selector, animationEngine : "css" });
        jQuery('.adeetheming-filter a.active').removeClass('active');
        jQuery(this).addClass('active');
        return false;
 
    });
		

	//event counter 2
	loopcounter('counter-class');


	/* --------------------------------------
	*		WooCommerce
	*  ------------------------------------*/
	jQuery('<div class="qtycontrol"><div class="qtybutton quantity-up">+</div><div class="qtybutton quantity-down">-</div></div>')
	.insertAfter('.woocommerce-page #content .quantity input');
    
    jQuery('.woocommerce-page #content .quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if ((max != '') && (oldValue >= max)) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("click");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("click");
      });

    });



});

jQuery.noConflict();