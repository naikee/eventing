<?php
/**
 * Product Loop End
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
</div>
<?php
global $woocommerce_loop, $adeetheming_increment;

if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

if(isset( $adeetheming_increment )){
	if( $adeetheming_increment != 1 ){
		echo '</div>'; //row
	}
}