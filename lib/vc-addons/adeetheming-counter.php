<?php
add_shortcode( 'adeetheming_counter', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'icon_type' 		=> '',
		'icon_counter' 		=> '',
		'icon_color'		=> '',
		'img_counter'	 	=> '',
		'counter_to' 		=> '',
		'count_color'		=> '',
		'count_start'		=> 0,
		'count_speed'		=> 2000,
		'count_prefix'		=> '',
		'count_suffix'		=> '',
		'count_size'		=> 36,
		'count_content'	 	=> '',
		'txt_color'		 	=> '',
		'count_style' 		=> '',
		'bg_color'		 	=> '',
		'bg_image'			=> '',
		'border'			=> '',
		'border_width'		=> '',
		'border_style'		=> '',
		'border_color'		=> '',
		'border_radius'		=> '',
		'class'		 		=> ''
		), $atts));


		$bgstyle = '';
		if ( $bg_color ) $bgstyle = 'background : ' . esc_attr( $bg_color ) . ';';
		$bgimage_scr = wp_get_attachment_image_src( $bg_image, 'full' );
		if ( $bg_image ) $bgstyle .= 'background-image : url(' . esc_attr( $bgimage_scr[0] ) . ');';

		if ( $border == "enable" ) {
			if ( $border_width ) $bgstyle .= ' border-width : ' . esc_attr( $border_width ) . ';';

			if ( $border_style ) $bgstyle .= ' border-style : ' . esc_attr( $border_style ) . ';';

			if ( $border_color ) $bgstyle .= ' border-color : ' . esc_attr( $border_color ) . ';';

			if ( $border_radius ) $bgstyle .= ' border-radius : ' . esc_attr( $border_radius ) . ';';
		}

		$iccolor = '';
		if ( $icon_color ) $iccolor = 'color : ' . esc_attr( $icon_color ) . ';';

		$cstyle = '';
		if ( $count_color ) $cstyle .= 'color : ' . esc_attr( $count_color ) . ';';

		$cstyle .= ' font-size : ' . esc_attr( $count_size ) . 'px;';

		$txtcolor = '';
		if ( $txt_color ) $txtcolor = 'color : ' . esc_attr( $txt_color ) . ';';

		switch ( $count_style ) {
			case 'left':
				$output = '<div class="adeetheming-counter counter counter-' . esc_attr( $count_style) . ' ' . esc_attr( $class ) . '" style="' . esc_attr( $bgstyle ) . '">';
					$output .= '<div class="icon_wrapper">';
					switch ( $icon_type ) {
						case 'image':
							$src_image = wp_get_attachment_image_src( $img_counter, 'thumbnail' );
							if ( $img_counter ) {
								$output .= '<img src="' . esc_url( $src_image[0] ) . '" alt="" />'; 
							}
							break;
						
						default:
							if ( $icon_counter ) {
								$output .= '<i class="' . esc_attr( $icon_counter ) . ' fa-4x" style="' . esc_attr( $iccolor ) . '"></i>';
							}
							break;
					}
					$output .= '</div>';
					$output .= '<div class="desc_wrapper">';
						$output .= '<span class="count-prefix" style="' . esc_attr( $cstyle ) . '">' . esc_attr( $count_prefix ) . '</span>';
						$output .= '<span class="timer count-title count-number" data-refresh-interval="50" data-from="' .esc_attr( $count_start ) . '" data-to="' . esc_attr( $counter_to ) . '" data-speed="' . esc_attr( $count_speed ) . '" style="' . esc_attr( $cstyle ) . '"></span>';
						$output .= '<span class="count-suffix" style="' . esc_attr( $cstyle ) . '">' . esc_attr( $count_suffix ) . '</span>';
						$output .= '<p class="count-text " style="' . esc_attr( $txtcolor ) . '">' . esc_attr( $count_content ) . '</p>';
					$output .= '</div>';
				$output .= '</div>';
				break;

			case 'right':
				$output = '<div class="adeetheming-counter counter counter-' . esc_attr( $count_style) . ' ' . esc_attr( $class ) . '" style="' . esc_attr( $bgstyle ) . '">';
					$output .= '<div class="icon_wrapper">';
					switch ( $icon_type ) {
						case 'image':
							$src_image = wp_get_attachment_image_src( $img_counter, 'thumbnail' );
							if ( $img_counter ) {
								$output .= '<img src="' . esc_url( $src_image[0] ) . '" alt="" />'; 
							}
							break;
						
						default:
							if ( $icon_counter ) {
								$output .= '<i class="' . esc_attr( $icon_counter ) . ' fa-4x" style="' . esc_attr( $iccolor ) . '"></i>';
							}
							break;
					}
					$output .= '</div>';
					$output .= '<div class="desc_wrapper">';
						$output .= '<span class="count-prefix" style="' . esc_attr( $cstyle ) . '">' . esc_attr( $count_prefix ) . '</span>';
						$output .= '<span class="timer count-title count-number" data-refresh-interval="50" data-from="' .esc_attr( $count_start ) . '"  data-to="' . esc_attr( $counter_to ) . '" data-speed="' . esc_attr( $count_speed ) . '" style="' . esc_attr( $cstyle ) . '"></span>';
						$output .= '<span class="count-suffix" style="' . esc_attr( $cstyle ) . '">' . esc_attr( $count_suffix ) . '</span>';
						$output .= '<p class="count-text " style="' . esc_attr( $txtcolor ) . '">' . esc_attr( $count_content ) . '</p>';
					$output .= '</div>';
				$output .= '</div>';
				break;
			
			default:
				$output = '<div class="adeetheming-counter counter counter-center' . esc_attr( $class ) . '" style="' . esc_attr( $bgstyle ) . '">';
					$output .= '<div class="icon_wrapper">';
					switch ( $icon_type ) {
						case 'image':
							$src_image = wp_get_attachment_image_src( $img_counter, 'thumbnail' );
							if ( $img_counter ) {
								$output .= '<img src="' . esc_url( $src_image[0] ) . '" alt="" />'; 
							}
							break;
						
						default:
							if ( $icon_counter ) {
								$output .= '<i class="' . esc_attr( $icon_counter ) . ' fa-4x" style="' . esc_attr( $iccolor ) . '"></i>';
							}
							break;
					}
					$output .= '</div>';
					$output .= '<div class="desc_wrapper">';
						$output .= '<span class="count-prefix" style="' . esc_attr( $cstyle ) . '">' . esc_attr( $count_prefix ) . '</span>';
						$output .= '<span class="timer count-title count-number" data-refresh-interval="50" data-from="' .esc_attr( $count_start ) . '"  data-to="' . esc_attr( $counter_to ) . '" data-speed="' . esc_attr( $count_speed ) . '" style="' . esc_attr( $cstyle ) . '"></span>';
						$output .= '<span class="count-suffix" style="' . esc_attr( $cstyle ) . '">' . esc_attr( $count_suffix ) . '</span>';
						$output .= '<p class="count-text " style="' . esc_attr( $txtcolor ) . '">' . esc_attr( $count_content ) . '</p>';
					$output .= '</div>';
				$output .= '</div>';
				break;
		}

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Counter", "adeecore"),
		"base" => "adeetheming_counter",
		'icon' => 'icon-thm-counter',
		"class" => "",
		"description" => __("Widget Title Heading", "adeecore"),
		"category" => __('Adeetheming', "adeecore"),
		"params" => array(		

			array(
				"type" => "dropdown",
				"heading" => __("Select Icon Type", "adeecore"),
				"param_name" => "icon_type",
				"value" => array('Icon'=>'icon','Image'=>'image'),
				),

			array(
				"type" => "iconpicker",
				"heading" => __("Select Icon", "adeecore"),
				"param_name" => "icon_counter",
				"setting" => array(
					"emptyIcon" => false,
					"type"		=> "fontawesome",
				),
				"dependency" => array(
					"element" => "icon_type",
					"value" => "icon",
				),
				"description" => __( "Select icon from library.", "adeecore" ),
				"value" => "",
				),

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Icon color", 'adeecore'),
				"param_name" => "icon_color",
				"value" => "",
				"dependency" => array(
					"element" => "icon_type",
					"value" => "icon",
					),
				),	

			array(
				"type" => "attach_image",
				"heading" => __("Upload Image Icon", "adeecore"),
				"param_name" => "img_counter",
				"value" => "",
				"dependency" => array(
					"element" => "icon_type",
					"value" => "image",
				),
				"description" => __( "Upload image to set as icon.", "adeecore" ),
				),			

			array(
				"type" => "textfield",
				"heading" => __("Count To", "adeecore"),
				"param_name" => "counter_to",
				"value" => "",
				"description" => __( "Number to count to.", "adeecore" ),
				),

			array(
				"type" => "textfield",
				"heading" => __("Count From", "adeecore"),
				"param_name" => "count_start",
				"value" => 0,
				"description" => __( "Number to count from.", "adeecore" ),
				),

			array(
				"type" => "textfield",
				"heading" => __("Prefix Counter", "adeecore"),
				"param_name" => "count_prefix",
				"value" => "",
				"description" => __( "Content show before counter", "adeecore" ),
				),

			array(
				"type" => "textfield",
				"heading" => __("Suffix Counter", "adeecore"),
				"param_name" => "count_suffix",
				"value" => "",
				"description" => __( "Content show after counter", "adeecore" ),
				),

			array(
				"type" => "textfield",
				"heading" => __("Counter Size", "adeecore"),
				"param_name" => "count_size",
				"value" => 24,
				"description" => __( "Set counter size", "adeecore" ),
				),

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Counter Color", 'adeecore'),
				"param_name" => "count_color",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Counter Speed", "adeecore"),
				"param_name" => "count_speed",
				"value" => "",
				"description" => __( "Short content to display on front image.", "adeecore" ),
				),		

			array(
				"type" => "textfield",
				"heading" => __("Counter Content", "adeecore"),
				"param_name" => "count_content",
				"value" => "",
				"description" => __( "Short description to display.", "adeecore" ),
				),

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Text Color", 'adeecore'),
				"param_name" => "txt_color",
				"value" => "",
				),

			array(
				"type" => "dropdown",
				"heading" => __("Counter Style", "adeecore"),
				"param_name" => "count_style",
				"value" => array( "Center" => "center", "Left Icon" => "left", "Right Icon" => "right"),
				),

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Background Color", 'adeecore'),
				"param_name" => "bg_color",
				"value" => "",
				),

			array(
				"type" => "attach_image",
				"heading" => __("Upload Background Image", "adeecore"),
				"param_name" => "bg_image",
				"value" => "",
				),

			array(
				"type" => "dropdown",
				"heading" => __("Border", "adeecore"),
				"param_name" => "border",
				"value" => array( "Disable" => "", "Enable" => "enable" ),
				),

			array(
				"type" => "dropdown",
				"heading" => __("Border Width", "adeecore"),
				"param_name" => "border_width",
				"value" => array( "Default" => "", "1px" => "1px", "2px" => "2px", "3px" => "3px", "4px" => "4px", "5px" => "5px", "6px" => "6px", "7px" => "7px", "8px" => "8px", "9px" => "9px", "10px" => "10px" ),
				"dependency" => array(
					"element" => "border",
					"value" => "enable",
				),
				),

			array(
				"type" => "dropdown",
				"heading" => __("Border Style", "adeecore"),
				"param_name" => "border_style",
				"value" => array( "Default" => "", "Solid" => "solid", "Dotted" => "dotted", "Dashed" => "dashed", "Double" => "double", "Groove" => "groove", "Ridge" => "ridge", "Inset" => "inset", "Outset" => "outset" ),
				"dependency" => array(
					"element" => "border",
					"value" => "enable",
				),
				),

			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Border Color", 'adeecore'),
				"param_name" => "border_color",
				"value" => "",
				"dependency" => array(
					"element" => "border",
					"value" => "enable",
				),
				),

			array(
				"type" => "dropdown",
				"heading" => __("Border Radius", "adeecore"),
				"param_name" => "border_radius",
				"value" => array( "Default" => "", "1px" => "1px", "2px" => "2px", "3px" => "3px", "4px" => "4px", "5px" => "5px", "6px" => "6px", "7px" => "7px", "8px" => "8px", "9px" => "9px", "10px" => "10px", "15px" => "15px", "20px" => "20px", "25px" => "25px", "30px" => "30px" ),
				"dependency" => array(
					"element" => "border",
					"value" => "enable",
				),
				),

			array(
				"type" => "textfield",
				"heading" => esc_html__("Custom Class", 'adeecore'),
				"param_name" => "class",
				"value" => "",
				),
			)
		)
	);
}