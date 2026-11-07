<?php 
global $adeetheming_options, $post;

$prefix = 'adee_';

$sidebar = $sidebar_layout = '';


if ( get_post_type() == 'page') {

	$sidebar = get_post_meta($post->ID, $prefix . 'left_sidebar', true);
	if( ($sidebar === '') || ($sidebar == '-1') )
		$sidebar = $adeetheming_options['single-page_sidebar'];

	$sidebar_layout = get_post_meta($post->ID, $prefix . 'page_sidebar', true);
	if ( ($sidebar_layout === '') || ($sidebar_layout == '-1') || ($sidebar_layout == 'default') ) {
		$sidebar_layout = $adeetheming_options['pages_sidebar_layout'];
	}
}
elseif ( get_post_type() == 'post' && is_single() ) {
	
	$sidebar = get_post_meta($post->ID, $prefix . 'left_sidebar', true);
	if( ($sidebar === '') || ($sidebar == '-1') )
		$sidebar = $adeetheming_options['single-post_sidebar'];

	$sidebar_layout = get_post_meta($post->ID, $prefix . 'page_sidebar', true);
	if ( ($sidebar_layout === '') || ($sidebar_layout == '-1') || ($sidebar_layout === 'default') ) {
		$sidebar_layout = $adeetheming_options['post_sidebar_layout'];
	}
}
elseif ( get_post_type() == 'portfolio' && is_single() ) {

	$sidebar = get_post_meta($post->ID, $prefix . 'left_sidebar', true);
	if( ($sidebar === '') || ($sidebar == '-1') )
		$sidebar = $adeetheming_options['single-portfolio_sidebar'];

	$sidebar_layout = get_post_meta($post->ID, $prefix . 'page_sidebar', true);
	if ( ($sidebar_layout === '') || ($sidebar_layout == '-1') || ($sidebar_layout === 'default') ) {
		$sidebar_layout = $adeetheming_options['portfolio_sidebar_layout'];
	}

}

$sidebars_width = get_post_meta($post->ID, $prefix . 'sidebars_width', true);
if( ($sidebars_width === '') || ($sidebars_width == '-1') )
	$sidebars_width = $adeetheming_options['sidebars_width'];

if( ($sidebars_width === '') || ($sidebars_width == '-1') )
	$sidebars_width = 4;

//#Content and #Sidebar Custom Page Padding
$toppad = get_post_meta($post->ID, $prefix . 'top_padding', true);
$bottompad = get_post_meta($post->ID, $prefix . 'top_padding', true);
$contentpad = '';
if (! empty($toppad) || ! empty($bottompad)) {
	$contentpad = array();
	if($toppad) $contentpad[] = 'padding-top: ' .$toppad. ';';
	if($bottompad) $contentpad[] = 'padding-bottom: ' .$bottompad. ';';

	$contentpad = 'style="' .implode(' ', $contentpad). '"';
}

if ($sidebar_layout == 'disabled' ) {
	//do nothing.
}
else { ?>

	<div id="sidebar" class="col-sm-<?php echo esc_attr($sidebars_width) . ' pull-' . esc_attr($sidebar_layout); ?> sidebar-content" role="complementary" <?php echo $contentpad; ?>>
    	<aside class="widget-area">
        	<?php 
	    	    if ( is_active_sidebar( $sidebar ) ) {
	    	    	dynamic_sidebar( $sidebar );
	    	    }
        	 ?>
    	</aside>
	</div>

<?php } ?>