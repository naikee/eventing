<?php 
/**
* Template Name: Blog Template
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

$blogpost_cols = array();
if ($adeetheming_options['blogpost_layout'] == 'masonry_layout') {
    $blogpost_cols[] = 'masonry-element';
} elseif ($adeetheming_options['blogpost_layout'] == 'grid_layout') {
    $blogpost_cols[] = 'grid-element';
}

if ( ($adeetheming_options['blogpost_layout'] == 'grid_layout') || ($adeetheming_options['blogpost_layout'] == 'masonry_layout') ) {
    $blogpost_cols[] = $adeetheming_options['blogpost_col'];

    $blogpost_cols[] = 'loadmore-masonry';

}

$blogpost_col = join(' ', $blogpost_cols);

$loadmore = $adeetheming_options['blog-loadmore'];

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
                <div class="loadmore-element <?php echo esc_attr($blogpost_col); ?>">
                <?php

                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array('post_type' => 'post','paged' => $paged, 'posts_per_page' => $adeetheming_options['blog-posts']);
                query_posts($args); 

                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'templates/post-format/content', get_post_format() );
                    endwhile;
                else:
                    get_template_part( 'templates/post-format/content', 'none' );
                endif;

                ?>
                </div>
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