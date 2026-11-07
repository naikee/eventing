<?php 
/**
* Template Name: Portfolio Template
*/
get_header();

global $adeetheming_options, $post;

$prefix = 'adee_';

$sidebar = get_post_meta($post->ID, $prefix . 'left_sidebar', true);
if( ($sidebar === '') || ($sidebar == '-1') )
    $sidebar = $adeetheming_options['single-page_sidebar'];

$sidebar_layout = get_post_meta($post->ID, $prefix . 'page_sidebar', true);
if ( ($sidebar_layout === '') || ($sidebar_layout == '-1') || ($sidebar_layout == 'default') ) {
    $sidebar_layout = $adeetheming_options['pages_sidebar_layout'];
}

$sidebars_width = get_post_meta($post->ID, $prefix . 'sidebars_width', true);
if( ($sidebars_width === '') || ($sidebars_width == '-1') )
    $sidebars_width = $adeetheming_options['sidebars_width'];

if( ($sidebars_width === '') || ($sidebars_width == '-1') )
    $sidebars_width = 4;

$col_size = 12;
if ($sidebar_layout !== 'disabled') {
    $col_size = $col_size - $sidebars_width;
}

$portfolio_cols = array();
if ($adeetheming_options['portfolio_layout'] == 'masonry_layout' || $adeetheming_options['portfolio_layout'] == 'flat_masonry_layout') {
    $portfolio_cols[] = 'masonry-element';
} elseif ($adeetheming_options['portfolio_layout'] == 'grid_layout' || $adeetheming_options['portfolio_layout'] == 'flat_grid_layout') {
    $portfolio_cols[] = 'grid-element';
}

if ( ($adeetheming_options['portfolio_layout'] != 'list_layout') && ($adeetheming_options['portfolio_layout'] != 'full_image_layout') ) {
    $portfolio_cols[] = $adeetheming_options['portfolio_col'];

    $portfolio_cols[] = 'content-filter';

    $portfolio_cols[] = 'loadmore-masonry';
}

$portfolio_col = join(' ', $portfolio_cols);

$loadmore = $adeetheming_options['portfolio-loadmore'];

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
?>

<section id="main">
    <div class="container">
        <div class="row">

            <?php if ($sidebar_layout == 'disabled') : ?>
                <div id="content" class="site-content col-sm-<?php echo esc_attr($col_size); ?>" role="main" <?php echo $contentpad; ?>>
            <?php else: ?>
                <div id="content" class="site-content col-sm-<?php echo esc_attr($col_size) . ' has-sidebar-' . esc_attr($sidebar_layout); ?>" role="main" <?php echo $contentpad; ?>>
            <?php endif; ?>

                
                <?php

                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array('post_type' => 'portfolio','paged' => $paged, 'posts_per_page' => $adeetheming_options['portfolio-posts']);
                
                query_posts($args); 

                if ( have_posts() ) :
                    if (($adeetheming_options['portfolio_layout'] != 'list_layout' && $adeetheming_options['portfolio_layout'] != 'full_image_layout') && $adeetheming_options['portfolio_filter'] == true) : ?>
                        <div class="portfolio-filter">
                            <?php if(function_exists('adeetheming_filter') ) echo adeetheming_filter(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div id="portfolio" class="loadmore-element <?php echo esc_attr($portfolio_col); ?>">
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'templates/portfolio/content', 'portfolio' );
                    endwhile; ?>

                    </div>

                <?php else:
                    get_template_part( 'templates/portfolio/content', 'portfolio-none' );
                endif;

                ?>
                
                <?php if ( $loadmore ) {
                    echo adeetheming_loadmore();
                } else {
                    echo adeetheming_pagination();
                } ?>

            </div>
        
        <?php 
        if ($sidebar_layout == 'disabled' ) {
            //do nothing.
        }
        else { ?>

        <div id="sidebar" class="col-sm-<?php echo esc_attr($sidebars_width) . ' pull-' . esc_attr($sidebar_layout); ?> sidebar-content" role="complementary">
            <aside class="widget-area">
                <?php 
                    if ( is_active_sidebar( $sidebar ) ) {
                        dynamic_sidebar( $sidebar );
                    }
                ?>
            </aside>
        </div>

        <?php } ?>
        </div> <!-- .row -->
    </div><!-- .container -->
</section> 

<?php get_footer();