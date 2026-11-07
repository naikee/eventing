<?php

if (! function_exists('check_vc_availability')) {
    function check_vc_availability() {
        if (is_plugin_active('js_composer/js_composer.php')) {
    
            vc_add_shortcode_param( 'number', 'dc_number_settings_field' );
            function dc_number_settings_field( $settings, $value ) {

                $defaults = array(
                    'param_name'    => '',
                    'type'          => '',
                    'min'           => 0,
                    'max'           => 100,
                    'step'          => 1,
                    'value'         => 0,
                    );
                $settings = wp_parse_args($settings, $defaults);

                $output = '<div class="vc_number_block">';
                    $output .= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ) . '_field" type="number" value="' . esc_attr( $value ) . '" min="' . esc_attr( $settings['min'] ) . '" max="' . esc_attr( $settings['max'] ) . '" step="' . esc_attr( $settings['step'] ) . '" />';
                $output .='</div>'; // This is html markup that will be outputted in content elements edit form

                return $output;
            }


            vc_add_shortcode_param( 'datetime', 'dc_datetime_settings_field', get_template_directory_uri().'/js/admin/jquery.datetimepicker.full.js' );
            function dc_datetime_settings_field( $settings, $value ) {

                $defaults = array(
                    'param_name'    => '',
                    'type'          => '',
                    );
                $settings = wp_parse_args($settings, $defaults);
                $uniqid = 'datetime_' .uniqid(rand(1,9999));

                $output = '<div class="vc_datetime_block form_datetime input-group">';
                    $output .= '<input id="' .$uniqid. '" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />';
                    $output .= '<span class="input-group-addon"><span class="fa fa-calendar"></span></span>';
                $output .= '</div>';

                $script = '<script>';
        
                    $script .= 'jQuery("#'.$uniqid.'").datetimepicker({';
                        $script .= 'format: "d-m-Y H:i",';
                        $script .= 'step: 5,';
                    $script .= '});';

                $script .= '</script>';

                $output .= $script;

                return $output;
            }
        }
    }

    add_action('admin_init', 'check_vc_availability');
}