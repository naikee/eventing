<?php get_header();
    
global $adeetheming_options;
$prefix = 'adee_';

$woo_sidebar = $adeetheming_options['shop_sidebar_layout'];

//#Content and #Sidebar Custom Page Padding
$toppad = $bottompad = $contentpad = '';
$toppad = get_post_meta($post->ID, $prefix . 'top_padding', true);
$bottompad = get_post_meta($post->ID, $prefix . 'top_padding', true);

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
            <?php if($woo_sidebar == 'disabled') { ?>
                <div id="content" class="col-md-12" role="main" <?php echo $contentpad; ?>>
            <?php } else { ?>
                <div id="content" class="col-md-9 has-sidebar-<?php echo esc_attr($woo_sidebar); ?>" role="main" <?php echo $contentpad; ?>>
            <?php } ?>
                    <div class="site-content">
                        <?php woocommerce_content(); ?>
                    </div>
                </div> <!-- #content -->

            <?php if($woo_sidebar !== 'disabled') { ?>
                <div id="sidebar" class="col-md-3" role="complementary" <?php echo $contentpad; ?>>
                    <aside class="widget-area">
                        <?php dynamic_sidebar('shop');?>
                    </aside>
                </div> <!-- #sidebar -->
            <?php } ?>
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>

<?php get_footer(); ?>