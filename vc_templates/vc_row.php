<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 *
 * Extra shortcode attributes
 * @var $enable_topfancysep
 * @var $topfancysep
 * @var $topfancysep_fill
 * @var $topfancysep_filltwo
 * @var $topfancysep_bgcolor
 * @var $enable_bottomfancysep
 * @var $bottomfancysep
 * @var $bottomfancysep_fill
 * @var $bottomfancysep_filltwo
 * @var $bottomfancysep_bgcolor
 * @var $enable_rowbg_slide
 * @var $rowimg_slides
 * @var $rowbg_overlay
 * @var $rowbg_transition
 * @var $rowbg_animation
 * @var $rowbg_delay
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = $enable_topfancysep = $topfancysep = $topfancysep_fill = $topfancysep_filltwo = $topfancysep_bgcolor = $enable_bottomfancysep = $bottomfancysep = $bottomfancysep_fill = $bottomfancysep_filltwo = $bottomfancysep_bgcolor = $enable_rowbg_slide = $rowimg_slides = $rowbg_overlay = $rowbg_transition = $rowbg_animation = $rowbg_delay = '';
$disable_element = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );


$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
	'vc_row-fluid',
	//Custome extra
	'dc_row_section',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

//Top SVG Fancy Separator
$topfancydiv = $tpfancybg = '';
if($topfancysep_fill) $tpfancybg = ' style="background: ' .$topfancysep_fill . ';"';

if (! empty($enable_topfancysep) && $topfancysep !== '' ) {
	
	if ($topfancysep == 'toprow-diagonal') {
		$topfancydiv = '<div class="topfancydiv topfancysvg">';
			$topfancydiv .= '<div class="fancysvg_wrap">';
				$topfancydiv .= '<svg class="bigDiagonalColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$topfancysep_bgcolor. ';">';
					$topfancydiv .= '<path d="M0 100 L100 0 L100 100" style="fill: ' .$topfancysep_fill. '; stroke: ' .$topfancysep_fill. ';" />';
				$topfancydiv .= '</svg>';
			$topfancydiv .= '</div>';
		$topfancydiv .= '</div>';

		$css_classes[] = 'updiagonalsvgclass';
	}
	elseif ($topfancysep == 'toprow-bigtriangleup') {
		$topfancydiv = '<div class="topfancydiv topfancysvg">';
			$topfancydiv .= '<div class="fancysvg_wrap">';
				$topfancydiv .= '<svg class="bigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$topfancysep_bgcolor. ';">';
					$topfancydiv .= '<path d="M0 0 L50 100 L100 0 Z" style="fill: ' .$topfancysep_fill. '; stroke: ' .$topfancysep_fill. ';" />';
				$topfancydiv .= '</svg>';
			$topfancydiv .= '</div>';
		$topfancydiv .= '</div>';

		$css_classes[] = 'uptrianglesvgclass';
	}
	elseif ($topfancysep == 'toprow-bigtriangletwo') {
		$topfancydiv = '<div class="topfancydiv topfancysvg">';
			$topfancydiv .= '<div class="fancysvg_wrap">';
				$topfancydiv .= '<svg class="bigTriangleColor2" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$topfancysep_bgcolor. ';">';
					$topfancydiv .= '<path d="M0 0 L50 100 L100 0 Z" style="fill: ' .$topfancysep_fill. '; stroke: ' .$topfancysep_fill. ';" />';
					$topfancydiv .= '<path d="M50 100 L100 40 L100 0 Z" style="fill: ' .$topfancysep_fill. '; fill-opacity: 0.8;" />';
				$topfancydiv .= '</svg>';
			$topfancydiv .= '</div>';
		$topfancydiv .= '</div>';

		$css_classes[] = 'uptrianglesvgclass';
	}
	elseif ($topfancysep == 'toprow-curveup') {
		$topfancydiv = '<div class="topfancydiv topfancysvg">';
			$topfancydiv .= '<div class="fancysvg_wrap">';
				$topfancydiv .= '<svg class="curveUpColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$topfancysep_bgcolor. ';">';
					$topfancydiv .= '<path d="M0 100 C20 0 50 0 100 100 Z" style="fill: ' .$topfancysep_fill. '; stroke: ' .$topfancysep_fill. ';" />';
				$topfancydiv .= '</svg>';
			$topfancydiv .= '</div>';
		$topfancydiv .= '</div>';

		$css_classes[] = 'topcurveupsvgclass';
	}
	elseif ($topfancysep == 'toprow-curvedown') {
		$topfancydiv = '<div class="topfancydiv topfancysvg">';
			$topfancydiv .= '<div class="fancysvg_wrap">';
				$topfancydiv .= '<svg class="curveDownColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$topfancysep_bgcolor. ';">';
					$topfancydiv .= '<path d="M0 0 C50 100 80 100 100 0 Z" style="fill: ' .$topfancysep_fill. '; stroke: ' .$topfancysep_fill. ';" />';
				$topfancydiv .= '</svg>';
			$topfancydiv .= '</div>';
		$topfancydiv .= '</div>';

		$css_classes[] = 'topcurvedownsvgclass';
	}
	elseif ($topfancysep == 'toprow-bighalfcircle') {
		$topfancydiv = '<div class="topfancydiv topfancysvg">';
			$topfancydiv .= '<div class="fancysvg_wrap">';
				$topfancydiv .= '<svg class="bigHalfCircleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$topfancysep_bgcolor. ';">';
					$topfancydiv .= '<path d="M0 0 C40 100 60 100 100 0 Z" style="fill: ' .$topfancysep_fill. '; stroke: ' .$topfancysep_fill. ';" />';
				$topfancydiv .= '</svg>';
			$topfancydiv .= '</div>';
		$topfancydiv .= '</div>';

		$css_classes[] = 'tophalfcirclesvgclass';
	}
	elseif ($topfancysep == 'toprow-splitslit') {
		$topfancydiv = '<div class="topfancydiv topfancysvg">';
			$topfancydiv .= '<div class="fancysvg_wrap">';
				$topfancydiv .= '<svg class="splitSlitColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$topfancysep_bgcolor. ';">';
					$topfancydiv .= '<path d="M47 0 L0 0 L0 100 L50 100 L47 0 Z" style="fill: ' .$topfancysep_fill. '; stroke: ' .$topfancysep_fill. '; stroke-width:0;" />';
					$topfancydiv .= '<path d="M53 0 L100 0 L100 100 L50 100 L53 0 Z" style="fill: ' .$topfancysep_fill. '; stroke: ' .$topfancysep_fill. '; stroke-width:0;" />';
					$topfancydiv .= '<path d="M50 100 C49 80 47 0 40 0 L47 0 Z" style="fill: ' .$topfancysep_filltwo. '; stroke: ' .$topfancysep_filltwo. '; stroke-width:0;" />';
					$topfancydiv .= '<path d="M50 100 C51 80 53 0 60 0 L53 0 Z" style="fill: ' .$topfancysep_filltwo. '; stroke: ' .$topfancysep_filltwo. '; stroke-width:0;" />';
				$topfancydiv .= '</svg>';
			$topfancydiv .= '</div>';
		$topfancydiv .= '</div>';

		$css_classes[] = 'topsplitslitsvgclass';
	}
	elseif ($topfancysep == 'toprow-clouds') {
		$topfancydiv = '<div class="topfancydiv topfancysvg">';
			$topfancydiv .= '<div class="fancysvg_wrap">';
				$topfancydiv .= '<svg class="cloudsColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$topfancysep_bgcolor. ';">';
					$topfancydiv .= '<path d="M-5 100 Q 0 20 5 100 Z
						 M0 100 Q 5 0 10 100
						 M5 100 Q 10 30 15 100
						 M10 100 Q 15 10 20 100
						 M15 100 Q 20 30 25 100
						 M20 100 Q 25 -10 30 100
						 M25 100 Q 30 10 35 100
						 M30 100 Q 35 30 40 100
						 M35 100 Q 40 10 45 100
						 M40 100 Q 45 50 50 100
						 M45 100 Q 50 20 55 100
						 M50 100 Q 55 40 60 100
						 M55 100 Q 60 60 65 100
						 M60 100 Q 65 50 70 100
						 M65 100 Q 70 20 75 100
						 M70 100 Q 75 45 80 100
						 M75 100 Q 80 30 85 100
						 M80 100 Q 85 20 90 100
						 M85 100 Q 90 50 95 100
						 M90 100 Q 95 25 100 100
						 M95 100 Q 100 15 105 100 Z" style="fill: ' .$topfancysep_fill. '; stroke: ' .$topfancysep_fill. ';" />';
				$topfancydiv .= '</svg>';
			$topfancydiv .= '</div>';
		$topfancydiv .= '</div>';

		$css_classes[] = 'topcloudssvgclass';
	}
	else{
		$topfancydiv = '<div class="topfancywrap">';
			$topfancydiv .= '<div class="topfancydiv ' . $topfancysep . '" ' . $tpfancybg .'></div>';
		$topfancydiv .= '</div>';

		$css_classes[] = 'top' . str_replace('toprow-', '', $topfancysep) . 'class';
	}
}

//Bottom SVG Fancy Separator
$bottomfancydiv = $btmfancybg = '';
if($bottomfancysep_fill) $btmfancybg = ' style="background: ' .$bottomfancysep_fill . ';"';

if (! empty($enable_bottomfancysep) && $bottomfancysep !== '' ) {
	
	if ($bottomfancysep == 'bottomrow-diagonal') {
		$bottomfancydiv = '<div class="bottomfancydiv bottomfancysvg">';
			$bottomfancydiv .= '<div class="fancysvg_wrap">';
				$bottomfancydiv .= '<svg class="bigDiagonalColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$bottomfancysep_bgcolor. ';">';
					$bottomfancydiv .= '<path d="M0 100 L100 0 L100 100" style="fill: ' .$bottomfancysep_fill. '; stroke: ' .$bottomfancysep_fill. ';" />';
				$bottomfancydiv .= '</svg>';
			$bottomfancydiv .= '</div>';
		$bottomfancydiv .= '</div>';

		$css_classes[] = 'downdiagonalsvgclass';
	}
	elseif ($bottomfancysep == 'bottomrow-bigtriangledown') {
		$bottomfancydiv = '<div class="bottomfancydiv bottomfancysvg">';
			$bottomfancydiv .= '<div class="fancysvg_wrap">';
				$bottomfancydiv .= '<svg class="bigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$bottomfancysep_bgcolor. ';">';
					$bottomfancydiv .= '<path d="M0 100 L50 0 L100 100 Z" style="fill: ' .$bottomfancysep_fill. '; stroke: ' .$bottomfancysep_fill. ';" />';
				$bottomfancydiv .= '</svg>';
			$bottomfancydiv .= '</div>';
		$bottomfancydiv .= '</div>';

		$css_classes[] = 'downtrianglesvgclass';
	}
	elseif ($bottomfancysep == 'bottomrow-bigtriangletwo') {
		$bottomfancydiv = '<div class="bottomfancydiv bottomfancysvg">';
			$bottomfancydiv .= '<div class="fancysvg_wrap">';
				$bottomfancydiv .= '<svg class="bigTriangleColor2" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$bottomfancysep_bgcolor. ';">';
					$bottomfancydiv .= '<path d="M0 100 L50 0 L100 100 Z" style="fill: ' .$bottomfancysep_fill. '; stroke: ' .$bottomfancysep_fill. ';" />';
					$bottomfancydiv .= '<path d="M50 0 L100 60 L100 100 Z" style="fill: ' .$bottomfancysep_fill. '; fill-opacity: 0.8;" />';
				$bottomfancydiv .= '</svg>';
			$bottomfancydiv .= '</div>';
		$bottomfancydiv .= '</div>';

		$css_classes[] = 'downtrianglesvgclass';
	}
	elseif ($bottomfancysep == 'bottomrow-curveup') {
		$bottomfancydiv = '<div class="bottomfancydiv bottomfancysvg">';
			$bottomfancydiv .= '<div class="fancysvg_wrap">';
				$bottomfancydiv .= '<svg class="curveUpColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$bottomfancysep_bgcolor. ';">';
					$bottomfancydiv .= '<path d="M0 100 C20 0 50 0 100 100 Z" style="fill: ' .$bottomfancysep_fill. '; stroke: ' .$bottomfancysep_fill. ';" />';
				$bottomfancydiv .= '</svg>';
			$bottomfancydiv .= '</div>';
		$bottomfancydiv .= '</div>';

		$css_classes[] = 'downcurveupsvgclass';
	}
	elseif ($bottomfancysep == 'bottomrow-curvedown') {
		$bottomfancydiv = '<div class="bottomfancydiv bottomfancysvg">';
			$bottomfancydiv .= '<div class="fancysvg_wrap">';
				$bottomfancydiv .= '<svg class="curveDownColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$bottomfancysep_bgcolor. ';">';
					$bottomfancydiv .= '<path d="M0 0 C50 100 80 100 100 0 Z" style="fill: ' .$bottomfancysep_fill. '; stroke: ' .$bottomfancysep_fill. ';" />';
				$bottomfancydiv .= '</svg>';
			$bottomfancydiv .= '</div>';
		$bottomfancydiv .= '</div>';

		$css_classes[] = 'downcurvedownsvgclass';
	}
	elseif ($bottomfancysep == 'bottomrow-bighalfcircle') {
		$bottomfancydiv = '<div class="bottomfancydiv bottomfancysvg">';
			$bottomfancydiv .= '<div class="fancysvg_wrap">';
				$bottomfancydiv .= '<svg class="bigHalfCircleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$bottomfancysep_bgcolor. ';">';
					$bottomfancydiv .= '<path d="M0 100 C40 0 60 0 100 100 Z" style="fill: ' .$bottomfancysep_fill. '; stroke: ' .$bottomfancysep_fill. ';" />';
				$bottomfancydiv .= '</svg>';
			$bottomfancydiv .= '</div>';
		$bottomfancydiv .= '</div>';

		$css_classes[] = 'downhalfcirclesvgclass';
	}
	elseif ($bottomfancysep == 'bottomrow-splitslit') {
		$bottomfancydiv = '<div class="bottomfancydiv bottomfancysvg">';
			$bottomfancydiv .= '<div class="fancysvg_wrap">';
				$bottomfancydiv .= '<svg class="splitSlitColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$bbottomfancysep_bgcolor. ';">';
					$bottomfancydiv .= '<path d="M47 0 L0 0 L0 100 L50 100 L47 0 Z" style="fill: ' .$bottomfancysep_fill. '; stroke: ' .$bottomfancysep_fill. '; stroke-width:0;" />';
					$bottomfancydiv .= '<path d="M53 0 L100 0 L100 100 L50 100 L53 0 Z" style="fill: ' .$bottomfancysep_fill. '; stroke: ' .$bottomfancysep_fill. '; stroke-width:0;" />';
					$bottomfancydiv .= '<path d="M50 100 C49 80 47 0 40 0 L47 0 Z" style="fill: ' .$bottomfancysep_filltwo. '; stroke: ' .$bottomfancysep_filltwo. '; stroke-width:0;" />';
					$bottomfancydiv .= '<path d="M50 100 C51 80 53 0 60 0 L53 0 Z" style="fill: ' .$bottomfancysep_filltwo. '; stroke: ' .$bottomfancysep_filltwo. '; stroke-width:0;" />';
				$bottomfancydiv .= '</svg>';
			$bottomfancydiv .= '</div>';
		$bottomfancydiv .= '</div>';

		$css_classes[] = 'downsplitslitsvgclass';
	}
	elseif ($bottomfancysep == 'bottomrow-clouds') {
		$bottomfancydiv = '<div class="bottomfancydiv bottomfancysvg">';
			$bottomfancydiv .= '<div class="fancysvg_wrap">';
				$bottomfancydiv .= '<svg class="cloudsColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" style="background: ' .$bottomfancysep_bgcolor. ';">';
					$bottomfancydiv .= '<path d="M-5 100 Q 0 20 5 100 Z
						 M0 100 Q 5 0 10 100
						 M5 100 Q 10 30 15 100
						 M10 100 Q 15 10 20 100
						 M15 100 Q 20 30 25 100
						 M20 100 Q 25 -10 30 100
						 M25 100 Q 30 10 35 100
						 M30 100 Q 35 30 40 100
						 M35 100 Q 40 10 45 100
						 M40 100 Q 45 50 50 100
						 M45 100 Q 50 20 55 100
						 M50 100 Q 55 40 60 100
						 M55 100 Q 60 60 65 100
						 M60 100 Q 65 50 70 100
						 M65 100 Q 70 20 75 100
						 M70 100 Q 75 45 80 100
						 M75 100 Q 80 30 85 100
						 M80 100 Q 85 20 90 100
						 M85 100 Q 90 50 95 100
						 M90 100 Q 95 25 100 100
						 M95 100 Q 100 15 105 100 Z" style="fill: ' .$bottomfancysep_fill. '; stroke: ' .$bottomfancysep_fill. ';" />';
				$bottomfancydiv .= '</svg>';
			$bottomfancydiv .= '</div>';
		$bottomfancydiv .= '</div>';

		$css_classes[] = 'downcloudssvgclass';
	}
	else{
		$bottomfancydiv = '<div class="bottomfancywrap">';
			$bottomfancydiv .= '<div class="bottomfancydiv ' . $bottomfancysep . '" ' . $btmfancybg .'></div>';
		$bottomfancydiv .= '</div>';

		$css_classes[] = 'bottom' . str_replace('bottomrow-', '', $bottomfancysep) . 'class';
	}
}

//Background Img Slide
$slide_img = explode(',', $rowimg_slides);
$imgcount = count($slide_img);
$slide_atts = '';
$before_content_wrap = '';

if ($enable_rowbg_slide && !empty($rowimg_slides)) {
	
	$overlay = get_template_directory_uri() . '/images/overlays/0' .$rowbg_overlay .'.png' ;

	$before_content_wrap = '<div class="imagebgslide"></div>';

	$slide_atts .= "
	<script type='text/javascript'>
		jQuery(document).ready(function() {
		jQuery('.imagebgslide').vegas({
			overlay : '{$overlay}',
			delay : {$rowbg_delay},
			transition : '{$rowbg_transition}',
			animation : '{$rowbg_animation}',
			slides : [";
			for ($i=0; $i < $imgcount; $i++) { 
				$img_atts = wp_get_attachment_image_src( $slide_img[$i], 'full' );
				$slide_atts .= "{ src:'{$img_atts[0]}'},";
			}
			$slide_atts .= "]
		});
	});
	</script>";

}


if ( vc_shortcode_custom_css_has_property( $css, array(
		'border',
		'background',
	) ) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $before_content_wrap;
$output .= $topfancydiv;
$output .= wpb_js_remove_wpautop( $content );
$output .= $bottomfancydiv;
$output .= '</div>';
$output .= $after_output;
$output .= $slide_atts;

echo $output;
