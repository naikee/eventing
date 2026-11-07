<?php global $adeetheming_options;
	$classes = array();
	$classes[] = $adeetheming_options['blogpost_layout'];
	if ($adeetheming_options['blogpost_layout'] == 'masonry_layout') {
		$classes[] = 'masonry-item';
	} elseif ($adeetheming_options['blogpost_layout'] == 'grid_layout') {
		$classes[] = 'grid-item';
	}

	$thumb   = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url( $thumb,'full');
	
	switch ($adeetheming_options['blogpost_layout']) {
		case 'list_layout':
			$image   = aq_resize( $img_url, 760, 480, true, true, true );
			break;

		case 'full_image_layout':
			$image   = aq_resize( $img_url, 1140, 520, true, true, true );
			break;

		case 'grid_layout':
			$image   = aq_resize( $img_url, 760, 480, true, true, true );
			break;
		
		default:
			$image   = aq_resize( $img_url, 760, 350, true, true, true );
			break;
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<?php if (!is_single()) { ?>
		<?php if ( has_post_thumbnail() ){
				$col = 'has-thumb';
			}else {
				$col = 'no-thumb';
			} ?>
			<div class="post-intro-wrap hidden-xs">
				<span class="post-icon"><i class="fa fa-file-text"></i></span>
				<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
					<div class="entry-calender">
            			<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            			<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            			<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            			<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            		</div>  
        		<?php }?>   
  			
			</div>
			<div class="content-wrapper">
	    		<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
	        		<div class="featured-wrapper <?php echo $col;?>"><a href="<?php the_permalink(); ?>" rel="bookmark">
	        		    <?php if ($adeetheming_options['blogpost_layout'] == 'masonry_layout') {
	        				the_post_thumbnail('full', array('class' => 'img-responsive'));
	        			} else { ?>
	        				<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        			<?php } ?>
	        		    <div class="featured-cover"></div>
	        		</a></div>
	    		<?php } ?>
				<div class="content-details <?php echo $col;?>">
		    		<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
				</div>
			</div>
	<?php } else { ?>
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="featured-wrap"><a href="<?php the_post_thumbnail_url(); ?>" class="featured-inner-image" rel="bookmark">
            <?php the_post_thumbnail('blog-medium', array('class' => 'img-responsive')); ?>
        </a></div>
    <?php } ?>
    	<?php if (!is_single()) { ?>
		<span class="post-icon"><i class="fa fa-file-text"></i></span>
		<?php }  ?>
	    <?php get_template_part( 'templates/post-format/entry-content' ); ?> 

	<?php }  ?>
</article> <!--/#post-->