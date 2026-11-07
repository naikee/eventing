<?php
add_shortcode( 'adeetheming_person', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'person_img' 		=> '',
		'person_name' 		=> '',
		'person_deg'		=> '',
		'facebook_url' 		=> '',
		'twitter_url' 		=> '',
		'gplus_url' 		=> '',
		'linkedin_url' 		=> '',
		'pinterest_url' 	=> '',
		'delicious_url' 	=> '',
		'tumblr_url' 		=> '',
		'stumbleupon_url' 	=> '',
		'dribble_url' 		=> '',
		'instagram_url'		=> '',
		'btn_text' 			=> '',
		'btn_url' 			=> '',
		'class'		 		=> ''
		), $atts));


		$output  	 = '<div class="adeetheming-person '.esc_attr($class).'">';
			$output  	.= '<div class="adeetheming-person-image">';
				$src_image   = wp_get_attachment_image_src($person_img, 'full');
				$output  	.= '<img src="' . esc_url($src_image[0]). '" class="img-responsive" alt="photo">';
			$output  	.= '</div>';//adeetheming-person-image
			$output  	.= '<div class="person-details">';
				if ($person_name) $output 	.= '<h3 class="person-title">' . esc_attr($person_name) . '</h3>';
				if ($person_deg) $output 	.= '<h4 class="person-deg">' . esc_attr($person_deg) . '</h4>';
			$output  	.= '</div>';//person-details	
			$output  	.= '<div class="social-icon">';
				$output  	.= '<ul class="list-unstyled list-inline">';
				if(isset($facebook_url) && !empty($facebook_url)) {
				$output 	.= '<li><a class="facebook" href="' . esc_url($facebook_url) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
				}

				if(isset($twitter_url) && !empty($twitter_url)) {
				$output 	.= '<li><a class="twitter" href="' . esc_url($twitter_url) . '" target="_blank" ><i class="fa fa-twitter"></i></a></li>';
				}	

				if(isset($gplus_url) && !empty($gplus_url)) {
				$output 	.= '<li><a class="g-plus" href="' . esc_url($gplus_url) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
				}	

				if(isset($linkedin_url) && !empty($linkedin_url)) {
				$output 	.= '<li><a class="linkedin" href="' . esc_url($linkedin_url) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
				}

				if(isset($pinterest_url) && !empty($pinterest_url)) {
				$output 	.= '<li><a class="pinterest" href="' . esc_url($pinterest_url) . '" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
				}	

				if(isset($delicious_url) && !empty($delicious_url)) {
				$output 	.= '<li><a class="delicious" href="' . esc_url($delicious_url) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>';
				}	

				if(isset($tumblr_url) && !empty($tumblr_url)) {
				$output 	.= '<li><a class="tumblr" href="' . esc_url($tumblr_url) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>';
				}	

				if(isset($stumbleupon_url) && !empty($stumbleupon_url)) {
				$output 	.= '<li><a class="stumbleupon" href="' . esc_url($stumbleupon_url) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>';
				}	

				if(isset($dribble_url) && !empty($dribble_url)) {
				$output 	.= '<li><a class="dribble" href="' . esc_url($dribble_url) . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>';
				}

				if(isset($dribble_url) && !empty($instagram_url)) {
				$output 	.= '<li><a class="instagram" href="' . esc_url($instagram_url) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>';
				}

				$output  	.= '</ul>';
			$output  	.= '</div>';//social-icon
			if($btn_url){
			$output  	.= '<p><a href="' . esc_url($btn_url) . '" class="btn btn-primary">' . esc_attr($btn_text) . '</a></p>';
			}
		$output  	 .= '</div>';//adeetheming-person

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Person", "adeecore"),
		"base" => "adeetheming_person",
		'icon' => 'icon-thm-person',
		"class" => "",
		"description" => __("Widget Title Heading", "adeecore"),
		"category" => __('Adeetheming', "adeecore"),
		"params" => array(		

			array(
				"type" => "attach_image",
				"heading" => __("Upload Person Image", "adeecore"),
				"param_name" => "person_img",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Person Name", "adeecore"),
				"param_name" => "person_name",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Team Designation", "adeecore"),
				"param_name" => "person_deg",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Facebook URL", "adeecore"),
				"param_name" => "facebook_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Twitter URL", "adeecore"),
				"param_name" => "twitter_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Google Plus URL", "adeecore"),
				"param_name" => "gplus_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Linkedin URL", "adeecore"),
				"param_name" => "linkedin_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Pinterest URL", "adeecore"),
				"param_name" => "pinterest_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Delicious URL", "adeecore"),
				"param_name" => "delicious_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Tumblr URL", "adeecore"),
				"param_name" => "tumblr_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Stumbleupon URL", "adeecore"),
				"param_name" => "stumbleupon_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Dribble URL", "adeecore"),
				"param_name" => "dribble_url",
				"value" => "",
				),
			array(
				"type" => "textfield",
				"heading" => __("Instagram URL", "adeecore"),
				"param_name" => "instagram_url",
				"value" => "",
				),


			array(
				"type" => "textfield",
				"heading" => __("Button Text", "adeecore"),
				"param_name" => "btn_text",
				"value" => "Button"
				),


			array(
				"type" => "textfield",
				"heading" => __("Button Url", "adeecore"),
				"param_name" => "btn_url",
				"value" => ""
				),			

			array(
				"type" => "textfield",
				"heading" => __("Button Font Size", "adeecore"),
				"param_name" => "btn_size",
				"value" => "14",
				),	


			array(
				"type" => "colorpicker",
				"heading" => __("Button Color", "adeecore"),
				"param_name" => "btn_color",
				"value" => "#fff",
				),						

			array(
				"type" => "colorpicker",
				"heading" => __("Button Background", "adeecore"),
				"param_name" => "btn_bg",
				"value" => "#8560a8",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Button padding Ex. 10px 0 5px 0", "adeecore"),
				"param_name" => "btn_padding",
				"value" => "10px 0px 5px 0px",
				),		

			array(
				"type" => "textfield",
				"heading" => __("Class", "adeecore"),
				"param_name" => "class",
				"value" => ""
				),					

			)
		));
}