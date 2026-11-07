<?php
add_shortcode( 'adeetheming_flipbox', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'outer_wrap'		=> 'div',
		'anchor_url'		=> '',
		'flip_type'			=> 'cardflip',
		'flip_direction'	=> 'n',
		'flip_ease'			=> 'ease',
		'flip_duration'		=> 500,
		'front_img' 		=> '',
		'front_bgcolor'		=> '',
		'icon_type' 		=> '',
		'front_icon'		=> '',
		'icon_size'			=> 35,
		'icon_format'		=> '',
		'front_iconcolor'	=> '',
		'front_iconbg'		=> '',
		'icon_img'	 		=> '',
		'image_size'		=> 34,
		'front_title' 		=> '',
		'front_tsize'		=> 22,
		'front_content'		=> '',
		'front_txtcolor'	=> '',
		'back_img' 			=> '',
		'back_bgcolor'		=> '',
		'back_title'	 	=> '',
		'back_tsize'		=> 22,
		'back_content'	 	=> '',
		'back_txtcolor'		=> '',
		'link_url'		 	=> '',
		'btn_color'			=> '',
		'btn_background'	=> '',
		'flip_width'		=> '100%',
		'flip_height'		=> '',
		'flip_pad'			=> '',
		'flip_border'		=> '',
		'flip_radius'		=> '',
		'border_color'		=> '',
		'border_style'		=> '',
		'class'		 		=> ''
		), $atts));


		if (in_array($flip_direction, array('ne', 'se', 'sw', 'nw') ) ) {
			if ($flip_type == 'cubetilt') {
				$flip_type = 'cubeflip';
			}
		}


		$classes = '';
		$classes .= ' animation_' . $flip_type;
		$classes .= ' direction_' . $flip_direction;
		$classes .= ' ' . $class;

		$attr = $attributes = '';
		if ($outer_wrap == 'a' || isset($link_url)) {
			$anchor_url = ( '||' === $anchor_url ) ? '' : $anchor_url;
			$link_url = ( '||' === $link_url ) ? '' : $link_url;

			$url = '';
			if($anchor_url) $url = $anchor_url;
			if($link_url) $url = $link_url;

			$attr = vc_build_link( $url );

			$use_link = false;
			if ( strlen( $attr['url'] ) > 0 ) {
				$use_link = true;
				$a_href = $attr['url'];
				$a_title = $attr['title'];
				$a_target = $attr['target'];
				$a_rel = $attr['rel'];
			}

			$attributes = array();
			if ( $use_link ) {
				$attributes[] = 'href="' . trim( $a_href ) . '"';
				$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
				if ( ! empty( $a_target ) ) {
					$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
				}
				if ( ! empty( $a_rel ) ) {
					$attributes[] = 'rel="' . esc_attr( trim( $a_rel ) ) . '"';
				}
			}

			$attributes = implode( ' ', $attributes );
		}

		$flip_ease = ' ease_' . $flip_ease;

		if ( ! preg_match( '~^(\d+ms)|(\d{0,2}(\.\d+)?s)$~', $flip_duration ) ) {
			$flip_duration = ( ( strpos( $flip_duration, '.' ) !== FALSE ) ? intval( ( floatval( $flip_duration ) * 1000 ) ) : intval( $flip_duration ) ) . 'ms';
		}

		$front_style = array();

		if($flip_height) $front_style[] = 'height: ' . $flip_height;
		if($flip_pad) $front_style[] = 'padding: ' . $flip_pad;
		if($front_bgcolor) $front_style[] = 'background-color: ' . $front_bgcolor;
		if($flip_border) $front_style[] = 'border-width: ' . $flip_border;
		if($flip_radius) $front_style[] = 'border-radius: ' . $flip_radius;
		if($border_color) $front_style[] = 'border-color: ' . $border_color;
		if($border_style) $front_style[] = 'border-style: ' . $border_style;

		$src_image_front   = wp_get_attachment_image_src( $front_img, 'full' );

		if($front_img) $front_style[] = 'background-image: url(' . trim($src_image_front[0]) . ')';

		$front_style = implode('; ', $front_style);

		//Front Icon Style
		$icon_style = array();

		if($icon_size) : $icon_style[] = 'font-size: ' . intval($icon_size) . 'px';
			$icon_bgstyle = intval($icon_size) * (($icon_format == 'simple') ? 1 : 2.2);
			$icon_bgstyle = intval($icon_bgstyle) . 'px';

			$icon_style[] = 'width: ' . $icon_bgstyle;
			$icon_style[] = 'height: ' . $icon_bgstyle;
			$icon_style[] = 'line-height: ' . $icon_bgstyle;
		endif;

		if($front_iconcolor) $icon_style[] = 'color: ' . $front_iconcolor;
		if($front_iconbg) $icon_style[] = 'background-color: ' . $front_iconbg;

		if($icon_format != 'simple') $icon_style[] = 'border-color: ' . $front_iconcolor;

		$icon_style = implode('; ', $icon_style);

		if($front_txtcolor) $front_txtcolor = 'color: ' . $front_txtcolor . ';';

		if($front_tsize) $front_tsize = 'font-size: ' . $front_tsize . 'px;';

		//Back Style Settings
		$back_style = array();

		if($flip_pad) $back_style[] = 'padding: ' . $flip_pad;
		if($back_bgcolor) $back_style[] = 'background-color: ' . $back_bgcolor;
		if($flip_border) $back_style[] = 'border-width: ' . $flip_border;
		if($flip_radius) $back_style[] = 'border-radius: ' . $flip_radius;
		if($border_color) $back_style[] = 'border-color: ' . $border_color;
		if($border_style) $back_style[] = 'border-style: ' . $border_style;

		$src_image_back   = wp_get_attachment_image_src( $back_img, 'full' );

		if($back_img) $back_style[] = 'background-image: url(' . trim($src_image_back[0]) . ')';

		$back_style = implode('; ', $back_style);

		if($back_txtcolor) $back_txtcolor = 'color: ' . $back_txtcolor . ';';

		if($back_tsize) $back_tsize = 'font-size: ' . $back_tsize . 'px;';

		$btn_style ='';
		if ( $btn_color ) $btn_style .= 'color : ' . $btn_color . ';';
		if ( $btn_background ) $btn_style .= 'background : ' . $btn_background . ';';

		//Flank Style Settings
		$flank_style = array();

		if($flip_border) $flank_style[] = 'border-width: ' . $flip_border;
		if($flip_radius) $flank_style[] = 'border-radius: ' . $flip_radius;
		if($border_color) $flank_style[] = 'border-color: ' . $border_color;

		//Flip Wrap
		$output = '<' . $outer_wrap . ' ' . $attributes . ' class="flip_wrap' . $classes . '" style="width : ' . $flip_width . ';">';
			$output .= '<div class="flipbox_mid ' . $flip_ease . '" style="-webkit-transition-duration : ' . $flip_duration . '; transition-duration : ' . $flip_duration . ';">';
				$output .= '<div class="flipbox_inn">';

					if($flip_type == 'cubeflip' && in_array($flip_direction, array('ne', 'se', 'sw', 'nw'))) {
						$output .= '<div class="flipbox_cubeflip">';
					}

					//Flip Front Wrap
					$output .= '<div class="flipbox_front" style="' . $front_style . ';">';
						$output .= '<div class="flipfront_content_wrap">';
							switch ($icon_type) {
						 		case 'image':
						 			$src_image_icon = wp_get_attachment_image_src( $icon_img, 'full' );
									if (  $icon_img ) :
										$output .= '<div class="flipfront_image_wrap" style="width: ' . $image_size . 'px;">';
											$output .= '<img src="' . esc_url($src_image_icon[0]) . '" class="boxshadow" alt="" />';
										$output .= '</div>';
									endif;
						 			break;
						 	
						 		default:
						 			if ( $front_icon ) :
						 				$output .= '<div class="flipfront_icon_wrap style_' . $icon_format . '" style="' . $icon_style . ';">';
											$output .= '<i class="' . $front_icon . ' boxshadow"></i>';
										$output .= '</div>';
									endif;
						 			break;
							}
							if ($front_title) $output 	.= '<h4 class="flipfront_title" style="' . $front_txtcolor . ' ' . $front_tsize .'">' . $front_title . '</h4>';
							if ($front_content) $output 	.= '<p class="flipfront_desc" style="' . $front_txtcolor . ';">' . $front_content . '</p>';
						$output .= '</div>';
					$output .= '</div>';

					//Flip Back Wrap
					$output .= '<div class="flipbox_back" style="' . $back_style . ';">';
						$output .= '<div class="flipback_content_wrap">';
							if ( $back_title ) $output		.= '<h4 class="flipback_title" style="' . $back_txtcolor . ' ' . $back_tsize .'">' . $back_title . '</h4>';
							if ( $back_content) $output		.= '<p class="flipback_desc"  style="' . $back_txtcolor . ';">' . $back_content . '</p>';

							if ( $link_url ) {
								$output .= '<a ' . $attributes . 'class="btn flip-btn adeecore-button" style="' . $btn_style . '">' . $attr['title'] . '</a>';
							}
						$output .= '</div>';
					$output .= '</div>';

					if($flip_type == 'cubeflip') {

						if(in_array($flip_direction, array('ne', 'e', 'se', 'sw', 'w', 'nw'))) {

							$front_bgcolor = ($front_bgcolor != '') ? $front_bgcolor : '#eeeeee';
							$front_rgb = dc_hex_to_rgb($front_bgcolor);
							for ($i=0; $i < 3; $i++) { 
								$front_rgb[$i] = min(250, $front_rgb[$i] + 20);
							}

							$flank_style = implode(', ', $front_rgb);

							$flank_style = 'background-color: rgb(' .$flank_style. ');' ;
							
							$output .= '<div class="flipflank_y" style="' . $flank_style . '"></div>';
						}
						if(in_array($flip_direction, array('n', 'ne', 'se', 's', 'sw', 'nw'))) {

							$front_bgcolor = ($front_bgcolor != '') ? $front_bgcolor : '#eeeeee';
							$front_rgb = dc_hex_to_rgb($front_bgcolor);
							for ($i=0; $i < 3; $i++) { 
								$front_rgb[$i] = max(5, $front_rgb[$i] - 20);
							}

							$flank_style = implode(', ', $front_rgb);

							$flank_style = 'background-color: rgb(' .$flank_style. ');' ;

							$output .= '<div class="flipflank_x" style="' . $flank_style . '"></div>';
						}
					}

					if($flip_type == 'cubeflip' && in_array($flip_direction, array('ne', 'se', 'sw', 'nw'))) {
						$output .= '</div>';
					}

				$output .= '</div>';
			$output .= '</div>';
		$output .= '</' . $outer_wrap . '>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Flip Box", "adeecore"),
		"base" => "adeetheming_flipbox",
		'icon' => 'icon-thm-flipbox',
		"class" => "",
		"description" => __("Flips image on hover", "adeecore"),
		"category" => __('Adeetheming', "adeecore"),
		"params" => array(

			array(
				"type"			=> "dropdown",
				"heading"		=> __("Outer Wrap", "adeecore"),
				"param_name"	=> "outer_wrap",
				"value"			=> array("Div" => "div", "Anchor" => "a"),
				),

			array(
				"type"			=> "vc_link",
				"heading"		=> __("Link URL", "adeecore"),
				"param_name"	=> "anchor_url",
				"dependency"	=> array(
					"element"	=> "outer_wrap",
					"value"		=> "a"
					),
				),

			array(
				"type"			=> "dropdown",
				"heading"		=> __("Flip Type", "adeecore"),
				"param_name"	=> "flip_type",
				"value"			=> array(
					"Card Flip"		=> "cardflip",
					"Cube Flip"		=> "cubeflip",
					"Cube Tilt"		=> "cubetilt",
					"Cover Open"	=> "coveropen"
					),
				),

			array(
				"type"			=> "dropdown",
				"heading"		=> __("Flip Direction", "adeecore"),
				"param_name"	=> "flip_direction",
				"value"			=> array(
					"Up"			=> "n",
					"Up/Right"		=> "ne",
					"Right"			=> "e",
					"Right/Down"	=> "se",
					"Down"			=> "s",
					"Down/Left"		=> "sw",
					"Left"			=> "w",
					"Left/Up"		=> "nw"
					),
				),

			array(
				"type"			=> "dropdown",
				"heading"		=> __("Flip Ease", "adeecore"),
				"param_name"	=> "flip_ease",
				"value"			=> array(
					"ease"			=> "ease",
					"easeInOutExpo"	=> "easeInOutExpo",
					"easeInOutCirc"	=> "easeInOutCirc",
					"easeOutBack"	=> "easeOutBack"
					),
				),

			array(
				"type"			=> "textfield",
				"heading"		=> __("Flip Duration", "adeecore"),
				"param_name"	=> "flip_duration",
				"value"			=> 500,
				),

			//Front
			array(
				"type"			=> "attach_image",
				"heading"		=> __("Upload Front Image", "adeecore"),
				"param_name"	=> "front_img",
				"value" 		=> "",
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "colorpicker",
				"heading"		=> __("Front Background Color", "adeecore"),
				"param_name"	=> "front_bgcolor",
				"value"			=> "",
				"group"			=> __("Flip Front" , "adeecore")
				),			

			array(
				"type"			=> "dropdown",
				"heading"		=> __("Select Icon Type", "adeecore"),
				"param_name"	=> "icon_type",
				"value"			=> array('Icon'=>'icon','Image'=>'image'),
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "iconpicker",
				"heading"		=> __("Select Icon", "adeecore"),
				"param_name"	=> "front_icon",
				"setting"		=> array(
					"emptyIcon" 	=> false,
					"type"			=> "fontawesome",
				),
				"dependency"	=> array(
					"element"		=> "icon_type",
					"value"			=> "icon",
				),
				"description"	=> __( "Select icon from library.", "adeecore" ),
				"value"			=> "",
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "textfield",
				"heading"		=> __("Icon Size", "adeecore"),
				"param_name"	=> "icon_size",
				"value"			=> 34,
				"dependency"	=> array(
					"element"		=> "icon_type",
					"value"			=> "icon",
				),
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "dropdown",
				"heading"		=> __("Icon Style", "adeecore"),
				"param_name"	=> "icon_format",
				"value"			=> array(
					"Simple"			=> "simple",
					"Circle Background"	=> "circle",
					"Square Background"	=> "square",
					),
				"dependency"	=> array(
					"element"		=> "icon_type",
					"value"			=> "icon",
				),
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "colorpicker",
				"heading"		=> __("Icon Color", "adeecore"),
				"param_name"	=> "front_iconcolor",
				"value"			=> "",
				"dependency"	=> array(
					"element"		=> "icon_type",
					"value"			=> "icon",
				),
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "colorpicker",
				"heading"		=> __("Icon Background Color", "adeecore"),
				"param_name"	=> "front_iconbg",
				"value"			=> "",
				"dependency"	=> array(
					"element"		=> "icon_type",
					"value"			=> "icon",
				),
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "attach_image",
				"heading"		=> __("Upload Image Icon", "adeecore"),
				"param_name"	=> "icon_img",
				"value"			=> "",
				"dependency"	=> array(
					"element"		=> "icon_type",
					"value" 		=> "image",
				),
				"description"	=> __( "Upload image to set as icon.", "adeecore" ),
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "textfield",
				"heading"		=> __("Image Size", "adeecore"),
				"param_name"	=> "image_size",
				"value"			=> 34,
				"dependency"	=> array(
					"element"		=> "icon_type",
					"value"			=> "image",
				),
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "textfield",
				"heading"		=> __("Front Title", "adeecore"),
				"param_name"	=> "front_title",
				"value"			=> "",
				"description"	=> __( "Short title to display on front image.", "adeecore" ),
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "textfield",
				"heading"		=> __("Front Title Size", "adeecore"),
				"param_name"	=> "front_tsize",
				"value"			=> 22,
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "textarea",
				"heading"		=> __("Front Content", "adeecore"),
				"param_name"	=> "front_content",
				"value"			=> "",
				"description"	=> __( "Short content to display on front image.", "adeecore" ),
				"group"			=> __("Flip Front" , "adeecore")
				),

			array(
				"type"			=> "colorpicker",
				"heading"		=> __("Front Text Color", "adeecore"),
				"param_name"	=> "front_txtcolor",
				"value"			=> "",
				"group"			=> __("Flip Front" , "adeecore")
				),		

			//Back
			array(
				"type"			=> "attach_image",
				"heading"		=> __("Back Flip Image", "adeecore"),
				"param_name"	=> "back_img",
				"value"			=> "",
				"description"	=> __( "Background image to display on hover", "adeecore" ),
				"group"			=> __("Flip Back" , "adeecore")
				),

			array(
				"type"			=> "colorpicker",
				"heading"		=> __("Back Background Color", "adeecore"),
				"param_name"	=> "back_bgcolor",
				"value"			=> "",
				"group"			=> __("Flip Back" , "adeecore")
				),		

			array(
				"type"			=> "textfield",
				"heading"		=> __("Back Title", "adeecore"),
				"param_name"	=> "back_title",
				"value"			=> "",
				"description"	=> __( "Short title to display on back image.", "adeecore" ),
				"group"			=> __("Flip Back" , "adeecore")
				),

			array(
				"type"			=> "textfield",
				"heading"		=> __("Back Title Size", "adeecore"),
				"param_name"	=> "back_tsize",
				"value"			=> 22,
				"group"			=> __("Flip Back" , "adeecore")
				),			

			array(
				"type"			=> "textarea",
				"heading"		=> __("Back Content", "adeecore"),
				"param_name"	=> "back_content",
				"value"			=> "",
				"description"	=> __( "Short content to display on back image.", "adeecore" ),
				"group"			=> __("Flip Back" , "adeecore")
				),

			array(
				"type"			=> "colorpicker",
				"heading"		=> __("Front Background Color", "adeecore"),
				"param_name"	=> "back_txtcolor",
				"value"			=> "",
				"group"			=> __("Flip Back" , "adeecore")
				),

			array(
				"type"			=> "vc_link",
				"heading"		=> __("Button Link URL", "adeecore"),
				"param_name"	=> "link_url",
				"value"			=> "",
				"dependency"	=> array(
					"element"		=> "outer_wrap",
					"value"			=> "div"
					),
				"group"			=> __("Flip Back" , "adeecore")
				),

			array(
				"type"			=> "colorpicker",
				"heading"		=> esc_html__("Button Text Color", 'adeecore'),
				"param_name"	=> "btn_color",
				"value"			=> "",
				"dependency"	=> array(
					"element"		=> "outer_wrap",
					"value"			=> "div"
					),
				"group"			=> __("Flip Back" , "adeecore")
				),

			array(
				"type"			=> "colorpicker",
				"heading"		=> esc_html__("Button Background", 'adeecore'),
				"param_name"	=> "btn_background",
				"value"			=> "",
				"dependency"	=> array(
					"element" 		=> "outer_wrap",
					"value"			=> "div"
					),
				"group"			=> __("Flip Back" , "adeecore")
				),

			//Custom
			array(
				"type"			=> "textfield",
				"heading"		=> __("Flip Width", "adeecore"),
				"param_name"	=> "flip_width",
				"value"			=> "100%",
				"group"			=> __("Custom Options" , "adeecore")
				),

			array(
				"type"			=> "textfield",
				"heading"		=> __("Flip Height", "adeecore"),
				"param_name"	=> "flip_height",
				"value"			=> "",
				"group"			=> __("Custom Options" , "adeecore")
				),

			array(
				"type"			=> "textfield",
				"heading"		=> __("Flip Padding", "adeecore"),
				"param_name"	=> "flip_pad",
				"value"			=> "15%",
				"group"			=> __("Custom Options" , "adeecore")
				),

			array(
				"type"			=> "textfield",
				"heading"		=> __("Flip Border", "adeecore"),
				"param_name"	=> "flip_border",
				"value"			=> "",
				"group"			=> __("Custom Options" , "adeecore")
				),

			array(
				"type"			=> "textfield",
				"heading"		=> __("Border Radius", "adeecore"),
				"param_name"	=> "flip_radius",
				"value"			=> "",
				"group"			=> __("Custom Options" , "adeecore")
				),

			array(
				"type"			=> "colorpicker",
				"heading"		=> __("Border Color", "adeecore"),
				"param_name"	=> "border_color",
				"value"			=> "",
				"group"			=> __("Custom Options" , "adeecore")
				),

			array(
				"type" => "dropdown",
				"heading" => __("Border Style", "adeecore"),
				"param_name" => "border_style",
				"value" => array( "Default" => "", "Solid" => "solid", "Dotted" => "dotted", "Dashed" => "dashed", "Double" => "double", "Groove" => "groove", "Ridge" => "ridge", "Inset" => "inset", "Outset" => "outset" ),
				"group"			=> __("Custom Options" , "adeecore")
				),

			array(
				"type"			=> "textfield",
				"heading"		=> esc_html__("Custom Class", 'adeecore'),
				"param_name"	=> "class",
				"value"			=> "",
				"group"			=> __("Custom Options" , "adeecore")
				),
			)
		)
	);
}