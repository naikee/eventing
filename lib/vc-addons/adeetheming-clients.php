<?php
add_shortcode( 'adeetheming_client_testimonial', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'client_image'					=> '',
		'client_text'					=> '',
		'client_name'					=> '',
		'class'						=> '',
		), $atts));

$src_image   = wp_get_attachment_image_src($client_image, 'full');


    $output = '<div class="adeetheming-clients '.$class.'">';
    	
    	$output .= '<div class="client-image">';
    		$output .= '<img src="'.$src_image[0].'" />';
    	$output .= '</div>';

    	$output .= '<div class="client-comments">';
    		$output .= $client_text;
    	$output .= '</div>';

    	$output .= '<div class="client-name">';
    		$output .= $client_name;
    	$output .= '</div>';

	$output .= '</div>';


	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => esc_html__("Client Testimonial", 'adeecore'),
	"base" => "adeetheming_client_testimonial",
	'icon' => 'icon-thm-client-testimonial',
	"class" => "",
	"description" => esc_html__("Client Testimonial", 'adeecore'),
	"category" => esc_html__('Adeetheming', 'adeecore'),
	"params" => array(


		array(
			"type" => "attach_image",
			"heading" => esc_html__("Client Image", 'adeecore'),
			"param_name" => "client_image",
			"value" => "",
			),	

		
		array(
			"type" => "textfield",
			"heading" => esc_html__("Client Name", 'adeecore'),
			"param_name" => "client_name",
			"value" => "",
			),

		array(
			"type" => "textarea",
			"heading" => esc_html__("Client Comments", 'adeecore'),
			"param_name" => "client_text",
			"value" => "",
			),


		array(
			"type" => "textfield",
			"heading" => esc_html__("Add Extra CSS Class", 'adeecore'),
			"param_name" => "class",
			"value" => "",
			),


		)
	));
}