<?php 
global $adeetheming_options;
$prefix = 'adee_';

$disable = get_post_meta(get_the_ID(), $prefix . 'disable_subheader', true);

$revslide = get_post_meta(get_the_ID(), $prefix . 'revslider_type', true);
if ( isset($revslide) && $revslide != '' ) { ?>
	<div class="sub-slider sub-revsliders">
		<?php echo do_shortcode('[rev_slider ' . $revslide . ']') ?>
	</div>
<?php } else {

	if (!is_front_page() && $adeetheming_options['subheader_enable'] == true ) { 
		if( isset($disable) && $disable != 1) {?>

			<div class="sub-title sub-title-breadcrumb">
		    	<div class="container">
        			<div class="sub-title-inner">
        	    		<h2>
        	    			<?php
	            				if( is_home() && get_option( 'page_for_posts' ) ) {
	            					echo ucfirst( get_the_title( get_option( 'page_for_posts' ) ) );
	            				}
	            				elseif (is_archive()) {
	            					global $wp_query;
	            					echo ucfirst( $wp_query->queried_object->name );
	            				}
	            				else
	            				{
	            					ucfirst( the_title() );
	            				}
            				?>
            			</h2>
            			<?php adeetheming_breadcrumbs(); ?>
        			</div>
    			</div>
			</div>

		<?php }
	}
} ?>