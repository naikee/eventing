<?php global $adeetheming_options;
	$classes = array();

	$prefix = 'adee_';

	$classes[] = 'portfolio-item';
	
	$classes[] = $adeetheming_options['portfolio_layout'];
	if ($adeetheming_options['portfolio_layout'] == 'masonry_layout' || $adeetheming_options['portfolio_layout'] == 'flat_masonry_layout') {
		$classes[] = 'masonry-item';
	} elseif ($adeetheming_options['portfolio_layout'] == 'grid_layout' || $adeetheming_options['portfolio_layout'] == 'flat_grid_layout') {
		$classes[] = 'grid-item';
	}

	$terms = get_the_terms($post->ID, 'portfolio-category');

    if ($terms && ! is_wp_error($terms)) {
        $links = array();
        $catlist = '';

        foreach ($terms as $term) {
            $links[] = $term->slug;
            $catlist .= '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>, ';
        }

        $tax = join(' ', $links);

        $catlist = rtrim($catlist, ', ');
    } else {
        $tax = '';
    }

    $classes[] = $tax;

	$thumb   = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url( $thumb,'full');
	
	switch ($adeetheming_options['portfolio_layout']) {
		case 'list_layout':
			$image   = aq_resize( $img_url, 760, 480, true, true, true );
			break;

		case 'full_image_layout':
			$image   = aq_resize( $img_url, 1140, 520, true,true, true );
			break;

		case 'grid_layout':
		case 'flat_grid_layout':
			$image   = aq_resize( $img_url, 760, 480, true, true, true );
			break;
		
		default:
			$image   = aq_resize( $img_url, 760, 350, true, true, true );
			break;
	}

	$client = get_post_meta(get_the_ID(), $prefix . 'portfolio_client', true);
	$url = get_post_meta(get_the_ID(), $prefix . 'portfolio_client_url', true);
	$target = get_post_meta(get_the_ID(), $prefix . 'portfolio_url_target', true);
?>
<article id="portfolio-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<?php if (!is_single()) { ?>
		<?php if ( has_post_thumbnail() ){
				$col = 'has-thumb';
			}else {
				$col = 'no-thumb';
			} 
		?>
			
			<?php if ($adeetheming_options['portfolio_layout'] != 'flat_grid_layout' && $adeetheming_options['portfolio_layout'] != 'flat_masonry_layout') : ?>
				<div class="content-wrapper">
					<div class="portfolio-intro-wrap">
						<?php if (isset($adeetheming_options['portfolio-date']) && $adeetheming_options['portfolio-date'] && has_post_thumbnail() ) { ?>
							<div class="entry-calender">
            					<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            					<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            					<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            					<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            				</div>  
        				<?php }?>
					</div>
	    			<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
	    	    		<div class="featured-wrapper <?php echo $col;?>">
	        				<a href="<?php the_permalink(); ?>" rel="bookmark">
	        					<?php if ($adeetheming_options['portfolio_layout'] == 'masonry_layout') {
	        						the_post_thumbnail('full', array('class' => 'img-responsive'));
	        					} else { ?>
	        						<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        					<?php } ?>
	            				<div class="featured-cover"></div>
	        				</a>
	        			</div>
	    			<?php } ?>
					<div class="content-details <?php echo $col;?>">
		    			<?php get_template_part( 'templates/portfolio/entry-content' ); ?> 
					</div>
				</div>
			<?php else : ?>
					<div class="content-wrapper featured-wrapper <?php echo $col;?>">
						<?php if ($adeetheming_options['portfolio_layout'] == 'flat_masonry_layout') {
	        				the_post_thumbnail('full', array('class' => 'img-responsive'));
	        			} else { ?>
	        				<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        			<?php } ?>
	        			<div class="image-outer-hover">
	        				<div class="image-hover-wrapper">
	        					<div class="image-inner-wrapper">
	        						<h4 class="entry-title-hover"><a href="<?php the_permalink(); ?>" rel="bookmark">
	        							<?php if (strlen($post->post_title) > 40) {
											echo substr(the_title($before = '', $after = '', FALSE), 0, 40) . '...'; } 
										else {
											the_title();
										} ?></a>
									</h4>
	        						<?php if($client) : ?>
	        							<div class="entry-client-hover"><i class="fa fa-handshake-o"></i> <span class="client-span"><?php echo esc_attr($client); ?></span></div>
	        						<?php endif; ?>
	        						<?php if (isset($adeetheming_options['portfolio-category']) && $adeetheming_options['portfolio-category'] ) : ?>
        								<div class="category"><i class="fa fa-folder-open-o"></i><ul class="category-list"><?php echo wp_kses_post($catlist); ?></ul></div>
        							<?php endif; ?>
        							<a href="<?php the_post_thumbnail_url(); ?>" class="featured-inner-image" rel="bookmark"><i class="fa fa-camera"></i></a>
        							<?php if ($url) : ?>
        								<a href="<?php echo esc_attr($url); ?>" target="<?php if($target) echo '_blank' ?>"><i class="fa fa-external-link"></i></a>
        							<?php endif; ?>
        							<a href="<?php the_permalink(); ?>" class="entry-project-link" rel="bookmark"><i class="fa fa-link"></i></a>
	        					</div>
	        				</div>
	        			</div>
					</div>
			<?php endif; ?>
	<?php }  ?>
</article> <!--/#post-->