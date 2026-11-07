<?php global $adeetheming_options;
	$classes = array();
	$classes[] = $adeetheming_options['portfolio_layout'];
	if ($adeetheming_options['portfolio_layout'] == 'masonry_layout') {
		$classes[] = 'masonry-item';
	}

	$prefix = 'adee_';

	$images = get_post_meta( $post->ID, $prefix . 'portfolio_gallery' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<?php if ( is_single()) { ?>
    	
        <?php if (!is_single()) { ?>
			<span class="post-icon"><i class="fa fa-thumb-tack"></i></span>
		<?php }  ?>
	    <?php get_template_part( 'templates/portfolio/entry-content' ); ?> 
	<?php }  ?>
</article> <!--/#post-->