<?php
define('ADEETHEMINGNAME', wp_get_theme()->get( 'Name' ));
define('THMVERSION', '1.0.0');
define('THMCSS', get_template_directory_uri().'/css/');
define('THMJS', get_template_directory_uri().'/js/');


if((!class_exists('RWMB_Loader'))&&(!defined('RWMB_VER'))){
// Include the meta box script
require_once (get_template_directory().'/lib/meta-box/meta-box.php');
}

require_once (get_template_directory().'/lib/meta-box-switch/switch.php');

require_once (get_template_directory().'/lib/meta-box-group/meta-box-group.php');

require_once (get_template_directory().'/lib/metabox.php');

require_once (get_template_directory().'/lib/post-type.php');


/*-------------------------------------------------------
*			Custom Widgets and VC shortocde Include
*-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/vc-addons/fontawesome-helper.php');
require_once( get_template_directory()  . '/lib/vc-addons/shortcode-helper.php');
require_once( get_template_directory()  . '/lib/vc-addons/event-counter.php');
require_once( get_template_directory()  . '/lib/vc-addons/adeetheming-title.php');
require_once( get_template_directory()  . '/lib/vc-addons/adeetheming-button.php');
require_once( get_template_directory()  . '/lib/vc-addons/adeetheming-latest-post.php');
require_once( get_template_directory()  . '/lib/vc-addons/adeetheming-feature-box.php');
require_once( get_template_directory()  . '/lib/vc-addons/adeetheming-person.php');
require_once( get_template_directory()  . '/lib/vc-addons/pricing-table.php');
require_once( get_template_directory()  . '/lib/vc-addons/adeetheming-action.php');
//require_once( get_template_directory()  . '/lib/vc-addons/adeetheming-clients.php');
require_once( get_template_directory()  . '/lib/vc-addons/wc-latest-products.php');
//require_once( get_template_directory()  . '/lib/vc-addons/adeetheming-counter.php');
//require_once( get_template_directory()  . '/lib/vc-addons/adeetheming-iconbox.php');
//require_once( get_template_directory()  . '/lib/vc-addons/adeetheming-progress-bar.php');

require_once( get_template_directory()  . '/lib/widgets/popular-news.php');


/*-------------------------------------------------------
 *				Redux Framework Options Added
 *-------------------------------------------------------*/

global $adecore_options; 

if ( !class_exists( 'ReduxFramework' ) ) {
	require_once( get_template_directory() . '/panel/framework.php' );
	require_once( get_template_directory() . '/lib/panel-extension/loader.php');
	require_once( get_template_directory()  . '/lib/main-function/import-functions.php');
}

if ( !isset( $redux_demo ) ) {
	require_once( get_template_directory() . '/theme-options/admin-config.php' );
}

/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary'		=> esc_html__( 'Primary Menu (Split Menu 1)', 'adeecore' ),
	'split-menu'	=> esc_html__( 'Split Menu 2', 'adeecore' ),
	'top-menu'		=> esc_html__( 'Top Menu', 'adeecore' ),
	'footer-menu'	=> esc_html__( 'Footer Menu', 'adeecore' ),
) );

/*-------------------------------------------*
 *				title tag
 *------------------------------------------*/
add_theme_support( 'title-tag' );
add_theme_support( 'post-formats', array( 'link', 'quote' ) );


/*-------------------------------------------*
 *				woocommerce support
 *------------------------------------------*/
add_action( 'after_setup_theme', 'dc_woocommerce_support' );
function dc_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
require_once( get_template_directory() . '/woocommerce/dc-quickview.php');


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
//Main Navigation
require_once( get_template_directory()  . '/lib/menu/admin-megamenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/meagmenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/mobile-navwalker.php');
//Admin mega menu
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Adeetheming_Megamenu_Walker';
}, 10, 2 );



/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/dc-register.php');


/*-------------------------------------------------------
 *			Adeetheming Core
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/dc-core.php');


/*-------------------------------------------------------
 *			Shortcode Function
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/dc-sc-function.php');
require_once( get_template_directory()  . '/lib/main-function/dc-sc-params.php');
require_once( get_template_directory()  . '/lib/main-function/vc-param-extend.php');


/*-------------------------------------------------------
 *			Mobile Detect Core
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/Mobile_Detect.php');
$detect = new Mobile_Detect;

/*-------------------------------------------------------
 *			Image Resize Core
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/aq_resizer.php');

if ( ! class_exists('DC_Love') ) {
	require_once( get_template_directory() . '/lib/main-function/dc-class-love.php');
}


// Remove Redux Ads
if(!function_exists('redux_ads_custom_admin_styles')):
function redux_ads_custom_admin_styles() { ?>
	<style type="text/css">
	.rAds {
		display: none !important;
	}
	</style>
<?php }
add_action('admin_head', 'redux_ads_custom_admin_styles');
endif;
