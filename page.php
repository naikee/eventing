<?php

get_header(); 

global $adeetheming_options, $post;

$prefix = 'adee_'; 

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

//#Content and #Sidebar Custom Page Padding
$toppad = $bottompad = '';
$toppad = get_post_meta($post->ID, $prefix . 'top_padding', true);
if (isset($toppad) && $toppad != '') {
    $toppad = (strpos($toppad, 'px')) ? $toppad : $toppad. 'px' ;
}
$bottompad = get_post_meta($post->ID, $prefix . 'bottom_padding', true);
if (isset($bottompad) && $bottompad != '') {
    $bottompad = (strpos($bottompad, 'px')) ? $bottompad : $bottompad. 'px' ;
}

$contentpad = '';
if ((isset($toppad) && $toppad != '') || (! empty($bottompad) && $bottompad != '')) {
    $contentpad = array();
    if($toppad) $contentpad[] = 'padding-top: ' .$toppad. ';';
    if($bottompad) $contentpad[] = 'padding-bottom: ' .$bottompad. ';';

    $contentpad = 'style="' .implode(' ', $contentpad). '"';
}
?>

<section id="main">
    
    <div class="container">

    <?php if ($sidebar_layout == 'disabled') : ?>
        <div id="content" class="site-content col-sm-<?php echo esc_attr($col_size); ?>" role="main" <?php echo $contentpad; ?>>
    <?php else: ?>
        <div id="content" class="site-content col-sm-<?php echo esc_attr($col_size) . ' has-sidebar-' . esc_attr($sidebar_layout); ?>" role="main" <?php echo $contentpad; ?>>
    <?php endif; ?>

            <?php while ( have_posts() ): the_post(); ?>

                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                        <div class="row">
                            <div class="entry-thumbnail col-md-12">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php  the_content(); ?>
                    </div>
                
                </div>
            <?php endwhile; ?>

            <div class="container page-bottom"> 

                <?php
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'adeecore' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) );
                ?>
            </div>
                <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
        </div> <!--/#content-->

        <?php get_sidebar(); ?> <!--Page Left or Right  Sidebar-->
    </div>
</section> <!--/#main-->
<?php get_footer();
