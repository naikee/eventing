<?php
/**
* Preloader Fxn.
*
* @package Adeetheming
* @since 1.0
*/
global $adeetheming_options;

$pre_obj = '';
if ( $adeetheming_options['preloader_color'] ) {
   $pre_obj = 'style="background:' .$adeetheming_options['preloader_color']. ';"';
}

$pre_bg = '';
if ( $adeetheming_options['preloader_color'] ) {
   $pre_bg = 'style="background:' .$adeetheming_options['preloader_bg_color']. ';"';
}

$style = $adeetheming_options['preloader_style'];
if (! isset($style) || empty($style)) {
	return;
}

?>

<div id="preloading" class="preloader<?php echo $style; ?>" <?php echo wp_kses_post($pre_bg);?>>
	<div id="preloading-center">
		<div id="preloading-center-absolute">
			<?php if ($style == 'style_one') { ?>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
			<?php } ?>
			
			<?php if ($style == 'style_two') { ?>
				<div class="object" id="first_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="second_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="third_object" <?php echo wp_kses_post($pre_obj);?>></div>
			<?php } ?>

			<?php if ($style == 'style_three') { ?>
				<div class="object" id="first_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="second_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="third_object" <?php echo wp_kses_post($pre_obj);?>></div>
			<?php } ?>

			<?php if ($style == 'style_four') { ?>
				<div class="object" id="first_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="second_object" <?php echo wp_kses_post($pre_obj);?> style="float:right;"></div>
			<?php } ?>

			<?php if ($style == 'style_five') { ?>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
			<?php } ?>

			<?php if ($style == 'style_six') { ?>
				<div class="object" id="first_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="second_object" <?php echo wp_kses_post($pre_obj);?> style="left:20px;"></div>
				<div class="object" id="third_object" <?php echo wp_kses_post($pre_obj);?> style="left:40px;"></div>
				<div class="object" id="fourth_object" <?php echo wp_kses_post($pre_obj);?> style="left:60px;"></div>
				<div class="object" id="fifth_object" <?php echo wp_kses_post($pre_obj);?> style="left:80px;"></div>
			<?php } ?>

			<?php if ($style == 'style_seven') { ?>
				<div class="object" id="first_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="second_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="third_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="fourth_object" <?php echo wp_kses_post($pre_obj);?>></div>
			<?php } ?>

			<?php if ($style == 'style_eight') { ?>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
			<?php } ?>

			<?php if ($style == 'style_nine') { ?>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" <?php echo wp_kses_post($pre_obj);?>></div>
			<?php } ?>

			<?php if ($style == 'style_ten') { ?>
				<div class="object" id="fourth_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="third_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="second_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="first_object" <?php echo wp_kses_post($pre_obj);?>></div>
			<?php } ?>

			<?php if ($style == 'style_eleven') { ?>
				<div class="object" id="fourth_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="third_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="second_object" <?php echo wp_kses_post($pre_obj);?>></div>
				<div class="object" id="first_object" <?php echo wp_kses_post($pre_obj);?>></div>
			<?php } ?>
		</div>
	</div>
</div>