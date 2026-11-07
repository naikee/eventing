<?php
	global $post;
	$prefix = 'adee_';

	$images = get_post_meta( $post->ID, $prefix . 'portfolio_gallery' );

if ( isset($images) && ! empty($images) ) :
?>
	<div id="portfolio_gallery" class="flexslider">
		<ul class="slides">
			<?php
				if (has_post_thumbnail()) {
					$thumb   = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url($thumb,'full');
					$image   = aq_resize( $img_url, 1140, 550, true, true, true );

					echo '<li><img src="' . $image . '" alt="' . $title . '" class="img-responsive" /></li>';
				}
				foreach ($images as $image) {
					$thumb = wp_get_attachment_image_src($image, 'full');
					$img = aq_resize( $thumb[0], 1140, 550, true, true, true );

					echo '<li><img src="' . $img . '" alt="' . $title . '" class="img-responsive" /></li>';
				}
			?>
		</ul>
	</div>

	<div id="portfolio_thumb" class="flexslider">
		<ul class="slides">
			<?php 
				if (has_post_thumbnail()) {
					$thumb   = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url($thumb,'full');
					$image   = aq_resize( $img_url, 180, 100, true, true, true );

					echo '<li><img src="' . $image . '" alt="' . $title . '" class="img-responsive" /></li>';
				}
				foreach ($images as $image) {
					$thumb = wp_get_attachment_image_src($image, 'full');
					$img = aq_resize( $thumb[0], 180, 100, true, true, true );

					echo '<li><img src="' . $img . '" alt="' . $title . '" /></li>';
				}
			?>
		</ul>
	</div>
<?php else : ?>
	<div class="flexslider">
		<?php 
			if (has_post_thumbnail()) {
				$thumb   = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url($thumb,'full');
				$image   = aq_resize( $img_url, 1140, 550, true, true, true );

					echo '<img src="' . $image . '" alt="' . $title . '" class="img-responsive" />';
			}
		?>
	</div>
<?php endif;