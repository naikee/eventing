<?php
add_shortcode( 'adeetheming_progress_bar', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'prog_title'					=> '',
		'prog_value'					=> '',
		'min_value'						=> '0',
		'max_value'						=> '100',
		'height'						=> 'normal',
		'tip_symbol'					=> '%',
		'bar_type'						=> '',
		'bar_stripe'					=> '',
		'bar_active'					=> '',
		'bar_color'						=> '',
		'class'							=> '',
		), $atts));


	$barclass = '';
	if ( $bar_type ) $barclass = esc_attr( $bar_type ) . ' ';
	if ( $bar_stripe == true ) $barclass .= 'progress-bar-striped ';
	if ( $bar_active == true ) $barclass .= 'active ';

	$barstyle = '';
	if ( $bar_color ) $barstyle = 'style="background: ' . esc_attr( $bar_color ) . '";';

    $output = '<div class="adeetheming-progressbar '.$class.'">';
    	
    	$output .= '<div class="barWrapper">';
    		$output .= '<span class="progressText"><strong>' . esc_attr( $prog_title ) . '</strong></span>';
    		$output .= '<div class="progress ' .$height. '">';
    			$output .= '<div class="progress-bar ' . esc_attr( $barclass ) . '" role="progressbar" aria-valuenow="' . esc_attr( $prog_value ) . '" arial-valuemin="' . esc_attr( $min_value ) . '" aria-valuemax="' . esc_attr( $max_value ) . '">';

    				$output .= '<span class="popOver" data-toggle="tooltip" data-placement="top" title="' . esc_attr( $prog_value ) . esc_attr( $tip_symbol ) . '"></span>';
    			$output .= '</div>';
    		$output .= '</div>';
    	$output .= '</div>';

	$output .= '</div>';


	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => esc_html__("Progress Bar", 'adeecore'),
	"base" => "adeetheming_progress_bar",
	'icon' => 'icon-thm-progress-bar',
	"class" => "",
	"description" => esc_html__("Progress bar with tooltip", 'adeecore'),
	"category" => esc_html__('Adeetheming', 'adeecore'),
	"params" => array(


		array(
			"type" => "textfield",
			"heading" => esc_html__("Progress Bar Title", 'adeecore'),
			"param_name" => "prog_title",
			"value" => "",
			),	

		
		array(
			"type" => "textfield",
			"heading" => esc_html__("Progress Value", 'adeecore'),
			"param_name" => "prog_value",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Minimum Value", 'adeecore'),
			"param_name" => "min_value",
			"value" => "0",
			),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Maximum Value", 'adeecore'),
			"param_name" => "max_value",
			"value" => "100",
			),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Progress Symbol", 'adeecore'),
			"param_name" => "tip_symbol",
			"value" => "%",
			),

		array(
				"type" => "dropdown",
				"heading" => __("Height", "adeecore"),
				"param_name" => "height",
				"value" => array('Normal'=>'normal', 'Small'=>'small', 'Big'=>'big'),
				),

		array(
				"type" => "dropdown",
				"heading" => __("Progress Bar Type", "adeecore"),
				"param_name" => "bar_type",
				"value" => array('Default'=>'', 'Success'=>'progress-bar-success', 'Info'=>'progress-bar-info', 'Warning' =>'progress-bar-warning', 'Danger' => 'progress-bar-danger'),
				),

		array(
			"type" => "checkbox",
			"heading" => esc_html__("Progress Bar Striped", 'adeecore'),
			"param_name" => "bar_stripe",
			"value" => "",
			),

		array(
			"type" => "checkbox",
			"heading" => esc_html__("Progress Bar Animation", 'adeecore'),
			"param_name" => "bar_active",
			"value" => "",
			),

		array(
				"type" => "colorpicker",
				"heading" => esc_html__("Progress Bar Color", 'adeecore'),
				"param_name" => "bar_color",
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