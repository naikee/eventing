<?php get_header(); 
global $adeetheming_options, $post;

$prefix = 'adee_';

$sidebar_layout = get_post_meta($post->ID, $prefix . 'page_sidebar', true);
if ( ($sidebar_layout === '') || ($sidebar_layout == '-1') || ($sidebar_layout == 'default') ) {
    $sidebar_layout = $adeetheming_options['portfolio_sidebar_layout'];
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

$client = get_post_meta($post->ID, $prefix . 'portfolio_client', true);
$url = get_post_meta($post->ID, $prefix . 'portfolio_client_url', true);
$target = get_post_meta($post->ID, $prefix . 'portfolio_url_target', true);
$start = get_post_meta($post->ID, $prefix . 'portfolio_start', true);
$end = get_post_meta($post->ID, $prefix . 'portfolio_end', true);
$desc = get_post_meta($post->ID, $prefix . 'portfolio_desc', true);
?>

<section id="main">

    <div class="container portfolio-gallery-wrap">
        <div class="row">
            <?php 
                if ( ( has_post_thumbnail() || ( isset($images) && ! empty($images) ) ) && ( empty($client || $url || $start || $end || $desc ) ) ) : ?>
                    <div class="site-gallery col-md-12">
                        <div class="featured-gallery-wrap">
                            <?php get_template_part( 'templates/portfolio/portfolio-image' ); ?>
                        </div>
                    </div>
            <?php elseif ( ( has_post_thumbnail() || ( isset($images) && ! empty($images) ) ) && ( ! empty($client || $url || $start || $end || $desc ) ) ) : ?>
                    <div class="site-gallery col-md-8">
                        <div class="featured-gallery-wrap">
                            <?php get_template_part( 'templates/portfolio/portfolio-image' ); ?>
                        </div>
                    </div>
                    <div class="site-client col-md-4">
                        <div class="featured-client-wrap">
                            <?php
                                echo '<ul class="client-wrapper">';
                                if ( isset($client) && $client !== '' ) { ?>
                                    <li class="even"><span class="client-subject">Client:</span>
                                        <span class="client-details"><?php echo esc_attr($client); ?></span>
                                    </li>
                                <?php }
                                if ( isset($url) && $url !== '' ) {
                                    $urltarget = '';
                                    if ($target) $urltarget = '_blank'; ?>
                                    <li><span class="client-subject">Client Webiste:</span>
                                        <span class="client-details"><a href="<?php echo esc_attr($url); ?>" target="<?php echo esc_attr($urltarget); ?>"><?php echo esc_attr($url); ?></a></span>
                                    </li>
                                <?php }
                                if ( isset($start) && $start !== '' ) { ?>
                                    <li class="even"><span class="client-subject">Start Date:</span>
                                        <span class="client-details"><?php echo esc_attr($start); ?></span>
                                    </li>
                                <?php }
                                if ( isset($end) && $end !== '' ) { ?>
                                    <li><span class="client-subject">Complete Date:</span>
                                        <span class="client-details"><?php echo esc_attr($end); ?></span>
                                    </li>
                                <?php }
                                echo '</ul>';

                                if( isset($desc) && $desc !== '' ) : ?>
                                    <div class="portfolio-desc">
                                        <?php echo do_shortcode($desc); ?>
                                    </div>
                                <?php endif;
                            ?>
                        </div>
                    </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php if ($sidebar_layout == 'disabled') : ?>
                <div id="content" class="site-content col-sm-<?php echo esc_attr($col_size); ?>" role="main">
            <?php else: ?>
                <div id="content" class="site-content col-sm-<?php echo esc_attr($col_size) . ' has-sidebar-' . esc_attr($sidebar_layout); ?>" role="main">
            <?php endif; ?>
                <?php if ( have_posts() ) :  ?> 

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'templates/portfolio/content', 'single' ); ?>

                         <?php if ( isset($adeetheming_options['post-nav-en']) && $adeetheming_options['post-nav-en'] ) { ?>
                            <div class="clearfix post-navigation">
                                <?php previous_post_link('<span class="previous-portfolio pull-left">%link</span>','<i class="fa fa-long-arrow-left"></i> '.esc_html__("Previous project",'adeecore')); ?>
                                <?php next_post_link('<span class="next-portfolio pull-right">%link</span>',esc_html__("Next project",'adeecore').' <i class="fa fa-long-arrow-right"></i>'); ?>
                            </div> <!-- .post-navigation -->
                        <?php } ?>

                        <?php
                            if ( comments_open() || get_comments_number() ) {
                                if ( isset($adeetheming_options['portfolio-single-comment-en']) && $adeetheming_options['portfolio-single-comment-en'] ) {
                                   comments_template();
                                }
                            }
                        ?>
                        <?php
                            if ( is_singular( 'portfolio' ) ){
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