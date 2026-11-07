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
    if ( rwmb_meta( $prefix . 'video' ) !== '' ){
        $col = 'has-thumb';
    }else {
        $col = 'no-thumb';
    } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
    <?php if (!is_single()) { ?>
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
    <?php } else { ?>
        <?php  if ( rwmb_meta( $prefix . 'video' ) ) { ?>
            <div class="featured-wrap">
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
        <?php if (!is_single()) { ?>
            <span class="post-icon"><i class="fa fa-video-camera"></i></span>
        <?php } ?>
        <?php get_template_part( 'templates/post-format/entry-content' ); ?>     
    <?php } ?>    
</article> <!--/#post -->