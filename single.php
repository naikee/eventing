<?php get_header(); 
global $adeetheming_options, $post;

$prefix = 'adee_';

$sidebar_layout = get_post_meta($post->ID, $prefix . 'page_sidebar', true);
if ( ($sidebar_layout === '') || ($sidebar_layout == '-1') || ($sidebar_layout == 'default') ) {
    $sidebar_layout = $adeetheming_options['post_sidebar_layout'];
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
?>

<section id="main">

    <div class="container">
        <div class="row">
            <?php if ($sidebar_layout == 'disabled') : ?>
                <div id="content" class="site-content col-sm-<?php echo esc_attr($col_size); ?>" role="main">
            <?php else: ?>
                <div id="content" class="site-content col-sm-<?php echo esc_attr($col_size) . ' has-sidebar-' . esc_attr($sidebar_layout); ?>" role="main">
            <?php endif; ?>
                <?php if ( have_posts() ) :  ?> 

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'templates/post-format/content', get_post_format() ); ?>

                         <?php if ( isset($adeetheming_options['post-nav-en']) && $adeetheming_options['post-nav-en'] ) { ?>
                            <div class="clearfix post-navigation">
                                <?php previous_post_link('<span class="previous-post pull-left">%link</span>','<i class="fa fa-long-arrow-left"></i> '.esc_html__("previous article",'adeecore')); ?>
                                <?php next_post_link('<span class="next-post pull-right">%link</span>',esc_html__("next article",'adeecore').' <i class="fa fa-long-arrow-right"></i>'); ?>
                            </div> <!-- .post-navigation -->
                        <?php } ?>

                        <?php
                            if ( comments_open() || get_comments_number() ) {
                                if ( isset($adeetheming_options['blog-single-comment-en']) && $adeetheming_options['blog-single-comment-en'] ) {
                                   comments_template();
                                }
                            }
                        ?>
                        <?php
                            if ( is_singular( 'post' ) ){
                                $count_post = esc_attr( get_post_meta( $post->ID, '_post_views_count', true) );
                                if( $count_post == ''){
                                    $count_post = 1;
                                    add_post_meta( $post->ID, '_post_views_count', $count_post);
                                }else{
                                    $count_post = (int)$count_post + 1;
                                    update_post_meta( $post->ID, '_post_views_count', $count_post);
                                }
                            }
                        ?>
                    <?php endwhile; ?>

                    
                <?php else: ?>
                    <?php get_template_part( 'templates/post-format/content', 'none' ); ?>
                <?php endif; ?>

                <div class="clearfix"></div>
        
            </div> <!-- #content -->


            <?php get_sidebar(); ?>
            <!-- #sidebar -->

        </div> <!-- .row -->
    </div><!-- .container -->
</section> 

<?php get_footer();