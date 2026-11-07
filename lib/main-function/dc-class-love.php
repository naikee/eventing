<?php
class DC_Love {

    function __construct() 
    {	
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
        add_filter('body_class', array(&$this, 'body_class'));
        add_action('publish_post', array(&$this, 'setup_love'));
        add_action('wp_ajax_adeetheming-love', array(&$this, 'ajax'));
		add_action('wp_ajax_nopriv_adeetheming-love', array(&$this, 'ajax'));
	}

	function enqueue_scripts()
	{
		
		wp_enqueue_script( 'adeetheming-love', trailingslashit(get_template_directory_uri()).'js/love-this-count.js', array('jquery') );
		wp_enqueue_script( 'jquery' ); 
		
		wp_localize_script( 'adeetheming-love', 'adeetheming_love', array('ajaxurl' => admin_url('admin-ajax.php')) );
	}
	
	function setup_love( $post_id ) 
	{
		if(!is_numeric($post_id)) return;
	
		add_post_meta($post_id, 'adeetheming_love', '0', true);
	}
	
	function ajax($post_id) 
	{

		if( isset($_POST['likes_id']) ) {
			$post_id = str_replace('adeetheming-love-', '', $_POST['likes_id']);
			echo $this->love($post_id, 'update');
		} else {
			$post_id = str_replace('adeetheming-love-', '', $_POST['post_id']);
			echo $this->love($post_id, 'get');
		}
		
		exit;
	}
	
	function love($post_id, $action = 'get') 
	{
		if(!is_numeric($post_id)) return;		
		
		switch($action) {
		
			case 'get':
				$love = get_post_meta($post_id, '_adeetheming_love', true);
				if( !$love ){
					$love = 0;
					add_post_meta($post_id, '_adeetheming_love', $love, true);
				}
				
				return $love;
				break;
				
			case 'update':
				$love = get_post_meta($post_id, '_adeetheming_love', true);
				if( isset($_COOKIE['adeetheming_love_'. $post_id]) ) return $love;
				
				$love++;
				update_post_meta($post_id, '_adeetheming_love', $love);
				setcookie('adeetheming_love_'. $post_id, $post_id, time()*20, '/');
				
				return $love;
				break;
		
		}
	}

	function do_love()
	{
		global $post;
		
		$output = $this->love($post->ID);
  
  		$class = 'adeetheming-love';
  		$title = esc_html__('Like this', 'adeecore');
		if( isset($_COOKIE['adeetheming_love_'. $post->ID]) ){
			$class = 'adeetheming-love active';
			$title = esc_html__('You already like this', 'adeecore');
		}
		
		return '<a href="#" class="'. $class .'" id="adeetheming-love-'. $post->ID .'" title="'. $title .'">'. $output .'</a>';
	}
	
    function body_class($classes) {
        $classes[] = 'ajax-adeetheming-love';
    	return $classes;
    }

}
global $adeetheming_love;
$adeetheming_love = new DC_Love();

/**
 * Template Tag
 */
function adeetheming_love()
{
	global $adeetheming_love;
    echo wp_kses_post($adeetheming_love->do_love()); 
}

function adeetheming_posts_column_views( $defaults ) {
	$defaults['post_love'] = esc_html__( 'Likes','adeecore' );
 
	return $defaults;
}  
function adeetheming_posts_custom_column_views( $column_name, $id ) {
	if ( $column_name === 'post_love' ) {
		echo get_post_meta( get_the_ID(), '_adeetheming_love', true); 
	}
}
add_filter( 'manage_posts_columns', 'adeetheming_posts_column_views' );
add_action( 'manage_posts_custom_column', 'adeetheming_posts_custom_column_views', 5, 2 );
