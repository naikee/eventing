jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(dc_loadmore.startPage) + 1;
	
	// The maximum number of pages the current query can return.
	var max = parseInt(dc_loadmore.maxPages);
	
	// The link of the next page of posts.
	var nextLink = dc_loadmore.nextPage;

	var postType = dc_loadmore.postType;

	var aTag = $('article');
	
	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(pageNum <= max) {
		// Insert the "More Posts" link.
		$('#content')
			.append('<div class="dc-loadmore dc-loadmore-placeholder-'+ pageNum +'"></div>')
			.append('<p id="dc-loadmore-load-posts"><a href="#">Load More</a></p>');
			
		// Remove the traditional navigation.
		//$('.navigation').remove();
	}
	
	
	/**
	 * Load new posts when the link is clicked.
	 */
	$('#dc-loadmore-load-posts a').click(function() {
	
		// Are there more posts to load?
		if(pageNum <= max) {
		
			// Show that we're working.
			$(this).text('Loading ' + postType + '...');
			
			$('.dc-loadmore-placeholder-'+ pageNum).load(nextLink + ' .' + postType,
				function() {
					// Update page number and nextLink.
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
					

					$('.dc-loadmore-placeholder-'+ (pageNum - 1) +' article').unwrap();

					$('article').appendTo('.loadmore-element');

					if ($('.loadmore-element').hasClass('loadmore-masonry')) {
						$('.loadmore-masonry').isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });

						// Add a new placeholder, for when user clicks again.
						$('#dc-loadmore-load-posts')
							.before('<div class=".dc-loadmore dc-loadmore-placeholder-'+ pageNum +'"></div>')
						
						// Update the button message.
						if(pageNum <= max) {
							$('#dc-loadmore-load-posts a').text('Load More');
						} else {
							$('#dc-loadmore-load-posts a').text('No more ' + postType + ' to load.');
						}
					} else {

						// Add a new placeholder, for when user clicks again.
						$('#dc-loadmore-load-posts')
							.before('<div class=".dc-loadmore dc-loadmore-placeholder-'+ pageNum +'"></div>')
						
						// Update the button message.
						if(pageNum <= max) {
							$('#dc-loadmore-load-posts a').text('Load More');
						} else {
							$('#dc-loadmore-load-posts a').text('No more ' + postType + ' to load.');
						}
						}

					$('.loadmore-element').imagesLoaded().progress( function() {
  						$('.loadmore-element').isotope('layout');
					});

					jQuery('div.featured-cover').mouseenter( function () {
						jQuery(this).parent().find('img.img-responsive').addClass('active');
					});
					jQuery('div.featured-cover').mouseleave( function () {
						jQuery(this).parent().find('img.img-responsive').removeClass('active');
					});

					if ( jQuery('.portfolio-item').hasClass('flat_grid_layout') ) {
    	    			jQuery( 'div.content-wrapper' ).hoverdir();
    					//} );
					} // /hoverdir

				}
			)
		} else {
			$('#dc-loadmore-load-posts a').append();
		}

		
		
		return false;
	});

});