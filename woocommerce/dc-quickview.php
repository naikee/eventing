<?php

/**
* Quick View
*/
class DC_QuickView
{
	
	function __construct() {

		add_action('wp_enqueue_scripts', array($this, 'dc_quickview_ajax_scripts'));
		add_action('woocommerce_after_shop_loop_item_title', array($this, 'dc_quickview_button'), 20);
		add_action('wp_ajax_dc_products_detail', array($this, 'dc_quickview_products_detail'));
		add_action('wp_ajax_nopriv_dc_products_detail', array($this, 'dc_quickview_products_detail'));

		add_action('wp_footer', array($this, 'dc_quickview_modal_wrap'));

		add_action('dc_quickview_show_product_sale_flash', 'woocommerce_show_product_sale_flash');
		add_action('dc_quickview_product_detail', 'woocommerce_template_single_title');
		add_action('dc_quickview_product_detail', 'woocommerce_template_single_rating');
		add_action('dc_quickview_product_detail', 'woocommerce_template_single_price');
		add_action('dc_quickview_product_detail', 'woocommerce_template_single_excerpt');
		add_action('dc_quickview_product_detail', 'woocommerce_template_single_meta');
		add_action('dc_quickview_product_detail', 'woocommerce_template_single_add_to_cart');
	}

	function dc_quickview_button(){

		global $product;

		echo 
		'<div class="dc_quickview_btn_wrap">
			<a class="dc_quickview_anchor open-popup-link button" href="#dc-quickview-link-'.$product->get_id().'" data-effect="zoom-in" data-product-id="'.$product->get_id().'">'.__( 'Quick View','adeecore' ).'
				<span title="Loading product..." class="dc_quickview_ajaxload ion-load-c"></span>
			</a>
		</div>';
	}

	function dc_quickview_ajax_scripts() {
		wp_register_script('dc_woo_quickview_js', THMJS . 'dc-woo-quickview.js', array('jquery'), THMVERSION, true);

		$prod_data = array(
			'ajaxurl'	=> admin_url('admin-ajax.php')
		);

		wp_localize_script('dc_woo_quickview_js', 'dc_woo_quickview_obj', $prod_data);
		wp_enqueue_script ( 'jquery' );
		wp_enqueue_script('dc_woo_quickview_js');
	}

	function dc_quickview_products_detail() {
		global $post, $product, $woocommerce;

		$product_id = $_POST['product_id'];

		if($product_id) {

			ob_start();

			$products_loop = array(
				'post_type'		=> 'product',
				'post__in'		=> array($product_id),
				'post_status'	=> 'publish'
			);

			$query = new WP_Query($products_loop);

			if ($query->have_posts()) {

				while ($query->have_posts()) {
					$query->the_post(); ?>
					<div class="dc-quickview-product-wrap">
						<div id="product-<?php the_ID(); ?>" <?php post_class('product'); ?> >

							<div class="row">
								<div class="col-md-6">
									<div class="single-product-image">

										<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

										<div class="quickview_view_product">
											<a href="<?php echo the_permalink();?>" title="<?php _e('Full Product Details','adeecore');?>" ><?php _e('Full Product Details','adeecore');?></a>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="single-product-details">
										<div class="product_summary summary_entry">
											<?php do_action('dc_quickview_product_detail'); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php

				}

				$next_product 		= get_next_post();
				$prev_product		= get_previous_post();
				$next_product_id	= ( ! empty($next_product) ) ? $next_product->ID : '';
				$prev_product_id	= ( ! empty($prev_product) ) ? $prev_product->ID : '';
				$next_product_title	= ( ! empty($next_product) ) ? $next_product->post_title : '';
				$prev_product_title	= ( ! empty($prev_product) ) ? $prev_product->post_title : '';
				$next_product_thumb	= ( ! empty($next_product) ) ? get_the_post_thumbnail($next_product->ID, 'shop_thumbnail', '') : '';
				$prev_product_thumb	= ( ! empty($prev_product) ) ? get_the_post_thumbnail($prev_product->ID, 'shop_thumbnail', '') : '';
				$next_product_class	= ( ! empty($next_product) ) ? 'next quickview-next-product' : '';
				$prev_product_class	= ( ! empty($prev_product) ) ? 'prev quickview-prev-product' : '';
				?>

				<?php if($prev_product != '') : ?>
					<div class="dc-prev-product">
						<a href="#" class="<?php echo $prev_product_class; ?>"  data-prev-product="<?php echo $prev_product_id; ?>">
							<span class="dc-prev-product-title">
								<?php echo $prev_product_title; ?>
							</span>
							<?php echo $prev_product_thumb; ?>
						</a>
					</div>
				<?php endif; ?>

				<?php if($next_product != '') : ?>
					<div class="dc-next-product">
						<a href="#" class="<?php echo $next_product_class; ?>" data-next-product="<?php echo $next_product_id; ?>">
							<?php echo $next_product_thumb; ?>
							<span class="dc-next-product-title">
								<?php echo $next_product_title; ?>
							</span>
						</a>
					</div>
				<?php endif; ?>

				<?php

				$html_content = ob_get_contents();

			}

			ob_end_clean();
			wp_reset_query();			

			echo json_encode($html_content);
			die();
		}
	}


	function dc_quickview_modal_wrap() {
		echo 
		'<div class="dc-quickview-modal-outer">
			<div class="dc-quickview-modal-bg"></div>
			<div class="dc-quickview-modal-container">
				<a href="#" data-rel="close-modal" class="dc-quickview-modal-close" title="Close"></a>
				<div id="dc-quickview-content"></div>
			</div>
		</div>';
	}

}

$dc_load_quickview = new DC_QuickView;
