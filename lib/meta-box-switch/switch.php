<?php

/**
 * Checkbox field class.
 */
if( class_exists('RWMB_Field') ) {
	

	class RWMB_Switch_Field extends RWMB_Field {

		/**
		 * Get field HTML
		 *
		 * @param mixed $meta
		 * @param array $field
		 *
		 * @return string
		 */

		/**
		 * Enqueue scripts and styles for tabs
		 */
		public static function admin_enqueue_scripts() {
			list( , $url ) = RWMB_Loader::get_path( dirname( __FILE__ ) );
			wp_enqueue_style( 'rwmb-switch', $url . 'switch.css', '', '1.0.0' );
		}



		public static function html( $meta, $field ) {
			
			$output = '<div class="switch-wrap">';

			$output .= sprintf(
				'<input type="checkbox" name="%s" id="%s" value="1" %s class="rwmb-checkbox-switch">',
				$field['field_name'],
				$field['id'],
				checked( ! empty( $meta ), 1, false )
			);

			$output .= sprintf(
				'<label for="%s" class="rwmb-switch">
					<div class="rwmb-switch-inner"></div>
					<div class="on-off-switch"></div>
				</label>',
				$field['id']
			);

			$output .= '</div>';

			return $output;
		}
	}
}