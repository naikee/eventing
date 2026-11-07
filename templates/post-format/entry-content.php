<?php global $adeetheming_options; ?>

<div class="entry-headder">
    <h2 class="entry-title blog-entry-title">
        <?php
            if ( is_single() ) {
                the_title();
            }
            else { ?>
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            <?php }
        ?>    
        <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
        <sup class="featured-post"><i class="fa fa-star-o"></i><?php esc_html_e( 'Sticky', 'adeecore' ) ?></sup>
        <?php } ?>
    </h2> <!-- //.entry-title --> 
</div>
<div class="entry-blog-meta">
    <ul>
        <?php if (isset($adeetheming_options['blog-author']) && $adeetheming_options['blog-author'] ) { ?>
          <li class="author-by"><i class="fa fa-user"></i> <span class="author"> <?php the_author_posts_link() ?></span> </li>
        <?php }?> 
        
        <?php if (isset($adeetheming_options['blog-category']) && $adeetheming_options['blog-category'] ) { ?>
        <li class="category"><i class="fa fa-folder-open-o"></i><?php echo get_the_category_list(', '); ?></li>
        <?php }?>      

        <?php if (isset($adeetheming_options['blog-date']) && $adeetheming_options['blog-date'] ) { ?>
            <li class="publish-date"><i class="fa fa-calendar-o"></i><time class="entry-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('M j,  Y'); ?></time></li>  
        <?php }?>   
  
        <?php if (isset($adeetheming_options['blog-tag']) && $adeetheming_options['blog-tag'] ) { ?>
            <li class="tag"> <?php the_tags('', ', ', '<br />'); ?> </li>
        <?php }?>

        <?php if (isset($adeetheming_options['blog-comment']) && $adeetheming_options['blog-comment'] ){ ?> 
        <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
            <li class="comments-link">
              <i class="fa fa-comments-o"></i><?php comments_popup_link( '<span class="leave-reply">' . esc_html__( 'No comment', 'adeecore' ) . '</span>', esc_html__( 'One comment', 'adeecore' ), esc_html__( '% comments', 'adeecore' ) ); ?>
            </li>
        <?php endif; //.comment-link ?>
        <?php } ?>

        <?php if (isset($adeetheming_options['post-love']) && $adeetheming_options['post-love'] && is_single() ) { ?>
            <li class="tag"> <?php if( function_exists('adeetheming_love') ) adeetheming_love(); ?> </li>
        <?php }?>

        <?php if (isset($adeetheming_options['blog-edit-en']) && $adeetheming_options['blog-edit-en']) { ?>
            <li class="edit-link">
                <i class="fa fa-edit"></i><?php edit_post_link( esc_html__( 'Edit', 'adeecore' ), '<span class="edit-link">', '</span>' ); ?>
            </li>
        <?php } ?>
    </ul>
</div> <!--/.entry-meta -->

<div class="clearfix"></div>

<div class="entry-summary clearfix">
    <?php if ( is_single() ) {
        the_content();
    } else {
        $excerpt = $adeetheming_options['excerpt-length'];
        $limit = 140;
        if ( $excerpt ) $limit = $excerpt;
        echo the_excerpt_max_charlength($limit); ?>
        <div class="wrap-btn-style dc-post-readmore">
        <?php
        if ( isset($adeetheming_options['blog-continue-en']) && $adeetheming_options['blog-continue-en']==1 ) {
            if ( isset($adeetheming_options['blog-continue']) && $adeetheming_options['blog-continue'] ) {
                $continue = esc_html($adeetheming_options['blog-continue']);
                echo '<a class="btn btn-style" href="'.get_permalink().'">'. $continue .'</a>';
            } else {
                echo '<a class="btn btn-style" href="'.get_permalink().'">'. esc_html__( 'Continue Reading', 'adeecore' ) .'</a>';
            }
        }
        if (isset($adeetheming_options['post-love']) && $adeetheming_options['post-love'] ) { ?>
            <span class="post-love"> <?php adeetheming_love(); ?> </span>
        <?php } ?>
        </div>
 
    <?php } 
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'adeecore' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );

     if (isset($adeetheming_options['blog-social']) && $adeetheming_options['blog-social'] ){
        if(is_single()) {
            get_template_part( 'templates/post-format/social-buttons' );
        }
    }?>
</div> <!-- //.entry-summary -->



