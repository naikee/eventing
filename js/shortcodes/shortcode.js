(function($) {
	
	"use strict";
	
	$(document).ready(function(e) {

		/*-----------------------------------
		*       Accordion
		*----------------------------------*/
		jQuery('.dc-sc-accordion').each( function() {

			var acc = $(this);
			var accCover = acc.find('.accordion_cover');
			var active = parseInt(accCover.data('active') - 1);

			accCover.find('.accordion-item-wrap:eq(' +active+ ')').addClass('active');

			$('.accordion-title-wrap').click( function() {
				$(this).parent().siblings().removeClass('active');
				$(this).parent().addClass('active');
			});
		});

		/*-----------------------------------
		*       Alert
		*----------------------------------*/
		jQuery('.alert_del_wrap').each( function() {
			$(this).click( function() {
				$(this).parent().fadeOut();
			});
		});


		/*-----------------------------------
		*       Audio
		*----------------------------------*/
		jQuery('.dc-open-audio').magnificPopup({
			type: 'inline',
			preloader: false,
			focus: '#username',
			showCloseBtn: true
		});


		/*-----------------------------------
		*       Blog Carousel
		*----------------------------------*/
		jQuery('.dc-sc-blogslide .blogslide_element').each(function() {

			var blogSlideTime = parseInt($(this).data('time'));

			var blogPause = parseInt($(this).data('pause'));

			var prevBlog = $(this).closest('.dc-sc-blogslide').find('.prev-blogslide');

			var nextBlog = $(this).closest('.dc-sc-blogslide').find('.next-blogslide');

			$(this).carouFredSel({
				responsive : true,
				prev : prevBlog,
				next : nextBlog,
				scroll : 1,
				items : {
					width : 280,
					visible : {
						min : 1,
						max : 3,
					}
				},
				auto : {
					pauseOnHover : blogPause ? true : false,
					play : (blogSlideTime > 0) ? true : false,
					timeoutDuration : blogSlideTime ? blogSlideTime : 3000,
				},
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
		});


		/* --------------------------------------
		*		Blog Gallery Slide
		*  ------------------------------------*/
		jQuery('.dc-sc-blogmagslide').each(function() {
			
			jQuery('.blogmagthumb-wrapper').flexslider({
    			animation: "slide",
    			controlNav: false,
    			animationLoop: true,
    			slideshow: false,
    			itemWidth: 180,
    			itemMargin: 5,
    			asNavFor: '.blogmaggallery-wrapper'
  			});
 
  			jQuery('.blogmaggallery-wrapper').flexslider({
    			animation: "slide",
    			controlNav: false,
    			animationLoop: true,
    			slideshow: true,
    			directionNav: false,
    			pauseOnHover: true,
    			sync: ".blogmagthumb-wrapper"
  			});
		});


		/*-----------------------------------
		*       Chart
		*----------------------------------*/
		jQuery('.dc-chart-track').waypoint({
			offset		: function() {
				return Waypoint.viewportHeight() - 100
			},
			triggerOnce : true,
			handler : function() {

				var bar_Color = $(this).data('bar-color');
				var	track_Color = $(this).data('track-color');
				var	line_Width = parseInt($(this).data('line-width'));

				$('.dc-chart-track').easyPieChart({
					animate : 2000,
					lineWidth : line_Width,
					lineCap : 'round',
					barColor : bar_Color,
					trackColor : track_Color,
					size : 200,
					scaleColor : false
				});
			}
		});



		/*-----------------------------------
		*       Client Carousel
		*----------------------------------*/
		jQuery('.clients-slide .slide-element').each(function() {

			var clientSlideTime = parseInt($(this).data('time'));

			var clientPause = parseInt($(this).data('pause'));

			var prevClient = $(this).parent().find('.prev-client');

			var nextClient = $(this).parent().find('.next-client');

			$(this).carouFredSel({
				responsive : true,
				prev : prevClient,
				next : nextClient,
				scroll : 1,
				items : {
					width : 280,
					visible : {
						min : 1,
						max : 5,
					}
				},
				auto : {
					pauseOnHover : clientPause ? true : false,
					play : (clientSlideTime > 0) ? true : false,
					timeoutDuration : clientSlideTime ? clientSlideTime : 3000,
				},
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
		});


		/*-----------------------------------
		*       Counter
		*----------------------------------*/
		jQuery( '.count-number' ).waypoint( {
			offset: function() {
				return Waypoint.viewportHeight() - 100
			},
			handler: function() {
				$(this.element).countTo();
				this.destroy()
			}
		} );


		/*-----------------------------------
		*       Countdown
		*----------------------------------*/
		jQuery('.countdown-clock').each( function() {
			var self = $(this);
			var countdown = new Date(self.data('countdown')).getTime();
			var days = self.find('.days-dc .count-dc');
			var hours = self.find('.hours-dc .count-dc');
			var mins = self.find('.minutes-dc .count-dc');
			var secs = self.find('.seconds-dc .count-dc');
			var getCountdown = function() {
				var current = new Date().getTime();

				var period = countdown - current;

				days.text(("0" + Math.floor(period / (1000 * 60 * 60 * 24))).slice(-2));

				hours.text(("0" + Math.floor(period % (1000 * 60 * 60 * 24) / (1000 * 60 * 60))).slice(-2));

				mins.text(("0" + Math.floor(period % (1000 * 60 * 60) / (1000 * 60))).slice(-2));

				secs.text(("0" + Math.floor(period % (1000 * 60) / (1000))).slice(-2));

				if (current >= countdown) {
					clearInterval(timer);

					current = countdown;

					period = countdown - countdown;

					days.text(("0" + Math.floor(period / (1000 * 60 * 60 * 24))).slice(-2));

					hours.text(("0" + Math.floor(period % (1000 * 60 * 60 * 24) / (1000 * 60 * 60))).slice(-2));

					mins.text(("0" + Math.floor(period % (1000 * 60 * 60) / (1000 * 60))).slice(-2));

					secs.text(("0" + Math.floor(period % (1000 * 60) / (1000))).slice(-2));
				}
			};

			var timer = setInterval(getCountdown, 1000);
		});

		jQuery('.countdown-clock-wrap').each( function() {
			var self = $(this);
			var countdown = new Date(self.find('.countdown-datetime').data('countdowndate')).getTime();
			var current = new Date().getTime();
			var diff = countdown/1000 - current/1000;

			if(current >= countdown) {
				diff = countdown - countdown;
			}
			function dateDiff(first, second) {
				return Math.round((second-first)/(1000*60*60*24));
			}
			if(dateDiff(countdown, current) > 99) {
				self.find('.countdown-datetime').addClass('countdown-extra');
			}
			var countdownClock = self.find('.countdown-datetime').FlipClock(diff, {
				clockFace : 'DailyCounter',
				countdown : true,
				autoStart : true,
			})
		});


		/*-----------------------------------
		*       FAQ
		*----------------------------------*/
		jQuery('.dc-sc-faq').each( function() {

			var faq = $(this);
			var faqControl = faq.find('.faq-title-tab');

			faqControl.click( function(event) {

				event.preventDefault();

				$(this).siblings().removeClass('active');
				$(this).addClass('active');

				var index = $(this).index();

				faq.find('.faq-content-wrap').removeClass('active');
				faq.find('.faq-content-wrap:eq(' + index + ')').addClass('active');
			});
		});

		jQuery('.faq-content-wrap').each( function() {

			var faqContent = $(this);

			if (faqContent.hasClass('activateall')) {
				faqContent.find('.faq-item-wrap').addClass('faq-active');
			}
		});

		$('.faq-item-title').click( function() {
			if ($(this).parent().hasClass('faq-active')) {
				$(this).parent().removeClass('faq-active');
			} else {
				$(this).parent().addClass('faq-active');
			}
		});


		/*-----------------------------------
		*       Portfolio Carousel
		*----------------------------------*/
		jQuery('.dc-sc-portfolioslide .portfolioslide_element').each(function() {

			var portfolioSlideTime = parseInt($(this).data('time'));

			var portfolioPause = parseInt($(this).data('pause'));

			var nextPortfolio = $(this).closest('.dc-sc-portfolioslide').find('.prev-portfolio');

			var prevPortfolio = $(this).closest('.dc-sc-portfolioslide').find('.next-portfolio');

			$(this).carouFredSel({
				responsive : true,
				prev : prevPortfolio,
				next : nextPortfolio,
				scroll : 1,
				items : {
					width : 280,
					visible : {
						min : 1,
						max : 3,
					}
				},
				auto : {
					pauseOnHover : portfolioPause ? true : false,
					play : (portfolioSlideTime > 0) ? true : false,
					timeoutDuration : portfolioSlideTime ? portfolioSlideTime : 3000,
				},
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
		});


		/*-----------------------------------
		*       Progress Bar
		*----------------------------------*/
		jQuery('.progress-bar').waypoint({
			offset		: function() {
				return Waypoint.viewportHeight() - 100
			},
			handler		: function(){
				jQuery('[data-toggle="tooltip"]').each(function() {
					jQuery(this).tooltip({trigger: 'manual'}).tooltip('show');
				});

				var each_bar_width = '';
				jQuery(this.element).each(function(){
    				each_bar_width = jQuery(this).attr('aria-valuenow');
    				jQuery(this).width(each_bar_width + '%');
  				});
  				this.destroy()
			}
		});


		/*-----------------------------------
		*       Shop Carousel
		*----------------------------------*/
		jQuery('.dc-shop-slide .product-carousel').each(function() {

			var shopSlideTime = parseInt($(this).data('time'));

			var shopPause = parseInt($(this).data('pause'));

			var prevProd = $(this).parent().find('.prev-shop');

			var nextProd = $(this).parent().find('.next-shop');

			$(this).carouFredSel({
				responsive : true,
				prev : prevProd,
				next : nextProd,
				scroll : 1,
				items : {
					width : 350,
					visible : {
						min : 1,
						max : 3,
					}
				},
				auto : {
					pauseOnHover : shopPause ? true : false,
					play : (shopSlideTime > 0) ? true : false,
					timeoutDuration : shopSlideTime ? shopSlideTime : 3000,
				},
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
		});


		/*-----------------------------------
		*       Tabs
		*----------------------------------*/
		jQuery('.dc-sc-tabs').each( function() {

			var tabs = $(this);
			var tabsControl = tabs.find('.tab-title-list');

			tabsControl.click( function(event) {

				event.preventDefault();

				$(this).siblings().removeClass('active');
				$(this).addClass('active');

				var index = $(this).index();

				tabs.find('.tab-content').removeClass('active');
				tabs.find('.tab-content:eq(' + index + ')').addClass('active');
			});
		});

		/*-----------------------------------
		*       Team Member
		*----------------------------------*/
		jQuery('.show-bio .team-inner-wrap, .show-bio .member-name').each(function() {
			$(this).click(function(e){
  				e.preventDefault();
  				var teams = $(this).closest('.teamsbrief-wrapper');
  				teams.hide();
  				$(this).parents('.show-bio').addClass('member-show');
  				var locate_member = $(this).parent().attr('href');
  				$(locate_member).addClass('active');
  			});

  			jQuery('.team-bio-wrap .close').each(function() {
  				$(this).click(function(e){
    				e.preventDefault();
    				$(this).parent().removeClass('active').parents('.show-bio').removeClass('member-show').find('.teamsbrief-wrapper').fadeIn();
    			});
  			});

  			jQuery('.teams-slide .teamsbrief-ul').each(function() {

				var teamsSlideTime = parseInt($(this).data('time'));

				var teamsPause = parseInt($(this).data('pause'));

				var prevTeam = $(this).closest('.teams-slide').find('.prev-team');

				var nextTeam = $(this).closest('.teams-slide').find('.next-team');

				$(this).carouFredSel({
					responsive : true,
					prev : prevTeam,
					next : nextTeam,
					scroll : 1,
					items : {
						width : 350,
						visible : {
							min : 1,
							max : 3,
						}
					},
					auto : {
						pauseOnHover : teamsPause ? true : false,
						play : (teamsSlideTime > 0) ? true : false,
						timeoutDuration : teamsSlideTime ? teamsSlideTime : 3000,
					},
					mousewheel: true,
					swipe: {
						onMouse: true,
						onTouch: true
					}
				});
		});
  		});


		/*-----------------------------------
		*       Testimonials Slider
		*----------------------------------*/
		jQuery('.testimonial-slide .slide-element').each(function() {

			var testimonialSlide = parseInt($(this).data('time'));

			var testPause = parseInt($(this).data('pause'));

			var prevTestimonial = $(this).parent().find('.prev-testimonial');

			var nextTestimonial = $(this).parent().find('.next-testimonial');

			$(this).carouFredSel({
				responsive : true,
				prev : prevTestimonial,
				next : nextTestimonial,
				scroll : 1,
				items : {
					width : 100,
					visible : 1,
				},
				auto : {
					pauseOnHover : testPause ? true : false,
					play : (testimonialSlide > 0) ? true : false,
					timeoutDuration : testimonialSlide ? testimonialSlide : 6000,
				},
				scroll		: {
					duration	: 500,
					easing		: 'swing'
				},
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
		});

		/*-----------------------------------
		*       Timeline
		*----------------------------------*/
		jQuery('.dc-timeline-item').each( function() {
			if ($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
				$(this).find('.timeline-icon-wrap, .timeline-date, .timeline-box').addClass('is-hidden');
			}
		});

		jQuery(window).on('scroll', function() {
			$('.dc-timeline-item').each( function() {
				if ($(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.timeline-date, .timeline-box').hasClass('is-hidden')) {
					$(this).find('.timeline-icon-wrap, .timeline-date, .timeline-box')
					.removeClass('is-hidden')
					.addClass('bounce-in');
				}
			});
		});

		/*-----------------------------------
		*       Toggle
		*----------------------------------*/
		jQuery('.dc-sc-toggle').each( function() {

			var tog = $(this);
			var togCover = tog.find('.toggle_cover');

			if (tog.hasClass('activateall')) {
				tog.find('.toggle-item-wrap').addClass('active');
			}
		});

		$('.toggle-title-wrap').click( function() {
			if ($(this).parent().hasClass('active')) {
				$(this).parent().removeClass('active');
			} else {
				$(this).parent().addClass('active');
			}
		});

		/*-----------------------------------
		*       Tooltip & Popover
		*----------------------------------*/
		jQuery('body').tooltip({
			selector : "[data-toggle='tooltip']",
			container : "body",
			html : true
		});

		jQuery('body').popover({
			selector : "[data-toggle='popover']",
			container : "body",
			html : true
		});


		/*-----------------------------------
		*       Video
		*----------------------------------*/
		jQuery('.dc-open-video').magnificPopup({
			type: 'inline',
			preloader: false,
			focus: '#username',
			showCloseBtn: true
		});

	});
	
	
})(jQuery);

