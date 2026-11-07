<?php get_header();

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
            <div id="content" class="site-content col-md-12" role="main" <?php echo $contentpad; ?>>
                <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post();
                            get_template_part( 'templates/post-format/content', get_post_format() );
                        endwhile;
                    else:
                        get_template_part( 'templates/post-format/content', 'none' );
                    endif;
                ?>
               <?php adeetheming_pagination(); ?>
            </div> <!-- #content -->
        </div> <!-- .row -->
    </div>
</section> <!-- .container -->

<?php get_footer();