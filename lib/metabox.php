<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'dc_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function dc_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	$prefix = 'adee_';

	$meta_boxes[] = array(
		'id' => 'post-standard-settings',

		'title' => esc_html__( 'Settings', 'adeecore' ),
		'pages' => array( 'post', 'portfolio' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
	
			array(
				'id'			=> $prefix . 'page_sidebar',
				'type'			=> 'image_select',
				'name'			=> __( 'Page Sidebar', 'adeecore' ),
				'desc'			=> __( 'Set a unique sidebar for this page', 'adeecore' ),
				'options'		=> array(
					'default'		=> get_template_directory_uri() . '/images/sidebars/sidebar_default.png',
					'right'			=> get_template_directory_uri() . '/images/sidebars/sidebar_right.png',
					'left'			=> get_template_directory_uri() . '/images/sidebars/sidebar_left.png',
					'disabled'		=> get_template_directory_uri() . '/images/sidebars/sidebar_disabled.png',
				),
				'std'			=> 'default',
			),

			array(
				'id'			=> $prefix . 'left_sidebar',
				'type'			=> 'select_advanced',
				'name'			=> __( 'Left Sidebar', 'adeecore' ),
				'desc'			=> __( 'Select Left Sidebar', 'adeecore' ),
				'options'		=> adeetheming_show_sidebars(),
				'placeholder'	=> __( 'Select Sidebar', 'adeecore' ),
				'multiple'    => false,
				'std'			=> '',
			),

			array(
                'id'        	=> $prefix . 'sidebars_width',
               	'type'      	=> 'select_advanced',
               	'name'     		=> __( 'Sidebars Width', 'adeecore' ),
                'desc'		  	=> __( 'Set default sidebar width', 'adeecore' ),
                'options'      	=> array(
                    	'3'         => __( 'One Fourth', 'adeecore' ),
                    	'4'         => __( 'One Third', 'adeecore' ),
                ),
                'multiple'    => false,
                'std'   		=> '',
            ),	
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-highlights',
		'title' => esc_html__( 'Highlights Post', 'adeecore' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
	
			array(
				'name'  		=> esc_html__( 'Highlights Post', 'adeecore' ),
				'id'    		=> $prefix . 'highlight',
				'desc'  		=> esc_html__( 'Highlights Post', 'adeecore' ),
				'type'  		=> 'checkbox',
				'std'   		=> 0
			),	
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-featured',
		'title' => __( 'Featured Post', 'adeecore' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
	
			array(
				'name'  		=> esc_html__( 'Featured Post', 'adeecore' ),
				'id'    		=> $prefix . 'featured',
				'desc'  		=> esc_html__( 'Featured Post', 'adeecore' ),
				'type'  		=> 'checkbox',
				'std'   		=> 0
			),	
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-quote',
		'title' => esc_html__( 'Post Quote Settings', 'adeecore' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Qoute Text', 'adeecore' ),
				'id'    => $prefix . 'quote',
				'desc'  => esc_html__( 'Write Your Qoute Here', 'adeecore' ),
				'type'  => 'textarea',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Qoute Author', 'adeecore' ),
				'id'    => $prefix . 'quote_author',
				'desc'  => esc_html__( 'Write Qoute Author or Source', 'adeecore' ),
				'type'  => 'text',
				'std'   => ''
			)
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-chat',
		'title' => esc_html__( 'Post Chat Settings', 'adeecore' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Chat Message', 'adeecore' ),
				'id'    =>  $prefix . 'chat_text',
				'type' => 'wysiwyg',
				'raw'  => false,
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => false,
					'media_buttons' => false,
				)
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-link',
		'title' => esc_html__( 'Post Link Settings', 'adeecore' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Link URL', 'adeecore' ),
				'id'    => $prefix . 'link',
				'desc'  => esc_html__( 'Write Your Link', 'adeecore' ),
				'type'  => 'text',
				'std'   => ''
			),

			array(
				'name'  => esc_html__( 'Link Title', 'adeecore' ),
				'id'    => $prefix . 'link_title',
				'desc'  => esc_html__( 'Write Your Link Title', 'adeecore' ),
				'type'  => 'text',
				'std'   => ''
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-audio',
		'title' => esc_html__( 'Post Audio Settings', 'adeecore' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Audio Embed Code', 'adeecore' ),
				'id'    => $prefix . 'audio_code',
				'desc'  => esc_html__( 'Write Your Audio Embed Code Here', 'adeecore' ),
				'type'  => 'textarea',
				'std'   => ''
			)
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-status',
		'title' => esc_html__( 'Post Status Settings', 'adeecore' ),
		'pages' => array('post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Status URL', 'adeecore' ),
				'id'    => $prefix . 'status_url',
				'desc'  => esc_html__( 'Write Facebook, Twitter etc status link', 'adeecore' ),
				'type'  => 'textarea',
				'std'   => ''
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-video',
		'title' => esc_html__( 'Post Video Settings', 'adeecore' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Video Embed Code/ID', 'adeecore' ),
				'id'    => $prefix . 'video',
				'desc'  => esc_html__( 'Write Your Video Embed Code/ID Here', 'adeecore' ),
				'type'  => 'textarea',
				'std'   => ''
			),
			array(
				'name'     => esc_html__( 'Select Video Type/Source', 'adeecore' ),
				'id'       => $prefix . 'video_source',
				'type'     => 'select',
				'options'  => array(
					'1' => esc_html__( 'Embed Code', 'adeecore' ),
					'2' => esc_html__( 'YouTube', 'adeecore' ),
					'3' => esc_html__( 'Vimeo', 'adeecore' ),
				),
				'multiple'    => false,
				'std'         => '1'
			),
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-gallery',
		'title' => esc_html__( 'Post Gallery Settings', 'adeecore' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'             => esc_html__( 'Gallery Image Upload', 'adeecore' ),
				'id'               => $prefix . 'gallery_images',
				'type'             => 'image_advanced',
				'max_file_uploads' => 6,
			)			
		)
	);


	$meta_boxes[] = array(
		'id' => 'page-meta-settings',
		'title' => __( 'Page Settings', 'adeecore' ),
		'pages' => array( 'page'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
	
			array(
				'id'       		=> $prefix . 'header_type',
				'type'     		=> 'select_advanced',
				'name'     		=> __( 'Header Type', 'adeecore' ),
				'options'  => array(
					'1' => __( 'Solid header', 'adeecore' ),
					'2' => __( 'Transparent header', 'adeecore' ),
				),
				'multiple'    => false,
				'std'         => '1'
			),

			array(
				'id'			=> $prefix . 'revslider_type',
				'type'			=> 'select_advanced',
				'name'			=> __( 'Revolution Slider Type', 'adeecore' ),
				'desc'			=> __( 'Select Revolution Slider type', 'adeecore'),
				'options'		=> adeetheming_show_revslider(),
				'placeholder'	=> __( 'Revolution Slider', 'adeecore' ),
			),

			array(
				'id'			=> $prefix . 'page_sidebar',
				'type'			=> 'image_select',
				'name'			=> __( 'Page Sidebar', 'adeecore' ),
				'desc'			=> __( 'Set a unique sidebar for this page', 'adeecore' ),
				'options'		=> array(
					'default'		=> get_template_directory_uri() . '/images/sidebars/sidebar_default.png',
					'right'			=> get_template_directory_uri() . '/images/sidebars/sidebar_right.png',
					'left'			=> get_template_directory_uri() . '/images/sidebars/sidebar_left.png',
					'disabled'		=> get_template_directory_uri() . '/images/sidebars/sidebar_disabled.png',
				),
				'std'			=> 'default',
			),

			array(
				'id'			=> $prefix . 'left_sidebar',
				'type'			=> 'select_advanced',
				'name'			=> __( 'Left Sidebar', 'adeecore' ),
				'desc'			=> __( 'Select Left Sidebar', 'adeecore' ),
				'options'		=> adeetheming_show_sidebars(),
				'placeholder'	=> __( 'Select Sidebar', 'adeecore' ),
				'multiple'    => false,
				'std'			=> '',
			),

			array(
                'id'        	=> $prefix . 'sidebars_width',
               	'type'      	=> 'select_advanced',
               	'name'     		=> __( 'Sidebars Width', 'adeecore' ),
                'desc'		  	=> __( 'Set default sidebar width', 'adeecore' ),
                'options'      	=> array(
                    	'3'         => __( 'One Fourth', 'adeecore' ),
                    	'4'         => __( 'One Third', 'adeecore' ),
                ),
                'multiple'    => false,
                'std'   		=> '',
            ),

            array(
				'id'			=> $prefix . 'one_page',
				'type'			=> 'switch',
				'name'			=> __( 'One Page', 'adeecore' ),
				'desc'			=> __( 'Enable/Disable one page', 'adeecore' ),
				'options'		=> array(
					'disable'			=> __( 'Enable', 'adeecore' ),
				),
				'std'			=> false,
			),

			array(
				'id'			=> $prefix . 'disable_subheader',
				'type'			=> 'switch',
				'name'			=> __( 'Disable Subheader', 'adeecore' ),
				'desc'			=> __( 'Enable/Disable subheader', 'adeecore' ),
				'options'		=> array(
					'disable'			=> __( 'Disable', 'adeecore' ),
				),
				'std'			=> false,
			),

			array(
				'id'			=> $prefix . 'top_padding',
				'type'			=> 'text',
				'name'			=> __( 'Content Top Padding', 'adeecore' ),
				'desc'			=> __( 'Set padding for content top, leave empty to use theme options settings | e.g 10px', 'adeecore' ),
				'size'			=> 60,
				'std'			=> '',
			),

			array(
				'id'			=> $prefix . 'bottom_padding',
				'type'			=> 'text',
				'name'			=> __('Content Bottom Padding', 'adeecore' ),
				'desc'			=> __('Set padding for content bottom, leave empty to use theme options settings | e.g 10px', 'adeecore' ),
				'size'			=> 60,
				'std'			=> '',
			),
		)
	);

	/**---------------------------------------------
 	* METABOX PORTFOLIO SETTINGS
	* -------------------------------------------- */

	$meta_boxes[] = array(
		'id'			=> 'meta_box_portfolio_settings',
		'title'			=> __( 'Portfolio Setting Options', 'adeecore' ),
		'post_types'	=> array( 'portfolio' ),
		'autosave'		=> true,
		'context'		=> 'normal',
		'priority'		=> 'high',
		'fields'			=> array(

			//PORTFOLIO CLIENT TAB FIELDS
			array(
				'type'			=> 'heading',
				'name'			=> __( 'Project Client Section', 'adeecore' ),
			),
			array(
				'id'			=> $prefix . 'portfolio_client',
				'type'			=> 'text',
				'name'			=> __( 'Client', 'adeecore' ),
				'desc'			=> __( 'Client name or company name', 'adeecore' ),
				'size'			=> 60,
			),
			array(
				'id'			=> $prefix . 'portfolio_client_url',
				'type'			=> 'text',
				'name'			=> __( 'Client Website', 'adeecore' ),
				'desc'			=> __( 'Client or company\'s website', 'adeecore' ),
				'size'			=> 60,
			),
			array(
				'id'			=> $prefix . 'portfolio_url_target',
				'type'			=> 'switch',
				'name'			=> __( 'Link Target', 'adeecore' ),
				'desc'			=> __( 'Open in New Tab', 'adeecore' ),
				'options'		=> array(
					'newtab'			=> __( 'New Tab', 'adeecore' ),
				),
				'std'			=> '',
			),
			array(
				'id'			=> $prefix . 'portfolio_start',
				'type'			=> 'date',
				'name'			=> __( 'Project Start Date', 'adeecore' ),
				'desc'			=> '',
			),
			array(
				'id'			=> $prefix . 'portfolio_end',
				'type'			=> 'date',
				'name'			=> __( 'Project End Date', 'adeecore' ),
				'desc'			=> '',
			),
			array(
				'id'			=> $prefix . 'portfolio_desc',
				'type'			=> 'textarea',
				'name'			=> __( 'Client Short Description', 'adeecore' ),
				'desc'			=> __( 'Enter short description about clients or project', 'adeecore' ),
				'size'			=> 60,
			),
			array(
				'id'               	=> $prefix . 'portfolio_gallery',
				'type'             	=> 'image_advanced',
				'name'             	=> esc_html__( 'Portfolio Images', 'adeecore' ),
				'desc'				=> esc_html__( 'Upload portfolio images showcase if any', 'adeecore'),
				'max_file_uploads'	=> 10,
			)	
		)
	);


	/**---------------------------------------------
 	* METABOX TESTIMONIAL SETTINGS
	* ------------------------------------------- */

	$meta_boxes[] = array(
		'id'			=> 'meta_box_testimonial_settings',
		'title'			=> __( 'Testimonial Options', 'adeecore' ),
		'post_types'	=> array( 'testimonial' ),
		'autosave'		=> true,
		'context'		=> 'normal',
		'priority'		=> 'high',
		'fields'			=> array(
			array(
				'id'			=> $prefix . 'testimonial_company',
				'type'			=> 'text',
				'name'			=> __( 'Company Name', 'adeecore' ),
				'desc'			=> __( 'Enter company name if available', 'adeecore' ),
				'size'			=> 60,
			),
			array(
				'id'			=> $prefix . 'testimonial_url',
				'type'			=> 'text',
				'name'			=> __( 'Company\'s Website', 'adeecore' ),
				'desc'			=> __( 'Enter testimonial company\'s website if available', 'adeecore' ),
				'size'			=> 60,
			),
			array(
				'id'			=> $prefix . 'testimonial_url_target',
				'type'			=> 'checkbox',
				'name'			=> __( 'Link Target', 'adeecore' ),
				'desc'			=> __( 'Open Link in New Tab', 'adeecore' ),
				'options'		=> array(
					'newtab'			=> __( 'New Tab', 'adeecore' ),
				),
				'std'			=> '',
			),
			array(
				'id'			=> $prefix . 'testimonial_location',
				'type'			=> 'text',
				'name'			=> __( 'Company Location', 'adeecore' ),
				'desc'			=> __( 'Enter testimonial company\'s location if available', 'adeecore' ),
				'size'			=> 60,
			),
		),
	);



	/**---------------------------------------------
 	* METABOX FAQ SETTINGS
	* ------------------------------------------- */

	$meta_boxes[] = array(
		'id'			=> 'meta_box_faq_settings',
		'title'			=> __( 'FAQ Question And Answer', 'adeecore' ),
		'post_types'	=> array( 'faq' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'fields'			=> array(
			array(
				'id'			=> $prefix . 'faq_group',
				'type'			=> 'group',
				'clone'			=> true,
				'sort_clone'	=> true,
				'fields'		=> array(
					array(
						'id'			=> $prefix . 'faq_question',
						'type'			=> 'text',
						'name'			=> __( 'FAQ Question', 'adeecore' ),
						'desc'			=> __( 'Enter FAQ Question', 'adeecore' ),
						'size'			=> 60,
					),
					array(
						'id'			=> $prefix . 'faq_answer',
						'type'			=> 'wysiwyg',
						'name'			=> __( 'FAQ Answer', 'adeecore' ),
						'desc'			=> __( 'Enter answer to the faq question', 'adeecore' ),
						'options' => array(
						'textarea_rows'	=> 4,
						),
						'raw'			=> true,
					),
					array(
						'id'			=> $prefix . 'faq_activate',
						'type'			=> 'checkbox',
						'name'			=> __( 'Activate', 'adeecore' ),
						'desc'			=> __( 'Open/Close this FAQ content', 'adeecore' ),
						'std'			=> true,
					),
				),
			),
			array(
				'id'			=> $prefix . 'activateall',
				'type'			=> 'switch',
				'name'			=> __( 'Activate All', 'adeecore' ),
				'desc'			=> __( 'Open/Close all FAQ content', 'adeecore' ),
				'std'			=> true,
			),
		),
	);


	/**---------------------------------------------
 	* METABOX TEAMS SETTINGS
	* ------------------------------------------- */

	$meta_boxes[] = array(
		'id'			=> 'meta_box_teams_settings',
		'title'			=> __( 'Teams Details', 'adeecore' ),
		'post_types'	=> array( 'teams' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'fields'			=> array(
			array(
				'id'			=> $prefix . 'staff_position',
				'type'			=> 'text',
				'name'			=> __( 'Staff Position', 'adeecore' ),
				'desc'			=> __( 'Enter the position of this staff', 'adeecore' ),
				'size'			=> 60,
			),
			array(
				'id'			=> $prefix . 'teams_group',
				'type'			=> 'group',
				'clone'			=> true,
				'sort_clone'	=> true,
				'fields'		=> array(
					array(
						'id'			=> $prefix . 'social_site',
						'type'			=> 'select_advanced',
						'name'			=> __( 'Social Media', 'adeecore' ),
						'desc'			=> __( 'Select social media', 'adeecore' ),
						'options' 		=> social_media_icons(),
						'placeholder'	=> __( 'Select Social Media', 'adeecore' ),
						'multiple'    => false,
						'std'			=> '',
					),
					array(
						'id'			=> $prefix . 'social_link',
						'type'			=> 'text',
						'name'			=> __( 'Social Link', 'adeecore' ),
						'desc'			=> __( 'Enter Team Social media Link', 'adeecore' ),
						'size'			=> 60,
					),
				),
			),
			array(
				'id'			=> $prefix . 'link_target',
				'type'			=> 'switch',
				'name'			=> __( 'Link Target', 'adeecore' ),
				'desc'			=> __( 'Enable link to open in a (_blank tab/ _self tab)', 'adeecore' ),
				'std'		=> true,
			),
			array(
				'id'			=> $prefix . 'favquote',
				'type'			=> 'textarea',
				'name'			=> __( 'Favourite Quote', 'adeecore' ),
				'desc'			=> __( 'Enter Team favourite quote', 'adeecore' ),
			),
			array(
				'id'			=> $prefix . 'phone',
				'type'			=> 'text',
				'name'			=> __( 'Staff Phone #', 'adeecore' ),
				'desc'			=> __( 'Enter the phone number of staff', 'adeecore' ),
				'size'			=> 60,
			),
			array(
				'id'			=> $prefix . 'email',
				'type'			=> 'text',
				'name'			=> __( 'Staff Email ID', 'adeecore' ),
				'desc'			=> __( 'Enter the email adress of staff', 'adeecore' ),
				'size'			=> 60,
			),
		),
	);


	/**---------------------------------------------
 	* METABOX CLIENTS SETTINGS
	* ------------------------------------------- */

	$meta_boxes[] = array(
		'id'			=> 'meta_box_clients_settings',
		'title'			=> __( 'Client Details', 'adeecore' ),
		'post_types'	=> array( 'clients' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'fields'			=> array(
			array(
				'id'			=> $prefix . 'clients_url',
				'type'			=> 'text',
				'name'			=> __( 'Client Website', 'adeecore' ),
				'desc'			=> __( 'Enter the website link to redirect to', 'adeecore' ),
				'size'			=> 60,
			),
			array(
				'id'			=> $prefix . 'clients_target',
				'type'			=> 'switch',
				'name'			=> __( 'Link Target', 'adeecore' ),
				'desc'			=> __( 'Enable link to open in a (_blank tab/ _self tab)', 'adeecore' ),
				'std'		=> true,
			),
		),
	);



	
	return $meta_boxes;
}