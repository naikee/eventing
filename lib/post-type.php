<?php
/*
*
*	General Custom Post Type Functions
*	------------------------------------------------
*
*/

if ( ! function_exists( 'create_portfolio_post_type' ) ) {
	function create_portfolio_post_type() {

		$labels = array(
			'name' => __( 'Portfolios', 'adeecore' ),
			'singular_name' => __( 'Portfolio', 'adeecore' ),
			'add_new' => __( 'Add New', 'adeecore' ),
			'add_new_item' => __( 'Add New Portfolio', 'adeecore' ),
			'edit_item' => __( 'Edit Portfolio', 'adeecore' ),
			'new_item' => __( 'New Portfolio', 'adeecore' ),
			'view_item' => __( 'View Portfolio', 'adeecore' ),
			'search_items' => __( 'Search Portfolios', 'adeecore' ),
			'not_found' => __( 'No Portfolio found', 'adeecore' ),
			'not_found_in_trash' => __( 'No Portfolio found in Trash', 'adeecore' ),
			'parent_item_colon' => ''
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_icon' => 'dashicons-portfolio',
			'menu_position' => 19,
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'author', 'page-attributes', 'comments' ),
			'rewrite' => array(
				'slug' => apply_filters( 'portfolio_slug', __( 'portfolio', 'adeecore' ) ),
			)
		);

		register_post_type( 'portfolio', $args );

	}
	add_action( 'init', 'create_portfolio_post_type' );
}



/* Create Portfolio Taxonomies */
if( !function_exists( 'create_portfolio_taxonomies' ) ){
    function create_portfolio_taxonomies(){
        $labels = array(
            'name' => __( 'Portfolio Categories', 'adeecore' ),
            'singular_name' => __( 'Portfolio Category', 'adeecore' ),
            'search_items' =>  __( 'Search Portfolio Categories', 'adeecore' ),
            'popular_items' => __( 'Popular Portfolio Categories', 'adeecore' ),
            'all_items' => __( 'All Portfolio Categories', 'adeecore' ),
            'parent_item' => __( 'Parent Portfolio Category', 'adeecore' ),
            'parent_item_colon' => __( 'Parent Portfolio Category:', 'adeecore' ),
            'edit_item' => __( 'Edit Portfolio Category', 'adeecore' ),
            'update_item' => __( 'Update Portfolio Category', 'adeecore' ),
            'add_new_item' => __( 'Add New Portfolio Category', 'adeecore' ),
            'new_item_name' => __( 'New Portfolio Category Name', 'adeecore' ),
            'separate_items_with_commas' => __( 'Separate Portfolio Category with commas', 'adeecore' ),
            'add_or_remove_items' => __( 'Add or remove Portfolio Category', 'adeecore' ),
            'choose_from_most_used' => __( 'Choose from the most used Portfolio Category', 'adeecore' ),
            'menu_name' => __( 'Portfolio Category', 'adeecore' )
        );

        register_taxonomy(
            'portfolio-category',
            'portfolio',
            array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => apply_filters( 'portfolio_category_slug', __( 'portfolio-category', 'adeecore' ) ) )
            )
        );
    }
	add_action( 'init', 'create_portfolio_taxonomies', 0 );
}

/* -------------------------------------
 * Edit columns
 * ------------------------------------- */
function portfolio_edit_columns($columns)
{
	$column = array(
		'cb' 					=> '<input type="checkbox" />',
		'thumb' 				=> __('Thumbnail','adeecore'),
		'title' 				=> 'Title',
		'category' 				=> __('Categories','adeecore'),
		'date' 					=> __('Publish Date','adeecore'),
	);

	return $column;
}
add_filter('manage_edit-portfolio_columns', 'portfolio_edit_columns');  

/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */
function portfolio_custom_columns($column)
{
	global $post;
	switch ($column)
	{
		case 'thumb':
			if ( has_post_thumbnail($post->ID) ) { the_post_thumbnail( array( 50, 50 ) ); }
			break;
		case 'category':
			$terms = get_the_term_list( $post->ID, 'portfolio-category', '', ',', '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			}
			break;	
	}
}
add_action('manage_portfolio_posts_custom_column',  'portfolio_custom_columns' ); 



/*--------------------------------------------------------
*     Testimonials
--------------------------------------------------------*/
if ( ! function_exists( 'create_testimonial_post_type' ) ) {
	function create_testimonial_post_type() {

		$labels = array(
			'name' => __( 'Testimonials', 'adeecore' ),
			'singular_name' => __( 'Testimonial', 'adeecore' ),
			'add_new' => __( 'Add New', 'adeecore' ),
			'add_new_item' => __( 'Add New Testimonial', 'adeecore' ),
			'edit_item' => __( 'Edit Testimonial', 'adeecore' ),
			'new_item' => __( 'New Testimonial', 'adeecore' ),
			'view_item' => __( 'View Testimonial', 'adeecore' ),
			'search_items' => __( 'Search Testimonials', 'adeecore' ),
			'not_found' => __( 'No Testimonial found', 'adeecore' ),
			'not_found_in_trash' => __( 'No Testimonial found in Trash', 'adeecore' ),
			'parent_item_colon' => ''
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_icon' => 'dashicons-megaphone',
			'menu_position' => 21,
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', ),
			'rewrite' => array(
				'slug' => apply_filters( 'testimonial_slug', __( 'testimonial', 'adeecore' ) ),
			)
		);

		register_post_type( 'testimonial', $args );

	}
	add_action( 'init', 'create_testimonial_post_type' );
}

/* Create Testimonial Taxonomies */
if( !function_exists( 'create_testimonial_taxonomies' ) ){
    function create_testimonial_taxonomies(){
        $labels = array(
            'name' => __( 'Testimonial Categories', 'adeecore' ),
            'singular_name' => __( 'Testimonial Category', 'adeecore' ),
            'search_items' =>  __( 'Search Testimonial Categories', 'adeecore' ),
            'popular_items' => __( 'Popular Testimonial Categories', 'adeecore' ),
            'all_items' => __( 'All Testimonial Categories', 'adeecore' ),
            'parent_item' => __( 'Parent Testimonial Category', 'adeecore' ),
            'parent_item_colon' => __( 'Parent Testimonial Category:', 'adeecore' ),
            'edit_item' => __( 'Edit Testimonial Category', 'adeecore' ),
            'update_item' => __( 'Update Testimonial Category', 'adeecore' ),
            'add_new_item' => __( 'Add New Testimonial Category', 'adeecore' ),
            'new_item_name' => __( 'New Testimonial Category Name', 'adeecore' ),
            'separate_items_with_commas' => __( 'Separate Testimonial Category with commas', 'adeecore' ),
            'add_or_remove_items' => __( 'Add or remove Testimonial Category', 'adeecore' ),
            'choose_from_most_used' => __( 'Choose from the most used Testimonial Category', 'adeecore' ),
            'menu_name' => __( 'Testimonial Category', 'adeecore' )
        );

        register_taxonomy(
            'testimonial-category',
            array('testimonial'),
            array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => apply_filters( 'testimonial_category_slug', __( 'testimonial-category', 'adeecore' ) ) )
            )
        );
    }
	add_action( 'init', 'create_testimonial_taxonomies', 0 );
}

/* -------------------------------------
 * Edit columns
 * ------------------------------------- */
function testimonial_edit_columns($columns)
{
	$column = array(
		'cb' 					=> '<input type="checkbox" />',
		'thumb' 				=> __('Thumbnail','adeecore'),
		'title' 				=> 'Title',
		'category' 				=> __('Categories','adeecore'),
		'date' 					=> __('Publish Date','adeecore'),
	);

	return $column;
}
add_filter('manage_edit-testimonial_columns', 'testimonial_edit_columns');  

/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */
function testimonial_custom_columns($column)
{
	global $post;
	switch ($column)
	{
		case 'thumb':
			if ( has_post_thumbnail($post->ID) ) { the_post_thumbnail( array( 50, 50 ) ); }
			break;
		case 'category':
			$terms = get_the_term_list( $post->ID, 'testimonial-category', '', ',', '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			}
			break;	
	}
}
add_action('manage_testimonial_posts_custom_column',  'testimonial_custom_columns' );



/*--------------------------------------------------------
*     FAQ
--------------------------------------------------------*/
if ( ! function_exists( 'create_faq_post_type' ) ) {
	function create_faq_post_type() {

		$labels = array(
			'name' => __( 'FAQ', 'adeecore' ),
			'singular_name' => __( 'FAQ', 'adeecore' ),
			'add_new' => __( 'Add New', 'adeecore' ),
			'add_new_item' => __( 'Add New FAQ', 'adeecore' ),
			'edit_item' => __( 'Edit FAQ', 'adeecore' ),
			'new_item' => __( 'New FAQ', 'adeecore' ),
			'view_item' => __( 'View FAQ', 'adeecore' ),
			'search_items' => __( 'Search FAQ', 'adeecore' ),
			'not_found' => __( 'No FAQ found', 'adeecore' ),
			'not_found_in_trash' => __( 'No FAQ found in Trash', 'adeecore' ),
			'parent_item_colon' => ''
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_icon' => 'dashicons-format-chat',
			'menu_position' => 22,
			'supports' => array( 'title' ),
			'rewrite' => array(
				'slug' => apply_filters( 'faq_slug', __( 'faq', 'adeecore' ) ),
			)
		);

		register_post_type( 'faq', $args );

	}
	add_action( 'init', 'create_faq_post_type' );
}

/* Create FAQ Taxonomies */
if( !function_exists( 'create_faq_taxonomies' ) ){
    function create_faq_taxonomies(){
        $labels = array(
            'name' => __( 'FAQ Categories', 'adeecore' ),
            'singular_name' => __( 'FAQ Category', 'adeecore' ),
            'search_items' =>  __( 'Search FAQ Categories', 'adeecore' ),
            'popular_items' => __( 'Popular FAQ Categories', 'adeecore' ),
            'all_items' => __( 'All FAQ Categories', 'adeecore' ),
            'parent_item' => __( 'Parent FAQ Category', 'adeecore' ),
            'parent_item_colon' => __( 'Parent FAQ Category:', 'adeecore' ),
            'edit_item' => __( 'Edit FAQ Category', 'adeecore' ),
            'update_item' => __( 'Update FAQ Category', 'adeecore' ),
            'add_new_item' => __( 'Add New FAQ Category', 'adeecore' ),
            'new_item_name' => __( 'New FAQ Category Name', 'adeecore' ),
            'separate_items_with_commas' => __( 'Separate FAQ Category with commas', 'adeecore' ),
            'add_or_remove_items' => __( 'Add or remove FAQ  Category', 'adeecore' ),
            'choose_from_most_used' => __( 'Choose from the most used FAQ Category', 'adeecore' ),
            'menu_name' => __( 'FAQ Category', 'adeecore' )
        );

        register_taxonomy(
            'faq-category',
            array('faq'),
            array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => apply_filters( 'faq_category_slug', __( 'faq-category', 'adeecore' ) ) )
            )
        );
    }
	add_action( 'init', 'create_faq_taxonomies', 0 );
}

/* -------------------------------------
 * Edit columns
 * ------------------------------------- */
function faq_edit_columns($columns)
{
	$column = array(
		'cb' 					=> '<input type="checkbox" />',
		'title' 				=> 'Title',
		'category' 				=> __('Categories','adeecore'),
		'order'					=> __('Order', 'adeecore'),
		'date' 					=> __('Publish Date','adeecore'),
	);

	return $column;
}
add_filter('manage_edit-faq_columns', 'faq_edit_columns');  

/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */
function faq_custom_columns($column)
{
	global $post;
	switch ($column)
	{

		case 'category':
			$terms = get_the_term_list( $post->ID, 'testimonial-category', '', ',', '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			}
			break;
		case 'order':
			echo $post->menu_order;
			break;	
	}
}
add_action('manage_faq_posts_custom_column',  'faq_custom_columns' );



/*--------------------------------------------------------
*     Team
--------------------------------------------------------*/
if ( ! function_exists( 'create_teams_post_type' ) ) {
	function create_teams_post_type() {

		$labels = array(
			'name' => __( 'Teams', 'adeecore' ),
			'singular_name' => __( 'Team', 'adeecore' ),
			'add_new' => __( 'Add New', 'adeecore' ),
			'add_new_item' => __( 'Add New Team', 'adeecore' ),
			'edit_item' => __( 'Edit Team', 'adeecore' ),
			'new_item' => __( 'New Team', 'adeecore' ),
			'view_item' => __( 'View Teams', 'adeecore' ),
			'search_items' => __( 'Search Teams', 'adeecore' ),
			'not_found' => __( 'No Team found', 'adeecore' ),
			'not_found_in_trash' => __( 'No Team found in Trash', 'adeecore' ),
			'parent_item_colon' => ''
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_icon' => 'dashicons-id',
			'menu_position' => 23,
			'supports' => array( 'title', 'editor', 'thumbnail', ),
			'rewrite' => array(
				'slug' => apply_filters( 'team_slug', __( 'teams', 'adeecore' ) ),
			)
		);

		register_post_type( 'teams', $args );

	}
	add_action( 'init', 'create_teams_post_type' );
}



/* Create Teams Taxonomies */
if( !function_exists( 'create_teams_taxonomies' ) ){
    function create_teams_taxonomies(){
        $labels = array(
            'name' => __( 'Team Categories', 'adeecore' ),
            'singular_name' => __( 'Team Category', 'adeecore' ),
            'search_items' =>  __( 'Search Team Categories', 'adeecore' ),
            'popular_items' => __( 'Popular Team Categories', 'adeecore' ),
            'all_items' => __( 'All Team Categories', 'adeecore' ),
            'parent_item' => __( 'Parent Team Category', 'adeecore' ),
            'parent_item_colon' => __( 'Parent Team Category:', 'adeecore' ),
            'edit_item' => __( 'Edit Team Category', 'adeecore' ),
            'update_item' => __( 'Update Team Category', 'adeecore' ),
            'add_new_item' => __( 'Add New Team Category', 'adeecore' ),
            'new_item_name' => __( 'New Team Category Name', 'adeecore' ),
            'separate_items_with_commas' => __( 'Separate Team Category with commas', 'adeecore' ),
            'add_or_remove_items' => __( 'Add or remove Team Category', 'adeecore' ),
            'choose_from_most_used' => __( 'Choose from the most used Team Category', 'adeecore' ),
            'menu_name' => __( 'Teams Category', 'adeecore' )
        );

        register_taxonomy(
            'teams-category',
            array('teams'),
            array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => apply_filters( 'teams_category_slug', __( 'teams-category', 'adeecore' ) ) )
            )
        );
    }
	add_action( 'init', 'create_teams_taxonomies', 0 );
}

/* -------------------------------------
 * Edit columns
 * ------------------------------------- */
function teams_edit_columns($columns)
{
	$column = array(
		'cb' 					=> '<input type="checkbox" />',
		'thumb' 				=> __('Thumbnail','adeecore'),
		'title' 				=> 'Title',
		'category' 				=> __('Categories','adeecore'),
		'date' 					=> __('Publish Date','adeecore'),
	);

	return $column;
}
add_filter('manage_edit-teams_columns', 'teams_edit_columns');  

/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */
function teams_custom_columns($column)
{
	global $post;
	switch ($column)
	{
		case 'thumb':
			if ( has_post_thumbnail($post->ID) ) { the_post_thumbnail( array( 50, 50 ) ); }
			break;
		case 'category':
			$terms = get_the_term_list( $post->ID, 'teams-category', '', ',', '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			}
			break;	
	}
}
add_action('manage_teams_posts_custom_column',  'teams_custom_columns' );


/*--------------------------------------------------------
*     Clients
--------------------------------------------------------*/
if ( ! function_exists( 'create_clients_post_type' ) ) {
	function create_clients_post_type() {

		$labels = array(
			'name' => __( 'Clients', 'adeecore' ),
			'singular_name' => __( 'Client', 'adeecore' ),
			'add_new' => __( 'Add New', 'adeecore' ),
			'add_new_item' => __( 'Add New Client', 'adeecore' ),
			'edit_item' => __( 'Edit Client', 'adeecore' ),
			'new_item' => __( 'New Client', 'adeecore' ),
			'view_item' => __( 'View Clients', 'adeecore' ),
			'search_items' => __( 'Search Clients', 'adeecore' ),
			'not_found' => __( 'No Client found', 'adeecore' ),
			'not_found_in_trash' => __( 'No Client found in Trash', 'adeecore' ),
			'parent_item_colon' => ''
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_icon' => 'dashicons-clipboard',
			'menu_position' => 20,
			'supports' => array( 'title', 'thumbnail' ),
			'rewrite' => array(
				'slug' => apply_filters( 'clients_slug', __( 'clients', 'adeecore' ) ),
			)
		);

		register_post_type( 'clients', $args );

	}
	add_action( 'init', 'create_clients_post_type' );
}

/* Create Clients Taxonomies */
if( !function_exists( 'create_clients_taxonomies' ) ){
    function create_clients_taxonomies(){
        $labels = array(
            'name' => __( 'Client Categories', 'adeecore' ),
            'singular_name' => __( 'Client Category', 'adeecore' ),
            'search_items' =>  __( 'Search Client Categories', 'adeecore' ),
            'popular_items' => __( 'Popular Client Categories', 'adeecore' ),
            'all_items' => __( 'All Client Categories', 'adeecore' ),
            'parent_item' => __( 'Parent Client Category', 'adeecore' ),
            'parent_item_colon' => __( 'Parent Client Category:', 'adeecore' ),
            'edit_item' => __( 'Edit Client Category', 'adeecore' ),
            'update_item' => __( 'Update Client Category', 'adeecore' ),
            'add_new_item' => __( 'Add New Client Category', 'adeecore' ),
            'new_item_name' => __( 'New Client Category Name', 'adeecore' ),
            'separate_items_with_commas' => __( 'Separate Client Category with commas', 'adeecore' ),
            'add_or_remove_items' => __( 'Add or remove Client  Category', 'adeecore' ),
            'choose_from_most_used' => __( 'Choose from the most used Clients Category', 'adeecore' ),
            'menu_name' => __( 'Clients Category', 'adeecore' )
        );

        register_taxonomy(
            'clients-category',
            array('clients'),
            array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => apply_filters( 'clients_category_slug', __( 'clients-category', 'adeecore' ) ) )
            )
        );
    }
	add_action( 'init', 'create_clients_taxonomies', 0 );
}

/* -------------------------------------
 * Edit columns
 * ------------------------------------- */
function clients_edit_columns($columns)
{
	$column = array(
		'cb' 					=> '<input type="checkbox" />',
		'thumb' 				=> __('Thumbnail','adeecore'),
		'title' 				=> __('Title','adeecore'),
		'category' 				=> __('Categories','adeecore'),
		'order'					=> __('Order', 'adeecore'),
		'date' 					=> __('Publish Date','adeecore'),
	);

	return $column;
}
add_filter('manage_edit-clients_columns', 'clients_edit_columns');  

/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */
function clients_custom_columns($column)
{
	global $post;
	switch ($column)
	{
		
		case 'thumb':
			if ( has_post_thumbnail($post->ID) ) { the_post_thumbnail( array( 50, 50 ) ); }
			break;
		case 'category':
			$terms = get_the_term_list( $post->ID, 'clients-category', '', ',', '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			}
			break;
		case 'order':
			echo $post->menu_order;
			break;	
	}
}
add_action('manage_clients_posts_custom_column',  'clients_custom_columns' );
