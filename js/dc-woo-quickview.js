jQuery(document).ready(function ($) {
	'use strict';

	var modal 		= $('.dc-quickview-modal-outer'),
		container	= $(modal).children('.dc-quickview-modal-container'),
		close 		= $(modal).find('.dc-quickview-modal-close'),
		contentwrap	= $(modal).find('.dc-quickview-content');
	

	//FlexSlider
	function initFlexslider() {
		var $images = $('.single-product-image .woocommerce-product-gallery__image'),
			$target = $('.single-product-image .woocommerce-product-gallery');

		$target.flexslider( {
			selector:       '.woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image',
			animation:      'slide',
			smoothHeight:   false,
			directionNav:   false,
			controlNav:     'thumbnails',
			slideshow:      false,
			animationSpeed: 500,
			animationLoop:  false, // Breaks photoswipe pagination if true.
			start: function() {
				$target.css( 'opacity', 1 );
			},
		} );

		// Trigger resize after main image loads to ensure correct gallery size.
		$( '.woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:eq(0) .wp-post-image' ).one( 'load', function() {
			var $image = $( this );

			if ( $image ) {
				setTimeout( function() {
					var setHeight = $image.closest( '.woocommerce-product-gallery__image' ).height();
					var $viewport = $image.closest( '.flex-viewport' );

					if ( setHeight && $viewport ) {
						$viewport.height( setHeight );
					}
				}, 100 );
			}
		} ).each( function() {
			if ( this.complete ) {
				$( this ).load();
			}
		} );
	};

	//Photoswipe
	function initPhotoswipe() {
		var $images = $('.single-product-image .woocommerce-product-gallery__image'),
			$target = $('.single-product-image .woocommerce-product-gallery');

		if ( $images.length > 0 ) {
			$target.prepend( '<a href="#" class="woocommerce-product-gallery__trigger">🔍</a>' );
			$target.on( 'click', '.woocommerce-product-gallery__trigger', function(e){openPhotoswipe(e)} );
		}
		$target.on( 'click', '.woocommerce-product-gallery__image a', function(e){openPhotoswipe(e)} );
	};

	//Open Photoswipe
	function openPhotoswipe( e ) {
		e.preventDefault();

		var pswpElement = $( '.pswp' )[0],
			items       = getGalleryItems(),
			eventTarget = $( e.target ),
			target = $('.single-product-image .woocommerce-product-gallery'),
			clicked;

		if ( ! eventTarget.is( '.woocommerce-product-gallery__trigger' ) ) {
			clicked = eventTarget.closest( '.woocommerce-product-gallery__image' );
		} else {
			clicked = target.find( '.flex-active-slide' );
		}

		var options = {
			index:                 $( clicked ).index(),
			shareEl:               false,
			closeOnScroll:         false,
			history:               false,
			hideAnimationDuration: 0,
			showAnimationDuration: 0
		};

		// Initializes and opens PhotoSwipe.
		var photoswipe = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options );
		photoswipe.init();
	};

	//Get Gallery Items
	function getGalleryItems() {
		var $slides = $('.single-product-image .woocommerce-product-gallery__image'),
			items   = [];

		if ( $slides.length > 0 ) {
			$slides.each( function( i, el ) {
				var img = $( el ).find( 'img' ),
					large_image_src = img.attr( 'data-large_image' ),
					large_image_w   = img.attr( 'data-large_image_width' ),
					large_image_h   = img.attr( 'data-large_image_height' ),
					item            = {
						src  : large_image_src,
						w    : large_image_w,
						h    : large_image_h,
						title: img.attr( 'data-caption' ) ? img.attr( 'data-caption' ) : img.attr( 'title' )
					};
				items.push( item );
			} );
		}

		return items;
	};

	function initZoom(){
		$( '.woocommerce-product-gallery__image').zoom();
	}

	//Product quantity
	function qtyControl() {
		$('<div class="qtycontrol"><div class="qtybutton quantity-up">+</div><div class="qtybutton quantity-down">-</div></div>')
		.insertAfter('.woocommerce-page #dc-quickview-content .quantity input');
    
    	jQuery('.woocommerce-page #dc-quickview-content .quantity').each(function() {
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
    }


	function initExtension() {
		initFlexslider();
		initPhotoswipe();
		initZoom();
		qtyControl();
	};

	//Display Main Product
	$(document).on('click', '.dc_quickview_anchor', function() {
		event.preventDefault();

		$(this).children('.dc_quickview_ajaxload').addClass('active');

		var product_id = $(this).data('product-id');
		dc_woo_show_quickview(product_id);
	});

	//Display Previous Product
	$(document).on('click', '.quickview-prev-product', function() {
		event.preventDefault();

		var product_id = $(this).data('prev-product');
		dc_woo_show_quickview(product_id);
	});

	//Display Next Product
	$(document).on('click', '.quickview-next-product', function() {
		event.preventDefault();

		var product_id = $(this).data('next-product');
		dc_woo_show_quickview(product_id);
	});

	//Close QuickView Modal
	$(document).on('click', '.dc-quickview-modal-close', function() {
		event.preventDefault();

		$(this).parents('.dc-quickview-modal-outer').fadeOut();
		$(this).parents('html').removeAttr('style');
	})

  	/* --------------------------------------
	*		QuickView Ajax Function
	*  ------------------------------------*/
	function dc_woo_show_quickview(product_id) {
		if (product_id !== undefined ) {

			jQuery.ajax({
				type	: 'POST',
				url		: dc_woo_quickview_obj.ajaxurl,
				data	: {
					action		: 'dc_products_detail',
					product_id 	: product_id
				},
				dataType : 'json',
				success	: function(data) {

					$('#dc-quickview-content').html(data);
					$('.dc_quickview_ajaxload').removeClass('active');
					modal.css('display','block');
					modal.parents('html').css('overflow', 'hidden');
					$('#dc-quickview-content').find('.woocommerce-product-gallery')
					.css('opacity', 1);
					initExtension();
				}
			});
		}
	}
})