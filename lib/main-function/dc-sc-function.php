<?php
/**
* Shortcodes Fxn.
*
* @package Adeetheming
* @since 1.0
*/

/* ---------------------------------------------------------------------------
* Accordion SC
* --------------------------------------------------------------------------- */
if (! function_exists('accordion_sc')) {
	function accordion_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'style'			=> 'style1',
			'icons'			=> 'fa-plus',
			'icons_align'	=> 'left',
			'active'		=> 1,
			'color'			=> '',
			'background'	=> '',
			'activecolor'	=> '',
			'activebg'		=> '',
			'class'			=> ''
			), $attr)
		);

		$active = (intval($active)) ? 'data-active="' .$active. '"' : '';

		$customcss = adeetheming_uniqclass('dc-custom-accordion');

		$classes = array();

		$classes[] = $class;
		$classes[] = $customcss;
		$classes[] = 'style_' .$style;
		$classes[] = 'icons_' .$icons;
		$classes[] = 'icons_align_' .$icons_align;

		$classes = implode(' ', $classes);

		$output = '<div class="accordion_wrap dc-sc-accordion ' .$classes. '">';

			if ($title) $output .= '<h4 class="accordion-title">' .$title. '</h4>';


			$output .= '<div class="accordion_cover" ' .$active. '>';

				$output .= do_shortcode($content);

			$output .= '</div>';

		$output .= '</div>';

		//Shortcode Custom CSS
		$shortcodecss = '';
		if($background) $shortcodecss = '.dc-sc-accordion.style_style1.'.$customcss.' div.accordion-title-wrap, .dc-sc-accordion.style_style2.'.$customcss.' div.accordion-title-wrap, .dc-sc-accordion.style_style3.'.$customcss.' div.accordion-title-wrap:before, .dc-sc-accordion.style_style4.'.$customcss.' div.accordion-title-wrap:before { background: ' .$background. '; }.dc-sc-accordion.style_style3.'.$customcss.' div.accordion-title-wrap, .dc-sc-accordion.style_style4.'.$customcss.' div.accordion-title-wrap, .dc-sc-accordion.style_style5.'.$customcss.' div.accordion-title-wrap { border-color: ' .$background. '; }';

		if($color) $shortcodecss .= '.dc-sc-accordion.'.$customcss.' div.accordion-title-wrap > span, .dc-sc-accordion.'.$customcss.' div.accordion-title-wrap:after { color: ' .$color. '; }.dc-sc-accordion.style_style2.'.$customcss.' div.accordion-title-wrap:before { background: ' .$color. '; }';

		if($activebg) $shortcodecss .= '.dc-sc-accordion.style_style1.'.$customcss.' .accordion-item-wrap.active div.accordion-title-wrap, .dc-sc-accordion.style_style2.'.$customcss.' .accordion-item-wrap.active div.accordion-title-wrap, .dc-sc-accordion.style_style3.'.$customcss.' .accordion-item-wrap.active div.accordion-title-wrap:before, .dc-sc-accordion.style_style4.'.$customcss.' .accordion-item-wrap.active div.accordion-title-wrap:before { background: ' .$activebg. '; } .dc-sc-accordion.style_style3.'.$customcss.' .accordion-item-wrap.active div.accordion-title-wrap, .dc-sc-accordion.style_style4.'.$customcss.' .accordion-item-wrap.active div.accordion-title-wrap, .dc-sc-accordion.style_style5.'.$customcss.' .accordion-item-wrap.active div.accordion-title-wrap { border-color: ' .$activebg. '; } .dc-sc-accordion.style_style4.'.$customcss.'.icons_align_right .active .accordion-title-wrap > span:first-child:before { border-right-color: ' .$activebg. '; } .dc-sc-accordion.style_style4.'.$customcss.'.icons_align_left .active .accordion-title-wrap > span:first-child:before { border-left-color: ' .$activebg. '; }';

		if($activecolor) $shortcodecss .= '.dc-sc-accordion.'.$customcss.' .accordion-item-wrap.active div.accordion-title-wrap > span, .dc-sc-accordion.'.$customcss.' .accordion-item-wrap.active div.accordion-title-wrap:after { color: ' .$activecolor. '; } .dc-sc-accordion.style_style2.'.$customcss.' .accordion-item-wrap.active div.accordion-title-wrap:before { background: ' .$activecolor. '; }';

		adeetheming_shortcodecss($shortcodecss);

		return $output;

	}

	add_shortcode('accordion', 'accordion_sc');
}



/* ---------------------------------------------------------------------------
* Accordion Item SC
* --------------------------------------------------------------------------- */
if (! function_exists('accordion_item_sc')) {
	function accordion_item_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'display'			=> 'title_only',
			'title'				=> '',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
			'image'				=> '',
			'size'				=> '',
			'arrangement'		=> ''
			), $attr)
		);
		
		if($title) $title = '<span class="dc-accordion-title">' .$title. '</span>';

		vc_icon_element_fonts_enqueue( $icon );

		$iconClass = isset( ${'icon_' .$icon} ) ? '<span class="dc-accordion-icon"><i class="' .esc_attr( ${'icon_' .$icon} ). '"></i></span>' : '';

		$size = (! empty(intval($size))) ? $size : 32;

		$image = wp_get_attachment_image_src( $image,'thumbnail');
		if($image) $img_src = '<span class="dc-accordion-image"><img src="' .$image[0]. '" alt="" width="' .$size. '" height="' .$size. '"/></span>';

		$element_set = '';

		switch ($display) {
			case 'icon_title':
				if ($arrangement === 'title_before_icon') {
					$element_set = $title. ' ' .$iconClass;
				} else {
					$element_set = $iconClass. ' ' .$title;
				}
				break;

			case 'image_title':
				if ($arrangement === 'title_before_image') {
					$element_set = $title. ' ' .$img_src;
				} else {
					$element_set = $img_src. ' ' .$title;
				}
				break;
			
			case 'icon_only':
				$element_set = $iconClass;
				break;

			case 'image_only':
				$element_set = $img_src;
				break;

			default:
				$element_set = $title;
				break;
		}

		$output = '<div class="accordion-item-wrap">';

			$output .= '<div class="accordion-title-wrap">' .$element_set. '</div>';

			$output .= '<div class="accordion-content">' .do_shortcode($content). '</div>';

		$output .= '</div>';

		return $output;
	}

	add_shortcode('accordion_item', 'accordion_item_sc');
}



/* ---------------------------------------------------------------------------
* Alert SC
* ---------------------------------------------------------------------------*/
if (! function_exists('alert_sc')) {
	function alert_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'type'				=> 'simple',
			'alerts'			=> 'success',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
			'bg_image'			=> '',
			'color'				=> '',
			'background'		=> '',
			'font'				=> '',
			'style'				=> 'square',
			'delete'			=> true,
			'class'				=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-alert');

		$classes = array();

		if($type) $classes[] = 'type_' .$type;
		if($style) $classes[] = 'style_' .$style;
		if($alerts) $classes[] = 'alerts_' .$alerts;
		if($type == 'simple') $classes[] = 'alert alert-' .$alerts;
		$classes[] = $customcss;
		$classes[] = $class;

		$classes = implode(' ', $classes);

		if ($type == 'simple') {
			switch ($alerts) {
				case 'info':
					$icon = '<i class="fa fa-info-circle"></i>';
					break;

				case 'warning':
					$icon = '<i class="fa fa-exclamation-triangle"></i>';
					break;

				case 'danger':
					$icon = '<i class="fa fa-exclamation-circle"></i>';
					break;
				
				default:
					$icon = '<i class="fa fa-check-circle"></i>';
					break;
			}
		} else {
			vc_icon_element_fonts_enqueue( $icon );
			$icon = isset( ${'icon_' .$icon} ) ? '<i class="' .esc_attr( ${'icon_' .$icon} ). '"></i>' : '';
		}

		$bgcolor = ($background !== '') ? $background : '';
		$bgcolor = dc_shadecolor($bgcolor);
		$bg_style = 'background: ' .$bgcolor. ';';

		$shortcodecss = $bin = '';
		

		$output = '<div class="alert_wrap dc-sc-alert ' .$classes. '">';
			$output .= '<div class="alert_icon_wrap" style="' .$bg_style. '">';
				$output .= '<span class="alert_icon">' .$icon. '</span>';
			$output .= '</div>';

			$output .= '<div class="alert_content_wrap">';
				$output .= do_shortcode($content);
			$output .= '</div>';

			if($delete == 0) {
				if ($type == 'modern') {
					$bin = 'ion-ios-trash';
				} else {
					$bin = 'fa fa-times-circle-o';
				}
				$output .= '<div class="alert_del_wrap" style="' .$bg_style. '">';
					$output .= '<span class="alert_del"><i class="' .$bin. '"></i></span>';
				$output .= '</div>';
			}
		$output .= '</div>';

		//Shortcode Custom CSS
		$image = wp_get_attachment_image_src($bg_image, 'full');

		if ($type != 'simple') {
			$shortcodecss = ($color != '') ? 'color: ' .$color. ';': '';
			$shortcodecss .= ($background != '') ? ' background: ' .$background. ';': '';
			$shortcodecss .= ($font != '') ? ' font-size: ' .$font. 'px;': '';
			$shortcodecss .= ($bg_image != '') ? ' background-image: url(' .$image[0]. ');' : '';

			$hovershade = dc_shadecolor($bgcolor);
			$hovercss = ($bgcolor != '') ? 'background: ' .$hovershade. ' !important;' : '';
			$hovercss = '.dc-sc-alert.' .$customcss. ' .alert_del_wrap:hover {' .$hovercss. '}';

			$shortcodecss = '.dc-sc-alert.' .$customcss. ' {' .$shortcodecss. '}' .$hovercss;
		}

		adeetheming_shortcodecss($shortcodecss);

		return $output;
	}

	add_shortcode('alert', 'alert_sc');
}



/* ---------------------------------------------------------------------------
* Audio Player SC
* --------------------------------------------------------------------------- */
if (! function_exists('audioplayer_sc')) {
	function audioplayer_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'type'				=> 'normal',
			'width'				=> 100,
			'audio'				=> '',
			'cover'				=> '',
			'align'				=> 'left',
			'icon_type'			=> 'icon',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
			'image'				=> '',
			'size'				=> 84,
			'title'				=> '',
			'textalign'			=> 'left',
			'buttons'			=> 'Listen to audio',
			'buttonalign'		=> 'left',
			'color'				=> '',
			'btn_background'	=> '',
			'background'		=> '',
			'bg_image'			=> '',
			'padding'			=> '',
			'class'				=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-audioplayer');

		$embed = do_shortcode( '[audio src="' .esc_url($audio). '"]' );

		$classes = $btnstyle = $bgstyle = array();
		if($type == 'normal' && $textalign) $classes[] = 'textalign_' .$textalign;
		if($type !== 'normal') $classes[] = 'popup-audio-wrap mfp-hide';
		$classes[] = $customcss;
		if($class) $classes[] = $class;
		$classes = implode(' ', $classes);

		vc_icon_element_fonts_enqueue( $icon );
		$icon = isset( ${'icon_' .$icon} ) ? '<i class="' .esc_attr( ${'icon_' .$icon} ). '"></i>' : '';

		$image = wp_get_attachment_image_src( $image,'thumbnail');
		if($image) $image = '<span class="dc-audio-image" ' .$icstyle. '><img src="' .$image[0]. '" alt="" width="' .$size. '" height="' .$size. '" /></span>';

		$cover = wp_get_attachment_image_src( $cover,'thumbnail');
		if($cover) $cover = '<div class="dc-audio-cover"><img src="' .$cover[0]. '" alt="" width="120" height="120" /></div>';

		$bg_image = wp_get_attachment_image_src( $bg_image,'full');
		if($bg_image) $bg_image = $bg_image[0];

		if($buttonalign && $type == 'buttons') $buttonalign = 'buttonalign_' .$buttonalign;

		$uniqid = uniqid(rand(1,9999));

		$output = '<div class="audio_wrap dc-sc-audio  ' .$buttonalign. '">';
			if ($type == 'buttons') {
				if($color) $btnstyle[] = 'color:' .$color .';';
				if($btn_background) $btnstyle[] = 'background:' .$btn_background .';';
				$btnstyle = 'style="' .implode(' ', $btnstyle). '"';

				$output .= '<a href="#audio_' .$uniqid. '" class="btn btn-link audio-btn dc-open-audio" ' .$btnstyle. '>';
					$output .= $buttons;
				$output .= '</a>';
			}

			if ($type == 'popup') {
				if($color) $bgstyle[] = 'color:' .$color .';';
				if($textalign) $bgstyle[] = 'text-align:' .$textalign. ';';
				if($background) $bgstyle[] = 'background-color:' .$background .';';
				if($bg_image) $bgstyle[] = 'background: url(' .$bg_image. ');';
				if($padding) $bgstyle[] = 'padding:' .$padding. ';';
				$bgstyle = 'style="' .implode(' ', $bgstyle). '"';

				$icstyle = 'style="font-size:' .$size. 'px;"';

				$output .= '<div class="audio-bg-wrap" ' .$bgstyle. '>';
					$output .= '<a href="#audio_' .$uniqid. '" class="audio-open-wrap dc-open-audio">';
						if ($icon_type == 'image') {
							$output .= $image;
						} else {
							$output .= '<span class="dc-audio-icon" ' .$icstyle. '>';
								$output .= $icon;
							$output .= '</span>';
						}
					$output .= '</a>';

					$color = (! empty($color)) ? 'style="color:' .$color.';"' : '';

					if($title) $output.= '<h4 class="audio-title" ' .$color. '>' .$title. '</h4>';
					if($content) $output .= '<div class="audio-content">' .do_shortcode($content). '</div>';
				$output .= '</div>';
			}

			$output .= '<div id="audio_' .$uniqid. '" class="' .$classes. '">';
				$output .= '<div class="audio-inner-wrap">';
					if ($align != 'right') $output .= $cover;
				
					$output .= '<div class="audio-container">';
						if($title) $output .= '<h4 class="audio-title">' .$title. '</h4>';
						$output .= '<div class="audio-embed-wrap">';
							$output .= $embed;
						$output .= '</div>';
					$output .= '</div>';

					if ($align == 'right') $output .= $cover;
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	add_shortcode('audioplayer', 'audioplayer_sc');
}



/* ---------------------------------------------------------------------------
* Blockquote SC
* --------------------------------------------------------------------------- */
if (! function_exists('blockquote_sc')) {
	function blockquote_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'type'			=> 'simple',
			'author'		=> '',
			'link'			=> '',
			'target'		=> '',
			'border'		=> '',
			'background'	=> '',
			'bg_image'		=> '',
			'class'			=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-blockquote');

		$target = ($target == 'blank') ? ' target="_' .$target. '"' : '';

		$classes = array();
		$classes[] = $customcss;
		$classes[] = 'type_' .$type;
		$classes[] = $class;

		$classes = implode(' ', $classes);

		$output = '<div class="blockquote_wrap dc-sc-blockquote ' .$classes. '">';
			$output .= '<blockquote>' .do_shortcode($content). '</blockquote>';

			if ($author) {
				$output .= '<p class="author_wrap">';
					$output .= '<i class="ion-person"></i> ';
					if($link) $output .= '<a href="' .esc_url($link). '"' .$target. '>';
						$output .= $author;
					if($link) $output .= '</a>';
				$output .= '</p>';
			}
		$output .= '</div>';

		$image = wp_get_attachment_image_src($bg_image, 'full');

		//Shortcode Custom CSS
		$shortcodecss = '';
		if ($border)	$shortcodecss = '.dc-sc-blockquote.type_simple.' .$customcss. ', .dc-sc-blockquote.type_classic.' .$customcss. ' { border-left-color: ' .$border. '; border-right-color: ' .$border. '; }';
		if($background) $shortcodecss .= '.dc-sc-blockquote.type_simple.' .$customcss. ', .dc-sc-blockquote.type_classic.' .$customcss. ', .dc-sc-blockquote.type_modern.' .$customcss. ' { background: ' .$background. ';} .dc-sc-blockquote.type_modern.' .$customcss. ':before { text-shadow: -3px 0 ' .$background. ';} .dc-sc-blockquote.type_modern.' .$customcss. ':after { text-shadow: 3px 0 ' .$background. ';}';
		if ($bg_image)	$shortcodecss .= '.dc-sc-blockquote.type_simple.' .$customcss. ', .dc-sc-blockquote.type_classic.' .$customcss. ', .dc-sc-blockquote.type_modern.' .$customcss. ' { background-image: url(' .$image[0]. ');}';

		adeetheming_shortcodecss($shortcodecss);

		return $output;
	}

	add_shortcode('blockquote', 'blockquote_sc');
}



/* ---------------------------------------------------------------------------
* BlogPost SC
* --------------------------------------------------------------------------- */
if (! function_exists('blog_sc')) {
    function blog_sc( $attr, $content = null ) {
        extract(shortcode_atts(array(
            'bloglayout'		=> 'list_layout',
            'column'			=> 'cols__2',
            'category'			=> '',
            'not_category'		=> '',
            'count'				=> 10,
            'orderby'			=> 'date',
            'order'				=> 'DESC',
            'loadmore'			=> true,
            'class'				=> ''
        ), $attr) );

        ob_start();

        $paged = (get_query_var('paged')) ? get_query_var('paged') : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

        $args = array(
            'post_type'     		=> 'post',
            'posts_per_page'		=> intval($count),
            'paged'         		=> $paged,
            'orderby'       		=> $orderby,
            'order'         		=> $order,
            'ignore_sticky_posts'	=> 0,
        );

        if($category) $args['category'] = $category;
        if($not_category) $args['category__not_in'] = $not_category;

        global $adeetheming_options;

        $prefix = 'adee_';

        $classes = array();
        $classes[] = $bloglayout;
        if ($bloglayout == 'masonry_layout') {
            $blogpost_cols[] = 'masonry-element';
            $classes[] = 'masonry-item';
        } elseif ($bloglayout == 'grid_layout') {
            $blogpost_cols[] = 'grid-element';
            $classes[] = 'grid-item';
        }

        if ( ($bloglayout == 'grid_layout') || ($bloglayout == 'masonry_layout') ) {
            $blogpost_cols[] = $column;

            $blogpost_cols[] = 'loadmore-masonry';

            $blogpost_col = join(' ', $blogpost_cols);
        }

        query_posts($args);

        if (have_posts()) { ?>

            <div class="loadmore-element <?php echo esc_attr($blogpost_col); ?>">

            <?php
            while (have_posts()) {
                the_post();

                $thumb   = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url($thumb,'full');
	
				switch ($bloglayout) {
					case 'list_layout':
						$image   = aq_resize( $img_url, 760, 480, true, true, true );
						break;

					case 'full_image_layout':
						$image   = aq_resize( $img_url, 1140, 520, true, true, true );
						break;

					case 'grid_layout':
						$image   = aq_resize( $img_url, 760, 480, true, true, true );
						break;
		
					default:
						$image   = aq_resize( $img_url, 760, 350, true, true, true );
						break;
				} ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
                	<?php if (!is_single()) { ?>
                		
                		<?php if(get_post_format() == 'aside') { ?>
                			<?php if ( has_post_thumbnail() ){
								$col = 'has-thumb';
							} else {
								$col = 'no-thumb';
							} ?>

							<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-file-text"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>
			
							<div class="content-wrapper">
	    						<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
	        						<div class="featured-wrapper <?php echo $col;?>"><a href="<?php the_permalink(); ?>" rel="bookmark">
	        		    				<?php if ($bloglayout == 'masonry_layout') {
	        								the_post_thumbnail('full', array('class' => 'img-responsive'));
	        							} else { ?>
	        								<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        							<?php } ?>
	        		    				<div class="featured-cover"></div>
	        						</a></div>
	    						<?php } ?>
								<div class="content-details <?php echo $col;?>">
		    						<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
								</div>
							</div>
                		<?php	} elseif (get_post_format() == 'audio') { ?>
                			<?php 
								if ( rwmb_meta( $prefix . 'audio_code' ) !== '' ){
									$col = 'has-thumb';
								}else {
									$col = 'no-thumb';
								} ?>

							<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-music"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
	    						<?php  if ( rwmb_meta( $prefix . 'audio_code' ) && ! post_password_required() ) { ?>
	    							<div class="featured-wrapper <?php echo $col; ?>">
	       								<div class="entry-audio embed-responsive embed-responsive-16by9"><a href="<?php the_permalink(); ?>" rel="bookmark">
	       									<?php if ($bloglayout == 'masonry_layout') {
	        									the_post_thumbnail('full', array('class' => 'img-responsive'));
	        								} else { ?>
	        									<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        								<?php } ?>
	        								<div class="featured-cover"></div>
	        								</a>
	        								<div class="audio-post-container">
	        									<div class="audio-embed-wrap">
	           										<?php echo do_shortcode( '[audio src="' .rwmb_meta(  $prefix . 'audio_code' ). '"]' ); ?>
	           									</div>
	           								</div>
	       								</div> <!--/.audio-content -->
	    							</div>   
	    						<?php } ?>    
	     						<div class="content-details <?php echo $col; ?>">
	    							<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
	    						</div>
    						</div>
                		<?php	} elseif (get_post_format() == 'gallery') { ?>
                			<?php 
    							if ( rwmb_meta( $prefix . 'gallery_images','type=image_advanced') !== '' ){
        							$col = 'has-thumb';
    							}else {
        							$col = 'no-thumb';
    							} ?>

    						<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-camera"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
                				<?php  if ( rwmb_meta( $prefix . 'gallery_images','type=image_advanced') && ! post_password_required() ) { ?>
                    				<div class="featured-wrapper <?php echo $col; ?>">
                        				<div class="entry-content-gallery">
                            				<?php $slides = rwmb_meta( $prefix . 'gallery_images','type=image_advanced'); ?>
                            				<?php if(count($slides) > 0) { ?>
                                				<div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                                				<!-- Wrapper for slides -->
                                    				<div class="carousel-inner">
                                    				<?php $slide_no = 1; ?>
                                    				<?php foreach( $slides as $slide ) { ?>
                                        				<div class="item <?php if($slide_no == 1) echo 'active'; ?>">
                                            				<?php $images = wp_get_attachment_image_src( esc_attr($slide['ID']), 'blog-medium' ); ?>
                                            				<img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="">
                                        				</div>
                                        				<?php $slide_no++; ?>
                                    				<?php } ?>
                                    				</div>
                                    				<!-- Controls -->
                                    				<a class="left carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev">
                                        				<i class="fa fa-angle-left"></i>
                                    				</a>
                                    				<a class="right carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next">
                                        				<i class="fa fa-angle-right"></i>
                                    				</a>
                                				</div>
                            				<?php } ?>
                        				</div><!--/.entry-content-gallery-->
                    				</div> 
                				<?php } ?>
            					<div class="content-details <?php echo $col; ?>">
                					<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
            					</div>
        					</div>
                		<?php	} elseif (get_post_format() == 'image') { ?>
                			<?php if ( has_post_thumbnail() ){
								$col = 'has-thumb';
							} else {
								$col = 'no-thumb';
							} ?>

							<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-picture-o"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
	    						<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
	        						<div class="featured-wrapper <?php echo $col;?>"><a href="<?php the_permalink(); ?>" rel="bookmark">
	        	    					<?php if ($bloglayout == 'masonry_layout') {
	        								the_post_thumbnail('full', array('class' => 'img-responsive'));
	        							} else { ?>
	        								<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        							<?php } ?>
	        	    					<div class="featured-cover"></div>
	        						</a></div>
	    						<?php } ?>
								<div class="content-details <?php echo $col;?>">
		    						<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
								</div>
							</div>
                		<?php	} elseif (get_post_format() == 'link') { ?>
                			<?php if ( rwmb_meta( $prefix . 'link' ) !== '' ){
								$col = 'has-thumb';
							} else {
								$col = 'no-thumb';
							} ?>

							<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-link"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
		    					<?php  if ( rwmb_meta( $prefix . 'link' ) && ! post_password_required() ) { ?>
		    						<div class="featured-wrapper <?php echo $col; ?>">
		       							<div class="entry-link"><a href="<?php the_permalink(); ?>" rel="bookmark">
	       									<?php if ($bloglayout == 'masonry_layout') {
	        									the_post_thumbnail('full', array('class' => 'img-responsive'));
	        								} else { ?>
	        									<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        								<?php } ?>
	        								<div class="featured-cover"></div>
	        								</a>
	        								<div class="link-post-container">
	        									<div class="link-embed-wrap">
	        										<a href="<?php echo esc_url( rwmb_meta( $prefix . 'link' ) ); ?>" target="_blank">
	        											<?php echo esc_attr( rwmb_meta( $prefix . 'link_title' ) ); ?>
	        										</a>
	        									</div>
	        								</div>
		       							</div>     
		    						</div>
		    					<?php } ?>
								<div class="content-details <?php echo $col; ?>">
		    						<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
	    						</div>
    						</div>
                		<?php	} elseif (get_post_format() == 'quote') { ?>
                			<?php if ( rwmb_meta( $prefix . 'quote' ) !== '' ){
        						$col = 'has-thumb';
    						}else {
        						$col = 'no-thumb';
    						} ?>

    						<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-quote-left"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
                				<?php  if ( rwmb_meta( $prefix . 'quote' ) && ! post_password_required() ) { ?>
                    				<div class="featured-wrapper <?php echo $col; ?>">
                        				<div class="entry-quote"><a href="<?php the_permalink(); ?>" rel="bookmark">
	       									<?php if ($bloglayout == 'masonry_layout') {
	        									the_post_thumbnail('full', array('class' => 'img-responsive'));
	        								} else { ?>
	        									<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        								<?php } ?>
	        								<div class="featured-cover"></div>
	        								</a>
	        								<div class="quote-post-container">
	        									<div class="quote-embed-wrap">
	        										<blockquote>
                                						<p><?php echo esc_html(rwmb_meta( $prefix . 'quote' )); ?></p>
                                						<small><?php echo esc_html(rwmb_meta( $prefix . 'quote_author' )); ?></small>
                            						</blockquote>
	        									</div>
	        								</div>
                        				</div>        
                    				</div>
                				<?php } ?>
            					<div class="content-details <?php echo $col; ?>">
                					<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
            					</div>
        					</div>
                		<?php	} elseif (get_post_format() == 'video') { ?>
                			<?php if ( rwmb_meta( $prefix . 'video' ) !== '' ){
        						$col = 'has-thumb';
    						} else {
        						$col = 'no-thumb';
    						} ?>

    						<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-video-camera"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
                				<?php  if ( rwmb_meta( $prefix . 'video' ) && ! post_password_required() ) { ?>
                    				<div class="featured-wrapper <?php echo $col; ?>">
                        				<div class="entry-video embed-responsive embed-responsive-16by9">
                            				<?php $video_source = esc_attr(rwmb_meta( $prefix . 'video_source' )); ?>
                            				<?php $video = rwmb_meta( $prefix . 'video' ); ?>
                            				<?php if($video_source == 1): ?>
                                				<?php echo rwmb_meta( $prefix . 'video' ); ?>
                            				<?php elseif ($video_source == 2): ?>
                                				<?php echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; ?>
                            				<?php elseif ($video_source == 3): ?>
                                				<?php echo '<iframe src="http://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="350" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; ?>
                            				<?php endif; ?>
                        				</div>
                    				</div>
                				<?php } ?>
            					<div class="content-details <?php echo $col; ?>"> 
                					<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
            					</div>
        					</div>
                		<?php	} else { ?>
                			<?php if ( has_post_thumbnail() ){
								$col = 'has-thumb';
							} else {
								$col = 'no-thumb';
							} ?>

							<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-thumb-tack"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
	    						<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
	    	    					<div class="featured-wrapper <?php echo $col;?>">
	        							<a href="<?php the_permalink(); ?>" rel="bookmark">
	            							<?php if ($bloglayout == 'masonry_layout') {
	        									the_post_thumbnail('full', array('class' => 'img-responsive'));
	        								} else { ?>
	        									<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        								<?php } ?>
	            							<div class="featured-cover"></div>
	        							</a>
	        						</div>
	    						<?php } ?>
								<div class="content-details <?php echo $col;?>">
		    						<?php get_template_part( 'templates/post-format/entry-content' ); ?>
								</div>
							</div>
                		<?php	} ?>

                	<?php } ?>
                </article>
            <?php } ?>

            </div>
            <?php if($loadmore) {
                echo adeetheming_loadmore();
            } else {
                echo adeetheming_pagination();
            } 
        }

        wp_reset_query();

        $blog = ob_get_contents();
        ob_end_clean();
        return $blog;
    }

    add_shortcode('blog', 'blog_sc');
}



/* ---------------------------------------------------------------------------
* Blog Mag Banner SC
* --------------------------------------------------------------------------- */
if (! function_exists('blogmagslide_sc')) {
    function blogmagslide_sc( $attr, $content = null ) {
        extract(shortcode_atts(array(
        	'title'				=> '',
            'category'			=> '',
            'not_category'		=> '',
            'count'				=> 6,
            'orderby'			=> 'date',
            'order'				=> 'DESC',
            'class'				=> ''
        	), $attr)
        );

        $args = array(
            'post_type'     		=> 'post',
            'posts_per_page'		=> intval($count),
            'paged'         		=> -1,
            'orderby'       		=> $orderby,
            'order'         		=> $order,
            'ignore_sticky_posts'	=> 1
        );

        if($category) $args['category_name'] = $category;
        if($not_category) $args['category__not_in'] = $not_category;

        global $post;

        $return = '';

        $blog_loop = new WP_Query($args);

        if ($blog_loop->have_posts()) {

        	$output = '<div class="blogmagslide_wrap dc-sc-blogmagslide ' .$class. '">';
        		
        		if ($title) {
				
				$output .= '<div class="blogslide-title-wrap">';
					$output .= '<h4 class="blogslide-title">' .$title. '</h4>';
				$output .= '</div>';
				}

        		$output .= '<div class="blogmaggallery-wrapper clearfix flexslider">';
        			$output .= '<ul class="slides">';
        	
        			while ($blog_loop->have_posts()) {
        				$blog_loop->the_post();

        				$output .= '<li>';
        					$output .= '<div class="content-wrap">';
        					if (has_post_thumbnail()) {
        						$thumb   = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url($thumb,'full');
								$image   = aq_resize( $img_url, 1140, 550, true, true, true );

								$output .= '<img src="' . $image . '" alt="' . $title . '" class="img-responsive" />';
        					}

        						$output .= '<div class="blogmagslide-img-hover">';
        							$output .= '<div class="blogmagslide-desc-wrap">';

        								$output .= '<h4 class="entry-title-blogmagslide">';
        									$output .= '<a href="' .get_the_permalink(). '" rel="bookmark">';
        									if (strlen($post->post_title) > 70) {
												$output .= substr(get_the_title($before = '', $after = '', FALSE), 0, 70) . '...';
											} else {
												$output .= get_the_title();
											}
        									$output .= '</a>';
        								$output .= '</h4>';

        								$output .= '<div class="blogmagslide-linesep"></div>';

        								$output .= '<ul class="blogmagslide-meta-entry">';
        									$output .= '<li><div class="author"><span class="ion-person icon"></span> ' .get_the_author_posts_link(). '</div></li>';
        									$output .= '<li><div class="date"><span class="ion-calendar icon"></span> <a href=" '.esc_url( get_the_permalink() ).' ">' .esc_attr( get_the_date() ). '</a></div></li>';
        									$output .= '<li><div class="comments"><span class="fa fa-comments-o icon"></span> <a href="'. get_comments_link() .'" class="post-comments">'. get_comments_number() .' ' .__('Comments', 'adeecore'). '</a></div></li>';
        								$output .= '</ul>';
        							$output .= '</div>';
        						$output .= '</div>';
        					$output .= '</div>';
        				$output .= '</li>';

        				$return .= '<li>';
        					$return .= '<div class="thumb-wrap">';
        					if (has_post_thumbnail()) {
        						$thumb   = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url($thumb,'full');
								$image   = aq_resize( $img_url, 180, 100, true, true, true );

								$return .= '<img src="' . $image . '" alt="' . $title . '" class="img-responsive" />';
        					}
        					$return .= '</div>';
        				$return .= '</li>';
        			}

        			$output .= '</ul>';
        		$output .= '</div>';

        		$output .= '<div class="blogmagthumb-wrapper clearfix flexslider">';
        			$output .= '<ul class="slides">';
        				$output .= $return;
        			$output .= '</ul>';
        		$output .= '</div>';

        	$output .= '</div>';
        }

        wp_reset_query();

        return $output;
    }

    add_shortcode('blogmagslide', 'blogmagslide_sc');
}



/* ---------------------------------------------------------------------------
* Blog Mag Block SC
* --------------------------------------------------------------------------- */
if (! function_exists('blogmag_sc')) {
    function blogmag_sc( $attr, $content = null ) {
        extract(shortcode_atts(array(
        	'title'				=> '',
            'category'			=> '',
            'not_category'		=> '',
            'count'				=> 6,
            'orderby'			=> 'date',
            'order'				=> 'DESC',
            'class'				=> ''
        	), $attr)
        );

        ob_start();

        $args = array(
            'post_type'     		=> 'post',
            'posts_per_page'		=> intval($count),
            'paged'         		=> -1,
            'orderby'       		=> $orderby,
            'order'         		=> $order,
            'ignore_sticky_posts'	=> 1
        );

        if($category) $args['category_name'] = $category;
        if($not_category) $args['category__not_in'] = $not_category;

        global $post;

        $classes = array();
        $classes[] = 'grid-item';

        $return = '';

        $blog_loop = new WP_Query($args);

        if ($blog_loop->have_posts()) { ?>

        	<div class="blogmag_wrap dc-sc-blogmag <?php echo $class; ?>">
        		
        		<?php if ($title) {
				
				echo '<div class="blogmag-title-wrap">';
					echo '<h4 class="blogmag-title">' .$title. '</h4>';
				echo '</div>';
				} ?>

        		<div class="grid_layout">
					        	
        			<?php while ($blog_loop->have_posts()) {
        				$blog_loop->the_post();

        				if ($blog_loop->current_post == 0) { ?>
        					<div class="blogmag-block col-xs-12 col-sm-6">
        						<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>

                					<?php if ( has_post_thumbnail() ){
										$col = 'has-thumb';
									} else {
										$col = 'no-thumb';
									} ?>

									<div class="content-wrapper">
	    								<?php if ( has_post_thumbnail()) { ?>
	    	    							<div class="featured-wrapper <?php echo $col;?>">
	        									<a href="<?php the_permalink(); ?>" rel="bookmark">
	            									<?php the_post_thumbnail('blog-grid_layout', array('class' => 'img-responsive')); ?>
	            									<div class="blogmag-featured-cover"><span class="ion-forward"></span></div>
	        									</a>
	       									</div>
	    								<?php } ?>
										<div class="content-details <?php echo $col;?>">
	    									<?php get_template_part( 'templates/post-format/entry-content' ); ?>
										</div>
									</div>
								</article>
							</div>
        				<?php }
        			} ?>
        		</div>

        		<div class="blogmag-thumb col-xs-12 col-sm-6">
        			<?php while ($blog_loop->have_posts()) {
        				$blog_loop->the_post();

        				if ($blog_loop->current_post != 0) { ?>
        					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        						<div class="blogmagimg-wrap">
        							<?php if ( has_post_thumbnail()) {
        						 		$thumb   = get_post_thumbnail_id();
										$img_url = wp_get_attachment_url($thumb,'full');
										$image   = aq_resize( $img_url, 100, 80, true, true, true );

										echo '<a href="' .get_the_permalink(). '" rel="bookmark">';
											echo '<img src="' . $image . '" alt="' . $title . '" class="img-responsive" />';
											echo '<div class="blogmagimg-thumb-cover"><span class="ion-forward"></span></div>';
										echo '</a>';
        							} ?>
        						</div>

        						<div class="blogmagthumb-content">
        							<h4 class="entry-title-blogmagthumb">
        								<a href="<?php get_the_permalink(); ?>" rel="bookmark">
        									<?php if (strlen($post->post_title) > 70) {
												echo substr(the_title($before = '', $after = '', FALSE), 0, 70) . '...';
											} else {
												echo the_title();
											} ?>
        								</a>
        							</h4>

        							<ul class="blogmagthumb-meta">
        								<li><div class="author"><span class="ion-calendar"></span> <time class="entry-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('M j, Y'); ?></time></div></li>
        								<?php if( comments_open() )echo '<li><i class="fa fa-comments-o"></i> <a href="' . get_comments_link(). '" class="post-comments"> ' .get_comments_number(). '</a></li>'; ?>
        								<li><div class="love-post"><?php adeetheming_love(); ?></div></li>
        							</ul>
        						</div>
        					</article>
        				<?php }
        			} ?>
        		</div>

        	</div>
        <?php }

        wp_reset_query();

        $blogmag = ob_get_contents();
        ob_end_clean();
        return $blogmag;
    }

    add_shortcode('blogmag', 'blogmag_sc');
}



/* ---------------------------------------------------------------------------
* Blog Slide SC
* --------------------------------------------------------------------------- */
if (! function_exists('blogslide_sc')) {
    function blogslide_sc( $attr, $content = null ) {
        extract(shortcode_atts(array(
            'title'				=> '',
            'category'			=> '',
            'not_category'		=> '',
            'count'				=> 6,
            'type'				=> 'classic',
			'display'			=> '',
			'time'				=> 5000,
			'hoverpause'		=> true,
			'navigation'		=> '',
            'orderby'			=> 'date',
            'order'				=> 'DESC',
            'class'				=> ''
        ), $attr) );

        ob_start();

        $args = array(
            'post_type'     		=> 'post',
            'posts_per_page'		=> intval($count),
            'paged'         		=> -1,
            'orderby'       		=> $orderby,
            'order'         		=> $order,
            'ignore_sticky_posts'	=> 1,
        );

        if($category) $args['category_name'] = $category;
        if($not_category) $args['category__not_in'] = $not_category;

        global $adeetheming_options;

        $prefix = 'adee_';

        $classes = array();
        //$classes[] = 'grid_layout';
        $classes[] = 'grid-item';
        
        $rel = array();
		if($time) $rel[] = 'data-time="' . $time . '"';
		if($hoverpause) $rel[] = 'data-pause="' . $hoverpause . '"';

		$rel = implode(' ', $rel);
        
        query_posts($args);

        if (have_posts()) { 

        	echo '<div class="blogslide_wrap dc-sc-blogslide ' .$class. '">';

        	echo '<div class="blogslide-wrapper clearfix">';

        	if ($title) {
				
				echo '<div class="blogslide-title-wrap">';
					echo '<h4 class="blogslide-title">' .$title. '</h4>';
				echo '</div>';
			}

			if (! empty($navigation)) {
				echo '<div class="prev-blogslide"><a href="javascript:void(0)"><i class="ion-ios-arrow-left"></i></a></div>';
				echo '<div class="next-blogslide"><a href="javascript:void(0)"><i class="ion-ios-arrow-right"></i></a></div>';
			} ?>

            <div class="grid_layout">

            <ul class="blogslide_element" <?php echo $rel; ?>>

            <?php
            while (have_posts()) {
                the_post();

                $thumb   = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url($thumb,'full');
				$image   = aq_resize( $img_url, 760, 480, true, true, true );
				?>

				<li class="blogslide-list">
                <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
                	<?php if (!is_single()) { ?>
                		
                		<?php if(get_post_format() == 'aside') { ?>
                			<?php if ( has_post_thumbnail() ){
								$col = 'has-thumb';
							} else {
								$col = 'no-thumb';
							} ?>

							<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-file-text"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>
			
							<div class="content-wrapper">
	    						<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
	        						<div class="featured-wrapper <?php echo $col;?>"><a href="<?php the_permalink(); ?>" rel="bookmark">
	        								<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        		    				<div class="featured-cover"></div>
	        						</a></div>
	    						<?php } ?>
								<div class="content-details <?php echo $col;?>">
		    						<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
								</div>
							</div>
                		<?php	} elseif (get_post_format() == 'audio') { ?>
                			<?php 
								if ( rwmb_meta( $prefix . 'audio_code' ) !== '' ){
									$col = 'has-thumb';
								}else {
									$col = 'no-thumb';
								} ?>

							<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-music"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
	    						<?php  if ( rwmb_meta( $prefix . 'audio_code' ) && ! post_password_required() ) { ?>
	    							<div class="featured-wrapper <?php echo $col; ?>">
	       								<div class="entry-audio embed-responsive embed-responsive-16by9"><a href="<?php the_permalink(); ?>" rel="bookmark">
	       									<?php if ($bloglayout == 'masonry_layout') {
	        									the_post_thumbnail('full', array('class' => 'img-responsive'));
	        								} else { ?>
	        									<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        								<?php } ?>
	        								<div class="featured-cover"></div>
	        								</a>
	        								<div class="audio-post-container">
	        									<div class="audio-embed-wrap">
	           										<?php echo do_shortcode( '[audio src="' .rwmb_meta(  $prefix . 'audio_code' ). '"]' ); ?>
	           									</div>
	           								</div>
	       								</div> <!--/.audio-content -->
	    							</div>   
	    						<?php } ?>    
	     						<div class="content-details <?php echo $col; ?>">
	    							<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
	    						</div>
    						</div>
                		<?php	} elseif (get_post_format() == 'gallery') { ?>
                			<?php 
    							if ( rwmb_meta( $prefix . 'gallery_images','type=image_advanced') !== '' ){
        							$col = 'has-thumb';
    							}else {
        							$col = 'no-thumb';
    							} ?>

    						<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-camera"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
                				<?php  if ( rwmb_meta( $prefix . 'gallery_images','type=image_advanced') && ! post_password_required() ) { ?>
                    				<div class="featured-wrapper <?php echo $col; ?>">
                        				<div class="entry-content-gallery">
                            				<?php $slides = rwmb_meta( $prefix . 'gallery_images','type=image_advanced'); ?>
                            				<?php if(count($slides) > 0) { ?>
                                				<div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                                				<!-- Wrapper for slides -->
                                    				<div class="carousel-inner">
                                    				<?php $slide_no = 1; ?>
                                    				<?php foreach( $slides as $slide ) { ?>
                                        				<div class="item <?php if($slide_no == 1) echo 'active'; ?>">
                                            				<?php $images = wp_get_attachment_image_src( esc_attr($slide['ID']), 'blog-medium' ); ?>
                                            				<img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="">
                                        				</div>
                                        				<?php $slide_no++; ?>
                                    				<?php } ?>
                                    				</div>
                                    				<!-- Controls -->
                                    				<a class="left carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev">
                                        				<i class="fa fa-angle-left"></i>
                                    				</a>
                                    				<a class="right carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next">
                                        				<i class="fa fa-angle-right"></i>
                                    				</a>
                                				</div>
                            				<?php } ?>
                        				</div><!--/.entry-content-gallery-->
                    				</div> 
                				<?php } ?>
            					<div class="content-details <?php echo $col; ?>">
                					<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
            					</div>
        					</div>
                		<?php	} elseif (get_post_format() == 'image') { ?>
                			<?php if ( has_post_thumbnail() ){
								$col = 'has-thumb';
							} else {
								$col = 'no-thumb';
							} ?>

							<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-picture-o"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
	    						<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
	        						<div class="featured-wrapper <?php echo $col;?>"><a href="<?php the_permalink(); ?>" rel="bookmark">
	        	    					
	        								<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>

	        	    					<div class="featured-cover"></div>
	        						</a></div>
	    						<?php } ?>
								<div class="content-details <?php echo $col;?>">
		    						<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
								</div>
							</div>
                		<?php	} elseif (get_post_format() == 'link') { ?>
                			<?php if ( rwmb_meta( $prefix . 'link' ) !== '' ){
								$col = 'has-thumb';
							} else {
								$col = 'no-thumb';
							} ?>

							<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-link"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
		    					<?php  if ( rwmb_meta( $prefix . 'link' ) && ! post_password_required() ) { ?>
		    						<div class="featured-wrapper <?php echo $col; ?>">
		       							<div class="entry-link"><a href="<?php the_permalink(); ?>" rel="bookmark">
	       									<?php if ($bloglayout == 'masonry_layout') {
	        									the_post_thumbnail('full', array('class' => 'img-responsive'));
	        								} else { ?>
	        									<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        								<?php } ?>
	        								<div class="featured-cover"></div>
	        								</a>
	        								<div class="link-post-container">
	        									<div class="link-embed-wrap">
	        										<a href="<?php echo esc_url( rwmb_meta( $prefix . 'link' ) ); ?>" target="_blank">
	        											<?php echo esc_attr( rwmb_meta( $prefix . 'link_title' ) ); ?>
	        										</a>
	        									</div>
	        								</div>
		       							</div>     
		    						</div>
		    					<?php } ?>
								<div class="content-details <?php echo $col; ?>">
		    						<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
	    						</div>
    						</div>
                		<?php	} elseif (get_post_format() == 'quote') { ?>
                			<?php if ( rwmb_meta( $prefix . 'quote' ) !== '' ){
        						$col = 'has-thumb';
    						}else {
        						$col = 'no-thumb';
    						} ?>

    						<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-quote-left"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
                				<?php  if ( rwmb_meta( $prefix . 'quote' ) && ! post_password_required() ) { ?>
                    				<div class="featured-wrapper <?php echo $col; ?>">
                        				<div class="entry-quote"><a href="<?php the_permalink(); ?>" rel="bookmark">
	       									<?php if ($bloglayout == 'masonry_layout') {
	        									the_post_thumbnail('full', array('class' => 'img-responsive'));
	        								} else { ?>
	        									<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	        								<?php } ?>
	        								<div class="featured-cover"></div>
	        								</a>
	        								<div class="quote-post-container">
	        									<div class="quote-embed-wrap">
	        										<blockquote>
                                						<p><?php echo esc_html(rwmb_meta( $prefix . 'quote' )); ?></p>
                                						<small><?php echo esc_html(rwmb_meta( $prefix . 'quote_author' )); ?></small>
                            						</blockquote>
	        									</div>
	        								</div>
                        				</div>        
                    				</div>
                				<?php } ?>
            					<div class="content-details <?php echo $col; ?>">
                					<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
            					</div>
        					</div>
                		<?php	} elseif (get_post_format() == 'video') { ?>
                			<?php if ( rwmb_meta( $prefix . 'video' ) !== '' ){
        						$col = 'has-thumb';
    						} else {
        						$col = 'no-thumb';
    						} ?>

    						<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-video-camera"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
                				<?php  if ( rwmb_meta( $prefix . 'video' ) && ! post_password_required() ) { ?>
                    				<div class="featured-wrapper <?php echo $col; ?>">
                        				<div class="entry-video embed-responsive embed-responsive-16by9">
                            				<?php $video_source = esc_attr(rwmb_meta( $prefix . 'video_source' )); ?>
                            				<?php $video = rwmb_meta( $prefix . 'video' ); ?>
                            				<?php if($video_source == 1): ?>
                                				<?php echo rwmb_meta( $prefix . 'video' ); ?>
                            				<?php elseif ($video_source == 2): ?>
                                				<?php echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; ?>
                            				<?php elseif ($video_source == 3): ?>
                                				<?php echo '<iframe src="http://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="350" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; ?>
                            				<?php endif; ?>
                        				</div>
                    				</div>
                				<?php } ?>
            					<div class="content-details <?php echo $col; ?>"> 
                					<?php get_template_part( 'templates/post-format/entry-content' ); ?> 
            					</div>
        					</div>
                		<?php	} else { ?>
                			<?php if ( has_post_thumbnail() ){
								$col = 'has-thumb';
							} else {
								$col = 'no-thumb';
							} ?>

							<div class="post-intro-wrap hidden-xs">
								<span class="post-icon"><i class="fa fa-thumb-tack"></i></span>
								<?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
									<div class="entry-calender">
            							<span class="publish-date"><i class="fa fa-calendar-o"></i></span>
            							<span><time class="entry-month" datetime="<?php the_time( 'm' ); ?>"><?php the_time('M'); ?></time></span>
            							<span><time class="entry-day" datetime="<?php the_time( 'j' ); ?>"><?php the_time('j'); ?></time></span>
            							<span><time class="entry-year" datetime="<?php the_time( 'y' ); ?>"><?php the_time('Y'); ?></time></span>
            						</div>  
        						<?php }?>   
							</div>

							<div class="content-wrapper">
	    						<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
	    	    					<div class="featured-wrapper <?php echo $col;?>">
	        							<a href="<?php the_permalink(); ?>" rel="bookmark">
	        									<img src="<?php echo esc_url( $image ); ?>" class="img-responsive wp-post-image" alt=""/>
	            							<div class="featured-cover"></div>
	        							</a>
	        						</div>
	    						<?php } ?>
								<div class="content-details <?php echo $col;?>">
		    						<?php get_template_part( 'templates/post-format/entry-content' ); ?>
								</div>
							</div>
                		<?php	} ?>

                	<?php } ?>
                </article>
                </li>
            <?php } ?>

            </ul>
            </div>
        <?php echo '</div>';

        echo '</div>'; }

        wp_reset_query();

        $blog = ob_get_contents();
        ob_end_clean();
        return $blog;
    }

    add_shortcode('blogslide', 'blogslide_sc');
}



/*---------------------------------------------------------------------------
*	Button SC
* ---------------------------------------------------------------------------*/
if(! function_exists('button_sc')) {
	function button_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'				=> '',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
			'position'			=> 'left',
			'link'				=> '',
			'target'			=> '',
			'alignment'			=> 'left',
			'size'				=> 'small',
			'type'				=> 'flat',
			'style'				=> 'square',
			'color'				=> '',
			'background'		=> '',
			'hovercolor'		=> '',
			'hoverbg'			=> '',
			'class'				=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-button');

		$classes = array();

		$classes[] = $class;
		$classes[] = $customcss;
		$classes[] = 'size_' .$size;
		$classes[] = 'type_' .$type;
		$classes[] = 'style_' .$style;

		$classes = implode(' ', $classes);

		$target = ($target == 'blank') ? 'target="_blank"' : '';

		vc_icon_element_fonts_enqueue( $icon );
		$iconClass = isset( ${'icon_' .$icon} ) ? '<span class="dc-button-icon"><i class="' .esc_attr( ${'icon_' .$icon} ). '"></i></span>' : '';

		$flipwrap = ($type === 'three_dflip') ? 'wrap_' .$type. ' sixe_' .$size : '';
		$flipdata = ($type === 'three_dflip') ? 'title="' .$title. '"' : '';

		$output = '<div class="button_wrap dc-sc-button align_' .$alignment. '">';
			$output .= '<a href="' .esc_url($link). '" ' .$target. ' class="btn btn-link ' .$classes. '" '.$flipdata. '>';
				if($position == 'left') $output .= $iconClass;
				$output .= '<span class="btn-title">' .$title. '</span>';
				if($position == 'right') $output .= $iconClass;
			$output .= '</a>'; 
		$output .= '</div>';

		//Shortcode Custom CSS
		$shortcodecss = $btn3d = $btn3dhover = '';
		$btn3d = dc_tintcolor($background);
		$btn3dhover = dc_tintcolor($hoverbg);

		if($color) $shortcodecss = 'a.btn.' .$customcss. ', a:focus.btn.' .$customcss. ' { color: ' .$color. ';}';
		if($background) $shortcodecss .= 'a.btn.' .$customcss. ', a:focus.btn.' .$customcss. ' { background: ' .$background. ';}.dc-sc-button a.btn.type_outline.' .$customcss. ' { color: ' .$background. '; border-color: ' .$background. '; }.dc-sc-button a.btn.type_three_d.' .$customcss. ' { -webkit-box-shadow: 0 8px 0 ' .$btn3d. ', 0 15px 20px rgba(0,0,0,.35); -moz-box-shadow: 0 8px 0 ' .$btn3d. ', 0 15px 20px rgba(0,0,0,.35); box-shadow: 0 8px 0 ' .$btn3d. ', 0 15px 20px rgba(0,0,0,.35); }.dc-sc-button a.btn.type_modern.' .$customcss. ':hover { background: '  .$background. '; }';
		if($hovercolor) $shortcodecss .= 'a.btn.' .$customcss. ':hover, a:active.btn.' .$customcss. ' { color: ' .$hovercolor. '; }';
		if($hoverbg) $shortcodecss .= 'a.btn.' .$customcss. ':hover, a:active.btn.' .$customcss. ' { background: ' .$hoverbg. '; }.dc-sc-button a.btn.type_outline.' .$customcss. ':before { background: ' .$hoverbg. '; }.dc-sc-button a.btn.type_outline.' .$customcss. ':hover { border-color: ' .$hoverbg. '; }.dc-sc-button a.btn.type_classic.' .$customcss. ':before, .dc-sc-button a.btn.type_classic.' .$customcss. ':after { background: ' .$hoverbg. '; }.dc-sc-button a.btn.type_classic.' .$customcss. ':hover { color: ' .$hoverbg. '; }.dc-sc-button a.btn.type_three_d.' .$customcss. ':hover { -webkit-box-shadow: 0 8px 0 ' .$btn3dhover. ', 0 15px 20px rgba(0,0,0,.35); -moz-box-shadow: 0 8px 0 ' .$btn3dhover. ', 0 15px 20px rgba(0,0,0,.35); box-shadow: 0 8px 0 ' .$btn3dhover. ', 0 15px 20px rgba(0,0,0,.35); }.dc-sc-button a.btn.type_three_d.' .$customcss. ':active { -webkit-box-shadow: 0 2px 0 ' .$btn3dhover. ', 0 8px 10px rgba(0,0,0,.35); -moz-box-shadow: 0 2px 0 ' .$btn3dhover. ', 0 8px 10px rgba(0,0,0,.35); box-shadow: 0 2px 0 ' .$btn3dhover. ', 0 8px 10px rgba(0,0,0,.35); }.dc-sc-button a.btn.type_modern.' .$customcss. ':before, .dc-sc-button a.btn.type_modern.' .$customcss. ':after { background: '  .$btn3dhover. '; }';

		adeetheming_shortcodecss($shortcodecss);

		return $output;
	}

	add_shortcode('button', 'button_sc');
}



/* ---------------------------------------------------------------------------
* Chart SC
* --------------------------------------------------------------------------- */
if (! function_exists('chart_sc')) {
	function chart_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'percent'		=> '',
			'label'			=> '',
			'prefix'		=> '',
			'suffix'		=> '%',
			'line_width'	=> 5,
			'size'			=> '',
			'color'			=> '',
			'track_color'	=> '',
			'title_color'	=> '',
			'label_color'	=> '',
			'class'			=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-chart');

		$classes[] = $class;
		$classes[] = $customcss;

		$classes = implode(' ', $classes);

		if($line_width) $line_width = 'data-line-width="'. intval( $line_width ) .'"';

		$percent = (intval($percent) !== '') ? 'data-percent="'. intval( $percent ) .'"' : 'data-percent="50"';

		if($prefix) $prefix = '<span class="prefix">' .$prefix. '</span>';

		if($suffix) $suffix = '<span class="suffix">' .$suffix. '</span>';

		$color = ($color !== '') ? $color : '#2595FC';

		$track_color = ($track_color !== '') ? $track_color : '#dddddd';

		$output = '<div class="chart_wrap dc-sc-chart' .$classes. '">';
			$output .= '<div class="dc-chart-track chart" data-bar-color="' .$color. '" data-track-color="' .$track_color. '" ' .$line_width. ' ' .$percent. '>';
				if ($label) {
					$output .= '<div class="chart_label">' .$prefix.$label.$suffix. '</div>';
				}
			$output .= '</div>';

			//title
			$output .= '<h4 class="dc-chart-title">' .$title. '</h4>';
		$output .= '</div>';

		//Shortcode Custom CSS
		$shortcodecss = '';

		if($title_color) $shortcodecss = '.dc-sc-chart.' .$customcss. ' h4.dc-chart-title { color: ' .$title_color. '; }';
		if($size) $shortcodecss .= '.dc-sc-chart.' .$customcss. ' h4.dc-chart-title { font-size: ' .$size. 'px; }';
		if($label_color) $shortcodecss .= '.dc-sc-chart.' .$customcss. ' .chart_label { color: ' .$label_color. '; }';

		adeetheming_shortcodecss($shortcodecss);

		return $output;
	}

	add_shortcode('chart', 'chart_sc');
}



/* ---------------------------------------------------------------------------
* Clients SC
* --------------------------------------------------------------------------- */
if (! function_exists('clients_sc')) {
	function clients_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'type'			=> 'slide',
			'time'			=> 5000,
			'hoverpause'	=> true,
			'column'		=> 4,
			'border'		=> '',
			'category'		=> '',
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'class'			=> '',
		),$attr));

		$prefix = 'adee_';

		$args = array(
			'post_type'			=> 'clients',
			'posts_per_page'	=> -1,
			'orderby'			=> $orderby,
			'order'				=> $order,
		);

		if($category) $args['clients-category'] = $category;

		global $post;

		if (! is_numeric($column)) $column = 4;

		$style = array();
		if ($type == 'slide') $style[] = 'slide-element';
		if ($type == 'grid') $style[] = 'grid-element';
		$style[] = ($border !== '') ? 'clientborder' : '';
		$style[] = $class;

		$style = implode(' ', $style);

		$rel = array();
		if($type == 'slide') $rel[] = 'data-time="' . $time . '"';
		if($type == 'slide') $rel[] = 'data-pause="' . $hoverpause . '"';

		$rel = implode(' ', $rel);

		$clients_loop = new WP_Query($args);

		
			if ($clients_loop->have_posts()) {
				$output = '<div class="clients-container clients-'. $type . '">';

					$output .= '<div class="clients-header">';
						if($title) $output .= '<h4 class="clients-title">' . $title . '</h4>';
						if ($type == 'slide') {
							$output .= '<div class="clients-navigation">';
								$output .= '<div class="prev-client"><a href="javascript:void(0)"><i class="ion-ios-arrow-left"></i></a></div>';
								$output .= '<div class="next-client"><a href="javascript:void(0)"><i class="ion-ios-arrow-right"></i></a></div>';
							$output .= '</div>';
						}
					$output .= '</div>';

					$output .= '<ul class="dc-sc-clients clearfix ' . $style . '" ' . $rel .'>';

						$i = 1;
						$width = '';
						if($type == 'grid') $width = 'style="width: ' . round((100 / intval($column) ), 5) . '%;" ';

						while ($clients_loop->have_posts()) {
							$clients_loop->the_post();

							$link = get_post_meta(get_the_ID(), $prefix .'clients_url', true);
							$target = get_post_meta(get_the_ID(), $prefix . 'clients_target', true);
							if($target) $target = 'target="_blank"';
							if (has_post_thumbnail($post->ID)) $image = get_the_post_thumbnail( null, 'clients-logo', array('class' => 'img-responsive'));
							$output .= '<li ' . $width . ' class="client-item grid-col-' . round((100 / intval($column) ), 0) . '">';
								$output .= '<div class="client_wrapper">';
									if($link) $output .= '<a href="' . $link . '" title="' . the_title(false, false, false) . '" ' . $target . '>';
										$output .= $image;
										$output .= '<div class="dc-client-over"></div>';
									if($link) $output .= '</a>';
								$output .= '</div>';
							$output .= '</li>';

							$i++;
						}

					$output .= '</ul>';
				$output .= '</div>';
			}
			wp_reset_query();
			

		return $output;

	}

	add_shortcode('clients','clients_sc');
}



/* ---------------------------------------------------------------------------
* Content Box SC
* --------------------------------------------------------------------------- */
if (! function_exists('contentbox_sc')) {
	function contentbox_sc($attr, $content = null) {
		
		extract(shortcode_atts(array(
			'type'				=> 'horizontal',
			'horizontal'		=> 'style1',
			'image'				=> '',
			'title'				=> '',
			'wrap'				=> 'div',
			'button_text'		=> '',
			'link'				=> '',
			'alignment' 		=> 'left',
			'contentpad'		=> '',
			'color'		 		=> '',
			'background'	 	=> '',
			'bg_image'			=> '',
			'btn_color'			=> '',
			'btn_hover'			=> '',
			'btn_background'	=> '',
			'btn_bg_hover'		=> '',
			'boxshadow'			=> '',
			'border'			=> 'disable',
			'border_width'		=> '',
			'border_style'		=> '',
			'border_color'		=> '',
			'border_radius'		=> '',
			'class'				=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-contentbox');

		$atts = vc_build_link( $link );

		$attributes = '';
		if($wrap == 'a') $attributes = 'href="' .$atts['url']. '"';

		$classes = array();
		if($alignment) $classes[] = 'align_' .$alignment;
		if($type) $classes[] = 'type_' .$type;
		if($horizontal) $classes[] = 'horizontal_' .$horizontal;
		if($boxshadow) $classes[] = 'boxshadow_enable';
		$classes[] = $customcss;
		if($class) $classes[] = $class;

		$classes = implode(' ', $classes);

		$image = wp_get_attachment_image_src( $image,'full');

		$output = '<' .$wrap. ' ' .$attributes. ' class="dc-sc-contentbox contentbox_wrap ' .$classes. '">';
			$output .= '<div class="dc-contentbox-imgwrap">';
				$output .= '<img src="' .$image[0]. '" alt="" class="img-responsive contentbox-img" />';
				if($title && $horizontal == 'style1') $output .= '<h4 class="contentbox-title">' .$title. '</h4>';
			$output .= '</div>';

			$output .= '<div class="dc-contentbox-contentwrap">';
				$output .= '<div class="dc-contentbox-desc">';
					if($title && $horizontal != 'style1') $output .= '<h4 class="contentbox-title">' .$title. '</h4>';
					if($content) $output .= do_shortcode($content);
				$output .= '</div>';

				if ($wrap == 'div' && $button_text) {
					$output .= '<div class="dc-contentbox-btn">';
						$output .= '<a href="' .$atts['url']. '" class="btn contentbox-btn adeecore-button">' .$button_text. '</a>';
					$output .= '</div>';
				}
			$output .= '</div>';
		$output .= '</' .$wrap. '>';

		//Shortcode Custom CSS
		$shortcodecss = '';
		$bgimage = wp_get_attachment_image_src( $bg_image, 'full' );

		if($contentpad) $shortcodecss = '.dc-sc-contentbox.' .$customcss. ' .dc-contentbox-contentwrap {padding: ' .$contentpad. ';}';
		if($color) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' .dc-contentbox-desc, .dc-sc-contentbox.' .$customcss. ' .dc-contentbox-desc h4 {color: ' .$color. ';}';
		if($background) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' {background: ' .$background. ';}';
		if($bgimage) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' {background-image: url(' .$bgimage[0]. ');}';
		if($btn_color) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' a.contentbox-btn {color: ' .$btn_color. ';}';
		if($btn_hover) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' a:hover.contentbox-btn {color: ' .$btn_color. ';}';
		if($btn_background) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' a.contentbox-btn {background: ' .$btn_background. ';}';
		if($btn_bg_hover) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' a:hover.contentbox-btn {background: ' .$btn_bg_hover. ';}';
		if ($border == 'enable') {
			if($border_width) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' {border-width: ' .$border_width. ';}';
			if($border_style) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' {border-style: ' .$border_style. ';}';
			if($border_color) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' {border-color: ' .$border_color. ';}';
			if($border_radius) $shortcodecss .= '.dc-sc-contentbox.' .$customcss. ' {border-radius: ' .$border_radius. ';}';
		}

		adeetheming_shortcodecss($shortcodecss);

		return $output;
	}

	add_shortcode('contentbox', 'contentbox_sc');
}



/* ---------------------------------------------------------------------------
* Counter SC
* --------------------------------------------------------------------------- */
if (! function_exists('counter_sc')) {
	function counter_sc($attr, $content = null) {

		extract(shortcode_atts(array(
			'type'				=> 'simple',
			'icontype' 			=> '',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
            'icon_format'		=> 'simple',
			'icon_color'		=> '',
			'icon_bg'			=> '',
			'image'	 			=> '',
			'size'				=> 'small',
			'animatedicon'		=> '',
			'counter_to' 		=> '',
			'count_color'		=> '',
			'count_start'		=> 0,
			'count_speed'		=> 2000,
			'count_prefix'		=> '',
			'count_suffix'		=> '',
			'count_size'		=> 30,
			'title'				=> '',
			'txt_color'		 	=> '',
			'alignment' 		=> 'center',
			'background'		=> '',
			'bg_image'			=> '',
			'boxshadow'			=> '',
			'border'			=> 'disable',
			'border_width'		=> '',
			'border_style'		=> '',
			'border_color'		=> '',
			'border_radius'		=> '',
			'class'		 		=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-counter');

		$classes = array();
		if($type) $classes[] = 'type_' .$type;
		if($alignment) $classes[] = 'counter_' .$alignment;
		if($size) $classes[] = 'icon_' .$size;
		if($boxshadow) $classes[] = 'boxshadow_enable';
		if($icon_format != 'simple') $classes[] = 'showicon_bg';
		if($animatedicon) $classes[] = 'animatedicon';
		if($customcss) $classes[] = $customcss;
		if($class) $classes[] = $class;

		$classes = implode(' ', $classes);

		//Content Style
		$cstyle = $txtcolor = '';
		if ($type !== 'simple') {

			if ( $count_color ) $cstyle .= 'color : ' .$count_color. ';';

			$cstyle .= ' font-size : ' .$count_size. 'px;';
			$cstyle .= ' line-height : ' .$count_size. 'px;';

			if ( $txt_color ) $txtcolor = 'color : ' .$txt_color. ';';
		}

		$output = '<div class="dc-sc-counter counter counter-' .$type. ' ' .$classes. '">';
			if ($icontype !== '') {
				$output .= '<div class="icon_wrapper">';
					switch ( $icontype ) {
						case 'image':
							$src_image = wp_get_attachment_image_src( $image, 'thumbnail' );
							if ( $image ) {
								$output .= '<img src="' . esc_url( $src_image[0] ) . '" alt="" />'; 
							}
							break;
						
						default:
							vc_icon_element_fonts_enqueue( $icon );
							$iconClass = isset( ${'icon_' .$icon} ) ? '<i class="' .esc_attr( ${'icon_' .$icon} ). '"></i>' : '';
							$output .= '<span class="counter-icon-wrap style_' .$icon_format. '">';
								if($icon_format === 'diagonal') $output .= '<div class="icon_wrap_out"><div class="icon_wrap_in">';
									$output .= $iconClass;
								if($icon_format === 'diagonal') $output .= '</div></div>';
							$output .= '</span>';
							break;
					}
				$output .= '</div>';
			}
			$output .= '<div class="desc_wrapper">';
				if($count_prefix) $output .= '<span class="count-prefix">' .$count_prefix. '</span>';
				$output .= '<span class="timer count-title count-number" data-refresh-interval="50" data-from="' .intval($count_start). '" data-to="' .intval($counter_to). '" data-speed="' . intval( $count_speed ) . '"></span>';
				if($count_suffix) $output .= '<span class="count-suffix">' .$count_suffix. '</span>';

				$output .= '<div class="count-text ">';
					if($title) $output .= '<h4 class="counter-title">' .$title. '</h4>';
					if($content) $output .= do_shortcode($content);
				$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="clear"></div>';
		$output .= '</div>';

		//Shortcode Custom CSS
		$shortcodecss = '';
		if($background) $shortcodecss = '.dc-sc-counter.' .$customcss. ' {background: ' .$background. ';}';
		if($bg_image) $shortcodecss .= '.dc-sc-counter.' .$customcss. ' {background-image: url(' .$bgimage[0]. ');}';
		if ($border == 'enable') {
			if($border_width) $shortcodecss .= '.dc-sc-counter.' .$customcss. ' {border-width: ' .$border_width. ';}';
			if($border_style) $shortcodecss .= '.dc-sc-counter.' .$customcss. ' {border-style: ' .$border_style. ';}';
			if($border_color) $shortcodecss .= '.dc-sc-counter.' .$customcss. ' {border-color: ' .$border_color. ';}';
			if($border_radius) $shortcodecss .= '.dc-sc-counter.' .$customcss. ' {border-radius: ' .$border_radius. ';}';
		}
		if ($type !== 'simple') {
			if($icon_color) $shortcodecss .= '.dc-sc-counter.' .$customcss. ' .counter-icon-wrap.style_square, .dc-sc-counter.' .$customcss. ' .counter-icon-wrap.style_circle, .dc-sc-counter.' .$customcss. ' .counter-icon-wrap.style_rounded, .dc-sc-counter.icon_small.' .$customcss. ' .counter-icon-wrap.style_diagonal, .dc-sc-counter.icon_medium.' .$customcss. ' .counter-icon-wrap.style_diagonal, .dc-sc-counter.icon_large.' .$customcss. ' .counter-icon-wrap.style_diagonal {color: ' .$icon_color. ';}';

			if($icon_bg) $shortcodecss .= '.dc-sc-counter.' .$customcss. ' .counter-icon-wrap.style_square, .dc-sc-counter.' .$customcss. ' .counter-icon-wrap.style_circle, .dc-sc-counter.' .$customcss. ' .counter-icon-wrap.style_rounded, .dc-sc-counter.icon_small.' .$customcss. ' .counter-icon-wrap.style_diagonal,  .dc-sc-counter.icon_small.' .$customcss. ' .counter-icon-wrap.style_diagonal:before,  .dc-sc-counter.icon_small.' .$customcss. ' .counter-icon-wrap.style_diagonal:after, .dc-sc-counter.icon_medium.' .$customcss. ' .counter-icon-wrap.style_diagonal, .dc-sc-counter.icon_medium.' .$customcss. ' .counter-icon-wrap.style_diagonal:before, .dc-sc-counter.icon_medium.' .$customcss. ' .counter-icon-wrap.style_diagonal:after, .dc-sc-counter.icon_large.' .$customcss. ' .counter-icon-wrap.style_diagonal, .dc-sc-counter.icon_large.' .$customcss. ' .counter-icon-wrap.style_diagonal:before, .dc-sc-counter.icon_large.' .$customcss. ' .counter-icon-wrap.style_diagonal:after {background: ' .$icon_bg. ';}';

			if($count_color) $shortcodecss .= '.dc-sc-counter' .$customcss. ' .desc_wrapper > span {color: ' .$count_color. ';}';

			if($count_size) $shortcodecss .= '.dc-sc-counter' .$customcss. ' .desc_wrapper > span {font-size: ' .$count_size. 'px; line-height: ' .$count_size. 'px;}';

			if($txt_color) $shortcodecss .= '.dc-sc-counter' .$customcss. ' .desc_wrapper .count-text, .dc-sc-counter' .$customcss. ' .desc_wrapper .count-text h4.counter-title {color: ' .$count_color. ';}';
		}

		adeetheming_shortcodecss($shortcodecss);

	return $output;

	}

	add_shortcode('counter', 'counter_sc');
}



/* ---------------------------------------------------------------------------
* Countdown SC
* --------------------------------------------------------------------------- */
if (! function_exists('countdown_sc')) {
	function countdown_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'type'			=> 'simple',
			'alignment'		=> 'left',
			'date'			=> '',
			'showdate'		=> '',
			'title'			=> '',
			'size'			=> '',
			'color'			=> '',
			'weight'		=> '',
			'class'			=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-countdown');

		$classes = $style = array();
		if($type) $classes[] = 'countdown_' .$type;
		if($alignment) $classes[] = 'align_' .$alignment;
		if($showdate && $type == 'modern') $classes[] = 'showdate';
		$classes[] = $customcss;
		$classes[] = $class;

		$classes = implode(' ', $classes);

		if($size) $style[] = 'font-size: ' .$size. 'px;';
		if($color) $style[] = 'color: ' .$color. ';';
		if($weight) $style[] = 'font-weight: ' .$color. ';';

		$style = ($type !== 'simple') ? 'style="' .implode(' ', $style). '"' : '';

		$label = array(
			'days'		=> esc_html__('Days', 'adeecore'),
			'hours'		=> esc_html__('Hours', 'adeecore'),
			'minutes'	=> esc_html__('Minutes', 'adeecore'),
			'seconds'	=> esc_html__('Seconds', 'adeecore')
			);

		$datetime = str_replace('/', '-', $date);

		$opentimewrap = ($type === 'classic') ? '<div class="timer-dc">' : '';
		$closetimewrap = ($type === 'classic') ? '</div>' : '';


		$output = '<div class="dc-sc-countdown countdown ' . esc_attr( $classes ) . '">';
			$output .= '<div class="countdown-timer-wrap">';
			if($type !== 'modern') {

				$output .= '<div class="countdown-clock timer-' .$type. '" data-countdown="' .date('m-d-Y H:i', strtotime($datetime)). '">';
					
					if (($type == 'classic') && $showdate) {
						$output .= '<div class="countdown-date-wrap">';
							$output .= '<span class="countdown_day">' .date('d', strtotime($datetime)). '</span>';
							$output .= '<span class="countdown_month">' .date('M', strtotime($datetime)). ', ' .date('Y', strtotime($datetime)). '</span>';
						$output .= '</div>';

						$output .= '<div class="countdown-sep"></div>';
					}

					$output .= $opentimewrap;
						$output .= '<div class="days-dc block-dc"><div class="count-dc"></div>';
							$output .= '<div class="label-dc">' .$label['days']. '</div>';
						$output .= '</div>';
					$output .= $closetimewrap;
					$output .= '<div class="div-dc">:</div>';
					$output .= $opentimewrap;
						$output .= '<div class="hours-dc block-dc"><div class="count-dc"></div>';
							$output .= '<div class="label-dc">' .$label['hours']. '</div>';
						$output .= '</div>';
					$output .= $closetimewrap;
					$output .= '<div class="div-dc">:</div>';
					$output .= $opentimewrap;
						$output .= '<div class="minutes-dc block-dc"><div class="count-dc"></div>';
							$output .= '<div class="label-dc">' .$label['minutes']. '</div>';
						$output .= '</div>';
					$output .= $closetimewrap;
					$output .= '<div class="div-dc">:</div>';
					$output .= $opentimewrap;
						$output .= '<div class="seconds-dc block-dc"><div class="count-dc"></div>';
							$output .= '<div class="label-dc">' .$label['seconds']. '</div>';
						$output .= '</div>';
					$output .= $closetimewrap;

				$output .= '</div>';

			} else {

				wp_enqueue_style('flipclock');

				$output .= '<div class="countdown-clock-wrap">';
					if ($showdate) {
						$output .= '<div class="countdown-date-wrap">';
							$output .= '<span class="countdown_day">' .date('d', strtotime($datetime)). '</span>';
							$output .= '<span class="countdown_month">' .date('M', strtotime($datetime)). ', ' .date('Y', strtotime($datetime)). '</span>';
						$output .= '</div>';

						$output .= '<div class="countdown-sep"></div>';
					}

					$output .= '<div class="countdown-datetime timer-' .$type. '" data-countdowndate="' .date('M-d-Y H:i', strtotime($datetime)). '"></div>';
				$output .= '</div>';
			}
			$output .= '</div>';

			if($title) $output .= '<h4 class="countdown-title" ' .$style. '>' .$title. '</h4>';
			if($content) $output .= do_shortcode($content);
		$output .= '</div>';

		return $output;
	}

	add_shortcode('countdown', 'countdown_sc');
}



/* ---------------------------------------------------------------------------
* Dropcap SC
* --------------------------------------------------------------------------- */
if (! function_exists('dropcap_sc')) {
	function dropcap_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'type'			=> 'simple',
			'style'			=> 'square',
			'size'			=> 32,
			'padding'		=> 10,
			'color'			=> '',
			'background'	=> '',
			'class'			=> ''
		), $attr) );

		$customcss = adeetheming_uniqclass('dc-custom-dropcap');

		$classes = array();

		if($type) $classes[] = 'dropcap_' .$type;
		if($style) $classes[] = 'style_' .$style;
		$classes[] = $customcss;
		if($class) $classes[] = $class;

		$classes = implode(' ', $classes);

		$output = '<span class="dc-sc-dropcap '. $classes . '">';
			$output .= do_shortcode($content);
		$output .= '</span>';

		//Shortcode Custom CSS
		$shortcodecss = '';
		if ($type == 'classic') {
			$size = (!empty($size)) ? 'font-size:' .intval($size). 'px;' : '';
			$padding = (!empty($padding)) ? 'padding:' .intval($padding). 'px;' : '';
			$color = (!empty($color)) ? 'color:' .$color. ';' : '';
			$background = (!empty($background)) ? 'background:' .$background. ';' : '';

			$shortcodecss = '.dc-sc-dropcap.dropcap_classic.' .$customcss. ' {' .$size.$padding.$color.$background. '}';
		}

		adeetheming_shortcodecss($shortcodecss);

		return $output;
	}

	add_shortcode('dropcap', 'dropcap_sc');
}



/* ---------------------------------------------------------------------------
* FAQ SC
* --------------------------------------------------------------------------- */
if (! function_exists('faq_sc')) {
	function faq_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'type'			=> 'classic',
			'active'		=> 1,
			'category'		=> '',
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'class'			=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-faq');

		$args = array(
			'post_type'			=> 'faq',
			'posts_per_page'	=> -1,
			'orderby'			=> $orderby,
			'order'				=> $order
		);

		$prefix = 'adee_';

		$uniqid = uniqid(rand(1,9999));

		$ret = '';

		$classes = array();
		$classes[] = $customcss;
		if($class) $classes[] = $class;

		$classes = implode(' ', $classes);

		if($category) $args['faq-category']	= $category;

		$faq_loop = new WP_Query($args);

		if ($faq_loop->have_posts()) {

			$active = (count($faq_loop->have_posts()) >= intval($active)) ? $active : 1;

			$i = 1;

			$output = '<div class="dc-sc-faq faq_wrap type-' .$type. ' ' .$classes. '">';

				if($title) $output .= '<h4 class="faq-title">' . $title . '</h4>';

				$output .= '<ul class="faq-tabs-title">';
					while ($faq_loop->have_posts()) {
						$faq_loop->the_post();

						$groups = get_post_meta(get_the_ID(), $prefix. 'faq_group', true);

						$active_tab = ($active == $i) ? 'active' : '';

						$output .= '<li class="faq-title-tab ' .$active_tab. '">';
							$output .= '<a href="#faq-' .$uniqid. '-' .get_the_ID(). '">';
								$output .= '<span class="faq-title-wrap">' .the_title(false, false, false). '</span>';
							$output .= '</a>';
						$output .= '</li>';

						$activateall = get_post_meta(get_the_ID(), $prefix. 'activateall', true);
						if($activateall) $activateall = 'activateall';
						$ret .= '<div id="faq-' .$uniqid. '-' .get_the_ID(). '" class="faq-content-wrap ' .$activateall. ' ' .$active_tab. '">';

							foreach ($groups as $group) {

								$question = $group[$prefix. 'faq_question'];
								$answer = $group[$prefix. 'faq_answer'];
								$activate = isset($group[$prefix. 'faq_activate']) ? $group[$prefix. 'faq_activate'] : '';

								$activate = (empty($activateall) && $activate) ? 'faq-active' : '';
								
								$ret .= '<div class="faq-item-wrap ' .$activate. '">';
									$ret .= '<div class="faq-item-title">';
										$ret .= '<span class="faq-question">' .$question. '</span>';
									$ret .= '</div>';

									$ret .= '<div class="faq-answer">';
										$ret .= $answer;
									$ret .= '</div>';
								$ret .= '</div>';
							}
						$ret .= '</div>';

						$i++;
					}
				$output .= '</ul>';

				$output .= $ret;

			$output .= '</div>';
		}
		wp_reset_query();

		return $output;
	}

	add_shortcode('faq', 'faq_sc');
}



/* ---------------------------------------------------------------------------
* Flipbox SC
* --------------------------------------------------------------------------- */
if (! function_exists('flipbox_sc')) {
	function flipbox_sc($attr, $content = null) {
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
			), $attr)
		);


		if (in_array($flip_direction, array('ne', 'se', 'sw', 'nw') ) ) {
			if ($flip_type == 'cubetilt') {
				$flip_type = 'cubeflip';
			}
		}


		$classes = '';
		$classes .= ' animation_' . $flip_type;
		$classes .= ' direction_' . $flip_direction;
		$classes .= ' ' . $class;

		$atts = $attributes = '';
		if ($outer_wrap == 'a' || isset($link_url)) {
			$anchor_url = ( '||' === $anchor_url ) ? '' : $anchor_url;
			$link_url = ( '||' === $link_url ) ? '' : $link_url;

			$url = '';
			if($anchor_url) $url = $anchor_url;
			if($link_url) $url = $link_url;

			$atts = vc_build_link( $url );

			$use_link = false;
			if ( strlen( $atts['url'] ) > 0 ) {
				$use_link = true;
				$a_href = $atts['url'];
				$a_title = $atts['title'];
				$a_target = $atts['target'];
				$a_rel = $atts['rel'];
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
								$output .= '<a ' . $attributes . 'class="btn flip-btn adeecore-button" style="' . $btn_style . '">' . $atts['title'] . '</a>';
							}
						$output .= '</div>';
					$output .= '</div>';

					if($flip_type == 'cubeflip') {

						if(in_array($flip_direction, array('ne', 'e', 'se', 'sw', 'w', 'nw'))) {

							$flank_style = 'background-color: ' .dc_shadecolor($front_bgcolor). ';' ;
							
							$output .= '<div class="flipflank_y" style="' . $flank_style . '"></div>';
						}
						if(in_array($flip_direction, array('n', 'ne', 'se', 's', 'sw', 'nw'))) {

							$flank_style = 'background-color: ' .dc_tintcolor($back_bgcolor). ';' ;

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
	}

	add_shortcode('flipbox', 'flipbox_sc');
}



/* ---------------------------------------------------------------------------
* Google Map SC
* --------------------------------------------------------------------------- */
if (! function_exists('googlemap_sc')) {
	function googlemap_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'latitude'			=> '6.5721891',
			'longitude'			=> '3.3679634',
			'zoom'				=> 13,
			'height'			=> 500,
			'type'				=> 'ROADMAP',
			'draggable'			=> '',
			'scrollwheel'		=> 'false',
			'marker'			=> '',
			'animation'			=> 'DROP',
			'infowindow'		=> '',
			'details'			=> '',
			'title'				=> '',
			'address'       	=> '',
            'email'          	=> '',
            'phone'          	=> '',
            'website'        	=> '',
            'skin'				=> '',
            'class'				=> ''
			), $attr)
		);

		global $adeetheming_options;

		$api_key = $adeetheming_options['map-api-key'];

		$ssl = 'https';
		if(! is_ssl()) $ssl = 'http';
		wp_enqueue_script('googleMaps', $ssl. '://maps.google.com/maps/api/js?key=' .$api_key, false, null, true);
		// end
        wp_enqueue_script('google-map',THMJS.'gmaps.js',array(),false,true);

		$marker = wp_get_attachment_thumb_url( $marker );

		//Marker
		$googlemarker = get_template_directory_uri() .'/images/marker.png';
		if (! empty($marker)) {
			$googlemarker = $marker;
		}

		$api_key = $adeetheming_options['map-api-key'];

		$uniqid = 'map_' .uniqid(rand(1,9999));

		$skin = rawurldecode( base64_decode( strip_tags( $skin ) ) );

		$output = '<div class="dc-sc-googlemap googlemap_wrap ' .$class. '">';
			$output .= '<div id="' .$uniqid.'" class="google-map" style="width: 100%; height: ' .intval($height). 'px;">';
			$output .= '</div>';

			if (! empty($details)) {
				$output .= '<div class="dc-contact-wrap">';
					$output .= '<div class="contact-info-address">';
						if($title) $output .= '<h4 class="googlemap-title">' .$title. '</h4>';
						if($content) $output .= '<div class="googlemap-desc">' .do_shortcode($content). '</div>';

						$output .= '<div class="contact-address-wrap">';
							$output .= '<ul>';
								if( $address ){
									$output .= '<li class="address">';
										$output .= '<span class="icon"><i class="fa fa-map-marker"></i></span>';
										$output .= '<div class="address_wrapper">'.$address.'</div>';
									$output .= '</li>';
								}
								if( $email ){
									$output .= '<li class="email">';
										$output .= '<span class="icon"><i class="fa fa-envelope"></i></span>';
										$output .= '<div class="email_wrapper"><a href="mailto:' .$email. '">'.$email.'</a></div>';
									$output .= '</li>';
								}
								if( $phone ){
									$output .= '<li class="phone">';
										$output .= '<span class="icon"><i class="fa fa-phone"></i></span>';
										$output .= '<div class="phone_wrapper"><a href="tel:' .str_replace(' ', '', $phone). '">'.$phone.'</a></div>';
									$output .= '</li>';
								}
								if( $website ){
									$output .= '<li class="website">';
										$output .= '<span class="icon"><i class="fa fa-globe"></i></span>';
										$output .= '<div class="website_wrapper"><a href="' .esc_url($website). '">'.$website.'</a></div>';
									$output .= '</li>';
								}
							$output .= '</ul>';
						$output .= '</div>';

					$output .= '</div>';
				$output .= '</div>';
			}
		$output .= '</div>';

		$script = '<script>';
			//<![CDATA[
			if ($draggable == 'enable') {
				$drag = 'true';
			} elseif ($draggable == 'disable_mobile') {
				$drag = 'jQuery(window).width() < 768 ? false : true';
			} else {
				$drag = 'false';
			}
			$script .= 'function dc_loadMap_' .$uniqid. '() {';
				$script .= 'var dcMapOptions = {';
					$script .= 'center : new google.maps.LatLng(' .$latitude. ', ' .$longitude. '),';
					$script .= 'zoom : ' .intval($zoom). ',';
					$script .= 'mapTypeId : google.maps.MapTypeId.' .$type. ',';
					$script .= 'draggable : ' .$drag. ',';
					if($skin) $script .= 'styles : ' .$skin. ',';
					$script .= 'scrollwheel : ' .$scrollwheel. ',';
				$script .= '};';

				$script .= 'var map = new google.maps.Map(document.getElementById("' .$uniqid. '"), dcMapOptions);';

				$script .= 'var marker = new google.maps.Marker({';
					$script .= 'position : new google.maps.LatLng(' .$latitude. ', ' .$longitude. '),';
					$script .= 'map : map,';
					$script .= 'icon : "' .$googlemarker. '",';
					$script .= 'animation : google.maps.Animation.' .$animation. ',';
				$script .= '});';

				$script .= 'marker.setMap(map);';

				if(! empty($infowindow)) {
					$script .= 'var infoWindow = new google.maps.InfoWindow({';
						$script .= 'content : "' .strip_tags($address). '",';
						$script .= 'maxWidth : 350,';
					$script .= '});';

					$script .= 'infoWindow.open(map, marker)';
				}

			$script .= '}';

			$script .= 'jQuery(document).ready( function($) {';
				$script .= 'dc_loadMap_' .$uniqid. '();';
			$script .= '});';
		$script .= '</script>';

		$output .= $script;
		
		return $output;
	}

	add_shortcode('googlemap', 'googlemap_sc');
}



/* ---------------------------------------------------------------------------
* Heading SC
* --------------------------------------------------------------------------- */
if (! function_exists('heading_sc')) {
	function heading_sc($attr, $content = null) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'tag'			=> 'h2',
			'type'			=> 'simple',
			'align'			=> 'left',
			'fontsize'		=> '',
			'lineheight'	=> '',
			'weight'		=> '',
			'responsive'	=> '',
			'tabletsize'	=> '',
			'tabletheight'	=> '',
			'mobilesize'	=> '',
			'mobileheight'	=> '',
			'color'			=> '',
			'class'			=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-heading');

		$classes = array();
		if($type) $classes[] = 'type_' .$type;
		if($align) $classes[] = 'align_' .$align;
		$classes[] = $customcss;
		if($class) $classes[] = $class;

		$classes = implode(' ', $classes);

		$output = '<div class="dc-sc-heading heading_wrap ' .$classes. '">';
			$output .= '<' .$tag. ' class="heading_title">';
				$output .= $title;
			$output .= '</' .$tag. '>';
		$output .= '</div>';

		//Shortcode Custom CSS
		$shortcodecss = '';
		$fontsize = (!empty($fontsize)) ? 'font-size:' .intval($fontsize). 'px;' : '';
		$lineheight = (!empty($lineheight)) ? 'line-height:' .intval($lineheight). 'px;' : '';
		$weight = (!empty($weight)) ? 'font-weight:' .intval($weight). ';' : '';
		$color = (!empty($color) && $type != 'simple') ? 'color:' .$color. ';' : '';

		$shortcodecss = '.dc-sc-heading.' .$customcss. ' ' .$tag. '.heading_title {' .$fontsize.$lineheight.$weight.$color. '}';
		if ($responsive) {
			$tabletsize = (!empty($tabletsize)) ? 'font-size:' .intval($tabletsize). 'px;' : '';
			$tabletheight = (!empty($tabletheight)) ? 'line-height:' .intval($tabletheight). 'px;' : '';

			$shortcodecss .= '@media (max-width: 992px) and (min-width: 768px) {.dc-sc-heading.' .$customcss. ' ' .$tag. '.heading_title {' .$tabletsize.$tabletheight. '}}';

			$mobilesize = (!empty($mobilesize)) ? 'font-size:' .intval($mobilesize). 'px;' : '';
			$mobileheight = (!empty($mobileheight)) ? 'line-height:' .intval($mobileheight). 'px;' : '';

			$shortcodecss .= '@media (max-width: 767px) {.dc-sc-heading.' .$customcss. ' ' .$tag. '.heading_title {' .$mobilesize.$mobileheight. '}}';
		}

		adeetheming_shortcodecss($shortcodecss);

		return $output;
	}

	add_shortcode('heading', 'heading_sc');
}



/* ---------------------------------------------------------------------------
* Highlight SC
* --------------------------------------------------------------------------- */
if (! function_exists('highlight_sc')) {
	function highlight_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'type'			=> 'simple',
			'size'			=> '',
			'color'			=> '',
			'background'	=> '',
			'class'			=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-highlight');

		$classes = array();
		$classes[] = 'highlight-' .$type;
		$classes[] = $customcss;
		$classes[] = $class;

		$classes = implode(' ', $classes);

		$output = '<span class="dc-sc-highlight '. $classes . '">';
			$output .= do_shortcode($content);
		$output .= '</span>';

		//Shortcode Custom CSS
		$shortcodecss = '';
		if ($type != 'simple') {
			$size = (!empty($size)) ? 'font-size:' .intval($size). 'px;' : '';
			$color = (!empty($color)) ? 'color:' .$color. ';' : '';
			$background = (!empty($background)) ? 'background:' .$background. ';' : '';

			$shortcodecss = '.dc-sc-highlight.' .$customcss. ' {' .$size.$color.$background. '}';
		}

		adeetheming_shortcodecss($shortcodecss);

		return $output;
	}

	add_shortcode('highlight', 'highlight_sc');
}



/* ---------------------------------------------------------------------------
* Hover Image SC
* --------------------------------------------------------------------------- */
if (! function_exists('hoverimage_sc')) {
	function hoverimage_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'image'			=> '',
			'align'			=> 'center',
			'color'			=> '',
			'border'		=> '',
			'bordercolor'	=> '',
			'anchor'		=> '',
			'link'			=> '',
			'effect'		=> 'n',
			'hover'			=> 'zoom-in',
			'hovercolor'	=> '',
			'image2'		=> '',
			'class'			=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-highlight');

		$classes = array();
		if($effect) $classes[] = 'effect_' .$effect;
		if($hover) $classes[] = 'hover_' .$hover;
		if($align) $classes[] = 'align_' .$align;
		$classes[] = $customcss;
		if($class) $classes[] = $class;

		$classes = implode(' ', $classes);

		
		$atts = $attributes = '';
		if ($anchor !== '' || isset($link)) {
			$link = ( '||' === $link ) ? '' : $link;

			$url = '';
			if($link) $url = $link;

			$atts = vc_build_link( $url );

			$use_link = false;
			if ( strlen( $atts['url'] ) > 0 ) {
				$use_link = true;
				$a_href = $atts['url'];
				$a_title = $atts['title'];
				$a_target = $atts['target'];
				$a_rel = $atts['rel'];
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

		$image = wp_get_attachment_image_src( $image,'full');
		if($image) $img_src = '<span class="dc-hoverimage-front"><img src="' .$image[0]. '" alt="" class="img-responsive hoverimage-img" /></span>';

		$image2 = wp_get_attachment_image_src( $image2,'full');
		if($image2) $img_src2 = '<span class="dc-hoverimage-back"><img src="' .$image2[0]. '" alt="" class="img-responsive hoverimage-img" /></span>';

		$output = '<div class="dc-sc-hoverimage hoverimage_wrap ' .$classes. '">';
			if($anchor === 'container') $output .= '<a ' .$attributes. '>';
			
			$output .= '<div class="hoverimage_wrap">';
				$output .= $img_src;
				if($hover == 'fade') {
					$output .= $img_src2;
				}
			$output .= '</div>';

			$output .= '<div class="desc_wrapper">';
				if ($title) {
					$output .= '<h4 class="hoverimage-title">';

						if ($anchor === 'item_title') $output .= '<a ' .$attributes. '>';
							$output .= $title;
						if ($anchor === 'item_title') $output .= '</a>';

					$output .= '</h4>';
				}
				$output .= '<div class="title-sep"></div>';
				$output .= do_shortcode($content);
			$output .= '</div>';

			if($anchor === 'container') $output .= '</a>';
		$output .= '</div>';

		//Shortcode Custom CSS
		$shortcodecss = '';
		$color = (!empty($color)) ? 'color:' .$color. ';' : '';
		$border = (!empty($border)) ? 'border-width:' .intval($border). 'px;' : '';
		$bordercolor = (!empty($bordercolor)) ? 'border-color:' .$bordercolor. ';' : '';

		$shortcodecss = '.dc-sc-hoverimage.' .$customcss. ' {' .$color.$border.$bordercolor. '}';

		adeetheming_shortcodecss($shortcodecss);

		return $output;
	}

	add_shortcode('hoverimage', 'hoverimage_sc');
}



/* ---------------------------------------------------------------------------
* Iconbox SC
* --------------------------------------------------------------------------- */
if (! function_exists('iconbox_sc')) {
	function iconbox_sc($attr, $content = null) {

		extract(shortcode_atts(array(
			'type'				=> 'simple',
			'icontype' 			=> 'icon',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
			'icon_color'		=> '',
			'icon_bg'			=> '',
			'image'	 			=> '',
			'size'				=> 48,
			'title'				=> '',
			'txt_color'		 	=> '',
			'alignment' 		=> 'center',
			'bg_color'		 	=> '',
			'bg_image'			=> '',
			'border'			=> 'disable',
			'border_width'		=> '',
			'border_style'		=> '',
			'border_color'		=> '',
			'border_radius'		=> '',
			'class'		 		=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-iconbox');


		$classes = array();

		if ($type !== 'simple') {
			$bgstyle = array();

			if ( $bg_color ) $bgstyle[] = 'background : ' . esc_attr( $bg_color ) . ';';
			$bgimage_scr = wp_get_attachment_image_src( $bg_image, 'full' );
			if ( $bg_image ) $bgstyle[] = 'background-image : url(' . esc_attr( $bgimage_scr[0] ) . ');';

			if ( $border == "enable" ) {
				if ( $border_width ) $bgstyle[] = 'border-width : ' . esc_attr( $border_width ) . ';';

				if ( $border_style ) $bgstyle[] = 'border-style : ' . esc_attr( $border_style ) . ';';

				if ( $border_color ) $bgstyle[] = 'border-color : ' . esc_attr( $border_color ) . ';';

				if ( $border_radius ) $bgstyle[] = 'border-radius : ' . esc_attr( $border_radius ) . ';';
			}

			$bgstyle = 'style="' .implode(' ', $bgstyle). '"';
		}

		$classes[] = 'type_' .$type;
		$classes[] = 'iconbox-' .$alignment;
		$classes[] = $customcss;
		$classes[] = $class;

		$classes = implode(' ', $classes);

		//Icon Style
		$icstyle = array();
		if ($icon_color && ($icon_format !== 'simple')) $icstyle[] = 'color : ' .esc_attr($icon_color ). ';';
		if ($icon_bg && ($icon_format !== 'simple')) $icstyle[] = 'background : ' .esc_attr($icon_bg). ';';
		if ($size) $icstyle[] = 'font-size : ' .esc_attr($size). 'px;';
		if ($size) $icstyle[] = 'width : ' . esc_attr($size) * (($icon_format == 'simple') ? 1 : 2). 'px;';
		if ($size) $icstyle[] = 'height : ' . esc_attr($size) * (($icon_format == 'simple') ? 1 : 2). 'px;';
		if ($size) $icstyle[] = 'line-height : ' . esc_attr($size) * (($icon_format == 'simple') ? 1 : 2). 'px;';

		$icstyle = 'style="' .implode(' ', $icstyle). '"';

		//Desc Wrapper
		$desc_wrap = '';
		if($alignment === 'left') $desc_wrap = 'style="padding-left: ' .intval($size) * (($icon_format == 'simple') ? 1 : 2). 'px;"';
		if($alignment === 'right') $desc_wrap = 'style="padding-right: ' .intval($size) * (($icon_format == 'simple') ? 1 : 2). 'px;"';

		if ($type !== 'simple') {

			//Text Color
			$txtcolor = '';
			if ( $txt_color ) $txtcolor = 'color : ' . esc_attr( $txt_color ) . ';';
		}
		
		$output = '<div class="dc-sc-iconbox iconbox-' .$type. ' ' . esc_attr( $classes ) . '" ' .$bgstyle. '>';
			$output .= '<div class="icon_wrapper">';
				switch ( $icontype ) {
					case 'image':
						$src_image = wp_get_attachment_image_src( $image, 'thumbnail' );
						if ( $image ) {
							$output .= '<img src="' . esc_url( $src_image[0] ) . '" alt="" with="' .$size. '" height="' .$size. '" />'; 
						}
						break;
						
					default:
						vc_icon_element_fonts_enqueue( $icon );
						$iconClass = isset( ${'icon_' .$icon} ) ? '<i class="' .esc_attr( ${'icon_' .$icon} ). '"></i>' : '';
						$output .= '<span class="iconbox-icon-wrap" ' .$icstyle. '>' .$iconClass. '</span>';
						break;
				}
			$output .= '</div>';
			
			$output .= '<div class="desc_wrapper" ' .$desc_wrap. '>';
				$output .= '<div class="count-text " style="' .$txtcolor. '">';
					if($type === 'modern') $output .= '<div class="iconbox-sep"></div>';
					if($title) $output .= '<h4 class="iconbox-title">' .$title. '</h4>';
					if($content) $output .= do_shortcode($content);
				$output .= '</div>';
				$output .= '</div>';
		$output .= '</div>';

	return $output;

	}

	add_shortcode('iconbox', 'iconbox_sc');
}



/* ---------------------------------------------------------------------------
* Info List SC
* --------------------------------------------------------------------------- */
if (! function_exists('infolist_sc')) {
	function infolist_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'				=> '',
			'type'				=> 'style1',
			'position'			=> 'left',
			'iconstyle'			=> 'round',
			'borderstyle'		=> 'solid',
			'size'				=> 'small',
			'borderwidth'		=> '1px',
			'class'				=> ''
			), $attr)
		);

		$classes = array();
		if($type) $classes[] = 'type_' .$type;
		if($position) $classes[] = 'position_' .$position;
		if($iconstyle) $classes[] = 'iconstyle_' .$iconstyle;
		if($borderstyle) $classes[] = 'borderstyle_' .$borderstyle;
		if($size) $classes[] = 'icon_' .$size;
		if($borderwidth) $classes[] = 'borderwidth_' .$borderwidth;
		if($class) $classes[] = $class;

		$classes = implode(' ', $classes);

		$output = '<div class="infolist_wrap dc-sc-infolist ' .$classes. '">';

			if ($title) $output .= '<h4 class="infolist-title">' .$title. '</h4>';

			$output .= '<div class="infolist_container">';
				$output .= do_shortcode($content);
			$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	add_shortcode('infolist', 'infolist_sc');
}



/* ---------------------------------------------------------------------------
* Info List Item SC
* --------------------------------------------------------------------------- */
if (! function_exists('infolist_item_sc')) {
	function infolist_item_sc( $attr, $content = null) {
		extract(shortcode_atts(array(
			'title'				=> '',
			'icon_type'			=> 'icon',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
			'image'				=> '',
			'icon_color'		=> '',
			'icon_bg_color'		=> '',
			'connector'			=> '',
			'anchor'			=> '',
			'link'				=> ''
			), $attr)
		);

		vc_icon_element_fonts_enqueue( $icon );
		$iconClass = isset( ${'icon_' .$icon} ) ? '<span class="dc-infolist-icon"><i class="' .esc_attr( ${'icon_' .$icon} ). '"></i></span>' : '';
		//Icon Style
		$icstyle = array();
		if ($icon_color) $icstyle[] = 'color: ' .$icon_color. ';';
		if ($icon_bg_color) $icstyle[] = 'background: ' .$icon_bg_color. ';';
		$icstyle = implode(' ', $icstyle);
		if (! empty($icstyle)) $icstyle = 'style="' .$icstyle. '"';

		$image = wp_get_attachment_image_src( $image,'thumbnail');
		if($image) $img_src = '<span class="dc-infolist-image"><img src="' .$image[0]. '" alt="" /></span>';

		$atts = $attributes = '';
		if ($anchor !== '' || isset($link)) {
			$link = ( '||' === $link ) ? '' : $link;

			$url = '';
			if($link) $url = $link;

			$atts = vc_build_link( $url );

			$use_link = false;
			if ( strlen( $atts['url'] ) > 0 ) {
				$use_link = true;
				$a_href = $atts['url'];
				$a_title = $atts['title'];
				$a_target = $atts['target'];
				$a_rel = $atts['rel'];
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

		$open_wrap = ($anchor === 'container') ? 'a ' .$attributes : 'div';
		$close_wrap = ($anchor === 'container') ? 'a' : 'div';

		if($connector) $connector = 'style="border-color:' .$connector. ';"';

		$output = '<' .$open_wrap. ' class="infolist-item-wrap">';
			$output .= '<div class="dc-connector" ' .$connector. '></div>';

			$output .= '<div class="infolist-icon-wrap" ' .$icstyle. '>';
				if ($icon_type == 'image') {
					$output .= $img_src;
				} else {
					$output .= $iconClass;
				}
			$output .= '</div>';

			$output .= '<div class="infolist-details-wrap">';

				if ($title) {
					$output .= '<h4 class="infolist-item-title">';

						if ($anchor === 'item_title') $output .= '<a ' .$attributes. '>';
							$output .= $title;
						if ($anchor === 'item_title') $output .= '</a>';

					$output .= '</h4>';
				}

				$output .= '<div class="infolist-content">';
					$output .= do_shortcode($content);
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</' .$close_wrap. '>';

		return $output;
	}

	add_shortcode('infolist_item', 'infolist_item_sc');
}



/* ---------------------------------------------------------------------------
* Interactive Text SC
* --------------------------------------------------------------------------- */
if(! function_exists('interactivetext_sc')) {
	function interactivetext_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'prefix'		=> '',
			'animatedtext'	=> '',
			'suffix'		=> '',
			'animation'		=> 'typed',
			'tag'			=> 'h2',
			'size'			=> '',
			'weight'		=> '',
			'color'			=> '',
			'background'	=> '',
			'alignment'		=> 'left',
			'autoloop'		=> true,
			'randomize'		=> false,
			'stoponhover'	=> false,
			'changeonclick'	=> false,
			'speed'			=> 4000,
			'animationin'	=> 'fadeIn',
			'animationout'	=> 'fadeOut',
			'loop'			=> true,
			'typespeed'		=> 0,
			'startdelay'	=> 0,
			'backspeed'		=> 0,
			'shuffle'		=> false,
			'backdelay'		=> 0,
			'cursorchar'	=> '|',
			'class'			=> ''
			), $attr)
		);

		$str_replace = explode('|', $animatedtext);
		$strcount = count($str_replace);

		if($color) $color = 'color: ' .$color. '; ';
		if($background) $background = 'background: ' .$background. '; ';
		$style = $script = '';
		if($color != '' || $background != '') {
			$style = ' style="' .$color.$background. '"';
		}

		$uniqid = $animation. '-' .uniqid(rand(1,9999));

		$output = '<div class="interactivetext_wrapper">';
			$output .= '<' .$tag. ' class="dc-sc-interactivetext ' .$class. '">';
				$output .= '<span class="inttext-prefix">' .$prefix. '</span> ';

				$output .= '<span' .$style.' class="inttext-main ' .$uniqid. '"></span>';

				$output .= ' <span class="inttext-suffix">' .$suffix. '</span>';
			$output .= '</' .$tag. '>';
		$output .= '</div>';

		if ($animation === 'rotator') {
			$script = '<script>';
				$script .= 'jQuery( function($) {
					jQuery(".' .$uniqid. '").wordsrotator({
						autoLoop : ' .$autoloop. ',
						randomize : ' .$randomize. ',
						stopOnHover : ' .$stoponhover. ',
						changeOnClick : ' .$changeonclick. ',
						speed : ' .$speed. ',
						animationIn : "' .$animationin. '",
						animationOut : "' .$animationout. '",';
						$script .= 'words : [';
						for ($i=0; $i < $strcount; $i++) { 
							$script .= '"' .trim($str_replace[$i]). '",';
						}
						$script .= ']
					});
				});';
			$script .= '</script>';
		} else {
			$script = '<script>';
				$script .= 'jQuery( function($) {
					jQuery(".' .$uniqid. '").typed({
						loop : ' .$autoloop. ',
						typeSpeed : ' .$typespeed. ',
						startDelay : ' .$startdelay. ',
						backSpeed : ' .$backspeed. ',
						shuffle : ' .$shuffle. ',
						backDelay : ' .$backdelay. ',
						cursorChar : "' .$cursorchar. '",';
						$script .= 'strings : [';
						for ($i=0; $i < $strcount; $i++) { 
							$script .= '"' .trim($str_replace[$i]). '",';
						}
						$script .= ']
					});
				});
			</script>';
		}

		$output .= $script;

		return $output;
	}

	add_shortcode('interactivetext', 'interactivetext_sc');
}



/* ---------------------------------------------------------------------------
* Portfolio SC
* --------------------------------------------------------------------------- */
if (! function_exists('portfolio_sc')) {
	function portfolio_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'layout'		=> 'list_layout',
			'column'		=> 'cols__3',
			'category'		=> '',
			'filter'		=> false,
			'count'			=> 10,
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'loadmore'		=> true,
			'class'			=> ''
		), $attr) );

		$paged = (get_query_var('paged')) ? get_query_var('paged') : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

		$args = array(
			'post_type'		=> 'portfolio',
			'posts_per_page'=> intval($count),
			'paged'			=> $paged,
			'orderby'		=> $orderby,
			'order'			=> $order
		);

		if($category) $args['portfolio-category'] = $category;

		$prefix = 'adee_';

		query_posts($args);


		if ( ($layout !== 'list_layout') && ($layout !== 'full_image_layout') ) {
    		$portfolio_cols[] = $column;

    		$portfolio_cols[] = 'content-filter';

    		$portfolio_cols[] = 'loadmore-masonry';
		}

		$portfolio_cols[] = $class;

		$portfolio_col = implode(' ', $portfolio_cols);

		global $post, $adeetheming_options;

		$excerpt = $adeetheming_options['excerpt-length'];
        $limit = 140;
        if ( $excerpt ) $limit = $excerpt;

		$output = '';

		if (have_posts()) {

			if ($layout != 'list_layout' && $layout != 'full_image_layout' && $filter == true ) {
				$output .= '<div class="portfolio-filter">';
                    if(function_exists('adeetheming_filter') ) $output .= adeetheming_filter();
                $output .= '</div>';
			}
			
			$output .= '<div id="portfolio" class="loadmore-element ' . $portfolio_col . '">';
			while (have_posts()) {
				the_post();

				$client = get_post_meta(get_the_ID(), $prefix . 'portfolio_client', true);
				$url = get_post_meta(get_the_ID(), $prefix . 'portfolio_client_url', true);
				$target = get_post_meta(get_the_ID(), $prefix . 'portfolio_url_target', true);

				$portfolio_cols = $classes = array();

				$classes[] = $layout;

				$classes[] = 'portfolio-item';

				if ($layout === 'masonry_layout' || $layout === 'flat_masonry_layout') {
    				$portfolio_cols[] = 'masonry-element';
    				$classes[] = 'masonry-item';
				} elseif ($layout === 'grid_layout' || $layout === 'flat_grid_layout') {
    				$portfolio_cols[] = 'grid-element';
    				$classes[] = 'grid-item';
				}

				$prefix = 'adee_';

				$terms = get_the_terms(get_the_ID(), 'portfolio-category');

    			if ($terms && ! is_wp_error($terms)) {
        			$links = array();
        			$catlist = '';

		        	foreach ($terms as $term) {
        		    	$links[] = $term->slug;
            			$catlist .= '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>, ';
        			}

			        $tax = join(' ', $links);

		    	    $catlist = rtrim($catlist, ', ');
    			} else {
    	    		$tax = '';
    			}
    			$classes[] = $tax;


    			$class_item = implode(" ",get_post_class($classes, get_the_ID()) );

				if ( has_post_thumbnail(get_the_ID()) ){
					$col = 'has-thumb';
				}else {
					$col = 'no-thumb';
				} 

				$output .= '<article id="portfolio-' . get_the_ID() . '" class="' . $class_item . '">';
				if ($layout !== 'flat_grid_layout' && $layout !== 'flat_masonry_layout') {
					$output .= '<div class="content-wrapper">';
						$output .= '<div class="portfolio-intro-wrap">';
							if (isset($adeetheming_options['portfolio-date']) && $adeetheming_options['portfolio-date'] && has_post_thumbnail(get_the_ID()) ) {
								$output .= '<div class="entry-calender">';
									$output .= '<span class="publish-date"><i class="fa fa-calendar-o"></i></span>';
									$output .= '<span><time class="entry-month" datetime="' . get_the_time('m', get_the_ID()) . '">' . get_the_time('M', get_the_ID()) . '</time></span>';
									$output .= '<span><time class="entry-day" datetime="' . get_the_time('j', get_the_ID()) . '">' . get_the_time('j', get_the_ID()) . '</time></span>';
									$output .= '<span><time class="entry-year" datetime="' . get_the_time('y', get_the_ID()) . '">' . get_the_time('Y', get_the_ID()) . '</time></span>';
								$output .= '</div>';
							}
						$output .= '</div>';

						if ( has_post_thumbnail(get_the_ID()) && ! post_password_required() ) {
							$output .= '<div class="featured-wrapper ' . $col . '">';
								$output .= '<a href="' . get_permalink() . '" rel="bookmark">';
									if ($layout == 'masonry_layout') {
										$output .= get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive'));
									} else {

										$thumb   = get_post_thumbnail_id();
										$img_url = wp_get_attachment_url( $thumb,'full');
	
										switch ($layout) {
											case 'list_layout':
												$image   = aq_resize( $img_url, 760, 480, true, true, true );
												break;

											case 'full_image_layout':
												$image   = aq_resize( $img_url, 1140, 520, true,true, true );
												break;

											case 'grid_layout':
											case 'flat_grid_layout':
												$image   = aq_resize( $img_url, 760, 480, true, true, true );
												break;
		
											default:
												$image   = aq_resize( $img_url, 760, 350, true, true, true );
												break;
										}

										$output .= '<img src="' . esc_url( $image ) . '" class="img-responsive wp-post-image" alt=""/>';
									}
									$output .= '<div class="featured-cover"></div>';
								$output .= '</a>';
							$output .= '</div>';
						}

						$output .= '<div class="content-details ' . $col . '">';
							$output .= '<div class="entry-header">';
								$output .= '<h3 class="entry-title portfolio-entry-title">';
									$output .= '<a href="' . get_permalink() .'" rel="bookmark">' . get_the_title(get_the_ID()) . '</a>';
								$output .= '</h3>';
							$output .= '</div>';
							$output .= '<div class="entry-portfolio-meta">';
								$output .= '<ul>';
									if (isset($adeetheming_options['portfolio-author']) && $adeetheming_options['portfolio-author'] ) {
										$output .= '<li class="author-by"><i class="fa fa-user"></i> <span class="author">'. get_the_author_posts_link(get_the_ID()) . '</span> </li>';
									}
									if (isset($adeetheming_options['portfolio-category']) && $adeetheming_options['portfolio-category'] ) {
										$output .= '<li class="category"><i class="fa fa-folder-open-o"></i><ul>' . wp_kses_post($catlist) .'</ul></li>';
									}
									if (isset($adeetheming_options['portfolio-comment']) && $adeetheming_options['portfolio-comment'] && isset($adeetheming_options['portfolio-single-comment-en']) && $adeetheming_options['portfolio-single-comment-en']){
										if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
											$output .= '<li class="comments-link"><i class="fa fa-comments-o"></i>' . comments_popup_link( '<span class="leave-reply">' . esc_html__( 'No comment', 'adeecore' ) . '</span>', esc_html__( 'One comment', 'adeecore' ), esc_html__( '% comments', 'adeecore' ) ) .'</li>';
										}
									}
								$output .= '</ul>';
							$output .= '</div>';

							$output .= '<div class="clearfix"></div>';

							$output .= '<div class="entry-summary clearfix">';
								$output .= the_excerpt_max_charlength($limit);

								$output .= '<div class="wrap-btn-style">';
									if ( isset($adeetheming_options['portfolio-continue-en']) && $adeetheming_options['portfolio-continue-en']==1 ) {
            							if ( isset($adeetheming_options['portfolio-continue']) && $adeetheming_options['portfolio-continue'] ) {
                							$continue = esc_html($adeetheming_options['portfolio-continue']);
                							$output .= '<a class="btn btn-style" href="'.get_permalink().'">'. $continue .'</a>';
            							} else {
                							$output .= '<a class="btn btn-style" href="'.get_permalink().'">'. esc_html__( 'Continue Reading', 'adeecore' ) .'</a>';
            							}
        							}
								$output .= '</div>';
							$output .= '</div>';

							
						$output .= '</div>';
					$output .= '</div>';
				}
				else {
					$output .= '<div class="content-wrapper featured-wrapper ' . $col . '">';
						if ($layout == 'flat_masonry_layout') {
							$output .= get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive'));
						} else {

							$thumb   = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb,'full');
							$image   = aq_resize( $img_url, 760, 480, true, true, true );

							$output .= '<img src="' . esc_url( $image ) . '" class="img-responsive wp-post-image" alt=""/>';
						}
						$output .= '<div class="image-outer-hover">';
	        				$output .= '<div class="image-hover-wrapper">';
	        					$output .= '<div class="image-inner-wrapper">';
	        						$output .= '<h4 class="entry-title-hover">';
	        							$output .= '<a href="' . get_permalink() . '" rel="bookmark">';
	        								if (strlen($post->post_title) > 40) {
												$output .= substr(get_the_title($before = '', $after = '', FALSE), 0, 40) . '...'; 
											} else {
												$output .= get_the_title();
											}
	        							$output .= '</a>';
	        						$output .= '</h4>';
	        						if( $client ) $output .= '<div class="entry-client-hover"><i class="fa fa-handshake-o"></i> <span class="client-span">' . esc_attr($client) . '</span></div>';
	        						if (isset($adeetheming_options['portfolio-category']) && $adeetheming_options['portfolio-category'] ) {
	        							$output .= '<div class="category"><i class="fa fa-folder-open-o"></i><ul class="category-list">' . wp_kses_post($catlist) . '</ul></div>';
	        						}
	        						$output .= '<a href="' . get_the_post_thumbnail_url() . '" class="featured-inner-image" rel="bookmark"><i class="fa fa-camera"></i></a>';
	        						if($target) $target = '_blank';
	        						if($url) $output .= '<a href="' . esc_attr($url) . '" target="' . esc_attr($target) . '"><i class="fa fa-external-link"></i></a>';
	        						$output .= '<a href="' . get_permalink() . '" class="entry-project-link" rel="bookmark"><i class="fa fa-link"></i></a>';
	        					$output .= '</div>';
	        				$output .= '</div>';
	        			$output .= '</div>';
					$output .= '</div>';
				}
				$output .= '</article>';
			}
			$output .= '</div>';

			if($loadmore) {
				$output .= adeetheming_loadmore();
			} else {
				$output .= adeetheming_pagination();
			}

		}
		

		wp_reset_query();

		return $output;

	}

	add_shortcode('portfolio', 'portfolio_sc');
}



/* ---------------------------------------------------------------------------
* Portfolio Slide SC
* --------------------------------------------------------------------------- */
if (! function_exists('portfolioslide_sc')) {
	function portfolioslide_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'layout'		=> 'grid_layout',
			'category'		=> '',
			'count'			=> 6,
			'type'			=> 'classic',
			'display'		=> '',
			'time'			=> 5000,
			'hoverpause'	=> true,
			'navigation'	=> '',
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'loadmore'		=> true,
			'class'			=> ''
		), $attr) );

		$args = array(
			'post_type'		=> 'portfolio',
			'posts_per_page'=> intval($count),
			'paged'			=> -1,
			'orderby'		=> $orderby,
			'order'			=> $order
		);

		if($category) $args['portfolio-category'] = $category;

		$prefix = 'adee_';

		query_posts($args);

		$rel = array();
		if($time) $rel[] = 'data-time="' . $time . '"';
		if($hoverpause) $rel[] = 'data-pause="' . $hoverpause . '"';

		$rel = implode(' ', $rel);

		global $post, $adeetheming_options;

		$excerpt = $adeetheming_options['excerpt-length'];
        $limit = 140;
        if ( $excerpt ) $limit = $excerpt;

		$output = '';

		if (have_posts()) {

			$output = '<div class="portfolioslide_wrap dc-sc-portfolioslide ' .$class. '">';

        	$output .= '<div class="portfolioslide-wrapper clearfix">';

        	if ($title) {
				
				$output .= '<div class="portfolioslide-title-wrap">';
					$output .= '<h4 class="portfolioslide-title">' .$title. '</h4>';
				$output .= '</div>';
			}

			if (! empty($navigation)) {
				$output .= '<div class="prev-portfolio"><a href="javascript:void(0)"><i class="ion-ios-arrow-left"></i></a></div>';
				$output .= '<div class="next-portfolio"><a href="javascript:void(0)"><i class="ion-ios-arrow-right"></i></a></div>';
			}
			
			$output .= '<div class=" ' . $layout . '">';

			$output .= '<ul class="portfolioslide_element" ' .$rel. '>';
			while (have_posts()) {
				the_post();

				$client = get_post_meta(get_the_ID(), $prefix . 'portfolio_client', true);
				$url = get_post_meta(get_the_ID(), $prefix . 'portfolio_client_url', true);
				$target = get_post_meta(get_the_ID(), $prefix . 'portfolio_url_target', true);

				$classes = array();

				$classes[] = $layout;

				
    			$classes[] = 'grid-item';

    			$classes[] = 'portfolioslide-item';    			

				$prefix = 'adee_';

				$terms = get_the_terms(get_the_ID(), 'portfolio-category');

    			if ($terms && ! is_wp_error($terms)) {
        			$links = array();
        			$catlist = '';

		        	foreach ($terms as $term) {
        		    	$links[] = $term->slug;
            			$catlist .= '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>, ';
        			}

			        $tax = join(' ', $links);

		    	    $catlist = rtrim($catlist, ', ');
    			} else {
    	    		$tax = '';
    			}
    			$classes[] = $tax;


    			$class_item = implode(" ",get_post_class($classes, get_the_ID()) );

				if ( has_post_thumbnail(get_the_ID()) ){
					$col = 'has-thumb';
				}else {
					$col = 'no-thumb';
				}

				$output .= '<li class="portfolioslide-list">';

				$output .= '<article id="portfolio-' . get_the_ID() . '" class="' . $class_item . '">';
				if ($layout !== 'flat_grid_layout') {
					$output .= '<div class="content-wrapper">';
						$output .= '<div class="portfolio-intro-wrap">';
							if (isset($adeetheming_options['portfolio-date']) && $adeetheming_options['portfolio-date'] && has_post_thumbnail(get_the_ID()) ) {
								$output .= '<div class="entry-calender">';
									$output .= '<span class="publish-date"><i class="fa fa-calendar-o"></i></span>';
									$output .= '<span><time class="entry-month" datetime="' . get_the_time('m', get_the_ID()) . '">' . get_the_time('M', get_the_ID()) . '</time></span>';
									$output .= '<span><time class="entry-day" datetime="' . get_the_time('j', get_the_ID()) . '">' . get_the_time('j', get_the_ID()) . '</time></span>';
									$output .= '<span><time class="entry-year" datetime="' . get_the_time('y', get_the_ID()) . '">' . get_the_time('Y', get_the_ID()) . '</time></span>';
								$output .= '</div>';
							}
						$output .= '</div>';

						if ( has_post_thumbnail(get_the_ID()) && ! post_password_required() ) {
							$output .= '<div class="featured-wrapper ' . $col . '">';
								$output .= '<a href="' . get_permalink() . '" rel="bookmark">';
									
										$thumb   = get_post_thumbnail_id();
										$img_url = wp_get_attachment_url( $thumb,'full');
										$image   = aq_resize( $img_url, 760, 480, true, true, true );
	
										$output .= '<img src="' . esc_url( $image ) . '" class="img-responsive wp-post-image" alt=""/>';
									$output .= '<div class="featured-cover"></div>';
								$output .= '</a>';
							$output .= '</div>';
						}

						$output .= '<div class="content-details ' . $col . '">';
							$output .= '<div class="entry-header">';
								$output .= '<h3 class="entry-title portfolio-entry-title">';
									$output .= '<a href="' . get_permalink() .'" rel="bookmark">' . get_the_title(get_the_ID()) . '</a>';
								$output .= '</h3>';
							$output .= '</div>';
							$output .= '<div class="entry-portfolio-meta">';
								$output .= '<ul>';
									if (isset($adeetheming_options['portfolio-author']) && $adeetheming_options['portfolio-author'] ) {
										$output .= '<li class="author-by"><i class="fa fa-user"></i> <span class="author">'. get_the_author_posts_link(get_the_ID()) . '</span> </li>';
									}
									if (isset($adeetheming_options['portfolio-category']) && $adeetheming_options['portfolio-category'] ) {
										$output .= '<li class="category"><i class="fa fa-folder-open-o"></i><ul>' . wp_kses_post($catlist) .'</ul></li>';
									}
									if (isset($adeetheming_options['portfolio-comment']) && $adeetheming_options['portfolio-comment'] && isset($adeetheming_options['portfolio-single-comment-en']) && $adeetheming_options['portfolio-single-comment-en']){
										if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
											$output .= '<li class="comments-link"><i class="fa fa-comments-o"></i>' . comments_popup_link( '<span class="leave-reply">' . esc_html__( 'No comment', 'adeecore' ) . '</span>', esc_html__( 'One comment', 'adeecore' ), esc_html__( '% comments', 'adeecore' ) ) .'</li>';
										}
									}
								$output .= '</ul>';
							$output .= '</div>';

							$output .= '<div class="clearfix"></div>';

							$output .= '<div class="entry-summary clearfix">';
								$output .= the_excerpt_max_charlength($limit);

								$output .= '<div class="wrap-btn-style">';
									if ( isset($adeetheming_options['portfolio-continue-en']) && $adeetheming_options['portfolio-continue-en']==1 ) {
            							if ( isset($adeetheming_options['portfolio-continue']) && $adeetheming_options['portfolio-continue'] ) {
                							$continue = esc_html($adeetheming_options['portfolio-continue']);
                							$output .= '<a class="btn btn-style" href="'.get_permalink().'">'. $continue .'</a>';
            							} else {
                							$output .= '<a class="btn btn-style" href="'.get_permalink().'">'. esc_html__( 'Continue Reading', 'adeecore' ) .'</a>';
            							}
        							}
								$output .= '</div>';
							$output .= '</div>';

							
						$output .= '</div>';
					$output .= '</div>';
				}
				else {
					$output .= '<div class="content-wrapper featured-wrapper ' . $col . '">';
						$thumb   = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full');
						$image   = aq_resize( $img_url, 760, 480, true, true, true );

						$output .= '<img src="' . esc_url( $image ) . '" class="img-responsive wp-post-image" alt=""/>';

						$output .= '<div class="image-outer-hover">';
	        				$output .= '<div class="image-hover-wrapper">';
	        					$output .= '<div class="image-inner-wrapper">';
	        						$output .= '<h4 class="entry-title-hover">';
	        							$output .= '<a href="' . get_permalink() . '" rel="bookmark">';
	        								if (strlen($post->post_title) > 40) {
												$output .= substr(get_the_title($before = '', $after = '', FALSE), 0, 40) . '...'; 
											} else {
												$output .= get_the_title();
											}
	        							$output .= '</a>';
	        						$output .= '</h4>';
	        						if( $client ) $output .= '<div class="entry-client-hover"><i class="fa fa-handshake-o"></i> <span class="client-span">' . esc_attr($client) . '</span></div>';
	        						if (isset($adeetheming_options['portfolio-category']) && $adeetheming_options['portfolio-category'] ) {
	        							$output .= '<div class="category"><i class="fa fa-folder-open-o"></i><ul class="category-list">' . wp_kses_post($catlist) . '</ul></div>';
	        						}
	        						$output .= '<a href="' . get_the_post_thumbnail_url() . '" class="featured-inner-image" rel="bookmark"><i class="fa fa-camera"></i></a>';
	        						if($target) $target = '_blank';
	        						if($url) $output .= '<a href="' . esc_attr($url) . '" target="' . esc_attr($target) . '"><i class="fa fa-external-link"></i></a>';
	        						$output .= '<a href="' . get_permalink() . '" class="entry-project-link" rel="bookmark"><i class="fa fa-link"></i></a>';
	        					$output .= '</div>';
	        				$output .= '</div>';
	        			$output .= '</div>';
					$output .= '</div>';
				}
				$output .= '</article>';

				$output .= '</li>';
			}
			$output .= '</ul>';

			$output .= '</div>';

			$output .= '</div>';

			$output .= '</div>';

		}
		
		wp_reset_query();

		return $output;

	}

	add_shortcode('portfolioslide', 'portfolioslide_sc');
}



/* ---------------------------------------------------------------------------
* Pricing SC
* --------------------------------------------------------------------------- */
if (! function_exists('pricing_sc')) {
	function pricing_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'type'			=> 'classic',
			'column'		=> 3,
			'margin'		=> false,
			'class'			=> ''
			), $attr)
		);

		$style = array();
		if($type) $style[] = 'type_' .$type;
		if($column) $style[] = 'column_' .$column;
		if($margin == true) $style[] = 'margin_space';
		$style[] = $class;

		$style = implode(' ', $style);

		$output = '<div class="dc-sc-pricing pricing_wrap ' .$style. '">';

			$output .= do_shortcode($content);

		$output .= '</div>';

		return $output;
	}

	add_shortcode('pricing', 'pricing_sc');
}



/* ---------------------------------------------------------------------------
* Pricing Table SC
* --------------------------------------------------------------------------- */
if (! function_exists('pricing_table_sc')) {
	function pricing_table_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'icon_type'						=> 'icon',
			'icon'							=> 'fontawesome',
			'icon_fontawesome'				=> '',
            'icon_openiconic'				=> '',
            'icon_typicons'					=> '',
            'icon_entypo'					=> '',
            'icon_linecons'					=> '',
			'image'							=> '',
			'html'							=> '',
			'size'							=> 'medium',
			'title' 						=> '',
			'price' 						=> '',
			'duration' 						=> '',
			'feature_items'					=> '',
			'list_suffix' 					=> '',
			'alignment' 					=> 'center',
			'button_text' 					=> 'BUY NOW',
			'button_url' 					=> '#',
			'btn_bg' 						=> '',
			'btn_color' 					=> '',
			'background' 					=> '',
			'bg_image'		 				=> '',
			'color' 						=> '',
			'featured' 						=> '',
			'class' 						=> '',
			), $attr)
		);

		$btnstyle = $ret_icon = $output = $img_url = $img_src = '';
		$classes = $style = array();

		$size = (! empty($size)) ? 'priceicon_' .$size : '';

		$image = wp_get_attachment_image_src($image, 'full');
		if($image) $img_src = '<img src="' .$image[0]. '" alt="" />';

		vc_icon_element_fonts_enqueue( $icon );
		$iconClass = isset( ${'icon_' .$icon} ) ? '<i class="' .esc_attr( ${'icon_' .$icon} ). '"></i>' : '';

		$html = rawurldecode( base64_decode( strip_tags( $html ) ) );

		if ($icon_type == 'icon' && !empty($icon)) {
			$ret_icon = '<span class="pricing-icon ' .$size. '">' .$iconClass. '</span>';
		} elseif ($icon_type == 'image' && !empty($image)) {
			$ret_icon = '<span class="pricing-img ' .$size. '">' .$img_src. '</span>';
		} elseif ($icon_type == 'html' && !empty($html)) {
			$ret_icon = '<div class="pricing-html">' .$html. '</div>';
		}

		if($background) $style[] = 'background-color:' . pricing_adeethemingrgba($background, $background_transparency). ';';
		if($bg_image) $style[] = 'background-image: url(' . $src_image[0] . ');';

		if($color) $style[] = 'color:' . esc_attr( $color ) . ';';

		$style = implode(' ', $style);
		$style = 'style="' .$style. '"';

		if($featured) $classes[] = 'featured-price';
		$classes[] = $class;
		$classes = implode(' ', $classes);

		if($alignment) $alignment = 'style="text-align: ' .$alignment. ';"';

		$output .= '<div class="dc-sc-pricingtable ' .$classes. '" ' .$style.'>';
			$output .= '<div class="pricing-top">' .$ret_icon. '</div>';
			$output .= '<div class="pricing-header">';
				if($title) $output .= '<div class="pricing-title">' . esc_html( $title ) . '</div>';
			$output .= '</div>';

			$output .= '<div class="pricing-price-wrap">';
				if($price) $output .= '<span class="pricing-price">' . esc_attr( $price ) . '</span>';
				if($duration) $output .= '<span class="pricing-duration">/' . esc_attr( $duration ) . '</span>';
			$output .= '</div>';

			if($feature_items) {
				$output .= '<div class="pricing-features" ' .$alignment. '>';
					$output .= '<ul>';

					$features = rawurldecode( base64_decode( strip_tags( $feature_items ) ) );
					$features = explode("\n", $features);

					foreach ($features as $feature) {
						$output .= '<li>' . $feature . '</li>';
					}
		
					$output .= '</ul>';
				$output .= '</div>';
			}
			if ($list_suffix) {
				$output .= '<div class="pricing-suffix" ' .$alignment. '>';
					$output .= $list_suffix;
				$output .= '</div>';
			}
			if ($button_url) {
			if($btn_bg) $btnstyle .= 'background-color:' . esc_attr( $btn_bg ). ';';
			if($btn_color) $btnstyle .= 'color:' . esc_attr( $btn_color ) . ';';
			$output .= '<div class="pricing-footer">';
				$output .= '<a href="' . esc_url($button_url) . '" class="btn pricing-btn" style="'.$btnstyle.'">'. esc_attr( $button_text ) .'</a>';
				$output .= '</div>';
			}
		$output .= '</div>';

		return $output;
	}

	add_shortcode('pricing_table', 'pricing_table_sc');
}



/* ---------------------------------------------------------------------------
* Progress Bar SC
* --------------------------------------------------------------------------- */
if (! function_exists('progressbar_sc')) {
	function progressbar_sc($atts, $content = null) {

		extract(shortcode_atts(array(
			'title'					=> '',
			'value'					=> '',
			'min_value'				=> 0,
			'max_value'				=> 100,
			'height'				=> 'normal',
			'tip_symbol'			=> '%',
			'height'				=> '',
			'type'					=> '',
			'stripe'				=> '',
			'active'				=> '',
			'color'					=> '',
			'class'					=> '',
			), $atts)
		);


		$barclass = '';
		if ( $type ) $barclass = esc_attr( $type ) . ' ';
		if ( $stripe == true ) $barclass .= 'progress-bar-striped ';
		if ( $active == true ) $barclass .= 'active ';

		$barstyle = '';
		if ( $color ) $barstyle = 'style="background: ' . esc_attr( $color ) . '";';

    	$output = '<div class="dc-sc-progressbar '.$class.'">';
    	
    		$output .= '<div class="barWrapper">';
    			$output .= '<span class="progressText"><strong>' . esc_attr( $title ) . '</strong></span>';
    			$output .= '<div class="progress ' .$height. '">';
    				$output .= '<div class="progress-bar ' . esc_attr( $barclass ) . '" role="progressbar" aria-valuenow="' . esc_attr( $value ) . '" arial-valuemin="' . esc_attr( $min_value ) . '" aria-valuemax="' . esc_attr( $max_value ) . '">';

    					$output .= '<span class="popOver" data-toggle="tooltip" data-placement="top" title="' . esc_attr( $value ) . esc_attr( $tip_symbol ) . '"></span>';
    				$output .= '</div>';
    			$output .= '</div>';
    		$output .= '</div>';

		$output .= '</div>';


	return $output;

	}

	add_shortcode('progressbar', 'progressbar_sc');
}



/* ---------------------------------------------------------------------------
* Shop Slider SC
* --------------------------------------------------------------------------- */
if (! function_exists('shopslider_sc')) {
	function shopslider_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'category'		=> '',
			'count'			=> 6,
			'type'			=> 'classic',
			'display'		=> '',
			'time'			=> 5000,
			'hoverpause'	=> true,
			'navigation'	=> '',
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'class'			=> ''
			), $attr)
		);

		ob_start();

		$args = array(
			'post_type'			=> 'product',
			'posts_per_page'	=> intval($count),
			'paged'				=> -1,
			'orderby'			=> $orderby,
			'order'				=> $order
		);

		if($category) $args['product_cat']	= $category;

		switch ($display) {
			case 'featured':
				$args['meta_key'] = '_featured';
				$args['meta_value'] = 'yes';
				break;

			case 'top_rated':
				add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
				$args['meta_query'] = WC()->query->get_meta_query();
				break;

			case 'on_sale':
				$args['meta_query'] = WC()->query->get_meta_query();
				$args['post__in']	= array_merge( array( 0 ), wc_get_product_ids_on_sale() );
				break;

			case 'best_selling':
				$args['meta_key'] = 'total_sales';
				$args['orderby']	= 'meta_value_num';
				break;
			
			default:
				$args['meta_query'] = WC()->query->get_meta_query();
				break;
		}

		$classes = array();
		if($type) $classes[] = 'type_' .$type;
		if($class)	$classes[] = $class;

		$classes = implode(' ', $classes);

		$rel = array();
		if($time) $rel[] = 'data-time="' . $time . '"';
		if($hoverpause) $rel[] = 'data-pause="' . $hoverpause . '"';

		$rel = implode(' ', $rel);

		

		$shop_loop = new WP_Query($args);

		if ($shop_loop->have_posts()) { ?>

			<div class="shop-container dc-shop-slide <?php echo $classes; ?>">
				<div class="shop-wrapper clearfix">

					<?php if ($title) { ?>
						<div class="shop-title-wrap">
							<h4 class="shop-title"><?php echo $title ?></h4>
						</div>
					<?php } ?>

					<?php if (! empty($navigation)) { ?>
						<div class="prev-shop"><a href="javascript:void(0)"><i class="ion-ios-arrow-left"></i></a></div>
						<div class="next-shop"><a href="javascript:void(0)"><i class="ion-ios-arrow-right"></i></a></div>
					<?php } ?>

					<ul class="product-carousel" <?php echo $rel; ?>>
						<?php while ($shop_loop->have_posts()) {
							$shop_loop->the_post();
							global $woocommerce, $product;

							$class_item = implode(' ',get_post_class()); ?>

							<li class="dc-shop-list">
								<div class="<?php echo $class_item; ?>">
									<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

									<div class="product-thumbnail-outer">
										<a href="<?php the_permalink(); ?>">
											<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

											<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
										</a>
									</div>

									<div class="product-thumbnail-outer-inner">
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

										<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
									</div>
								</div>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<?php }

		wp_reset_query();

		$shopslider = ob_get_contents();
        ob_end_clean();
        
        return $shopslider;
	}

	add_shortcode('shopslider', 'shopslider_sc');
}



/* ---------------------------------------------------------------------------
* Spacer SC
* --------------------------------------------------------------------------- */
if (! function_exists('spacer_sc')) {
	function spacer_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'height'			=> '',
			'responsive'		=> '',
			'tabletheight'		=> '',
			'mobileheight'		=> '',
			'class'				=> '',
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-spacer');

		$classes = array();
		$classes[] = $customcss;
		if($class) $classes[] = $class;

		$classes = implode(' ', $classes);

		$output = '<div class="dc-sc-spacer clearfix ' .$classes. '"></div>';

		return $output;
	}

	add_shortcode('spacer', 'spacer_sc');
}



/* ---------------------------------------------------------------------------
* Table SC
* --------------------------------------------------------------------------- */
if (! function_exists('table_sc')) {
	function table_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'row'			=> 3,
			'column'		=> 5,
			'style'			=> 'classic',
			'class'			=> ''
			), $attr)
		);

		$output = '<div class"dc-sc-table table_' .$style. ' ' .$class. '">';
			if($title) $output = '<h4 class="table-title">' .$title. '</h4>';

			$output .= '<table>';
				for ($i=0; $i < count($row); $i++) { 
					$output .= '<tr>';
						for ($x=0; $x < count($column); $x++) { 
							$output .= '<td>Row ' .$row. ' Column ' .$column. '</td>';
						}
					$output .= '</tr>';
				}
			$output .= '</table>';
		$output .= '</div>';

		return $output;
	}

	add_shortcode('table', 'table_sc');
}



/* ---------------------------------------------------------------------------
* Tabs SC
* --------------------------------------------------------------------------- */
if (! function_exists('tabs_sc')) {
	function tabs_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'type'			=> 'horizontal',
			'style'			=> 'style1',
			'color'			=> '',
			'background'	=> '',
			'activecolor'	=> '',
			'activebgcolor'	=> '',
			'hposition'		=> 'top',
			'vposition'		=> 'left',
			'alignment'		=> 'left',
			'active'		=> 1,
			'class'			=> ''
			), $attr)
		);

		global $tab_title, $tab_content, $tab_count;

		do_shortcode($content);

		$uniqid = uniqid(rand(1,9999));

		$classes = '';

		$classes[] = $class;

		$classes[] = ($type === 'horizontal' && !empty($hposition)) ? 'tabs_position_' .$hposition : '';

		$classes[] = ($type === 'vertical' && !empty($vposition)) ? 'tabs_position_' .$vposition : '';

		$classes[] = ($type === 'horizontal' && !empty($alignment)) ? 'tabs_alignment_' .$alignment : '';

		$classes = implode(' ', $classes);

		$active = (count($tab_title) >= intval($active)) ? $active : 1;

		if($title) $output = '<h4 class="tabs-title">' .$title. '</h4>';

		$output .= '<div class="dc-sc-tabs tabs_' .$type. ' tabs_style_' .$style.$classes. '">';

			$i = $x = 1;

			if($hposition !== 'bottom') {

				$output .= '<ul class="tabs-title-wrap">';

					foreach ($tab_title as $tab_nav) {

						$tabs_uid = ' href="#' .$uniqid. '-' .$i. '"';

						$active_tab = ($active == $i) ? ' active' : '';

						$output .= '<li class="tab-title-list ' .$active_tab. '"><a' .$tabs_uid. '>' .$tab_nav. '</a></li>';

						$i++;
					}
				$output .= '</ul>';
			}

			foreach ($tab_content as $detail) {
				
				$tabs_uid = ' id="' .$uniqid. '-' .$x. '"';

				$active_tab = ($active == $x) ? ' active' : '';

				$output .= '<div' .$tabs_uid. ' class="tab-content ' .$active_tab. '">' .do_shortcode($detail). '</div>';

				$x++;
			}

			if($type === 'horizontal' && $hposition === 'bottom') {

				$output .= '<ul class="tabs-title-wrap">';

					foreach ($tab_title as $tab_nav) {

						$tabs_uid = ' href="#' .$uniqid. '-' .$i. '"';

						$active_tab = ($active == $i) ? ' active' : '';

						$output .= '<li class="tab-title-list ' .$active_tab. '"><a' .$tabs_uid. '>' .$tab_nav. '</a></li>';

						$i++;
					}
				$output .= '</ul>';
			}

		$output .= '</div>';

		$tab_title = $tab_content = '';
		$tab_count = 0;

		return $output;
	}

	add_shortcode('tabs', 'tabs_sc');
}



/* ---------------------------------------------------------------------------
* Tab Item SC
* --------------------------------------------------------------------------- */
$tab_count = 0;
if (! function_exists('tab_sc')) {
	function tab_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'display'			=> 'title_only',
			'title'				=> '',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
			'image'				=> '',
			'size'				=> '',
			'arrangement'		=> 'icon_before_title'
			), $attr)
		);

		global $tab_title, $tab_content, $tab_count;
		
		if($title) $title = '<span class="dc-tab-title">' .$title. '</span>';

		vc_icon_element_fonts_enqueue( $icon );
		$iconClass = isset( ${'icon_' .$icon} ) ? '<span class="dc-tab-icon"><i class="' .esc_attr( ${'icon_' .$icon} ). '"></i></span>' : '';

		$size = (! empty(intval($size))) ? $size : 32;

		$image = wp_get_attachment_image_src( $image,'thumbnail');
		if($image) $img_src = '<span class="dc-tab-image"><img src="' .$image[0]. '" alt="" width="' .$size. '" height="' .$size. '"/></span>';

		$element_set = '';

		switch ($display) {
			case 'icon_title':
				if ($arrangement == 'title_before_icon') {
					$element_set = $title. ' ' .$iconClass;
				} else {
					$element_set = $iconClass. ' ' .$title;
				}
				break;

			case 'image_title':
				if ($arrangement === 'title_before_image') {
					$element_set = $title. ' ' .$img_src;
				} else {
					$element_set = $img_src. ' ' .$title;
				}
				break;
			
			case 'icon_only':
				$element_set = $iconClass;
				break;

			case 'image_only':
				$element_set = $img_src;
				break;

			default:
				$element_set = $title;
				break;
		}

		$tab_title[] = $element_set;
		$tab_content[] = do_shortcode($content);

		$tab_count++;

		return true;
	}

	add_shortcode('tab', 'tab_sc');
}



/* ---------------------------------------------------------------------------
* Teams Grid SC
* --------------------------------------------------------------------------- */
if (! function_exists('teams_grid_sc')) {
	function teams_grid_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'column'		=> 3,
			'category'		=> '',
			'bio'			=> true,
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'class'			=> ''
			), $attr)
		);

		$args = array(
			'post_type'			=> 'teams',
			'posts_per_page'	=> -1,
			'orderby'			=> $orderby,
			'order'				=> $order
		);

		$prefix = 'adee_';

		if($category) $args['teams-category']	= $category;

		$classes = array();
		if($bio == true) $classes[] = 'show-bio';
		if($class)	$classes[] = $class;

		$classes = implode(' ', $classes);

		$uniqid = 'dc-teams' . uniqid(rand(1,9999));

		$teams_loop = new WP_Query($args);

		if ($teams_loop->have_posts()) {

			$output = '<div class="teams-container teams-grid ' .$classes. '">';
				$output .= '<div class="teams-wrapper clearfix">';

					if ($title) {
						$output .= '<div class="teams-title-wrap">';
							$output .= '<h4 class="teams-title">' .$title. '</h4>';
						$output .= '</div>';
					}

					$i = $x = 1;

					$column = round((100/intval($column) - 2), 5);
					$style = 'style="width: ' .$column. '%;"';

					//Teams Short Biodata
					$output .= '<div class="teamsbrief-wrapper">';
						$output .= '<ul class="teamsbrief-ul">';
							while ($teams_loop->have_posts()) {
								$teams_loop->the_post();

								$position = get_post_meta(get_the_ID(), $prefix . 'staff_position', true);
								$groups = get_post_meta(get_the_ID(), $prefix . 'teams_group', true);
								$target = get_post_meta(get_the_ID(), $prefix . 'link_target', true);
								$quote = get_post_meta(get_the_ID(), $prefix . 'favquote', true);

								$output .= '<li class="team_list list-' . round($column) . '" '. $style .'>';
									$output .= '<div class="team-item-wrap">';
										$output .= '<a href="#team-details-'. $uniqid.$x . '" class="team-anchor">';
											$output .= '<div class="team-inner-wrap">';

												$thumb   = get_post_thumbnail_id();
												$img_url = wp_get_attachment_url( $thumb,'full');
												$image   = aq_resize( $img_url, 700, 750, true, true, true );

												$output .= '<img src="' . esc_url( $image ) . '" class="img-responsive wp-post-image" alt=""/>';

											$output .= '</div>';
										$output .= '</a>';

										$output .= '<div class="team-short-desc">';
											$output .= '<div class="team-name">';
												$output .= '<a href="#team-details-'. $uniqid.$x . '" class="team-anchor">';
													$output .= '<h4 class="member-name">' . get_the_title() . '</h4>';
												$output .= '</a>';
												$output .= '<span class="team-position">' . $position . '</span>';
											$output .= '</div>';

											if($quote) $output .= '<div class="teamhr-separator"></div>';

											$output .= '<div class="favquote">';
												if (strlen($quote) > 90) {
													$output .= '<blockquote>' . substr($quote, 0, 90) . '... </blockquote>'; 
												} else {
													$output .= '<blockquote>' . $quote . '</blockquote>';
												}
											$output .= '</div>';
										$output .= '</div>';

										$output .= '<div class="team-social">';
											if ($target) $target = 'target="_blank"';

											$output .= '<ul class="team-social-ul">';
												foreach ($groups as $group) {
													$social = $group[$prefix . 'social_site'];
													$link = $group[$prefix . 'social_link'];

													if ($link) $output .= '<li class="' . $social . '"><a ' . $target . ' href="' . $link . '" title="' . $social . '"><i class="fa fa-' .$social . '"></i></a></li>';
												}
											$output .= '</ul>';
										$output .= '</div>';

									$output .= '</div>';
								$output .= '</li>';

								$x++;
							}
						$output .= '</ul>';
					$output .= '</div>';//Team Short Biodata Ends

					//Popout Team Full Biodata
					if($bio == true) {
					$output .= '<div class="team-info">';
						$output .= '<ul class="team-biodata-ul">';

							while ($teams_loop->have_posts()) {
								$teams_loop->the_post();

								$position = get_post_meta(get_the_ID(), $prefix . 'staff_position', true);
								$groups = get_post_meta(get_the_ID(), $prefix . 'teams_group', true);
								$target = get_post_meta(get_the_ID(), $prefix . 'link_target', true);
								$quote = get_post_meta(get_the_ID(), $prefix . 'favquote', true);
								$phone = get_post_meta(get_the_ID(), $prefix . 'phone', true);
								$email = get_post_meta(get_the_ID(), $prefix . 'email', true);

								$output .= '<li class="team-biodata-list">';
									$output .= '<div id="team-details-' . $uniqid.$i . '" class="team-bio-wrap">';
										
										$output .= '<a href="#'. $uniqid .'" class="close">Close</a>';

										$output .= '<div class="team-group-top">';
											$output .= '<div class="team-image-wrap">';

												$thumb   = get_post_thumbnail_id();
												$img_url = wp_get_attachment_url( $thumb,'full');
												$image   = aq_resize( $img_url, 700, 720, true, true, true );

												$output .= '<img src="' . esc_url( $image ) . '" class="img-responsive wp-post-image" alt=""/>';
											$output .= '</div>';

											$output .= '<div class="teaminfo-wrap">';
												$output .= '<div class="teaminfo-name">';
													$output .= '<h4 class="teammember-name">' . get_the_title() . '</h4>';
													$output .= '<span class="teaminfo-position">' . $position . '</span>';
												$output .= '</div>';

												if($phone || $email) $output .= '<div class="teamhr-separator"></div>';

												if($phone || $email) $output .= '<div class="teaminfo-contact">';
													if($phone) $output .= '<span class="teaminfo-phone"><i class="fa fa-phone"></i><a href="tel:'. str_replace(' ', '', $phone) . '">' . $phone . '</a></span>';
													if($email) $output .= '<span class="teaminfo-email"><i class="fa fa-envelope"></i><a href="mailto:'. str_replace(' ', '', $email) . '">' . $email . '</a></span>';
												if($phone || $email) $output .= '</div>';

												if($quote) $output .= '<div class="teamhr-separator"></div>';

												if($quote) {
													$output .= '<div class="favquote">';
														$output .= '<blockquote>' . $quote . '</blockquote>';
													$output .= '</div>';
												}

												$output .= '<div class="team-social">';
													if ($target) $target = 'target="_blank"';

													$output .= '<ul class="team-social-ul">';
														foreach ($groups as $group) {
															$social = $group[$prefix . 'social_site'];
															$link = $group[$prefix . 'social_link'];

															if ($link) $output .= '<li class="' . $social . '"><a ' . $target . ' href="' . $link . '" title="' . $social . '"><i class="fa fa-' .$social . '"></i></a></li>';
														}
													$output .= '</ul>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</div>';

										$output .= '<div class="teaminfo-desc">';
											$output .= get_the_content();
										$output .= '</div>';

									$output .= '</div>';
								$output .= '</li>';

								$i++;
							}
						$output .= '</ul>';
					$output .= '</div>';
					}//Full Biodata Ends

				$output .= '</div>';
			$output .= '</div>';
		}

		wp_reset_query();

		return $output;
	}

	add_shortcode('teams_grid', 'teams_grid_sc');
}



/* ---------------------------------------------------------------------------
* Teams Slide SC
* --------------------------------------------------------------------------- */
if (! function_exists('teams_slide_sc')) {
	function teams_slide_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'category'		=> '',
			'count'			=> 6,
			'time'			=> 5000,
			'hoverpause'	=> true,
			'navigation'	=> '',
			'bio'			=> true,
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'class'			=> ''
			), $attr)
		);

		$args = array(
			'post_type'			=> 'teams',
			'posts_per_page'	=> intval($count),
			'orderby'			=> $orderby,
			'order'				=> $order
		);

		$prefix = 'adee_';

		if($category) $args['teams-category']	= $category;

		$classes = array();
		if($bio == true) $classes[] = 'show-bio';
		if($class)	$classes[] = $class;

		$classes = implode(' ', $classes);

		$rel = array();
		if($time) $rel[] = 'data-time="' . $time . '"';
		if($hoverpause) $rel[] = 'data-pause="' . $hoverpause . '"';

		$rel = implode(' ', $rel);

		$uniqid = 'dc-teams' . uniqid(rand(1,9999));

		$teams_loop = new WP_Query($args);

		if ($teams_loop->have_posts()) {

			$output = '<div class="teams-container teams-slide ' .$classes. '">';
				$output .= '<div class="teams-wrapper clearfix">';

					if ($title) {
						$output .= '<div class="teams-title-wrap">';
							$output .= '<h4 class="teams-title">' .$title. '</h4>';
						$output .= '</div>';
					}

					if (! empty($navigation)) {
						$output .= '<div class="prev-team"><a href="javascript:void(0)"><i class="ion-ios-arrow-left"></i></a></div>';
						$output .= '<div class="next-team"><a href="javascript:void(0)"><i class="ion-ios-arrow-right"></i></a></div>';
					}

					$i = $x = 1;

					//Teams Short Biodata
					$output .= '<div class="teamsbrief-wrapper">';
						$output .= '<ul class="teamsbrief-ul" ' .$rel. '>';
							while ($teams_loop->have_posts()) {
								$teams_loop->the_post();

								$position = get_post_meta(get_the_ID(), $prefix . 'staff_position', true);
								$groups = get_post_meta(get_the_ID(), $prefix . 'teams_group', true);
								$target = get_post_meta(get_the_ID(), $prefix . 'link_target', true);
								$quote = get_post_meta(get_the_ID(), $prefix . 'favquote', true);

								$output .= '<li class="team_list list-slide">';
									$output .= '<div class="team-item-wrap">';
										$output .= '<a href="#team-details-'. $uniqid.$x . '" class="team-anchor">';
											$output .= '<div class="team-inner-wrap">';

												$thumb   = get_post_thumbnail_id();
												$img_url = wp_get_attachment_url($thumb,'full');
												$image   = aq_resize( $img_url, 700, 750, true, true, true );

												$output .= '<img src="' . esc_url( $image ) . '" class="img-responsive wp-post-image" alt=""/>';

											$output .= '</div>';
										$output .= '</a>';

										$output .= '<div class="team-short-desc">';
											$output .= '<div class="team-name">';
												$output .= '<a href="#team-details-'. $uniqid.$x . '" class="team-anchor">';
													$output .= '<h4 class="member-name">' . get_the_title() . '</h4>';
												$output .= '</a>';
												$output .= '<span class="team-position">' . $position . '</span>';
											$output .= '</div>';

											if($quote) $output .= '<div class="teamhr-separator"></div>';

											$output .= '<div class="favquote">';
												if (strlen($quote) > 90) {
													$output .= '<blockquote>' . substr($quote, 0, 90) . '... </blockquote>'; 
												} else {
													$output .= '<blockquote>' . $quote . '</blockquote>';
												}
											$output .= '</div>';
										$output .= '</div>';

										$output .= '<div class="team-social">';
											if ($target) $target = 'target="_blank"';

											$output .= '<ul class="team-social-ul">';
												foreach ($groups as $group) {
													$social = $group[$prefix . 'social_site'];
													$link = $group[$prefix . 'social_link'];

													if ($link) $output .= '<li class="' . $social . '"><a ' . $target . ' href="' . $link . '" title="' . $social . '"><i class="fa fa-' .$social . '"></i></a></li>';
												}
											$output .= '</ul>';
										$output .= '</div>';

									$output .= '</div>';
								$output .= '</li>';

								$x++;
							}
						$output .= '</ul>';
					$output .= '</div>';//Team Short Biodata Ends


					//Popout Team Full Biodata
					if($bio == true) {
					$output .= '<div class="team-info">';
						$output .= '<ul class="team-biodata-ul">';

							while ($teams_loop->have_posts()) {
								$teams_loop->the_post();

								$position = get_post_meta(get_the_ID(), $prefix . 'staff_position', true);
								$groups = get_post_meta(get_the_ID(), $prefix . 'teams_group', true);
								$target = get_post_meta(get_the_ID(), $prefix . 'link_target', true);
								$quote = get_post_meta(get_the_ID(), $prefix . 'favquote', true);
								$phone = get_post_meta(get_the_ID(), $prefix . 'phone', true);
								$email = get_post_meta(get_the_ID(), $prefix . 'email', true);

								$output .= '<li class="team-biodata-list">';
									$output .= '<div id="team-details-' . $uniqid.$i . '" class="team-bio-wrap">';
										
										$output .= '<a href="#'. $uniqid .'" class="close">Close</a>';

										$output .= '<div class="team-group-top">';
											$output .= '<div class="team-image-wrap">';

												$thumb   = get_post_thumbnail_id();
												$img_url = wp_get_attachment_url( $thumb,'full');
												$image   = aq_resize( $img_url, 700, 720, true, true, true );

												$output .= '<img src="' . esc_url( $image ) . '" class="img-responsive wp-post-image" alt=""/>';
											$output .= '</div>';

											$output .= '<div class="teaminfo-wrap">';
												$output .= '<div class="teaminfo-name">';
													$output .= '<h4 class="teammember-name">' . get_the_title() . '</h4>';
													$output .= '<span class="teaminfo-position">' . $position . '</span>';
												$output .= '</div>';

												if($phone || $email) $output .= '<div class="teamhr-separator"></div>';

												if($phone || $email) $output .= '<div class="teaminfo-contact">';
													if($phone) $output .= '<span class="teaminfo-phone"><i class="fa fa-phone"></i><a href="tel:'. str_replace(' ', '', $phone) . '">' . $phone . '</a></span>';
													if($email) $output .= '<span class="teaminfo-email"><i class="fa fa-envelope"></i><a href="mailto:'. str_replace(' ', '', $email) . '">' . $email . '</a></span>';
												if($phone || $email) $output .= '</div>';

												if($quote) $output .= '<div class="teamhr-separator"></div>';

												if($quote) {
													$output .= '<div class="favquote">';
														$output .= '<blockquote>' . $quote . '</blockquote>';
													$output .= '</div>';
												}

												$output .= '<div class="team-social">';
													if ($target) $target = 'target="_blank"';

													$output .= '<ul class="team-social-ul">';
														foreach ($groups as $group) {
															$social = $group[$prefix . 'social_site'];
															$link = $group[$prefix . 'social_link'];

															if ($link) $output .= '<li class="' . $social . '"><a ' . $target . ' href="' . $link . '" title="' . $social . '"><i class="fa fa-' .$social . '"></i></a></li>';
														}
													$output .= '</ul>';
												$output .= '</div>';
											$output .= '</div>';
										$output .= '</div>';

										$output .= '<div class="teaminfo-desc">';
											$output .= get_the_content();
										$output .= '</div>';

									$output .= '</div>';
								$output .= '</li>';

								$i++;
							}
						$output .= '</ul>';
					$output .= '</div>';
					}//Full Biodata Ends

				$output .= '</div>';
			$output .= '</div>';
		}

		wp_reset_query();

		return $output;
	}

	add_shortcode('teams_slide', 'teams_slide_sc');
}



/* ---------------------------------------------------------------------------
* Testimonials SC
* --------------------------------------------------------------------------- */
if (! function_exists('testimonials_sc')) {
 	function testimonials_sc( $attr, $content = null ) {
 		extract(shortcode_atts(array(
 			'title'			=> '',
 			'type'			=> 'slide',
 			'time'			=> 5000,
 			'hoverpause'	=> true,
 			'category'		=> '',
 			'orderby'		=> 'date',
 			'order'			=> 'DESC',
 			'class'			=> ''
 		), $attr) );

 		$prefix = 'adee_';

		$args = array(
			'post_type'			=> 'testimonial',
			'posts_per_page'	=> -1,
			'orderby'			=> $orderby,
			'order'				=> $order,
		);

		if($category) $args['testimonial-category'] = $category;

		global $post;

		$style = array();
		if ($type == 'slide') $style[] = 'slide-element';
		if ($type == 'list') $style[] = 'list-element';
		$style[] = $class;

		$style = implode(' ', $style);

		$rel = array();
		if($type == 'slide') $rel[] = 'data-time="' . $time . '"';
		if($type == 'slide') $rel[] = 'data-pause="' . $hoverpause . '"';

		$rel = implode(' ', $rel);

		$testimonial_loop = new WP_Query($args);
		
		if ($testimonial_loop->have_posts()) {
			$output = '<div class="testimonial-container testimonial-' .$style. '">';

				$output .= '<div class="testimonial-wrap testimonial-' . $type . '">';

					if ($type == 'slide') {
						$output .= '<div class="prev-testimonial"><a href="javascript:void(0)"><i class="ion-ios-arrow-left"></i></a></div>';
					}

					$output .= '<ul class="dc-sc-testimonial clearfix ' . $style . '" ' . $rel .'>';
						while ($testimonial_loop->have_posts()) {
							$testimonial_loop->the_post();

							$company = get_post_meta(get_the_ID(), $prefix . 'testimonial_company', true);
							$link = get_post_meta(get_the_ID(), $prefix . 'testimonial_url', true);
							$target = get_post_meta(get_the_ID(), $prefix . 'testimonial_url_target', true);
							if($target) $target = 'target="_blank"';
							$location = get_post_meta(get_the_ID(), $prefix . 'testimonial_location', true);

							if (has_post_thumbnail($post->ID)) $image = get_the_post_thumbnail(null, 'testimonial-thumb', array('class' => 'img-responsive') );

							$output .= '<li class="testimonial-item testimonial-item-' . $type . '">';
								$output .= '<div class="testimonial-content-wrapper">';
									$output .= '<i class="fa fa-quote-left"></i>';

									$output .= '<div class="testimonial-desc">';
										$output .= '<blockquote>' . get_the_content() . '</blockquote>';
									$output .= '</div>';
								$output .= '</div>';

								$output .= '<div class="testimonial-author">';
									$output .= '<div class="image_wrap">';
										$output .= $image;
									$output .= '</div>';

									$output .= '<div class="company-details">';
										$output .= '<h5 class="testimonial-name">' . the_title(false, false, false) . '</h5>';
										if($link) {
											$output .= '<span class="company"><a href="' . $link . '" ' . $target .'>' . $company . '</a></span>';
										} else {
											$output .= '<span class="company">' . $company . '</span>';
										}
										$output .= '<span class="location">' . $location . '</span>';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</li>'; 
						}
				
					$output .= '</ul>';

					if ($type == 'slide') {
						$output .= '<div class="next-testimonial"><a href="javascript:void(0)"><i class="ion-ios-arrow-right"></i></a></div>';
					}
				$output .= '</div>';
			$output .= '</div>';
		}
		wp_reset_query();

		return $output;

 	}

 	add_shortcode('testimonials', 'testimonials_sc');
}



/* ---------------------------------------------------------------------------
* Timeline SC
* --------------------------------------------------------------------------- */
if (! function_exists('timeline_sc')) {
	function timeline_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'type'			=> 'classic',
			'class'			=> '',
			), $attr)
		);

		$output = '<div class="timeline_wrap dc-sc-timeline ' .$class. ' type-' .$type. '">';

			if ($title) $output .= '<h4 class="timeline-title">' .$title. '</h4>';


			$output .= '<div class="timeline_cover">';

				$output .= do_shortcode($content);

			$output .= '</div>';

		$output .= '</div>';

		return $output;
	}

	add_shortcode('timeline', 'timeline_sc');
}



/* ---------------------------------------------------------------------------
* Timeline Item SC
* --------------------------------------------------------------------------- */
if (! function_exists('timeline_item_sc')) {
	function timeline_item_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'heading'			=> '',
			'icontype'			=> 'icon',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
			'image'				=> '',
			'size'				=> 24,
			'date'				=> '',
			'link_text'			=> 'Learn More...',
			'link'				=> '',
			'target'			=> '',
			'background'		=> '',
			'bg_image'			=> '',
			'color'				=> '',
			'hd_color'			=> '',
			'hd_size'			=> '',
			'icon_color'		=> '',
			'icon_bg_color'		=> '',
			'btn_color'			=> '',
			'btn_txt_color'		=> '',
			), $attr)
		);

		$bgstyle = $icstyle = $hdstyle = $btnstyle = array();
		//Background Style
		$bgimage_scr = wp_get_attachment_image_src( $bg_image, 'full' );
		if ($bg_image) $bgstyle[] = 'background-image: url(' . $bgimage_scr[0] . ');';
		$bgstyle = implode(' ', $bgstyle);
		if (! empty($bgstyle)) $bgstyle = 'style="' .$bgstyle. '"';

		//Icon Style
		if ($icon_color) $icstyle[] = 'color: ' .$icon_color. ';';
		if ($icon_bg_color) $icstyle[] = 'background: ' .$icon_bg_color. ';';
		if ($icontype == 'icon') $icstyle[] = 'font-size: ' .$size. 'px;';
		$icstyle = implode(' ', $icstyle);
		if (! empty($icstyle)) $icstyle = 'style="' .$icstyle. '"';

		//Heading Style
		if ($hd_color) $hdstyle[] = 'color: ' .$hd_color. ';';
		if ($hd_size) $hdstyle[] = 'font-size: ' .$hd_size. ';';
		$hdstyle = implode(' ', $hdstyle);
		if (! empty($hdstyle)) $hdstyle = 'style="' .$hdstyle. '"';

		//Button Style
		if ($btn_txt_color) $btnstyle[] = 'color: ' .$btn_txt_color. ';';
		if ($btn_color) $btnstyle[] = 'background: ' .$btn_color. ';';
		$btnstyle = implode(' ', $btnstyle);
		if (! empty($btnstyle)) $btnstyle = 'style="' .$btnstyle. '"';

		if ($color) $color = 'style="color: ' .$color. ';"';
		if ($background) $background = 'style="background: ' . $background . ';"';

		$target = ($target == 'blank') ? 'target="_blank"' : '';

		vc_icon_element_fonts_enqueue( $icon );
		$iconClass = isset( ${'icon_' .$icon} ) ? '<span class="dc-timeline-icon" ' .$icstyle. '><i class="' .esc_attr( ${'icon_' .$icon} ). '"></i></span>' : '';

		$image = wp_get_attachment_image_src( $image,'thumbnail');
		if($image) $image = '<span class="dc-timeline-image" ' .$icstyle. '><img src="' .$image[0]. '" alt="" width="' .$size. '" height="' .$size. '"/></span>';

		$output = '<div class="timeline-item-wrap dc-timeline-item" ' .$bgstyle. '>';
			$output .= '<div class="timeline-icon-wrap">';
				if ($icontype == 'image') {
					$output .= $image;
				} else {
					$output .= $iconClass;
				}
			$output .= '</div>';

			$output .= '<span class="timeline-date">';
				$output .= $date;
			$output .= '</span>';

			$output .= '<div class="timeline-box" '.$background.'>';
				$output .= '<h4 class="timeline-headiing" ' .$hdstyle. '>' .$heading. '</h4>';
				$output .= '<div class="timeline-content" ' .$color. '>';
					$output .= do_shortcode($content);
				$output .= '</div>';
				$output .= '<a href="' .esc_url($link). '" ' .$target. ' class="btn btn-link timeline-btn" ' .$btnstyle. '>';
					$output .= '<span class="btn-title">' .$link_text. '</span>';
				$output .= '</a>';
			$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	add_shortcode('timeline_item', 'timeline_item_sc');
}



/* ---------------------------------------------------------------------------
* Toggle SC
* --------------------------------------------------------------------------- */
if (! function_exists('toggle_sc')) {
	function toggle_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'style'			=> 'style1',
			'icons'			=> 'fa-plus',
			'icons_align'	=> 'right',
			'color'			=> '',
			'activateall'	=> 'yes',
			'class'			=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-toggle');

		$classes = array();

		$classes[] = $class;
		$classes[] = $customcss;
		$classes[] = 'style_' .$style;
		$classes[] = 'icons_' .$icons;
		$classes[] = 'icons_align_' .$icons_align;
		$classes[] = ($activateall == 'yes') ? 'activateall' : '';

		$classes = implode(' ', $classes);

		$output = '<div class="toggle_wrap dc-sc-toggle ' .$classes. '">';

			if ($title) $output .= '<h4 class="toggle-title">' .$title. '</h4>';


			$output .= '<div class="toggle_cover">';

				$output .= do_shortcode($content);

			$output .= '</div>';

		$output .= '</div>';

		return $output;
	}

	add_shortcode('toggle', 'toggle_sc');
}



/* ---------------------------------------------------------------------------
* Toggle Item SC
* --------------------------------------------------------------------------- */
if (! function_exists('toggle_item_sc')) {
	function toggle_item_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'display'			=> 'title_only',
			'title'				=> '',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
			'image'				=> '',
			'size'				=> '',
			'arrangement'		=> 'icon_before_title'
			), $attr)
		);
		
		if($title) $title = '<span class="dc-toggle-title">' .$title. '</span>';

		vc_icon_element_fonts_enqueue( $icon );

		$iconClass = isset( ${'icon_' .$icon} ) ? '<span class="dc-toggle-icon"><i class="' .esc_attr( ${'icon_' .$icon} ). '"></i></span>' : '';

		$size = (! empty(intval($size))) ? $size : 32;

		$image = wp_get_attachment_image_src( $image,'full');
		if($image) $img_src = '<span class="dc-toggle-image"><img src="' .$image[0]. '" alt="" width="' .$size. '" height="' .$size. '"/></span>';

		$element_set = '';

		switch ($display) {
			case 'icon_title':
				if ($arrangement == 'title_before_icon') {
					$element_set = $title. ' ' .$icon;
				} else {
					$element_set = $icon. ' ' .$title;
				}
				break;

			case 'image_title':
				if ($arrangement === 'title_before_image') {
					$element_set = $title. ' ' .$img_src;
				} else {
					$element_set = $img_src. ' ' .$title;
				}
				break;
			
			case 'icon_only':
				$element_set = $icon;
				break;

			case 'image_only':
				$element_set = $img_src;
				break;

			default:
				$element_set = $title;
				break;
		}

		$output = '<div class="toggle-item-wrap">';

			$output .= '<div class="toggle-title-wrap">' .$element_set. '</div>';

			$output .= '<div class="toggle-content">' .do_shortcode($content). '</div>';

		$output .= '</div>';

		return $output;
	}

	add_shortcode('toggle_item', 'toggle_item_sc');
}


/* ---------------------------------------------------------------------------
* Tooltip SC
* --------------------------------------------------------------------------- */
if (! function_exists('tooltip_sc')) {
	function tooltip_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'type'			=> 'tooltip',
			'placement'		=> 'top',
			'title'			=> '',
			'content'		=> '',
			'class'			=> ''
		), $attr) );

		$attributes = array();

		if($placement) $attributes[] = 'data-placement="' .$placement. '"';

		if($type) $attributes[] = 'data-toggle="' .$type. '"';

		if($title) $attributes[] = 'data-original-title="' .$title. '"';

		if($content) $attributes[] = 'data-content="' .$content. '"';

		$classes = '';
		$classes .= ' ' . $class;

		$attributes[] = 'class="dc-sc-' .$type. ' '. $classes . '"';

		$output = '<span ' . implode(' ', $attributes) . '>';
			$output .= do_shortcode($content);
		$output .= '</span>';

		return $output;
	}

	add_shortcode('tooltip', 'tooltip_sc');
}



/* ---------------------------------------------------------------------------
* Video Player SC
* --------------------------------------------------------------------------- */
if (! function_exists('videoplayer_sc')) {
	function videoplayer_sc( $attr, $content = null ) {
		extract(shortcode_atts(array(
			'type'				=> 'normal',
			'width'				=> '100',
			'ratio'				=> 'embed-responsive-16by9',
			'video'				=> '',
			'align'				=> 'center',
			'icon_type'			=> 'icon',
			'icon'				=> 'fontawesome',
			'icon_fontawesome'	=> '',
            'icon_openiconic'	=> '',
            'icon_typicons'		=> '',
            'icon_entypo'		=> '',
            'icon_linecons'		=> '',
			'image'				=> '',
			'size'				=> 84,
			'title'				=> '',
			'textalign'			=> 'center',
			'buttons'			=> 'Watch Video',
			'color'				=> '',
			'btn_background'	=> '',
			'background'		=> '',
			'bg_image'			=> '',
			'padding'			=> '',
			'class'				=> ''
			), $attr)
		);

		$customcss = adeetheming_uniqclass('dc-custom-videoplayer');

		global $wp_embed;

		$embed = '';
		$video_w = 500;
		$video_h = $video_w / 1.61;
		if ( is_object( $wp_embed ) ) {
			$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '" height="' . $video_h . '"]' .esc_url($video). '[/embed]' );
		}

		$classes = $btnstyle = $bgstyle = array();
		if($type == 'normal' && $align) $classes[] = 'align_' .$align;
		if($type == 'normal' && $ratio) $classes[] = 'embed-responsive ' .$ratio;
		if($type !== 'normal') $classes[] = 'popup-video-wrap mfp-hide';
		$classes[] = $customcss;
		if($class) $classes[] = $class;
		$classes = implode(' ', $classes);

		vc_icon_element_fonts_enqueue( $icon );
		$icon = isset( ${'icon_' .$icon} ) ? '<i class="' .esc_attr( ${'icon_' .$icon} ). '"></i>' : '';

		$image = wp_get_attachment_image_src( $image,'thumbnail');
		if($image) $image = '<span class="dc-video-image" ' .$icstyle. '><img src="' .$image[0]. '" alt="" width="' .$size. '" height="' .$size. '" /></span>';

		$bg_image = wp_get_attachment_image_src( $bg_image,'full');
		if($bg_image) $bg_image = $bg_image[0];

		$uniqid = uniqid(rand(1,9999));

		$output = '<div class="video_wrap dc-sc-video">';
			if ($type == 'buttons') {
				if($color) $btnstyle[] = 'color:' .$color .';';
				if($btn_background) $btnstyle[] = 'background:' .$btn_background .';';
				$btnstyle = 'style="' .implode(' ', $btnstyle). '"';

				$output .= '<a href="#video_' .$uniqid. '" class="btn btn-link video-btn dc-open-video" ' .$btnstyle. '>';
					$output .= $buttons;
				$output .= '</a>';
			}

			if ($type == 'popup') {
				if($color) $bgstyle[] = 'color:' .$color .';';
				if($textalign) $bgstyle[] = 'text-align:' .$textalign. ';';
				if($background) $bgstyle[] = 'background-color:' .$background .';';
				if($bg_image) $bgstyle[] = 'background: url(' .$bg_image. ');';
				if($padding) $bgstyle[] = 'padding:' .$padding. ';';
				$bgstyle = 'style="' .implode(' ', $bgstyle). '"';

				$icstyle = 'style="font-size:' .$size. 'px;"';

				$output .= '<div class="video-bg-wrap" ' .$bgstyle. '>';
					$output .= '<a href="#video_' .$uniqid. '" class="video-open-wrap dc-open-video">';
						if ($icon_type == 'image') {
							$output .= $image;
						} else {
							$output .= '<span class="dc-video-icon" ' .$icstyle. '>';
								$output .= $icon;
							$output .= '</span>';
						}
					$output .= '</a>';

					$color = (! empty($color)) ? 'style="color:' .$color.';"' : '';

					if($title) $output.= '<h4 class="video-title" ' .$color. '>' .$title. '</h4>';
					if($content) $output .= '<div class="video-content">' .do_shortcode($content). '</div>';
				$output .= '</div>';
			}

			if($title && ($type == 'normal')) $output .= '<h4 class="video-title">' .$title. '</h4>';
			$output .= '<div id="video_' .$uniqid. '" class="' .$classes. '">';
				$output .= '<div class="video-container">';
					$output .= $embed;
				$output .= '</div>';
			$output .= '</div>';

		$output .= '</div>';

		return $output;
	}

	add_shortcode('videoplayer', 'videoplayer_sc');
}


/* ---------------------------------------------------------------------------
* Enqueue Shortcode Script
* --------------------------------------------------------------------------- */
if (! function_exists('dc_shortcode_script') ) {
 	function dc_shortcode_script() {

 		//global variables
 		//global $clientTime;

 		//enqueue script
		wp_enqueue_script('adeetheming_sc', THMJS . 'shortcodes/shortcode.js', array('jquery'), THMVERSION, true );
		wp_enqueue_script( 'jquery' );
		
 	}

 	add_action('wp_enqueue_scripts','dc_shortcode_script');
}