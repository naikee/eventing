<?php global $adeetheming_options;
    $prefix = 'adee_'; 
    $classes = array();
    $classes[] = $adeetheming_options['blogpost_layout'];
    if ($adeetheming_options['blogpost_layout'] == 'masonry_layout') {
        $classes[] = 'masonry-item';
    } elseif ($adeetheming_options['blogpost_layout'] == 'grid_layout') {
        $classes[] = 'grid-item';
    }
?>
<?php 
    if ( rwmb_meta( $prefix . 'gallery_images','type=image_advanced') !== '' ){
        $col = 'has-thumb';
    }else {
        $col = 'no-thumb';
    } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
    <?php if (!is_single()) { ?>
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
    <?php } else { ?>
        <?php  if ( rwmb_meta( $prefix . 'gallery_images','type=image_advanced') ) { ?>
        <div class="featured-wrapper">
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
        <?php if (!is_single()) { ?>
        <span class="post-icon"><i class="fa fa-camera"></i></span>
        <?php } ?>
        <?php get_template_part( 'templates/post-format/entry-content' ); ?> 
       <?php } ?>
</article> <!--/#post -->