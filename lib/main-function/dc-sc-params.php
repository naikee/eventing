<?php

add_action('vc_before_init', 'dc_sc_VCextendField');

if (! function_exists('dc_sc_VCextendField')) {
	function dc_sc_VCextendField() {

		$el_pixels = array( 
			__('Default', 'adeecore')	=> '',
			__('1px', 'adeecore')		=> '1px',
			__('2px', 'adeecore')		=> '2px',
			__('3px', 'adeecore')		=> '3px',
			__('4px', 'adeecore')		=> '4px',
			__('5px', 'adeecore')		=> '5px',
			__('6px', 'adeecore')		=> '6px',
			__('7px', 'adeecore')		=> '7px',
			__('8px', 'adeecore')		=> '8px',
			__('9px', 'adeecore')		=> '9px',
			__('10px', 'adeecore')		=> '10px',
			__('11px', 'adeecore')		=> '11px',
			__('12px', 'adeecore')		=> '12px',
			__('13px', 'adeecore')		=> '13px',
			__('14px', 'adeecore')		=> '14px',
			__('15px', 'adeecore')		=> '15px',
			__('16px', 'adeecore')		=> '16px',
			__('17px', 'adeecore')		=> '17px',
			__('18px', 'adeecore')		=> '18px',
			__('19px', 'adeecore')		=> '19px',
			__('20px', 'adeecore')		=> '20px',
			__('21px', 'adeecore')		=> '21px',
			__('22px', 'adeecore')		=> '22px',
			__('23px', 'adeecore')		=> '23px',
			__('24px', 'adeecore')		=> '24px',
			__('25px', 'adeecore')		=> '25px',
			__('26px', 'adeecore')		=> '26px',
			__('27px', 'adeecore')		=> '27px',
			__('28px', 'adeecore')		=> '28px',
			__('29px', 'adeecore')		=> '29px',
			__('30px', 'adeecore')		=> '30px'
		);

		$el_border = array( 
			__('Default', 'adeecore')	=> '',
			__('Solid', 'adeecore')		=> 'solid',
			__('Dotted', 'adeecore')	=> 'dotted',
			__('Dashed', 'adeecore')	=> 'dashed',
			__('Double', 'adeecore')	=> 'double',
			__('Groove', 'adeecore')	=> 'groove',
			__('Ridge', 'adeecore')		=> 'ridge',
			__('Inset', 'adeecore')		=> 'inset',
			__('Outset', 'adeecore')	=> 'outset'
		);

		$dc_vc_extendRow = array(
			array(
				'type'			=> 'dropdown',
				'heading'		=> __('Section App Class', 'adeecore'),
				'param_name'	=> 'section_appclass',
				'value'			=> array(
					__('Normal', 'adeecore')			=> '',
					__('Dark', 'adeecore')				=> 'darkrow',
					)
				),

			//Top Fancy Separator
			array(
				'type'			=> 'checkbox',
				'heading'		=> __('Enable Top Fancy Separator', 'adeecore'),
				'param_name'	=> 'enable_topfancysep',
				'value'			=> array(__('Yes, please enable', 'adeecore') => 'yes'),
				'group'			=> __('Fancy Separator', 'adeecore')
				),

			array(
				'type'			=> 'dropdown',
				'heading'		=> __('Top Fancy Separator', 'adeecore'),
				'param_name'	=> 'topfancysep',
				'value'			=> array(
					__('None', 'adeecore')					=> '',
					__('Top Traingle')						=> 'toprow-triangle',
					__('Top Diagonal', 'adeecore')			=> 'toprow-diagonal',
					__('Top Big Triangle', 'adeecore')		=> 'toprow-bigtriangleup',
					__('Top Big Triangle 2', 'adeecore')	=> 'toprow-bigtriangletwo',
					__('Top Curve Up', 'adeecore')			=> 'toprow-curveup',
					__('Top Curve Down', 'adeecore')		=> 'toprow-curvedown',
					__('Top Rounded Split', 'adeecore')		=> 'toprow-roundedsplit',
					__('Top Slit', 'adeecore')				=> 'toprow-slit',
					__('Top Big Half Circle', 'adeecore')	=> 'toprow-bighalfcircle',
					__('Top Split Slit', 'adeecore')		=> 'toprow-splitslit',
					__('Top Clouds'	, 'adeecore')			=> 'toprow-clouds',
					),
				'dependency'	=> array(
					'element'		=> 'enable_topfancysep',
					'not_empty'		=> true
					),
				'group'			=> __('Fancy Separator', 'adeecore')
				),

			array(
				'type'			=> 'colorpicker',
				'heading'		=> __('Top Fill Color', 'adeecore'),
				'param_name'	=> 'topfancysep_fill',
				'value'			=> '',
				'dependency'	=> array(
					'element'		=> 'enable_topfancysep',
					'not_empty'		=> true
					),
				'group'			=> __('Fancy Separator', 'adeecore')
				),

			array(
				'type'			=> 'colorpicker',
				'heading'		=> __('Top Fill Color 2', 'adeecore'),
				'param_name'	=> 'topfancysep_filltwo',
				'value'			=> '',
				'dependency'	=> array(
					'element'		=> 'topfancysep',
					'value'			=> array('toprow-splitslit')
					),
				'group'			=> __('Fancy Separator', 'adeecore')
				),

			array(
				'type'			=> 'colorpicker',
				'heading'		=> __('Fancy BG Color', 'adeecore'),
				'param_name'	=> 'topfancysep_bgcolor',
				'value'			=> '',
				'dependency'	=> array(
					'element'		=> 'topfancysep',
					'value'			=> array('toprow-diagonal', 'toprow-bigtriangleup', 'toprow-bigtriangletwo', 'toprow-curveup', 'toprow-curvedown', 'toprow-bighalfcircle', 'toprow-splitslit', 'toprow-clouds')
					),
				'group'			=> __('Fancy Separator', 'adeecore')
				),

			//Bottom Fancy Separator
			array(
				'type'			=> 'checkbox',
				'heading'		=> __('Enable Bottom Fancy Separator', 'adeecore'),
				'param_name'	=> 'enable_bottomfancysep',
				'value'			=> array(__('Yes, please enable', 'adeecore') => 'yes'),
				'group'			=> __('Fancy Separator', 'adeecore')
				),

			array(
				'type'			=> 'dropdown',
				'heading'		=> __('Bottom Fancy Separator', 'adeecore'),
				'param_name'	=> 'bottomfancysep',
				'value'			=> array(
					__('None', 'adeecore')					=> '',
					__('Bottom Traingle')					=> 'bottomrow-triangle',
					__('Bottom Diagonal', 'adeecore')		=> 'bottomrow-diagonal',
					__('Bottom Big Triangle', 'adeecore')	=> 'bottomrow-bigtriangledown',
					__('Bottom Big Triangle 2', 'adeecore')	=> 'bottomrow-bigtriangletwo',
					__('Bottom Curve Up', 'adeecore')		=> 'bottomrow-curveup',
					__('Bottom Curve Down', 'adeecore')		=> 'bottomrow-curvedown',
					__('Bottom Rounded Split', 'adeecore')	=> 'bottomrow-roundedsplit',
					__('Bottom Slit', 'adeecore')			=> 'bottomrow-slit',
					__('Bottom Big Half Circle', 'adeecore')=> 'bottomrow-bighalfcircle',
					__('Bottom Split Slit', 'adeecore')		=> 'bottomrow-splitslit',
					__('Bottom Clouds'	, 'adeecore')		=> 'bottomrow-clouds',
					),
				'dependency'	=> array(
					'element'		=> 'enable_bottomfancysep',
					'not_empty'		=> true
					),
				'group'			=> __('Fancy Separator', 'adeecore')
				),

			array(
				'type'			=> 'colorpicker',
				'heading'		=> __('Bottom Fill Color', 'adeecore'),
				'param_name'	=> 'bottomfancysep_fill',
				'value'			=> '',
				'dependency'	=> array(
					'element'		=> 'enable_bottomfancysep',
					'not_empty'		=> true
					),
				'group'			=> __('Fancy Separator', 'adeecore')
				),

			array(
				'type'			=> 'colorpicker',
				'heading'		=> __('Bottom Fill Color 2', 'adeecore'),
				'param_name'	=> 'bottomfancysep_filltwo',
				'value'			=> '',
				'dependency'	=> array(
					'element'		=> 'bottomfancysep',
					'value'			=> array('bottomrow-splitslit')
					),
				'group'			=> __('Fancy Separator', 'adeecore')
				),

			array(
				'type'			=> 'colorpicker',
				'heading'		=> __('Fancy BG Color', 'adeecore'),
				'param_name'	=> 'bottomfancysep_bgcolor',
				'value'			=> '',
				'dependency'	=> array(
					'element'		=> 'bottomfancysep',
					'value'			=> array('bottomrow-diagonal', 'bottomrow-bigtriangleup', 'bottomrow-bigtriangletwo', 'bottomrow-curveup', 'bottomrow-curvedown', 'bottomrow-bighalfcircle', 'bottomrow-splitslit', 'bottomrow-clouds')
					),
				'group'			=> __('Fancy Separator', 'adeecore')
				),

			//Background Slide
			array(
				'type'			=> 'checkbox',
				'heading'		=> __('Enable Background Slide', 'adeecore'),
				'param_name'	=> 'enable_rowbg_slide',
				'value'			=> array(__('Yes, please enable', 'adeecore') => 'yes'),
				'group'			=> __('Background Slide', 'adeecore')
				),

			array(
				'type'			=> 'attach_images',
				'heading'		=> __('Upload Slide Images', 'adeecore'),
				'param_name'	=> 'rowimg_slides',
				'value'			=> '',
				'dependency'	=> array(
					'element'		=> 'enable_rowbg_slide',
					'not_empty'		=> true
					),
				'group'			=> __('Background Slide', 'adeecore')
				),

			array(
				'type'			=> 'dropdown',
				'heading'		=> __('Background Overlay', 'adeecore'),
				'param_name'	=> 'rowbg_overlay',
				'value'			=> array(
					__('Overlay 1', 'adeecore')	=> 1,
					__('Overlay 2', 'adeecore')	=> 2,
					__('Overlay 3', 'adeecore')	=> 3,
					__('Overlay 4', 'adeecore')	=> 4,
					__('Overlay 5', 'adeecore')	=> 5,
					__('Overlay 6', 'adeecore')	=> 6,
					__('Overlay 7', 'adeecore')	=> 7,
					__('Overlay 8', 'adeecore')	=> 8,
					__('Overlay 9', 'adeecore')	=> 9,
					),
				'dependency'	=> array(
					'element'		=> 'enable_rowbg_slide',
					'not_empty'		=> true
					),
				'group'			=> __('Background Slide', 'adeecore')
				),

			array(
				'type'			=> 'dropdown',
				'heading'		=> __('Background Slide Transition', 'adeecore'),
				'param_name'	=> 'rowbg_transition',
				'value'			=> array(
					__('Fade', 'adeecore')			=> 'fade',
					__('Fade 2', 'adeecore')		=> 'fade2',
					__('slideLeft', 'adeecore')		=> 'slideLeft',
					__('slideLeft2', 'adeecore')	=> 'slideLeft2',
					__('slideRight', 'adeecore')	=> 'slideRight',
					__('slideRight2', 'adeecore')	=> 'slideRight2',
					__('slideUp', 'adeecore')		=> 'slideUp',
					__('slideUp2', 'adeecore')		=> 'slideUp2',
					__('slideDown', 'adeecore')		=> 'slideDown',
					__('slideDown2', 'adeecore')	=> 'slideDown2',
					__('zoomIn', 'adeecore')		=> 'zoomIn',
					__('zoomOut', 'adeecore')		=> 'zoomOut',
					__('swirlLeft', 'adeecore')		=> 'swirlLeft',
					__('blur', 'adeecore')			=> 'blur',
					),
				'dependency'	=> array(
					'element'		=> 'enable_rowbg_slide',
					'not_empty'		=> true
					),
				'group'			=> __('Background Slide', 'adeecore')
				),

			array(
				'type'			=> 'dropdown',
				'heading'		=> __('Background Slide Animation', 'adeecore'),
				'param_name'	=> 'rowbg_animation',
				'value'			=> array(
					__('kenburns', 'adeecore')			=> 'kenburns',
					__('kenburnsUp', 'adeecore')		=> 'kenburnsUp',
					__('kenburnsDown', 'adeecore')		=> 'kenburnsDown',
					__('kenburnsRight', 'adeecore')		=> 'kenburnsRight',
					__('kenburnsLeft', 'adeecore')		=> 'kenburnsLeft',
					__('kenburnsUpLeft', 'adeecore')	=> 'kenburnsUpLeft',
					__('kenburnsUpRight', 'adeecore')	=> 'kenburnsUpRight',
					__('kenburnsDownLeft', 'adeecore')	=> 'kenburnsDownLeft',
					__('kenburnsDownRight', 'adeecore')	=> 'kenburnsDownRight',
					__('random', 'adeecore')			=> 'random',
					),
				'dependency'	=> array(
					'element'		=> 'enable_rowbg_slide',
					'not_empty'		=> true
					),
				'group'			=> __('Background Slide', 'adeecore')
				),

			array(
				'type'			=> 'textfield',
				'heading'		=> __('Background Image Delay', 'adeecore'),
				'param_name'	=> 'rowbg_delay',
				'value'			=> 6000,
				'dependency'	=> array(
					'element'		=> 'enable_rowbg_slide',
					'not_empty'		=> true
					),
				'group'			=> __('Background Slide', 'adeecore')
				),
		);

		vc_add_params('vc_row', $dc_vc_extendRow);


		/*------------------------------------------------
		*	Accordions
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'accordion',
			'name'				=> __('Accordions', 'adeecore'),
			'as_parent'			=> array('only'	=> 'accordion_item'),
			'content_element'	=> true,
			'show_settings_on_create'	=> true,
			'is_container'		=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'js_view'			=> 'VcColumnView',
			'description'		=> __('Display accordion content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Accordion Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Style', 'adeecore'),
					'param_name'	=> 'style',
					'value'			=> array(
						__('Style 1', 'adeecore')		=> 'style1',
						__('Style 2', 'adeecore')		=> 'style2',
						__('Style 3', 'adeecore')		=> 'style3',
						__('Style 4', 'adeecore')		=> 'style4',
						__('Style 5', 'adeecore')		=> 'style5',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon', 'adeecore'),
					'param_name'	=> 'icons',
					'value'			=> array(
						__('Plus', 'adeecore')			=> 'fa-plus',
						__('Chevron', 'adeecore')		=> 'fa-chevron-down',
						__('Caret', 'adeecore')			=> 'fa-caret-down',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Align', 'adeecore'),
					'param_name'	=> 'icons_align',
					'value'			=> array(
						__('Left', 'adeecore')			=> 'left',
						__('Right', 'adeecore')			=> 'right',
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Active', 'adeecore'),
					'param_name'	=> 'active',
					'value'			=> 1,
					'min'			=> 1,
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Title Color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					'group'			=> __('Accordion Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Title Background Color', 'adeecore'),
					'param_name'	=> 'background',
					'value'			=> '',
					'group'			=> __('Accordion Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Active Title Color', 'adeecore'),
					'param_name'	=> 'activecolor',
					'value'			=> '',
					'group'			=> __('Accordion Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Active Title Background Color', 'adeecore'),
					'param_name'	=> 'activebg',
					'value'			=> '',
					'group'			=> __('Accordion Style', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Accordion Item
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'accordion_item',
			'name'				=> __('Accordion Item', 'adeecore'),
			'as_child'			=> array('only'	=> 'accordion'),
			'content_element'	=> true,
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Title Display', 'adeecore'),
					'param_name'	=> 'display',
					'value'			=> array(
						__('Title Only', 'adeecore')			=> 'title_only',
						__('Icon and Title', 'adeecore')		=> 'icon_title',
						__('Image and Title', 'adeecore')		=> 'image_title',
						__('Icon Only', 'adeecore')				=> 'icon_only',
						__('Image Only', 'adeecore')			=> 'image_only',
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Accordion Item Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'display',
						'value'			=> array('title_only', 'icon_title', 'image_title')
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' 		=> array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency' 	=> array(
						'element'			=> 'display',
						'value'				=> array('icon_title', 'icon_only')
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' 	=> array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Icon Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'display',
						'value'				=> array('image_title', 'image_only')
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Arrangement', 'adeecore'),
					'param_name'	=> 'arrangement',
					'value'			=> array(
						__('Icon before title', 'adeecore')		=> 'icon_before_title',
						__('Title before icon', 'adeecore')		=> 'title_before_icon',
						__('Image before title', 'adeecore')	=> 'image_before_title',
						__('Title before image', 'adeecore')	=> 'title_before_image'
						),
					'dependency'	=> array(
						'element'		=> 'display',
						'value'			=> array('image_title', 'icon_title')
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Image size', 'adeecore'),
					'param_name'	=> 'size',
					'min'			=> 1,
					'max'			=> 200,
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'display',
						'value'			=> array('image_title', 'image_only')
						),
					),

				array(
					'type' => 'textarea_html',
					'heading' => __( 'Accordion content', 'adeecore' ),
					'param_name' => 'content',
					'value' => __( '<p>Accordion content goes here, edit content and save.</p>', 'adeecore' ),
					),
				),
			)
		);


		/*------------------------------------------------
		*	Alert
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'alert',
			'name'				=> __('Alert', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display alert content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Simple', 'adeecore')		=> 'simple',
						__('Classic', 'adeecore')		=> 'classic',
						__('Modern', 'adeecore')		=> 'modern',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Alert', 'adeecore'),
					'param_name'	=> 'alerts',
					'value'			=> array(
						__('Success', 'adeecore')		=> 'sucess',
						__('Info', 'adeecore')			=> 'info',
						__('Warning', 'adeecore')		=> 'warning',
						__('Danger', 'adeecore')		=> 'danger',
						),
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> 'simple'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency'	=> array(
						'element'			=> 'type',
						'value'				=> array('classic', 'modern')
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' )
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency'	=> array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' 	=> array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Font size', 'adeecore'),
					'param_name'	=> 'font',
					'min'			=> 1,
					'max'			=> 100,
					'value'			=> '',
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('classic', 'modern')
						),
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> array('classic', 'modern')
						),
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Background Color', 'adeecore'),
					'param_name'	=> 'background',
					'value'			=> '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> array('classic', 'modern')
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Background Image', 'adeecore'),
					'param_name'	=> 'bg_image',
					'value'			=> '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> array('classic', 'modern')
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Style', 'adeecore'),
					'param_name'	=> 'style',
					'value'			=> array(
						__('Square', 'adeecore')		=> 'square',
						__('Rounded', 'adeecore')		=> 'rounded',
						__('Round', 'adeecore')			=> 'round',
						),
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> array('classic', 'modern')
						),
					),

				array(
					'type' => 'textarea_html',
					'heading' => __( 'Alert content', 'adeecore' ),
					'param_name' => 'content',
					'value' => __( '<p>Alert content goes here, edit content and save.</p>', 'adeecore' ),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Add delete button', 'adeecore'),
					'param_name'	=> 'delete',
					'value'			=> array(__('Yes, please add delete', 'adeecore') => 'yes'),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				),
			)
		);


		/*------------------------------------------------
		*	Audio Player
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'audioplayer',
			'name'				=> __('Audio Player', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display audio content.', 'adeecore'),
			'params'			=> array(

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Audio type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Normal', 'adeecore')		=> 'normal',
						__('Popup', 'adeecore')			=> 'popup',
						__('Button', 'adeecore')		=> 'buttons'
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Audio width', 'adeecore'),
					'param_name'	=> 'width',
					'min'			=> 10,
					'max'			=> 100,
					'step'			=> 5,
					'value'			=> 100,
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Audio link', 'adeecore'),
					'param_name'	=> 'audio',
					'value'			=> '',
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Audio Cover Image', 'adeecore'),
					'param_name'	=> 'cover',
					'value'			=> '',
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Cover align', 'adeecore'),
					'param_name'	=> 'align',
					'value'			=> array(
						__('Left', 'adeecore')		=> 'left',
						__('Right', 'adeecore')		=> 'right',
						),
					'dependency'	=> array(
						'element'		=> 'type',
						'value'			=> 'normal'
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Button text', 'adeecore'),
					'param_name'	=> 'buttons',
					'value'			=> 'Listen to audio',
					'dependency'	=> array(
						'element'			=> 'type',
						'value'				=> 'buttons'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Button align', 'adeecore'),
					'param_name'	=> 'buttonalign',
					'value'			=> array(
						__('Left', 'adeecore')		=> 'left',
						__('Center', 'adeecore')	=> 'center',
						__('Right', 'adeecore')		=> 'right',
						),
					'dependency'	=> array(
						'element'		=> 'type',
						'value'			=> 'buttons'
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon type', 'adeecore'),
					'param_name'	=> 'icon_type',
					'value'			=> array(
						__('Icon', 'adeecore')		=> 'icon',
						__('Image', 'adeecore')		=> 'image',
						),
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency' 	=> array(
						'element'			=> 'icon_type',
						'value'				=> 'icon'
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' 	=> array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' 	=> array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' 	=> array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' 	=> array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' 	=> array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Icon Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'icon_type',
						'value'				=> 'image'
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Image/Icon Size', 'adeecore'),
					'param_name'	=> 'size',
					'value'			=> 84,
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Audio title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> '',
					),

				array(
					'type'			=> 'textarea_html',
					'heading'		=> __( 'Audio content', 'adeecore' ),
					'param_name'	=> 'content',
					'value'			=> __( '<p>Audio content goes here, edit content and save.</p>', 'adeecore' ),
					'dependency'	=> array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Text align', 'adeecore'),
					'param_name'	=> 'textalign',
					'value'			=> array(
						__('Left', 'adeecore')		=> 'left',
						__('Center', 'adeecore')	=> 'center',
						__('Right', 'adeecore')		=> 'right',
						),
					'dependency'	=> array(
						'element'		=> 'type',
						'value'			=> array('normal', 'popup')
						)
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'type',
						'value'				=> array('popup','buttons')
						),
					'group'			=> __('Audio Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Button background color', 'adeecore'),
					'param_name'	=> 'btn_background',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'type',
						'value'				=> 'buttons'
						),
					'group'			=> __('Audio Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Background Color', 'adeecore'),
					'param_name'	=> 'background',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					'group'			=> __('Audio Style', 'adeecore')
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Background Image', 'adeecore'),
					'param_name'	=> 'bg_image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					'group'			=> __('Audio Style', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Background padding', 'adeecore'),
					'param_name'	=> 'padding',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					'group'			=> __('Audio Style', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				),
			)
		);


		/*------------------------------------------------
		*	Blockquote
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'blockquote',
			'name'				=> __('Blockquote', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display blockquote content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Simple', 'adeecore')		=> 'simple',
						__('Classic', 'adeecore')		=> 'classic',
						__('Modern', 'adeecore')		=> 'modern',
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Author', 'adeecore'),
					'param_name'	=> 'author',
					'value'			=> ''
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Link', 'adeecore'),
					'param_name'	=> 'link',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Target', 'adeecore'),
					'param_name'	=> 'target',
					'value'			=> array(
						__('Same Tab', 'adeecore')		=> '',
						__('New Tab', 'adeecore')		=> 'blank',
						),
					),

				array(
					'type' => 'textarea_html',
					'heading' => __( 'Blockquote content', 'adeecore' ),
					'param_name' => 'content',
					'value' => __( '<p>Blockquote content goes here, edit content and save.</p>', 'adeecore' ),
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Border color', 'adeecore'),
					'param_name'	=> 'border',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'type',
						'value'				=> array('simple','classic')
						),
					'group'			=> __('Blockquote Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Background Color', 'adeecore'),
					'param_name'	=> 'background',
					'value'			=> '',
					'group'			=> __('Blockquote Style', 'adeecore')
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Background Image', 'adeecore'),
					'param_name'	=> 'bg_image',
					'group'			=> __('Blockquote Style', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				),
			)
		);


		/*------------------------------------------------
		*	Blog Post
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'blog',
			'name'				=> __('Blog', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display blog content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Blog Layout', 'adeecore'),
					'param_name'	=> 'bloglayout',
					'value'			=> array(
						__('List', 'adeecore')				=> 'list_layout',
						__('Grid', 'adeecore')				=> 'grid_layout',
						__('Masonry', 'adeecore')			=> 'masonry_layout',
						__('Full image', 'adeecore')		=> 'full_image_layout',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Column', 'adeecore'),
					'param_name'	=> 'column',
					'value'			=> array(
						__('2 Column', 'adeecore')		=> 'cols__2',
						__('3 Column', 'adeecore')		=> 'cols__3',
						__('4 Column', 'adeecore')		=> 'cols__4',
						),
					'dependency'	=> array(
						'element'			=> 'bloglayout',
						'value'				=> array('grid_layout','masonry_layout')
						),
					),

				array(
					'type'			=> 'autocomplete',
					'heading'		=> __('Enter Category Title', 'adeecore'),
					'param_name'	=> 'category',
					'settings'		=> array(
						'multiple'			=> true,
						'sortable'			=> true,
						'unique_values'		=> true,
						'values'			=> dc_get_categories('category'),
						),
					),

				array(
					'type'			=> 'autocomplete',
					'heading'		=> __('Enter Category to Exclude', 'adeecore'),
					'param_name'	=> 'not_category',
					'settings'		=> array(
						'multiple'			=> true,
						'sortable'			=> true,
						'unique_values'		=> true,
						'values'			=> dc_get_categories('category'),
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Count', 'adeecore'),
					'param_name'	=> 'count',
					'min'			=> 1,
					'value'			=> 10
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'ASC',
						__('ASC', 'adeecore')			=> 'DESC',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Ajax load more', 'adeecore'),
					'param_name'	=> 'loadmore',
					'value'			=> array(
						__('True', 'adeecore')			=> true,
						__('False', 'adeecore')			=> false,
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Extra Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Blog Mag Block
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'blogmag',
			'name'				=> __('Blog Mag Block', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display blog mag block content.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Blog Mag Block Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'autocomplete',
					'heading'		=> __('Enter Category Title', 'adeecore'),
					'param_name'	=> 'category',
					'settings'		=> array(
						'multiple'			=> true,
						'sortable'			=> true,
						'unique_values'		=> true,
						'values'			=> dc_get_categories('category'),
						),
					),

				array(
					'type'			=> 'autocomplete',
					'heading'		=> __('Enter Category to Exclude', 'adeecore'),
					'param_name'	=> 'not_category',
					'settings'		=> array(
						'multiple'			=> true,
						'sortable'			=> true,
						'unique_values'		=> true,
						'values'			=> dc_get_categories('category'),
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Count', 'adeecore'),
					'param_name'	=> 'count',
					'min'			=> 1,
					'value'			=> 6
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'ASC',
						__('ASC', 'adeecore')			=> 'DESC',
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Extra Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Blog Mag Slide
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'blogmagslide',
			'name'				=> __('Blog Mag Slide', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display blog mag slide content.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Blog Mag Slide Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'autocomplete',
					'heading'		=> __('Enter Category Title', 'adeecore'),
					'param_name'	=> 'category',
					'settings'		=> array(
						'multiple'			=> true,
						'sortable'			=> true,
						'unique_values'		=> true,
						'values'			=> dc_get_categories('category'),
						),
					),

				array(
					'type'			=> 'autocomplete',
					'heading'		=> __('Enter Category to Exclude', 'adeecore'),
					'param_name'	=> 'not_category',
					'settings'		=> array(
						'multiple'			=> true,
						'sortable'			=> true,
						'unique_values'		=> true,
						'values'			=> dc_get_categories('category'),
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Count', 'adeecore'),
					'param_name'	=> 'count',
					'min'			=> 1,
					'value'			=> 6
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'ASC',
						__('ASC', 'adeecore')			=> 'DESC',
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Extra Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Blog Slide
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'blogslide',
			'name'				=> __('Blog slide', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display blog content in variety of slide styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Blog Slide Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'autocomplete',
					'heading'		=> __('Enter Category Title', 'adeecore'),
					'param_name'	=> 'category',
					'settings'		=> array(
						'multiple'			=> true,
						'sortable'			=> true,
						'unique_values'		=> true,
						'values'			=> dc_get_categories('category'),
						),
					),

				array(
					'type'			=> 'autocomplete',
					'heading'		=> __('Enter Category to Exclude', 'adeecore'),
					'param_name'	=> 'not_category',
					'settings'		=> array(
						'multiple'			=> true,
						'sortable'			=> true,
						'unique_values'		=> true,
						'values'			=> dc_get_categories('category'),
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Blogslide count', 'adeecore'),
					'param_name'	=> 'count',
					'min'			=> 1,
					'step'			=> 1,
					'value'			=> 6,
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Delay time', 'adeecore'),
					'param_name'	=> 'time',
					'min'			=> 0,
					'max'			=> 30000,
					'step'			=> 500,
					'value'			=> 5000,
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Pause on hover', 'adeecore'),
					'param_name'	=> 'hoverpause',
					'value'			=> array(
						__('Yes', 'adeecore')			=> true,
						__('No', 'adeecore')			=> false,
						),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Display arrow', 'adeecore'),
					'param_name'	=> 'navigation',
					'value'			=> array(__('Yes, display navigation arrow', 'adeecore') => 'display'),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'DESC',
						__('ASC', 'adeecore')			=> 'ASC',
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Button
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'button',
			'name'				=> __('Button', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display button content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Button Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' )
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> true,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Position', 'adeecore'),
					'param_name'	=> 'position',
					'value'			=> array(
						__('Left', 'adeecore')			=> 'left',
						__('Right', 'adeecore')			=> 'right',
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Link', 'adeecore'),
					'param_name'	=> 'link',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Target', 'adeecore'),
					'param_name'	=> 'target',
					'value'			=> array(
						__('Same Tab', 'adeecore')		=> '',
						__('New Tab', 'adeecore')		=> 'blank',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Button alignment', 'adeecore'),
					'param_name'	=> 'alignment',
					'value'			=> array(
						__('Left', 'adeecore')			=> 'left',
						__('Center', 'adeecore')		=> 'center',
						__('Right', 'adeecore')			=> 'right',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Button size', 'adeecore'),
					'param_name'	=> 'size',
					'value'			=> array(
						__('Small', 'adeecore')			=> 'small',
						__('Medium', 'adeecore')		=> 'medium',
						__('Large', 'adeecore')			=> 'large',
						__('Full width', 'adeecore')	=> 'full_width',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Button type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Flat', 'adeecore')			=> 'flat',
						__('Modern', 'adeecore')		=> 'modern',
						__('Classic', 'adeecore')		=> 'classic',
						__('3D', 'adeecore')			=> 'three_d',
						__('Outline', 'adeecore')		=> 'outline',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Style', 'adeecore'),
					'param_name'	=> 'style',
					'value'			=> array(
						__('Square', 'adeecore')		=> 'square',
						__('Rounded', 'adeecore')		=> 'rounded',
						__('Round', 'adeecore')			=> 'round',
						),
					),


				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					'group'			=> __('Button Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Background Color', 'adeecore'),
					'param_name'	=> 'background',
					'value'			=> '',
					'group'			=> __('Button Style', 'adeecore')
					),


				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Hover Color', 'adeecore'),
					'param_name'	=> 'hovercolor',
					'value'			=> '',
					'group'			=> __('Button Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Hover Background Color', 'adeecore'),
					'param_name'	=> 'hoverbg',
					'value'			=> '',
					'group'			=> __('Button Style', 'adeecore')
					),


				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				),
			)
		);


		/*------------------------------------------------
		*	Chart
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'chart',
			'name'				=> __('Circle Chart', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display chart content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Chart Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Chart percent', 'adeecore'),
					'param_name'	=> 'percent',
					'min'			=> 1,
					'max'			=> 100,
					'value'			=> ''
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Chart Label', 'adeecore'),
					'param_name'	=> 'label',
					'value'			=> ''
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Prefix', 'adeecore'),
					'param_name'	=> 'prefix',
					'value'			=> ''
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Suffix', 'adeecore'),
					'param_name'	=> 'suffix',
					'value'			=> '%'
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Line width', 'adeecore'),
					'param_name'	=> 'line_width',
					'min'			=> 2,
					'max'			=> 30,
					'value'			=> ''
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Font Size', 'adeecore'),
					'param_name'	=> 'size',
					'min'			=> 2,
					'max'			=> 64,
					'value'			=> ''
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					'group'			=> __('Chart Style', 'adeecore'),
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Track Color', 'adeecore'),
					'param_name'	=> 'track_color',
					'value'			=> '',
					'group'			=> __('Chart Style', 'adeecore'),
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Title Color', 'adeecore'),
					'param_name'	=> 'title_color',
					'value'			=> '',
					'group'			=> __('Chart Style', 'adeecore'),
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Label Color', 'adeecore'),
					'param_name'	=> 'label_color',
					'value'			=> '',
					'group'			=> __('Chart Style', 'adeecore'),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				),
			)
		);


		/*------------------------------------------------
		*	Clients
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'clients',
			'name'				=> __('Clients', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display clients content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Clients Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Slide', 'adeecore')			=> 'slide',
						__('Grid', 'adeecore')			=> 'grid',
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Delay time', 'adeecore'),
					'param_name'	=> 'time',
					'min'			=> 0,
					'max'			=> 30000,
					'step'			=> 500,
					'value'			=> 5000,
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> 'slide'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Pause on hover', 'adeecore'),
					'param_name'	=> 'hoverpause',
					'value'			=> array(
						__('True', 'adeecore')			=> true,
						__('False', 'adeecore')			=> false,
						),
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> 'slide'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Columns', 'adeecore'),
					'param_name'	=> 'column',
					'value'			=> array(
						__('Two', 'adeecore')			=> 2,
						__('Three', 'adeecore')			=> 3,
						__('Four', 'adeecore')			=> 4,
						__('Five', 'adeecore')			=> 5,
						__('Six', 'adeecore')			=> 6
						),
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> 'grid'
						),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Show Border', 'adeecore'),
					'param_name'	=> 'border',
					'value'			=> array(__('Yes, display client border', 'adeecore') => 'yes'),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Category', 'adeecore'),
					'param_name'	=> 'category',
					'value'			=> dc_get_categories('clients-category'),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'DESC',
						__('ASC', 'adeecore')			=> 'ASC',
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Content Box
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'contentbox',
			'name'				=> __('Content Box', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display content box in variety of styles.', 'adeecore'),
			'params'			=> array(

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Horizontal', 'adeecore')		=> 'horizontal',
						__('Vertical', 'adeecore')			=> 'vertical',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Horizontal Style', 'adeecore'),
					'param_name'	=> 'horizontal',
					'value'			=> array(
						__('Style 1', 'adeecore')		=> 'style1',
						__('Style 2', 'adeecore')		=> 'style2',
						),
					'dependency'	=> array(
						'element'	=> 'type',
						'value'		=> 'horizontal'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Content Box Wrap', 'adeecore'),
					'param_name'	=> 'wrap',
					'value'			=> array(
						__('Div', 'adeecore')		=> 'div',
						__('Anchor', 'adeecore')	=> 'a',
						),
					),

				array(
					'type'			=> 'textarea_html',
					'heading'		=> __('Content', 'adeecore'),
					'param_name'	=> 'content',
					'value'			=> '',
					'description'	=> __( 'Short description to display.', 'adeecore' ),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Button Text', 'adeecore'),
					'param_name'	=> 'button_text',
					'value'			=> '',
					'dependency'	=> array(
						'element'	=> 'wrap',
						'value'		=> 'div'
						),
					),

				array(
					'type'			=> 'vc_link',
					'heading'		=> __('Link URL', 'adeecore'),
					'param_name'	=> 'link',
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Content Alignment', 'adeecore'),
					'param_name'	=> 'alignment',
					'value'			=> array(
						__('Left', 'adeecore')			=> 'left',
						__('Center', 'adeecore')		=> 'center',
						__('Right', 'adeecore')			=> 'right',
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Content Padding', 'adeecore'),
					'param_name'	=> 'contentpad',
					'value'			=> '',
					),

				array(
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Color', 'adeecore'),
					'param_name' 	=> 'color',
					'value' 		=> '',
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Background Color', 'adeecore'),
					'param_name' 	=> 'background',
					'value' 		=> '',
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Background Image', 'adeecore'),
					'param_name'	=> 'bg_image',
					'value'			=> '',
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Button Color', 'adeecore'),
					'param_name' 	=> 'btn_color',
					'value' 		=> '',
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Button Background Color', 'adeecore'),
					'param_name' 	=> 'btn_background',
					'value' 		=> '',
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Button Hover Color', 'adeecore'),
					'param_name' 	=> 'btn_hover',
					'value' 		=> '',
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type' 			=> 'colorpicker',
					'heading' 		=> __('Button Background Hover', 'adeecore'),
					'param_name' 	=> 'btn_bg_hover',
					'value' 		=> '',
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Enable Box Shadow', 'adeecore'),
					'param_name'	=> 'boxshadow',
					'value'			=> array(__('Yes, enable box-shadow', 'adeecore') => 'yes'),
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Content Box Wrap', 'adeecore'),
					'param_name'	=> 'border',
					'value'			=> array(
						__('Disable', 'adeecore')		=> 'disable',
						__('Enable', 'adeecore')		=> 'enable',
						),
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Border Width', 'adeecore'),
					'param_name'	=> 'border_width',
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'border',
						'value'			=> 'enable',
						),
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Border Style', 'adeecore'),
					'param_name'	=> 'border_style',
					'value'			=> $el_border,
					'dependency'	=> array(
						'element'		=> 'border',
						'value'			=> 'enable',
						),
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> esc_html__('Border Color', 'adeecore'),
					'param_name'	=> 'border_color',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'border',
						'value'				=> 'enable',
						),
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Border Radius', 'adeecore'),
					'param_name'	=> 'border_radius',
					'value'			=> $el_pixels,
					'dependency'	=> array(
						'element'			=> 'border',
						'value'				=> 'enable',
						),
					'group'			=> __('Content Box Style', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Counter
		*-----------------------------------------------*/
		vc_map(array(
			'name' => __('Counter', 'adeecore'),
			'base' => 'counter',
			'class' => '',
			'description' => __('Display Counter in a variety of styles.', 'adeecore'),
			'category' => __('AdeeCore', 'adeecore'),
			'params' => array(		

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'	=> array(
						__('Simple', 'adeecore')			=> 'simple',
						__('Classic', 'adeecore')			=> 'classic',
						__('Modern', 'adeecore')			=> 'modern',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Type', 'adeecore'),
					'param_name'	=> 'icontype',
					'value'	=> array(
						__('Empty', 'adeecore')			=> '',
						__('Icon', 'adeecore')			=> 'icon',
						__('Image', 'adeecore')			=> 'image',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency' => array(
						'element'			=> 'icontype',
						'value'				=> 'icon'
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> true,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Icon Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'icontype',
						'value'				=> 'image'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Image / Icon size', 'adeecore'),
					'param_name'	=> 'size',
					'value'	=> array(
						__('Small', 'adeecore')			=> 'small',
						__('Medium', 'adeecore')		=> 'medium',
						__('Large', 'adeecore')			=> 'large'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Style', 'adeecore'),
					'param_name'	=> 'icon_format',
					'value'	=> array(
						__('Simple', 'adeecore')			=> 'simple',
						__('Square', 'adeecore')			=> 'square',
						__('Circle', 'adeecore')			=> 'circle',
						__('Rounded', 'adeecore')			=> 'rounded',
						__('Diagonal', 'adeecore')			=> 'diagonal',
						),
					'dependency' => array(
						'element' => 'icontype',
						'value' => 'icon',
						),
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Icon color', 'adeecore'),
					'param_name' => 'icon_color',
					'value' => '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Icon background color', 'adeecore'),
					'param_name' => 'icon_bg',
					'value' => '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Enable Icon Hover Animation', 'adeecore'),
					'param_name'	=> 'animatedicon',
					'value'			=> array(__('Yes, enable icon hover animation', 'adeecore') => 'yes'),
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					),		

				array(
					'type' => 'number',
					'heading' => __('Count To', 'adeecore'),
					'param_name' => 'counter_to',
					'value' => '',
					'description' => __( 'Number to count to.', 'adeecore' ),
					),

				array(
					'type' => 'number',
					'heading' => __('Count From', 'adeecore'),
					'param_name' => 'count_start',
					'value' => 0,
					'description' => __( 'Number to count from.', 'adeecore' ),
					),

				array(
					'type' => 'textfield',
					'heading' => __('Prefix Counter', 'adeecore'),
					'param_name' => 'count_prefix',
					'value' => '',
					'description' => __( 'Content show before counter', 'adeecore' ),
					),

				array(
					'type' => 'textfield',
					'heading' => __('Suffix Counter', 'adeecore'),
					'param_name' => 'count_suffix',
					'value' => '',
					'description' => __( 'Content show after counter', 'adeecore' ),
					),

				array(
					'type' => 'number',
					'heading' => __('Counter Size', 'adeecore'),
					'param_name' => 'count_size',
					'value' => 30,
					'description' => __( 'Set counter size', 'adeecore' ),
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Counter Color', 'adeecore'),
					'param_name' => 'count_color',
					'value' => '',
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					),

				array(
					'type' => 'number',
					'heading' => __('Counter Speed', 'adeecore'),
					'param_name' => 'count_speed',
					'min'			=> 500,
					'step'			=> 500,
					'value' => '',
					'description' => __( 'Short content to display on front image.', 'adeecore' ),
					),

				array(
					'type' => 'textfield',
					'heading' => __('Title', 'adeecore'),
					'param_name' => 'title',
					'value' => '',
					'description' => __( 'Counter title', 'adeecore' ),
					),		

				array(
					'type' => 'textarea_html',
					'heading' => __('Content', 'adeecore'),
					'param_name' => 'content',
					'value' => '',
					'description' => __( 'Short description to display.', 'adeecore' ),
					),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Text Color', 'adeecore'),
					'param_name' => 'txt_color',
					'value' => '',
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					),

				array(
					'type' => 'dropdown',
					'heading' => __('Alignment', 'adeecore'),
					'param_name' => 'alignment',
					'value' => array( 'Center' => 'center', 'Left Icon' => 'left', 'Right Icon' => 'right'),
					),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Background Color', 'adeecore'),
					'param_name' => 'background',
					'value' => '',
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'attach_image',
					'heading' => __('Upload Background Image', 'adeecore'),
					'param_name' => 'bg_image',
					'value' => '',
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Enable Box Shadow', 'adeecore'),
					'param_name'	=> 'boxshadow',
					'value'			=> array(__('Yes, enable box-shadow', 'adeecore') => 'yes'),
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'dropdown',
					'heading' => __('Border', 'adeecore'),
					'param_name' => 'border',
					'value' => array( 'Disable' => 'disable', 'Enable' => 'enable' ),
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'textfield',
					'heading' => __('Border Width', 'adeecore'),
					'param_name' => 'border_width',
					'value' => '',
					'dependency' => array(
						'element' => 'border',
						'value' => 'enable',
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'dropdown',
					'heading' => __('Border Style', 'adeecore'),
					'param_name' => 'border_style',
					'value' => $el_border,
					'dependency' => array(
						'element' => 'border',
						'value' => 'enable',
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Border Color', 'adeecore'),
					'param_name' => 'border_color',
					'value' => '',
					'dependency' => array(
						'element' => 'border',
						'value' => 'enable',
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'dropdown',
					'heading' => __('Border Radius', 'adeecore'),
					'param_name' => 'border_radius',
					'value' => $el_pixels,
					'dependency' => array(
						'element' => 'border',
						'value' => 'enable',
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'textfield',
					'heading' => esc_html__('Extra Class', 'adeecore'),
					'param_name' => 'class',
					'value' => '',
					),
				)
			)
		);


		/*------------------------------------------------
		*	Countdown
		*-----------------------------------------------*/
		vc_map(array(
			'name' => __('Countdown', 'adeecore'),
			'base' => 'countdown',
			'class' => '',
			'description' => __('Display Countdown in a variety of styles.', 'adeecore'),
			'category' => __('AdeeCore', 'adeecore'),
			'params' => array(		

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'	=> array(
						__('Simple', 'adeecore')			=> 'simple',
						__('Classic', 'adeecore')			=> 'classic',
						__('Modern', 'adeecore')			=> 'modern',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Alignment', 'adeecore'),
					'param_name'	=> 'alignment',
					'value'			=> array(
						__('Left', 'adeecore')			=> 'left',
						__('Center', 'adeecore')		=> 'center',
						__('Right', 'adeecore')			=> 'right',
						),
					),		

				array(
					'type' => 'datetime',
					'heading' => __('Date', 'adeecore'),
					'param_name' => 'date',
					'value' => '',
					'description' => __( 'Set Countdown Date', 'adeecore' ),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Show Date', 'adeecore'),
					'param_name'	=> 'showdate',
					'value'			=> array(__('Yes, display countdown date', 'adeecore') => 'yes'),
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					),

				array(
					'type' => 'textfield',
					'heading' => __('Title', 'adeecore'),
					'param_name' => 'title',
					'value' => '',
					'description' => __( 'Countdown title', 'adeecore' ),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Title Size', 'adeecore'),
					'param_name'	=> 'size',
					'min'			=> 1,
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					'group'			=> __('Title Style', 'adeecore')
					),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Counter Color', 'adeecore'),
					'param_name' => 'color',
					'value' => '',
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					'group'			=> __('Title Style', 'adeecore')
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Title Weight', 'adeecore'),
					'param_name'	=> 'weight',
					'min'			=> 100,
					'max'			=> 900,
					'step'			=> 100,
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					'group'			=> __('Title Style', 'adeecore')
					),		

				array(
					'type' => 'textarea_html',
					'heading' => __('Content', 'adeecore'),
					'param_name' => 'content',
					'value' => '',
					'description' => __( 'Short description to display.', 'adeecore' ),
					),

				array(
					'type' => 'textfield',
					'heading' => esc_html__('Extra Class', 'adeecore'),
					'param_name' => 'class',
					'value' => '',
					),
				)
			)
		);


		/*------------------------------------------------
		*	FAQ
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'faq',
			'name'				=> __('FAQ', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display FAQ content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('FAQ Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Classic', 'adeecore')			=> 'classic',
						__('Modern', 'adeecore')			=> 'modern',
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Active tab', 'adeecore'),
					'param_name'	=> 'active',
					'min'			=> 1,
					'max'			=> 30,
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Category', 'adeecore'),
					'param_name'	=> 'category',
					'value'			=> dc_get_categories('faq-category'),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'DESC',
						__('ASC', 'adeecore')			=> 'ASC',
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Flipbox
		*-----------------------------------------------*/
		vc_map(array(
			'name' => __('Flip Box', 'adeecore'),
			'base' => 'flipbox',
			'class' => '',
			'description' => __('Flips image on hover', 'adeecore'),
			'category' => __('AdeeCore', 'adeecore'),
			'params' => array(

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Outer Wrap', 'adeecore'),
					'param_name'	=> 'outer_wrap',
					'value'			=> array('Div' => 'div', 'Anchor' => 'a'),
					),

				array(
					'type'			=> 'vc_link',
					'heading'		=> __('Link URL', 'adeecore'),
					'param_name'	=> 'anchor_url',
					'dependency'	=> array(
						'element'	=> 'outer_wrap',
						'value'		=> 'a'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Flip Type', 'adeecore'),
					'param_name'	=> 'flip_type',
					'value'			=> array(
						'Card Flip'		=> 'cardflip',
						'Cube Flip'		=> 'cubeflip',
						'Cube Tilt'		=> 'cubetilt',
						'Cover Open'	=> 'coveropen'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Flip Direction', 'adeecore'),
					'param_name'	=> 'flip_direction',
					'value'			=> array(
						__('Up', 'adeecore')			=> 'n',
						__('Up/Right', 'adeecore')		=> 'ne',
						__('Right', 'adeecore')			=> 'e',
						__('Right/Down', 'adeecore')	=> 'se',
						__('Down', 'adeecore')			=> 's',
						__('Down/Left', 'adeecore')		=> 'sw',
						__('Left', 'adeecore')			=> 'w',
						__('Left/Up', 'adeecore')		=> 'nw'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Flip Ease', 'adeecore'),
					'param_name'	=> 'flip_ease',
					'value'			=> array(
						__('ease', 'adeecore')			=> 'ease',
						__('easeInOutExpo', 'adeecore')	=> 'easeInOutExpo',
						__('easeInOutCirc', 'adeecore')	=> 'easeInOutCirc',
						__('easeOutBack', 'adeecore')	=> 'easeOutBack'
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Flip Duration', 'adeecore'),
					'param_name'	=> 'flip_duration',
					'value'			=> 500,
					),

				//Front
				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Front Image', 'adeecore'),
					'param_name'	=> 'front_img',
					'value' 		=> '',
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Front Background Color', 'adeecore'),
					'param_name'	=> 'front_bgcolor',
					'value'			=> '',
					'group'			=> __('Flip Front' , 'adeecore')
					),			

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Type', 'adeecore'),
					'param_name'	=> 'icon_type',
					'value'			=> array('Icon'=>'icon','Image'=>'image'),
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'front_icon',
					'setting'		=> array(
						'emptyIcon' 	=> false,
						'type'			=> 'fontawesome',
					),
					'dependency'	=> array(
						'element'		=> 'icon_type',
						'value'			=> 'icon',
					),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					'value'			=> '',
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Icon Size', 'adeecore'),
					'param_name'	=> 'icon_size',
					'value'			=> 34,
					'dependency'	=> array(
						'element'		=> 'icon_type',
						'value'			=> 'icon',
					),
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Style', 'adeecore'),
					'param_name'	=> 'icon_format',
					'value'			=> array(
						__('Simple', 'adeecore')	=> 'simple',
						__('Circle', 'adeecore')	=> 'circle',
						__('Square', 'adeecore')	=> 'square',
						__('Diagonal', 'adeecore')	=> 'diagonal',
						),
					'dependency'	=> array(
						'element'		=> 'icon_type',
						'value'			=> 'icon',
					),
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Icon Color', 'adeecore'),
					'param_name'	=> 'front_iconcolor',
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'icon_type',
						'value'			=> 'icon',
					),
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Icon Background Color', 'adeecore'),
					'param_name'	=> 'front_iconbg',
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'icon_type',
						'value'			=> 'icon',
					),
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Image Icon', 'adeecore'),
					'param_name'	=> 'icon_img',
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'icon_type',
						'value' 		=> 'image',
					),
					'description'	=> __( 'Upload image to set as icon.', 'adeecore' ),
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Image Size', 'adeecore'),
					'param_name'	=> 'image_size',
					'value'			=> 34,
					'dependency'	=> array(
						'element'		=> 'icon_type',
						'value'			=> 'image',
					),
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Front Title', 'adeecore'),
					'param_name'	=> 'front_title',
					'value'			=> '',
					'description'	=> __( 'Short title to display on front image.', 'adeecore' ),
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Front Title Size', 'adeecore'),
					'param_name'	=> 'front_tsize',
					'value'			=> 22,
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'textarea',
					'heading'		=> __('Front Content', 'adeecore'),
					'param_name'	=> 'front_content',
					'value'			=> '',
					'description'	=> __( 'Short content to display on front image.', 'adeecore' ),
					'group'			=> __('Flip Front' , 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Front Text Color', 'adeecore'),
					'param_name'	=> 'front_txtcolor',
					'value'			=> '',
					'group'			=> __('Flip Front' , 'adeecore')
					),		

				//Back
				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Back Flip Image', 'adeecore'),
					'param_name'	=> 'back_img',
					'value'			=> '',
					'description'	=> __( 'Background image to display on hover', 'adeecore' ),
					'group'			=> __('Flip Back' , 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Back Background Color', 'adeecore'),
					'param_name'	=> 'back_bgcolor',
					'value'			=> '',
					'group'			=> __('Flip Back' , 'adeecore')
					),		

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Back Title', 'adeecore'),
					'param_name'	=> 'back_title',
					'value'			=> '',
					'description'	=> __( 'Short title to display on back image.', 'adeecore' ),
					'group'			=> __('Flip Back' , 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Back Title Size', 'adeecore'),
					'param_name'	=> 'back_tsize',
					'value'			=> 22,
					'group'			=> __('Flip Back' , 'adeecore')
					),			

				array(
					'type'			=> 'textarea',
					'heading'		=> __('Back Content', 'adeecore'),
					'param_name'	=> 'back_content',
					'value'			=> '',
					'description'	=> __( 'Short content to display on back image.', 'adeecore' ),
					'group'			=> __('Flip Back' , 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Front Text Color', 'adeecore'),
					'param_name'	=> 'back_txtcolor',
					'value'			=> '',
					'group'			=> __('Flip Back' , 'adeecore')
					),

				array(
					'type'			=> 'vc_link',
					'heading'		=> __('Button Link URL', 'adeecore'),
					'param_name'	=> 'link_url',
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'outer_wrap',
						'value'			=> 'div'
						),
					'group'			=> __('Flip Back' , 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> esc_html__('Button Text Color', 'adeecore'),
					'param_name'	=> 'btn_color',
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'outer_wrap',
						'value'			=> 'div'
						),
					'group'			=> __('Flip Back' , 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> esc_html__('Button Background', 'adeecore'),
					'param_name'	=> 'btn_background',
					'value'			=> '',
					'dependency'	=> array(
						'element' 		=> 'outer_wrap',
						'value'			=> 'div'
						),
					'group'			=> __('Flip Back' , 'adeecore')
					),

				//Custom
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Flip Width', 'adeecore'),
					'param_name'	=> 'flip_width',
					'value'			=> '100%',
					'group'			=> __('Custom Options' , 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Flip Height', 'adeecore'),
					'param_name'	=> 'flip_height',
					'value'			=> '',
					'group'			=> __('Custom Options' , 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Flip Padding', 'adeecore'),
					'param_name'	=> 'flip_pad',
					'value'			=> '15%',
					'group'			=> __('Custom Options' , 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Flip Border', 'adeecore'),
					'param_name'	=> 'flip_border',
					'value'			=> '',
					'group'			=> __('Custom Options' , 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Border Radius', 'adeecore'),
					'param_name'	=> 'flip_radius',
					'value'			=> '',
					'group'			=> __('Custom Options' , 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Border Color', 'adeecore'),
					'param_name'	=> 'border_color',
					'value'			=> '',
					'group'			=> __('Custom Options' , 'adeecore')
					),

				array(
					'type' => 'dropdown',
					'heading' => __('Border Style', 'adeecore'),
					'param_name' => 'border_style',
					'value' => $el_border,
					'group'			=> __('Custom Options' , 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Custom Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> '',
					'group'			=> __('Custom Options' , 'adeecore')
					),
				)
			)
		);


		/*------------------------------------------------
		*	Google Map
		*-----------------------------------------------*/
		vc_map(array(
			'name' => __('Google Map', 'adeecore'),
			'base' => 'googlemap',
			'class' => '',
			'description' => __('Display Google Map in a variety of styles.', 'adeecore'),
			'category' => __('AdeeCore', 'adeecore'),
			'params' => array(		

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Latitude', 'adeecore'),
					'param_name'	=> 'latitude',
					'value'			=> '6.5767137',
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Longitude', 'adeecore'),
					'param_name'	=> 'longitude',
					'value'			=> '3.3568001',
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Zoom', 'adeecore'),
					'param_name'	=> 'zoom',
					'value'			=> 13,
					'min'			=> 3,
					'max'			=> 21
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Height', 'adeecore'),
					'param_name'	=> 'height',
					'value'			=> 500,
					'min'			=> 50,
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type of Map', 'adeecore'),
					'param_name'	=> 'type',
					'value' 		=> array(
						__( 'ROADMAP', 'adeecore' )		=> 'ROADMAP',
						__( 'SATELLITE', 'adeecore' )	=> 'SATELLITE',
						__( 'HYBRID', 'adeecore' )		=> 'HYBRID',
						__( 'TERRAIN', 'adeecore' )		=> 'TERRAIN',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Draggable', 'adeecore'),
					'param_name'	=> 'draggable',
					'value' 		=> array(
						__( 'Disable', 'adeecore' )			=> '',
						__( 'Enable', 'adeecore' )			=> 'enable',
						__( 'Mobile Disable', 'adeecore' )	=> 'disable_mobile',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Mouse Scroll', 'adeecore'),
					'param_name'	=> 'scrollwheel',
					'value' 		=> array(
						__( 'Disable', 'adeecore' )			=> 'false',
						__( 'Enable', 'adeecore' )			=> 'true',
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Marker Icon', 'adeecore'),
					'param_name'	=> 'marker',
					'value'			=> '',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Marker Animation', 'adeecore'),
					'param_name'	=> 'animation',
					'value'			=> array(
						__('Drop', 'adeecore')			=> 'DROP',
						__('Bounce', 'adeecore')		=> 'BOUNCE',
						),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Contact Details', 'adeecore'),
					'param_name'	=> 'details',
					'value'			=> array(__('Yes, display contact details', 'adeecore') => 'yes'),
					'group'			=> __('Contact Info', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'details',
						'not_empty'			=> true
						),
					'group'			=> __('Contact Info', 'adeecore')
					),

				array(
					'type'			=> 'textarea_html',
					'heading'		=> __('Short description', 'adeecore'),
					'param_name'	=> 'content',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'details',
						'not_empty'			=> true
						),
					'group'			=> __('Contact Info', 'adeecore')
					),

				array(
					'type'			=> 'textarea',
					'heading'		=> __('Address', 'adeecore'),
					'param_name'	=> 'address',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'details',
						'not_empty'			=> true
						),
					'group'			=> __('Contact Info', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Email', 'adeecore'),
					'param_name'	=> 'email',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'details',
						'not_empty'			=> true
						),
					'group'			=> __('Contact Info', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Phone', 'adeecore'),
					'param_name'	=> 'phone',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'details',
						'not_empty'			=> true
						),
					'group'			=> __('Contact Info', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Website', 'adeecore'),
					'param_name'	=> 'website',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'details',
						'not_empty'			=> true
						),
					'group'			=> __('Contact Info', 'adeecore')
					),

				array(
					'type'			=> 'textarea_raw_html',
					'heading'		=> __('Map Skin Style', 'adeecore'),
					'param_name'	=> 'skin',
					'value'			=> '',
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Custom Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> '',
					),
				)
			)
		);



		/*------------------------------------------------
		*	Heading
		*-----------------------------------------------*/
		vc_map(array(
			'name' => __('Heading', 'adeecore'),
			'base' => 'heading',
			'class' => '',
			'description' => __('Display heading in a variety of styles.', 'adeecore'),
			'category' => __('AdeeCore', 'adeecore'),
			'params' => array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> '',
					),

				array(
					'type' => 'dropdown',
					'heading' => __( 'Heading  Tag', 'adeecore' ),
					'param_name' => 'tag',
					'value'			=> array(
						__('H1', 'adeecore')		=> 'h1',
						__('H2', 'adeecore')		=> 'h2',
						__('H3', 'adeecore')		=> 'h3',
						__('H4', 'adeecore')		=> 'h4',
						__('H5', 'adeecore')		=> 'h5',
						__('H6', 'adeecore')		=> 'h6',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Simple', 'adeecore')			=> 'simple',
						__('Classic', 'adeecore')			=> 'classic',
						__('Modern', 'adeecore')			=> 'modern',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Align Text', 'adeecore'),
					'param_name'	=> 'align',
					'value'			=> array(
						__('Left', 'adeecore')		=> 'left',
						__('Center', 'adeecore')	=> 'center',
						__('Right', 'adeecore')		=> 'right',
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Font Size', 'adeecore'),
					'param_name'	=> 'fontsize',
					'value'			=> '',
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Line Height', 'adeecore'),
					'param_name'	=> 'lineheight',
					'value'			=> '',
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Font Weight', 'adeecore'),
					'param_name'	=> 'weight',
					'value'			=> '',
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Enable responsive', 'adeecore'),
					'param_name'	=> 'responsive',
					'value'			=> array(__('Yes, display different size for smaller screen sizes', 'adeecore') => 'display'),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Font Size | Tablet', 'adeecore'),
					'param_name'	=> 'tabletsize',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'responsive',
						'not_empty'			=> true
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Line Height | Tablet', 'adeecore'),
					'param_name'	=> 'tabletheight',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'responsive',
						'not_empty'			=> true
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Font Size | Mobile', 'adeecore'),
					'param_name'	=> 'mobilesize',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'responsive',
						'not_empty'			=> true
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Line Height | Mobile', 'adeecore'),
					'param_name'	=> 'mobileheight',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'responsive',
						'not_empty'			=> true
						),
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Color', 'adeecore'),
					'param_name' => 'color',
					'value' => '',
					'dependency'	=> array(
						'element'			=> 'type',
						'value'			=> array('classic', 'modern')
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Extra Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> '',
					),
				)
			)
		);


		/*------------------------------------------------
		*	Hover Image
		*-----------------------------------------------*/
		vc_map(array(
			'name' => __('Hover Image', 'adeecore'),
			'base' => 'hoverimage',
			'class' => '',
			'description' => __('Display Hover Image effect in a variety of styles.', 'adeecore'),
			'category' => __('AdeeCore', 'adeecore'),
			'params' => array(
				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> '',
					),

				array(
					'type' => 'textarea_html',
					'heading' => __( 'Hover content', 'adeecore' ),
					'param_name' => 'content',
					'value' => __( '<p>Hover short description content goes here, edit content and save.</p>', 'adeecore' ),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Text alignment', 'adeecore'),
					'param_name'	=> 'align',
					'value'			=> array(
						__('Left', 'adeecore')			=> 'left',
						__('Center', 'adeecore')		=> 'center',
						__('Right', 'adeecore')			=> 'right',
						),
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Color', 'adeecore'),
					'param_name' => 'color',
					'value' => '',
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Border', 'adeecore'),
					'param_name'	=> 'border',
					'value'			=> '',
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Border Color', 'adeecore'),
					'param_name' => 'bordercolor',
					'value' => '',
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Add Link', 'adeecore'),
					'param_name'	=> 'anchor',
					'value'			=> array(
						__('None', 'adeecore')			=> '',
						__('Outer Wrap', 'adeecore')	=> 'container',
						__('Item title', 'adeecore')	=> 'item_title',
						),
					),

				array(
					'type'			=> 'vc_link',
					'heading'		=> __('Link URL', 'adeecore'),
					'param_name'	=> 'link',
					'dependency'	=> array(
						'element'	=> 'anchor',
						'value'		=> array('container', 'item_title')
						),
					),


				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Hover Effect', 'adeecore'),
					'param_name'	=> 'effect',
					'value'			=> array(
						__('Up', 'adeecore')			=> 'n',
						__('Up/Right', 'adeecore')		=> 'ne',
						__('Right', 'adeecore')			=> 'e',
						__('Right/Down', 'adeecore')	=> 'se',
						__('Down', 'adeecore')			=> 's',
						__('Down/Left', 'adeecore')		=> 'sw',
						__('Left', 'adeecore')			=> 'w',
						__('Left/Up', 'adeecore')		=> 'nw'
						),
					'group'			=> __('Hover Options', 'adeecore')
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Image Effect', 'adeecore'),
					'param_name'	=> 'hover',
					'value'			=> array(
						__('Zoom In', 'adeecore')		=> 'zoom-in',
						__('Zoom Out', 'adeecore')		=> 'zoom-out',
						__('Rotate Right', 'adeecore')	=> 'rotate-right',
						__('Rotate Left', 'adeecore')	=> 'rotate-left',
						__('Fade', 'adeecore')			=> 'fade',
						),
					'group'			=> __('Hover Options', 'adeecore')
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Hover Color', 'adeecore'),
					'param_name' => 'hovercolor',
					'value' => '',
					'group'			=> __('Hover Options', 'adeecore')
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Image', 'adeecore'),
					'param_name'	=> 'image2',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'hover',
						'value'				=> 'fade'
						),
					'group'			=> __('Hover Options', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Extra Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> '',
					),
				)
			)
		);


		/*------------------------------------------------
		*	Iconbox
		*-----------------------------------------------*/
		vc_map(array(
			'name' => __('Iconbox', 'adeecore'),
			'base' => 'iconbox',
			'class' => '',
			'description' => __('Display Iconbox in a variety of styles.', 'adeecore'),
			'category' => __('AdeeCore', 'adeecore'),
			'params' => array(		

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'	=> array(
						__('Simple', 'adeecore')			=> 'simple',
						__('Classic', 'adeecore')			=> 'classic',
						__('Modern', 'adeecore')			=> 'modern',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Type', 'adeecore'),
					'param_name'	=> 'icontype',
					'value'	=> array(
						__('Icon', 'adeecore')			=> 'icon',
						__('Image', 'adeecore')			=> 'image',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency' => array(
						'element'			=> 'icontype',
						'value'				=> 'icon'
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Icon Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'icontype',
						'value'				=> 'image'
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Image / Icon size', 'adeecore'),
					'param_name'	=> 'size',
					'min'			=> 1,
					'value'			=> 48,
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Style', 'adeecore'),
					'param_name'	=> 'icon_format',
					'value'	=> array(
						__('Simple', 'adeecore')			=> 'simple',
						__('Square', 'adeecore')			=> 'square',
						__('Circle', 'adeecore')			=> 'circle',
						__('Rounded', 'adeecore')			=> 'rounded',
						),
					'dependency' => array(
						'element' => 'icontype',
						'value' => 'icon',
						),
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Icon color', 'adeecore'),
					'param_name' => 'icon_color',
					'value' => '',
					'dependency' => array(
						'element' => 'icon_format',
						'value' => array('square', 'circle', 'rounded'),
						),
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Icon background color', 'adeecore'),
					'param_name' => 'icon_bg',
					'value' => '',
					'dependency' => array(
						'element' => 'icon_format',
						'value' => array('square', 'circle', 'rounded'),
						),
					),

				array(
					'type' => 'textfield',
					'heading' => __('Title', 'adeecore'),
					'param_name' => 'title',
					'value' => '',
					'description' => __( 'Counter title', 'adeecore' ),
					),		

				array(
					'type' => 'textarea_html',
					'heading' => __('Content', 'adeecore'),
					'param_name' => 'content',
					'value' => '',
					'description' => __( 'Short description to display.', 'adeecore' ),
					),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Text Color', 'adeecore'),
					'param_name' => 'txt_color',
					'value' => '',
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					),

				array(
					'type' => 'dropdown',
					'heading' => __('Alignment', 'adeecore'),
					'param_name' => 'alignment',
					'value' => array( 'Center' => 'center', 'Left Icon' => 'left', 'Right Icon' => 'right'),
					),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Background Color', 'adeecore'),
					'param_name' => 'bg_color',
					'value' => '',
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'attach_image',
					'heading' => __('Upload Background Image', 'adeecore'),
					'param_name' => 'bg_image',
					'value' => '',
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'dropdown',
					'heading' => __('Border', 'adeecore'),
					'param_name' => 'border',
					'value' => array( 'Disable' => 'disable', 'Enable' => 'enable' ),
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> array('modern', 'classic'),
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'textfield',
					'heading' => __('Border Width', 'adeecore'),
					'param_name' => 'border_width',
					'value' => '',
					'dependency' => array(
						'element' => 'border',
						'value' => 'enable',
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'dropdown',
					'heading' => __('Border Style', 'adeecore'),
					'param_name' => 'border_style',
					'value' => $el_border,
					'dependency' => array(
						'element' => 'border',
						'value' => 'enable',
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Border Color', 'adeecore'),
					'param_name' => 'border_color',
					'value' => '',
					'dependency' => array(
						'element' => 'border',
						'value' => 'enable',
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'dropdown',
					'heading' => __('Border Radius', 'adeecore'),
					'param_name' => 'border_radius',
					'value' => $el_pixels,
					'dependency' => array(
						'element' => 'border',
						'value' => 'enable',
						),
					'group'			=> __('Background Style', 'adeecore')
					),

				array(
					'type' => 'textfield',
					'heading' => esc_html__('Extra Class', 'adeecore'),
					'param_name' => 'class',
					'value' => '',
					),
				)
			)
		);

		
		/*------------------------------------------------
		*	Info List
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'infolist',
			'name'				=> __('Info List', 'adeecore'),
			'as_parent'			=> array('only'	=> 'infolist_item'),
			'content_element'	=> true,
			'show_settings_on_create'	=> true,
			'is_container'		=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'js_view'			=> 'VcColumnView',
			'description'		=> __('Display infolist content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Position', 'adeecore'),
					'param_name'	=> 'position',
					'value'			=> array(
						__('Left', 'adeecore')		=> 'left',
						__('Right', 'adeecore')		=> 'right',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Infolist type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Style 1', 'adeecore')			=> 'style1',
						__('Style 2', 'adeecore')			=> 'style2',
						__('Style 3', 'adeecore')			=> 'style3',
						__('Style 4', 'adeecore')			=> 'style4',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Style', 'adeecore'),
					'param_name'	=> 'iconstyle',
					'value'			=> array(
						__('Round Background', 'adeecore')		=> 'round',
						__('Square Background', 'adeecore')		=> 'square',
						__('Rounded Background', 'adeecore')	=> 'rounded',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon size', 'adeecore'),
					'param_name'	=> 'size',
					'value'			=> array(
						__('Small', 'adeecore')		=> 'small',
						__('Medium', 'adeecore')	=> 'medium',
						__('Large', 'adeecore')		=> 'large',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Connector Style', 'adeecore'),
					'param_name'	=> 'borderstyle',
					'value'			=> array(
						__('None', 'adeecore')			=> 'none',
						__('Solid', 'adeecore')			=> 'solid',
						__('Dashed', 'adeecore')		=> 'dashed',
						__('Dotted', 'adeecore')		=> 'dotted',
						__('Double', 'adeecore')		=> 'double',
						__('Inset', 'adeecore')			=> 'inset',
						__('Outset', 'adeecore')		=> 'outset',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Border Width', 'adeecore'),
					'param_name'	=> 'borderwidth',
					'value'			=> array(
						__('1px', 'adeecore')		=> '1px',
						__('2px', 'adeecore')		=> '2px',
						__('3px', 'adeecore')		=> '3px',
						__('4px', 'adeecore')		=> '4px',
						__('5px', 'adeecore')		=> '5px',
						__('6px', 'adeecore')		=> '6px',
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Extra Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Info List Item
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'infolist_item',
			'name'				=> __('Info List Item', 'adeecore'),
			'as_child'			=> array('only'	=> 'infolist'),
			'content_element'	=> true,
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Infolist Item Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> '',
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon type', 'adeecore'),
					'param_name'	=> 'icon_type',
					'value'			=> array(
						__('Icon', 'adeecore')			=> 'icon',
						__('Image', 'adeecore')			=> 'image',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency' => array(
						'element'			=> 'icon_type',
						'value'				=> 'icon'
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'icon_type',
						'value'				=> 'image'
						),
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Icon color', 'adeecore'),
					'param_name' => 'icon_color',
					'value' => '',
					'dependency' => array(
						'element' => 'icon_type',
						'value' => 'icon',
						),
					'group'			=> __('Color', 'adeecore')
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Icon background color', 'adeecore'),
					'param_name' => 'icon_bg_color',
					'value' => '',
					'dependency' => array(
						'element' => 'icon_type',
						'value' => 'icon',
						),
					'group'			=> __('Color', 'adeecore')
					),

				array(
					'type' => 'colorpicker',
					'heading' => __('Connector color', 'adeecore'),
					'param_name' => 'connector',
					'value' => '',
					'group'			=> __('Color', 'adeecore')
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Add Link', 'adeecore'),
					'param_name'	=> 'anchor',
					'value'			=> array(
						__('None', 'adeecore')			=> '',
						__('Outer Wrap', 'adeecore')	=> 'container',
						__('Item title', 'adeecore')	=> 'item_title',
						),
					),

				array(
					'type'			=> 'vc_link',
					'heading'		=> __('Link URL', 'adeecore'),
					'param_name'	=> 'link',
					'dependency'	=> array(
						'element'	=> 'anchor',
						'value'		=> array('container', 'item_title')
						),
					),

				array(
					'type' => 'textarea_html',
					'heading' => __( 'Infolist content', 'adeecore' ),
					'param_name' => 'content',
					'value' => __( '<p>Infolist content goes here, edit content and save.</p>', 'adeecore' ),
					),
				)
			)
		);
		

		/*------------------------------------------------
		*	Portfolio
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'portfolio',
			'name'				=> __('Portfolio', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display portfolio content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Portfolio Layout', 'adeecore'),
					'param_name'	=> 'layout',
					'value'			=> array(
						__('List', 'adeecore')				=> 'list_layout',
						__('Grid', 'adeecore')				=> 'grid_layout',
						__('Masonry', 'adeecore')			=> 'masonry_layout',
						__('Full image', 'adeecore')		=> 'full_image_layout',
						__('Flat Grid', 'adeecore')			=> 'flat_grid_layout',
						__('Flat Masonry', 'adeecore')		=> 'flat_masonry_layout',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Column', 'adeecore'),
					'param_name'	=> 'column',
					'value'			=> array(
						__('2 Column', 'adeecore')		=> 'cols__2',
						__('3 Column', 'adeecore')		=> 'cols__3',
						__('4 Column', 'adeecore')		=> 'cols__4',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Category', 'adeecore'),
					'param_name'	=> 'category',
					'value'			=> dc_get_categories('portfolio-category'),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Display filter', 'adeecore'),
					'param_name'	=> 'filter',
					'value'			=> array(
						__('True', 'adeecore')			=> true,
						__('False', 'adeecore')			=> false,
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Count', 'adeecore'),
					'param_name'	=> 'count',
					'min'			=> 1,
					'value'			=> 10
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'DESC',
						__('ASC', 'adeecore')			=> 'ASC',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Ajax load more', 'adeecore'),
					'param_name'	=> 'loadmore',
					'value'			=> array(
						__('True', 'adeecore')			=> true,
						__('False', 'adeecore')			=> false,
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Portfolio Slide
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'portfolioslide',
			'name'				=> __('Portfolio slide', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display portfolio content in variety of slide styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Portfolio Layout', 'adeecore'),
					'param_name'	=> 'layout',
					'value'			=> array(
						__('Grid', 'adeecore')				=> 'grid_layout',
						__('Flat Grid', 'adeecore')			=> 'flat_grid_layout',
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Portfolio Slide Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Category', 'adeecore'),
					'param_name'	=> 'category',
					'value'			=> dc_get_categories('portfolio-category'),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Portfolio Slide count', 'adeecore'),
					'param_name'	=> 'count',
					'min'			=> 1,
					'step'			=> 1,
					'value'			=> 6,
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Delay time', 'adeecore'),
					'param_name'	=> 'time',
					'min'			=> 0,
					'max'			=> 30000,
					'step'			=> 500,
					'value'			=> 5000,
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Pause on hover', 'adeecore'),
					'param_name'	=> 'hoverpause',
					'value'			=> array(
						__('Yes', 'adeecore')			=> true,
						__('No', 'adeecore')			=> false,
						),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Display arrow', 'adeecore'),
					'param_name'	=> 'navigation',
					'value'			=> array(__('Yes, display navigation arrow', 'adeecore') => 'display'),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'DESC',
						__('ASC', 'adeecore')			=> 'ASC',
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Pricing
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'pricing',
			'name'				=> __('Pricing', 'adeecore'),
			'as_parent'			=> array('only'	=> 'pricing_table'),
			'content_element'	=> true,
			'show_settings_on_create'	=> true,
			'is_container'		=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'js_view'			=> 'VcColumnView',
			'description'		=> __('Display pricing content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Classic', 'adeecore')		=> 'classic',
						__('Modern', 'adeecore')		=> 'modern',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Column', 'adeecore'),
					'param_name'	=> 'column',
					'value'			=> array(
						__('Two column', 'adeecore')	=> 2,
						__('Three column', 'adeecore')	=> 3,
						__('Four column', 'adeecore')	=> 4,
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Margin', 'adeecore'),
					'param_name'	=> 'margin',
					'value'			=> array(
						__('True', 'adeecore')			=> true,
						__('False', 'adeecore')			=> false,
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Pricing Table
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'pricing_table',
			'name'				=> __('Pricing table', 'adeecore'),
			'as_child'			=> array('only'	=> 'pricing'),
			'content_element'	=> true,
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon type', 'adeecore'),
					'param_name'	=> 'icon_type',
					'value'			=> array(
						__('Icon', 'adeecore')			=> 'icon',
						__('Image', 'adeecore')			=> 'image',
						__('HTML', 'adeecore')			=> 'html',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency' => array(
						'element'			=> 'icon_type',
						'value'				=> 'icon'
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'icon_type',
						'value'				=> 'image'
						),
					),

				array(
					'type' => 'textarea_raw_html',
					'heading' => __( 'HTML content', 'adeecore' ),
					'param_name' => 'html',
					'value' => __( 'HTML content goes here, edit content and save.', 'adeecore' ),
					'dependency'	=> array(
						'element'			=> 'icon_type',
						'value'				=> 'html'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Image / Icon size', 'adeecore'),
					'param_name'	=> 'size',
					'value'			=> array(
						__('Small', 'adeecore')			=> 'small',
						__('Medium', 'adeecore')		=> 'medium',
						__('Large', 'adeecore')			=> 'large',
						),
					'dependency'	=> array(
						'element'		=> 'icon_type',
						'value'			=> array('icon', 'image')
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Price', 'adeecore'),
					'param_name'	=> 'price',
					'value'			=> ''
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Duration', 'adeecore'),
					'param_name'	=> 'duration',
					'value'			=> ''
					),

				array(
					'type'			=> 'textarea_raw_html',
					'heading'		=> __( 'Feature items', 'adeecore' ),
					'param_name'	=> 'feature_items',
					'value'			=> '',
					),

				array(
					'type'			=> 'textarea',
					'heading'		=> __( 'Feature Content', 'adeecore' ),
					'param_name'	=> 'list_suffix',
					'value'			=> __( 'Feature content goes here, edit content and save.', 'adeecore' ),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Features alignment', 'adeecore'),
					'param_name'	=> 'alignment',
					'value'			=> array(
						__('Left', 'adeecore')			=> 'left',
						__('Center', 'adeecore')		=> 'center',
						__('Right', 'adeecore')			=> 'right',
						),
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Background color', 'adeecore'),
					'param_name'	=> 'background',
					'value'			=> '',
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Background Image', 'adeecore'),
					'param_name'	=> 'bg_image',
					'value'			=> '',
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Featured', 'adeecore'),
					'param_name'	=> 'featured',
					'value'			=> array(__('Yes, make featured', 'adeecore') => 'yes'),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Button text', 'adeecore'),
					'param_name'	=> 'button_text',
					'value'			=> 'BUY NOW',
					'group'			=> __('Pricing Button', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Button URL', 'adeecore'),
					'param_name'	=> 'button_url',
					'value'			=> '#',
					'group'			=> __('Pricing Button', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Button color', 'adeecore'),
					'param_name'	=> 'btn_color',
					'value'			=> '',
					'group'			=> __('Pricing Button', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Button background color', 'adeecore'),
					'param_name'	=> 'btn_bg',
					'value'			=> '',
					'group'			=> __('Pricing Button', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				),
			)
		);


		/*------------------------------------------------
		*	Progress bar
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'progressbar',
			'name'				=> __('Progress bar', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display progress bar in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Progress Value', 'adeecore'),
					'param_name'	=> 'value',
					'value'			=> '',
					'max'			=> 100,
					'min'			=> 1,
					'step'			=> 1
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Minimum Value', 'adeecore'),
					'param_name'	=> 'min_value',
					'value'			=> 0,
					'max'			=> 100,
					'min'			=> 1,
					'step'			=> 1
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Minimum Value', 'adeecore'),
					'param_name'	=> 'min_value',
					'value'			=> 100,
					'max'			=> 100,
					'min'			=> 1,
					'step'			=> 1
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Tip Symbol', 'adeecore'),
					'param_name'	=> 'tip_symbol',
					'value'			=> '%'
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Height', 'adeecore'),
					'param_name'	=> 'height',
					'value'			=> array(
						__('Small', 'adeecore')			=> 'small',
						__('Normal', 'adeecore')		=> 'normal',
						__('Big', 'adeecore')			=> 'big',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Bar type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Default', 'adeecore')		=> '',
						__('Success', 'adeecore')		=> 'progress-bar-success',
						__('Info', 'adeecore')			=> 'progress-bar-info',
						__('Error', 'adeecore')			=> 'progress-bar-error',
						__('Warning', 'adeecore')		=> 'progress-bar-warning',
						),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Bar Stripe', 'adeecore'),
					'param_name'	=> 'stripe',
					'value'			=> array(__('Yes, enable bar stripe', 'adeecore') => 'yes'),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Bar active', 'adeecore'),
					'param_name'	=> 'active',
					'value'			=> array(__('Yes, activate bar active', 'adeecore') => 'yes'),
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Bar color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Product Slide
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'shopslider',
			'name'				=> __('Product Slide', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display product content in variety of slide styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Product Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Category', 'adeecore'),
					'param_name'	=> 'category',
					'value'			=> dc_get_categories('product_cat'),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Product count', 'adeecore'),
					'param_name'	=> 'count',
					'min'			=> 1,
					'step'			=> 1,
					'value'			=> 6,
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Product type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Classic', 'adeecore')		=> 'classic',
						__('Modern', 'adeecore')		=> 'modern',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Product display', 'adeecore'),
					'param_name'	=> 'display',
					'value'			=> array(
						__('All', 'adeecore')				=> '',
						__('Featured', 'adeecore')			=> 'featured',
						__('Top Rated', 'adeecore')			=> 'top_rated',
						__('On Sale', 'adeecore')			=> 'on_sale',
						__('Best Selling', 'adeecore')		=> 'best_selling',
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Delay time', 'adeecore'),
					'param_name'	=> 'time',
					'min'			=> 0,
					'max'			=> 30000,
					'step'			=> 500,
					'value'			=> 5000,
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Pause on hover', 'adeecore'),
					'param_name'	=> 'hoverpause',
					'value'			=> array(
						__('Yes', 'adeecore')			=> true,
						__('No', 'adeecore')			=> false,
						),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Display arrow', 'adeecore'),
					'param_name'	=> 'navigation',
					'value'			=> array(__('Yes, display navigation arrow', 'adeecore') => 'display'),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Display teams bio', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Classic', 'adeecore')		=> 'classic',
						__('Modern', 'adeecore')		=> 'modern',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'DESC',
						__('ASC', 'adeecore')			=> 'ASC',
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Extra Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);

		
		/*------------------------------------------------
		*	Tabs
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'tabs',
			'name'				=> __('Tabs', 'adeecore'),
			'as_parent'			=> array('only'	=> 'tab'),
			'content_element'	=> true,
			'show_settings_on_create'	=> true,
			'is_container'		=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'js_view'			=> 'VcColumnView',
			'description'		=> __('Display tabs content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Tabs Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Horizontal', 'adeecore')	=> 'horizontal',
						__('Vertical', 'adeecore')		=> 'vertical',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Style', 'adeecore'),
					'param_name'	=> 'style',
					'value'			=> array(
						__('Style 1', 'adeecore')		=> 'style1',
						__('Style 2', 'adeecore')		=> 'style2',
						__('Style 3', 'adeecore')		=> 'style3',
						__('Style 4', 'adeecore')		=> 'style4',
						__('Style 5', 'adeecore')		=> 'style5',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Tabs Position', 'adeecore'),
					'param_name'	=> 'hposition',
					'value'			=> array(
						__('Top', 'adeecore')		=> 'top',
						__('Bottom', 'adeecore')	=> 'bottom',
						),
					'dependency'	=> array(
						'element'		=> 'type',
						'value'			=> 'horizontal'
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Tabs Position', 'adeecore'),
					'param_name'	=> 'vposition',
					'value'			=> array(
						__('Left', 'adeecore')		=> 'left',
						__('Right', 'adeecore')		=> 'right',
						),
					'dependency'	=> array(
						'element'		=> 'type',
						'value'			=> 'vertical'
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Tabs alignment', 'adeecore'),
					'param_name'	=> 'alignment',
					'value'			=> array(
						__('Left', 'adeecore')		=> 'left',
						__('Center', 'adeecore')	=> 'center',
						__('Right', 'adeecore')		=> 'right',
						),
					'dependency'	=> array(
						'element'		=> 'type',
						'value'			=> 'horizontal'
						)
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Active', 'adeecore'),
					'param_name'	=> 'active',
					'value'			=> 1,
					'min'			=> 1,
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Background color', 'adeecore'),
					'param_name'	=> 'background',
					'value'			=> '',
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Tab Item
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'tab',
			'name'				=> __('Tab Item', 'adeecore'),
			'as_child'			=> array('only'	=> 'tabs'),
			'content_element'	=> true,
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Title Display', 'adeecore'),
					'param_name'	=> 'display',
					'value'			=> array(
						__('Title Only', 'adeecore')			=> 'title_only',
						__('Icon and Title', 'adeecore')		=> 'icon_title',
						__('Image and Title', 'adeecore')		=> 'image_title',
						__('Icon Only', 'adeecore')				=> 'icon_only',
						__('Image Only', 'adeecore')			=> 'image_only',
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Tab Item Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'display',
						'value'			=> array('title_only', 'icon_title', 'image_title')
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency' => array(
						'element'			=> 'display',
						'value'				=> array('icon_title', 'icon_only')
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Icon Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'display',
						'value'				=> array('image_title', 'image_only')
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Arrangement', 'adeecore'),
					'param_name'	=> 'arrangement',
					'value'			=> array(
						__('Icon before title', 'adeecore')		=> 'icon_before_title',
						__('Title before icon', 'adeecore')		=> 'title_before_icon',
						__('Image before title', 'adeecore')	=> 'image_before_title',
						__('Title before image', 'adeecore')	=> 'title_before_image'
						),
					'dependency'	=> array(
						'element'		=> 'display',
						'value'			=> array('image_title', 'icon_title')
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Image size', 'adeecore'),
					'param_name'	=> 'size',
					'min'			=> 1,
					'max'			=> 200,
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'display',
						'value'			=> array('image_title', 'image_only')
						),
					),

				array(
					'type' => 'textarea_html',
					'heading' => __( 'Tab content', 'adeecore' ),
					'param_name' => 'content',
					'value' => __( '<p>Tab content goes here, edit content and save.</p>', 'adeecore' ),
					),
				),
			)
		);

		/*------------------------------------------------
		*	Teams Grid
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'teams_grid',
			'name'				=> __('Teams grid', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display teams content in variety of grid styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Teams Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Column', 'adeecore'),
					'param_name'	=> 'column',
					'value'			=> array(
						__('Two column', 'adeecore')	=> 2,
						__('Three column', 'adeecore')	=> 3,
						__('Four column', 'adeecore')	=> 4,
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Category', 'adeecore'),
					'param_name'	=> 'category',
					'value'			=> dc_get_categories('teams-category'),
					),


				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Display teams bio', 'adeecore'),
					'param_name'	=> 'bio',
					'value'			=> array(
						__('True', 'adeecore')			=> true,
						__('False', 'adeecore')			=> false,
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'DESC',
						__('ASC', 'adeecore')			=> 'ASC',
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Teams Slide
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'teams_slide',
			'name'				=> __('Teams slide', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display teams content in variety of slide styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Teams Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Category', 'adeecore'),
					'param_name'	=> 'category',
					'value'			=> dc_get_categories('teams-category'),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Teams count', 'adeecore'),
					'param_name'	=> 'count',
					'min'			=> 1,
					'step'			=> 1,
					'value'			=> 6,
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Delay time', 'adeecore'),
					'param_name'	=> 'time',
					'min'			=> 0,
					'max'			=> 30000,
					'step'			=> 500,
					'value'			=> 5000,
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Pause on hover', 'adeecore'),
					'param_name'	=> 'hoverpause',
					'value'			=> array(
						__('Yes', 'adeecore')			=> true,
						__('No', 'adeecore')			=> false,
						),
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Display arrow', 'adeecore'),
					'param_name'	=> 'navigation',
					'value'			=> array(__('Yes, display navigation arrow', 'adeecore') => 'display'),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Display teams bio', 'adeecore'),
					'param_name'	=> 'bio',
					'value'			=> array(
						__('Yes', 'adeecore')			=> true,
						__('No', 'adeecore')			=> false,
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'DESC',
						__('ASC', 'adeecore')			=> 'ASC',
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Testimonials
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'testimonails',
			'name'				=> __('Testimonials', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display testimonials content.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Slide', 'adeecore')			=> 'slide',
						__('List', 'adeecore')			=> 'list',
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Delay time', 'adeecore'),
					'param_name'	=> 'time',
					'min'			=> 0,
					'max'			=> 30000,
					'step'			=> 500,
					'value'			=> 5000,
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> 'slide'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Pause on hover', 'adeecore'),
					'param_name'	=> 'hoverpause',
					'value'			=> array(
						__('True', 'adeecore')			=> true,
						__('False', 'adeecore')			=> false,
						),
					'dependency' 	=> array(
						'element'			=> 'type',
						'value'				=> 'slide'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Category', 'adeecore'),
					'param_name'	=> 'category',
					'value'			=> dc_get_categories('testimonial-category'),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order by', 'adeecore'),
					'param_name'	=> 'orderby',
					'value'			=> array(
						__('Date', 'adeecore')			=> 'date',
						__('Title', 'adeecore')			=> 'title',
						__('Rand', 'adeecore')			=> 'rand',
						__('Menu order', 'adeecore')	=> 'menu_order',
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Order', 'adeecore'),
					'param_name'	=> 'order',
					'value'			=> array(
						__('DESC', 'adeecore')			=> 'DESC',
						__('ASC', 'adeecore')			=> 'ASC',
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Timeline
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'timeline',
			'name'				=> __('Timeline', 'adeecore'),
			'as_parent'			=> array('only'	=> 'timeline_item'),
			'content_element'	=> true,
			'show_settings_on_create'	=> true,
			'is_container'		=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'js_view'			=> 'VcColumnView',
			'description'		=> __('Display timeline content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Classic', 'adeecore')		=> 'classic',
						__('Modern', 'adeecore')		=> 'modern',
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Timeline Item
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'timeline_item',
			'name'				=> __('Timeline Item', 'adeecore'),
			'as_child'			=> array('only'	=> 'timeline'),
			'content_element'	=> true,
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Timeline Heading', 'adeecore'),
					'param_name'	=> 'heading',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Type', 'adeecore'),
					'param_name'	=> 'icontype',
					'value'	=> array(
						__('Icon', 'adeecore')			=> 'icon',
						__('Image', 'adeecore')			=> 'image',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency' => array(
						'element'			=> 'icontype',
						'value'				=> 'icon'
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Icon Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'icontype',
						'value'				=> 'image'
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Image size', 'adeecore'),
					'param_name'	=> 'size',
					'min'			=> 1,
					'max'			=> 100,
					'value'			=> ''
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Date', 'adeecore'),
					'param_name'	=> 'date',
					'value'			=> ''
					),

				array(
					'type' => 'textarea_html',
					'heading' => __( 'Timeline content', 'adeecore' ),
					'param_name' => 'content',
					'value' => __( '<p>Timeline content goes here, edit content and save.</p>', 'adeecore' ),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Heading size', 'adeecore'),
					'param_name'	=> 'hd_size',
					'min'			=> 1,
					'max'			=> 100,
					'value'			=> ''
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Heading color', 'adeecore'),
					'param_name'	=> 'hd_color',
					'value'			=> '',
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Background color', 'adeecore'),
					'param_name'	=> 'background',
					'value'			=> '',
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Icon color', 'adeecore'),
					'param_name'	=> 'icon_color',
					'value'			=> '',
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Icon background color', 'adeecore'),
					'param_name'	=> 'icon_bg_color',
					'value'			=> '',
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Background Image', 'adeecore'),
					'param_name'	=> 'bg_image',
					'value'			=> '',
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Link text', 'adeecore'),
					'param_name'	=> 'link_text',
					'value'			=> 'Learn More...',
					'group'			=> __('Timeline Button', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Link', 'adeecore'),
					'param_name'	=> 'link',
					'value'			=> '',
					'group'			=> __('Timeline Button', 'adeecore')
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Target', 'adeecore'),
					'param_name'	=> 'target',
					'value'			=> array(
						__('Same Tab', 'adeecore')		=> '',
						__('New Tab', 'adeecore')		=> 'blank',
						),
					'group'			=> __('Timeline Button', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Button color', 'adeecore'),
					'param_name'	=> 'btn_color',
					'value'			=> '',
					'group'			=> __('Timeline Button', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Button text color', 'adeecore'),
					'param_name'	=> 'btn_txt_color',
					'value'			=> '',
					'group'			=> __('Timeline Button', 'adeecore')
					),
				),
			)
		);


		/*------------------------------------------------
		*	Toggle
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'toggle',
			'name'				=> __('Toggle', 'adeecore'),
			'as_parent'			=> array('only'	=> 'toggle_item'),
			'content_element'	=> true,
			'show_settings_on_create'	=> true,
			'is_container'		=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'js_view'			=> 'VcColumnView',
			'description'		=> __('Display toggle content in variety of styles.', 'adeecore'),
			'params'			=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __('Toggle Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> ''
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Style', 'adeecore'),
					'param_name'	=> 'style',
					'value'			=> array(
						__('Style 1', 'adeecore')		=> 'style1',
						__('Style 2', 'adeecore')		=> 'style2',
						__('Style 3', 'adeecore')		=> 'style3',
						__('Style 4', 'adeecore')		=> 'style4',
						__('Style 5', 'adeecore')		=> 'style5',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon', 'adeecore'),
					'param_name'	=> 'icons',
					'value'			=> array(
						__('Plus', 'adeecore')			=> 'fa-plus',
						__('Chevron', 'adeecore')		=> 'fa-chevron-down',
						__('Caret', 'adeecore')			=> 'fa-caret-down',
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon Align', 'adeecore'),
					'param_name'	=> 'icons_align',
					'value'			=> array(
						__('Left', 'adeecore')		=> 'left',
						__('Right', 'adeecore')		=> 'right',
						),
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					),

				array(
					'type'			=> 'checkbox',
					'heading'		=> __('Activate all', 'adeecore'),
					'param_name'	=> 'activateall',
					'value'			=> array(__('Yes, activate all', 'adeecore') => 'yes'),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				)
			)
		);


		/*------------------------------------------------
		*	Toggle Item
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'toggle_item',
			'name'				=> __('Toggle Item', 'adeecore'),
			'as_child'			=> array('only'	=> 'toggle'),
			'content_element'	=> true,
			'params'			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Title Display', 'adeecore'),
					'param_name'	=> 'display',
					'value'			=> array(
						__('Title Only', 'adeecore')			=> 'title_only',
						__('Icon and Title', 'adeecore')		=> 'icon_title',
						__('Image and Title', 'adeecore')		=> 'image_title',
						__('Icon Only', 'adeecore')				=> 'icon_only',
						__('Image Only', 'adeecore')			=> 'image_only',
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Toggle Item Title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'display',
						'value'			=> array('title_only', 'icon_title', 'image_title')
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency' => array(
						'element'			=> 'display',
						'value'				=> array('icon_title', 'icon_only')
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Icon Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'display',
						'value'				=> array('image_title', 'image_only')
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Arrangement', 'adeecore'),
					'param_name'	=> 'arrangement',
					'value'			=> array(
						__('Icon before title', 'adeecore')		=> 'icon_before_title',
						__('Title before icon', 'adeecore')		=> 'title_before_icon',
						__('Image before title', 'adeecore')	=> 'image_before_title',
						__('Title before image', 'adeecore')	=> 'title_before_image'
						),
					'dependency'	=> array(
						'element'		=> 'display',
						'value'			=> array('image_title', 'icon_title')
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Image size', 'adeecore'),
					'param_name'	=> 'size',
					'min'			=> 1,
					'max'			=> 200,
					'value'			=> '',
					'dependency'	=> array(
						'element'		=> 'display',
						'value'			=> array('image_title', 'image_only')
						),
					),

				array(
					'type' => 'textarea_html',
					'heading' => __( 'Accordion content', 'adeecore' ),
					'param_name' => 'content',
					'value' => __( '<p>Accordion content goes here, edit content and save.</p>', 'adeecore' ),
					),
				),
			)
		);
		

		/*------------------------------------------------
		*	Video Player
		*-----------------------------------------------*/
		vc_map( array(
			'base'				=> 'videoplayer',
			'name'				=> __('Video Player', 'adeecore'),
			'content_element'	=> true,
			'category'			=> __('AdeeCore', 'adeecore'),
			'description'		=> __('Display video content.', 'adeecore'),
			'params'			=> array(

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Video type', 'adeecore'),
					'param_name'	=> 'type',
					'value'			=> array(
						__('Normal', 'adeecore')		=> 'normal',
						__('Popup', 'adeecore')			=> 'popup',
						__('Button', 'adeecore')		=> 'buttons'
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Video width', 'adeecore'),
					'param_name'	=> 'width',
					'min'			=> 10,
					'max'			=> 100,
					'step'			=> 5,
					'value'			=> '100%',
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Video ratio', 'adeecore'),
					'param_name'	=> 'ratio',
					'value'			=> array(
						__('16:9', 'adeecore')		=> 'embed-responsive-16by9',
						__('4:3', 'adeecore')		=> 'embed-responsive-4by3',
						__('1:1', 'adeecore')		=> 'embed-responsive-1by1',
						),
					'dependency'	=> array(
						'element'		=> 'type',
						'value'			=> 'normal'
						)
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Video link', 'adeecore'),
					'param_name'	=> 'video',
					'value'			=> '',
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Video align', 'adeecore'),
					'param_name'	=> 'align',
					'value'			=> array(
						__('Left', 'adeecore')		=> 'left',
						__('Center', 'adeecore')	=> 'center',
						__('Right', 'adeecore')		=> 'right',
						),
					'dependency'	=> array(
						'element'		=> 'type',
						'value'			=> 'normal'
						)
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Icon type', 'adeecore'),
					'param_name'	=> 'icon_type',
					'value'			=> array(
						__('Icon', 'adeecore')		=> 'icon',
						__('Image', 'adeecore')		=> 'image',
						),
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Select Icon Library', 'adeecore'),
					'param_name'	=> 'icon',
					'value' => array(
						__( 'Font Awesome', 'adeecore' )	=> 'fontawesome',
						__( 'Open Iconic', 'adeecore' )		=> 'openiconic',
						__( 'Typicons', 'adeecore' )		=> 'typicons',
						__( 'Entypo', 'adeecore' )			=> 'entypo',
						__( 'Linecons', 'adeecore' )		=> 'linecons'
					),
					'dependency' => array(
						'element'			=> 'icon_type',
						'value'				=> 'icon'
						),
					'description'	=> __( 'Select icon from library.', 'adeecore' ),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_fontawesome',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'fontawesome',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'fontawesome'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_openiconic',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'openiconic',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'openiconic'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_typicons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'typicons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'typicons'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_entypo',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'entypo',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'entypo'
						),
					),

				array(
					'type'			=> 'iconpicker',
					'heading'		=> __('Select Icon', 'adeecore'),
					'param_name'	=> 'icon_linecons',
					'settings'		=> array(
						'emptyIcon'			=> false,
						'type'				=> 'linecons',
						'iconsPerPage'		=> 4000,
						),
					'dependency' => array(
						'element'			=> 'icon',
						'value'				=> 'linecons'
						),
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Icon Image', 'adeecore'),
					'param_name'	=> 'image',
					'value'			=> '',
					'dependency'	=> array(
						'element'			=> 'icon_type',
						'value'				=> 'image'
						),
					),

				array(
					'type'			=> 'number',
					'heading'		=> __('Image/Icon Size', 'adeecore'),
					'param_name'	=> 'size',
					'value'			=> 84,
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Video title', 'adeecore'),
					'param_name'	=> 'title',
					'value'			=> '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> array('popup','normal')
						),
					),

				array(
					'type' => 'textarea_html',
					'heading' => __( 'Video content', 'adeecore' ),
					'param_name' => 'content',
					'value' => __( '<p>Video content goes here, edit content and save.</p>', 'adeecore' ),
					'dependency'	=> array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __('Text align', 'adeecore'),
					'param_name'	=> 'textalign',
					'value'			=> array(
						__('Left', 'adeecore')		=> 'left',
						__('Center', 'adeecore')	=> 'center',
						__('Right', 'adeecore')		=> 'right',
						),
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Button text', 'adeecore'),
					'param_name'	=> 'buttons',
					'value'			=> 'Watch Video',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> 'buttons'
						),
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Color', 'adeecore'),
					'param_name'	=> 'color',
					'value'			=> '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> array('popup','buttons')
						),
					'group'			=> __('Video Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Button background color', 'adeecore'),
					'param_name'	=> 'btn_background',
					'value'			=> '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> 'buttons'
						),
					'group'			=> __('Video Style', 'adeecore')
					),

				array(
					'type'			=> 'colorpicker',
					'heading'		=> __('Background Color', 'adeecore'),
					'param_name'	=> 'background',
					'value'			=> '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					'group'			=> __('Video Style', 'adeecore')
					),

				array(
					'type'			=> 'attach_image',
					'heading'		=> __('Upload Background Image', 'adeecore'),
					'param_name'	=> 'bg_image',
					'value'			=> '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					'group'			=> __('Video Style', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Background padding', 'adeecore'),
					'param_name'	=> 'padding',
					'value'			=> '',
					'dependency' => array(
						'element'			=> 'type',
						'value'				=> 'popup'
						),
					'group'			=> __('Video Style', 'adeecore')
					),

				array(
					'type'			=> 'textfield',
					'heading'		=> __('Class', 'adeecore'),
					'param_name'	=> 'class',
					'value'			=> ''
					),
				),
			)
		);
	}
}

//Your 'container' content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_accordion extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_accordion_item extends WPBakeryShortCode {
    }
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_infolist extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_infolist_item extends WPBakeryShortCode {
    }
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pricing extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_pricing_table extends WPBakeryShortCode {
    }
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_tabs extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_tab extends WPBakeryShortCode {
    }
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_timeline extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_timeline_item extends WPBakeryShortCode {
    }
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_toggle extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_toggle_item extends WPBakeryShortCode {
    }
}