<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $product, $woocommerce_loop, $adeetheming_increment, $adeetheming_options;

// WC < 3.0 backward compatibility
if( version_compare( WC_VERSION, '2.7', '<=' ) ){
	$attachment_ids = $product->get_gallery_attachment_ids();
} else {
	$attachment_ids = $product->get_gallery_image_ids();
}

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
$woo_col = round(12/$woocommerce_loop['columns']);
$classes[] = 'col-xs-12 col-sm-6 col-md-' . $woo_col;

if( $adeetheming_increment == 1 ){
	echo '<div class="row">';
}


?>
	<div <?php post_class( $classes ); ?>>

		<?php remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
		do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<div class="product-thumbnail-outer">
			<a href="<?php the_permalink(); ?>">
			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			<?php 
			if (! empty($attachment_ids) && $adeetheming_options['shop_second_img'] == true) {
			 	if (isset($attachment_ids)) {
			 		$attachment_ids = array_unique($attachment_ids);
			 		$shop_second_img = ($attachment_ids['0'] === get_post_thumbnail_id()) ? $attachment_ids['1'] : $attachment_ids['0'] ;
			 		echo wp_get_attachment_image( $shop_second_img, 'shop_catalog', '', $attr = array( 'class' => 'hidden_shop_image' ) );
			 	}
			}
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
			</a>
		</div>
		<div class="product-thumbnail-outer-inner">
			<?php //echo get_the_term_list( get_the_ID(), 'product_cat','<span class="product-cat">','','</span>' ); ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

			<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15);
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	</div>

<?php

//echo 'loop'.$woocommerce_loop['adeetheming_increment'];

if( $adeetheming_increment%$woocommerce_loop['columns'] == 0 ){
		echo '</div>'; //row
		$adeetheming_increment = 0;
	}
$adeetheming_increment = $adeetheming_increment + 1;






