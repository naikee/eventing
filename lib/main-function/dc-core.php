<?php 

/* Image size and theme support Function */
if(!function_exists('adeetheme_setup')):

    function adeetheme_setup()
    {
        //Textdomain
        load_theme_textdomain( 'adeecore', get_stylesheet_directory() . '/languages' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'speaker-thumb', 458, 458, true ); // Speaker Thumb for Speaker single page
        add_image_size( 'blog-full_image_layout', 1140, 450, true ); // Blog Thumb for full_image_layout on blog page
        add_image_size( 'blog-list_layout', 760, 350, true ); // Blog Thumb for list_layout on blog page
        add_image_size( 'blog-grid_layout', 760, 350, true ); // Blog Thumb for list_layout on blog page
        add_image_size( 'blog-small', 360, 230, true ); // Speaker Thumb for Speaker single page
        add_image_size( 'x-blog-small', 100, 60, true ); // Speaker Thumb for Speaker single page
        add_image_size( 'portfolio-thumb', 1140, 500, true ); // Portfolio Thumb for portfolio page
        add_image_size( 'clients-logo', 150, 80, false ); // Client Thumb for Clients Logo
        add_image_size( 'testimonial-thumb', 100, 100, true ); // Testimonial Thumb for Testimonials
        add_theme_support( 'post-formats', array( 'aside','audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );

        add_editor_style('');

        if ( ! isset( $content_width ) )
        $content_width = 660;
    }

    add_action('after_setup_theme','adeetheme_setup');

endif;


/* Social Icon Function */
if( ! function_exists( 'social_media_icons' ) ) {
    function social_media_icons() {
        return array(
            'facebook'      => 'Facebook',
            'twitter'       => 'Twitter',
            'linkedin'      => 'LinkedIn',
            'youtube'       => 'Youtube',
            'skype'         => 'Skype',
            'rss'           => 'RSS',
            'pinterest'     => 'Pinterest',
            'vimeo'         => 'Vimeo',
            'google-plus'   => 'Google+',
            'flickr'        => 'Flickr',
            'instagram'     => 'Instagram',
            'behance'       => 'Behance',
            'dribbble'      => 'Dribbble',
            'viadeo'        => 'Viadeo',
            'tumblr'        => 'Tumblr',
            'vk'            => 'VK',
            'xing'          => 'Xing',
            'digg'          => 'Digg',
            'foursquare'    => 'Foursquare',
            'deviantart'    => 'Deviantart',
            'reddit'        => 'Reddit',
            'dropbox'       => 'Dropbox',
            'yahoo'         => 'Yahoo',
            'paypal'        => 'Paypal',
            'envelope-o'    => 'Email Address',
        );
    }
}


/* Pagination Function */
if(!function_exists('adeetheming_pagination')):

    function adeetheming_pagination($load_more = false, $pages = '', $range = 2)
    {  
        $showitems = ($range * 2)+1;  
        global $paged;
        if(empty($paged)) $paged = 1;
        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if(!$pages)
            {
                $pages = 1;
            }
        }

        $post_type = get_post_type();

        $output = '<div class="row"><div class="dc-pagination col-md-12">';

        if(1 != $pages) {

            $output .= "<div class='adeetheming-pagination'><ul class='pagination'><li>Page ".$paged." of ".$pages."</li>";
                if($paged > 2 && $paged > $range+1 && $showitems < $pages){
                    $output .= "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
                }
                if($paged > 1 && $showitems < $pages){ 
                    $output .= '<li>';
                        $output .= get_previous_posts_link(esc_html__("Prev",'adeecore'));
                    $output .= '</li>';
                }
                for ($i=1; $i <= $pages; $i++)
                {
                    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                    {
                        $output .= ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
                    }
                }
                if ($paged < $pages && $showitems < $pages){
                    $output .= '<li>';
                        $output .= get_next_posts_link(esc_html__("Next",'adeecore'));
                    $output .= '</li>';
                }
                if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
                    $output .= "<li><a href='".get_pagenum_link($pages)."'>&raquo; Last</a></li>";
                }
            $output .= "</ul></div>";

        }

        $output .= '</div></div>';

        return $output;

    }

endif;


/* Loadmore Function */
if(!function_exists('adeetheming_loadmore')) {

    function adeetheming_loadmore( $pages = '')
    {  
        global $paged;
        if(empty($paged)) $paged = 1;
        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if(!$pages)
            {
                $pages = 1;
            }
        }

        $post_type = get_post_type();

            
        if (!is_singular()) {
            wp_enqueue_script(
                'adeetheming_loadmore', THMJS . 'load-more.js', array('jquery'), 1.0, true
            );

            wp_localize_script(
                'adeetheming_loadmore', 'dc_loadmore', array('startPage' => $paged, 'maxPages' => $pages, 'nextPage' => next_posts($pages, false), 'postType' => $post_type)
            );
        }

    }
}



/* Filter Function */
if (! function_exists('adeetheming_filter')) {

    function adeetheming_filter() {
        $terms = get_terms('portfolio-category');
        $count = count($terms);
        $output = '<ul id="filters" class="adeetheming-filter">';
            $output .= '<li><a href="javascript:void(0)" title="" data-filter="*" class="active">' . esc_attr( "All", "adeecore" ) . '</a></li>';

                if ($count > 0) {
                    foreach ($terms as $term) {
                        $name = $term->name;
                        $url = $term->slug;
                        $output .= '<li class="' . $url . '"><a href="javascript:void(0)" title="" data-filter=".' . $url . '">' . $name . '</a></li>';
                    }
                }
            
        $output .= '</ul>';

        return $output;
    }
}


/* Comment Function */
if(!function_exists('adeetheming_comment')):

    function adeetheming_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
            // Display trackbacks differently than normal comments.
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'adeecore' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
                break;
            default :
            
            global $post;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body media">
                
                    <div class="comment-avartar pull-left">
                        <?php
                            echo get_avatar( $comment, $args['avatar_size'] );
                        ?>
                    </div>
                    <div class="comment-context media-body">
                        <div class="comment-head">
                            <?php
                                printf( '<span class="comment-author">%1$s</span>',
                                    get_comment_author_link());
                            ?>
                            <span class="comment-date"><?php echo get_comment_date('d / m / Y') ?></span>

                            <?php edit_comment_link( esc_html__( 'Edit', 'adeecore' ), '<span class="edit-link">', '</span>' ); ?>
                            <span class="comment-reply">
                                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'adeecore' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                            </span>
                        </div>

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'adeecore' ); ?></p>
                        <?php endif; ?>

                        <div class="comment-content">
                            <?php comment_text(); ?>
                        </div>
                    </div>
                
            </div>
        <?php
            break;
        endswitch; 
    }

endif;


/*-------------------------------------------------------
*           Adeetheming Breadcrumb Function
*-------------------------------------------------------*/
if(!function_exists('adeetheming_breadcrumbs')):
    function adeetheming_breadcrumbs(){
        global $adeetheming_options;

        $step = '&raquo;';
        $crumbs_id = 'breadcrumbs';
        $crumbs_class = 'breadcrumbs crumb_trails';
        $home = $adeetheming_options['home_breadcrumb'];

        if ( $home == 'icon' ) {
            $home = '<i class="fa fa-home"></i>';
        } else {
            $home = 'Home';
        }

        global $post, $wp_query;
        $homeLink = get_bloginfo('url');

        if (get_post_type() == 'product') {
            $custom_taxonomy = 'product_cat';
        } elseif (get_post_type() == 'portfolio') {
            $custom_taxonomy = 'portfolio-category';
        } elseif (get_post_type() == 'teams') {
            $custom_taxonomy = 'teams-category';
        } else {
            $custom_taxonomy = 'category';
        }

        if ( is_home() || is_front_page() ) {

            return;

        } else {
            
            //Breadcrumbs Build
            $output = '<ul id="' . $crumbs_id . '" class="' . $crumbs_class . '">';
                $output .= '<li class="item_home"><a class="crumb_link crumb_home" href="' . $homeLink . '" title="Home">' . $home . '</a></li>';
                $output .= '<li class="separator separator_home">' . $step . '</li>';

                if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
                    $output .= '<li class="item_current item_archive"><strong class="crumb_current crumb_archive">' . post_type_archive_title('', false) . '</strong></li>';
                } elseif ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
                    // If post is a custom post type
                    $post_type = get_post_type();
              
                    // If it is a custom post type display name and link
                    if($post_type != 'post') {
                  
                        $post_type_object = get_post_type_object($post_type);
                        $post_type_archive = get_post_type_archive_link($post_type);

                        $output .= '<li class="item_cat item_custom_posttype_' . $post_type . '"><a class="crumb_cat crumb_custom_post_type_' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                        $output .= '<li class="separator"> ' . $step . ' </li>';
                    }

                    $custom_tax_name = get_queried_object()->name;
                    $output .= '<li class="item_current item_archive"><strong class="crumb_current crumb_archive">' . $custom_tax_name . '</strong></li>';
                } elseif ( is_single() ) {
                    //If post is a custom post type
                    $post_type = get_post_type();

                    // If it is a custom post type display name and link
                    if ($post_type != 'post') {

                        $post_type_object = get_post_type_object($post_type);
                        $post_type_archive = get_post_type_archive_link($post_type);

                        $output .= '<li class="item_cat item_custom_posttype_' . $post_type . '"><a class="crumb_cat crumb_custom_post_type_' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                        $output .= '<li class="separator"> ' . $step . ' </li>';
                    }

                    // Get category info
                    $category = get_the_category();

                    if ( ! empty($category) ) {

                        // Get last category post is in
                        $last_category = $category[count($category) - 1];

                        // Get parent any categories and create array
                        $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                        $cat_parents = explode(',',$get_cat_parents);

                        // Loop through parent categories and store in variable $cat_display
                        $cat_display = '';
                        foreach($cat_parents as $parents) {
                            $cat_display .= '<li class="item_cat">'.$parents.'</li>';
                            $cat_display .= '<li class="separator"> ' . $step . ' </li>';
                        }
                    }

                    // If it's a custom post type within a custom taxonomy

                    $taxonomy_exists = taxonomy_exists($custom_taxonomy);
                    if ( empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists ) {
                        
                        $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                        $cat_id         = $taxonomy_terms[0]->term_id;
                        $cat_nicename   = $taxonomy_terms[0]->slug;
                        $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                        $cat_name       = $taxonomy_terms[0]->name;
                    }

                    // Check if the post is in a category
                    if ( !empty( $last_category ) ) {
                        $output .= $cat_display;
                        $output .= '<li class="item_current item_' . $post->ID . '"><strong class="crumb_current bread_' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

                        // Else if post is in a custom taxonomy
                    } elseif ( ! empty( $cat_id ) ) {
                        
                        $output .= '<li class="item_cat item_cat_' . $cat_id . ' item_cat_' . $cat_nicename . '"><a class="crumb_cat crumb_cat-' . $cat_id . ' crumb_cat_' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                        $output .= '<li class="separator"> ' . $step . ' </li>';
                        $output .= '<li class="item_current item_' . $post->ID . '"><strong class="crumb_current crumb_' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                    } else {

                        $output .= '<li class="item_current item_' . $post->ID . '"><strong class="crumb_current crumb_' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                    }
                } elseif ( is_category() ) {
                    
                    // Category Page
                    $output .= '<li class="item-current item-cat"><strong class="crumb_current crumb_cat">' . single_cat_title('', false) . '</strong></li>';
                } elseif ( is_page() ) {

                    // Standard page
                    if( $post->post_parent ){
                        
                        // If child page get parents page
                        $ancestors = get_post_ancestors( $post->ID );

                        $ancestors = array_reverse($ancestors);

                        if ( ! isset( $parents ) ) {
                            $parents = null;
                        }
                        foreach ($ancestors as $ancestor ) {
                            $parents .= '<li class="item_parent item_parent_' . $ancestor . '"><a class="crumb_parent crumb_parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                            $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $step . ' </li>';
                        }

                        // Display parent pages
                        $output .= $parents;

                        // Current page
                        $output .= '<li class="item_current item_' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                    } else {

                        // Just display current page if not parents
                        $output .= '<li class="item_current item_' . $post->ID . '"><strong class="crumb_current crumb_' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                    }
                } elseif ( is_tag() ) {
                    
                    // Tag Information
                    $term_id = get_query_var('tag_id');
                    $taxonomy = 'post_tag';
                    $args = 'include=' . $term_id;
                    $terms = get_terms( $taxonomy, $args );
                    $get_term_id = $terms[0]->term_id;
                    $get_term_slug = $terms[0]->slug;
                    $get_term_name = $terms[0]->name;
               
                    // Display the tag name
                    $output .= '<li class="item_current item_tag_' . $get_term_id . ' item_tag_' . $get_term_slug . '"><strong class="bread_current bread_tag_' . $get_term_id . ' crumb_tag_' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
                } elseif ( is_day() ) {
                      
                    // Day archive
               
                    // Year link
                    $output .= '<li class="item_year item_year_' . get_the_time('Y') . '"><a class="crumb_year crumb_year_' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
                    $output .= '<li class="separator separator_' . get_the_time('Y') . '"> ' . $step . ' </li>';
                       
                    // Month link
                    $output .= '<li class="item_month item_month_' . get_the_time('m') . '"><a class="crumb_month crumb_month_' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
                    $output .= '<li class="separator separator_' . get_the_time('m') . '"> ' . $step . ' </li>';
                       
                    // Day display
                    $output .= '<li class="item-current item-' . get_the_time('j') . '"><strong class="crumb_current crumb_' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
                } elseif ( is_month() ) {
                    
                    // Month archive
               
                    // Year link
                    $output .= '<li class="item_year item_year_' . get_the_time('Y') . '"><a class="crumb_year crumb_year_' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
                    $output .= '<li class="separator separator_' . get_the_time('Y') . '"> ' . $step . ' </li>';
                       
                    // Display Month
                    $output .= '<li class="item_month item_month_' . get_the_time('m') . '"><strong class="crumb_month crumb_month_' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
                } elseif ( is_year() ) {
                    
                    // Year archive
               
                    // Display Year
                    $output .= '<li class="item_year item_year_' . get_the_time('Y') . '"><strong class="crumb_year crumb_year_' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
                } elseif ( is_author() ) {
                    
                    // Auhor archive
               
                    // Get the author information
                    global $author;
                    $userdata = get_userdata( $author );
                       
                    // Display author name
                    $output .= '<li class="item_current item_current_' . $userdata->user_nicename . '"><strong class="crumb_current crumb_current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
                } elseif ( get_query_var('paged') ) {
                    // Paginated archives
                    $output .= '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
                } elseif ( is_search() ) {
                    // Search results page
                    $output .= '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
                } elseif ( is_404() ) {
                    // 404 page
                    $output .= '<li>' . 'Error 404' . '</li>';
                }
            $output .= '</ul>';
        }

        echo $output;
    }
endif;


/*-----------------------------------------------------
 *              Video Function
 *----------------------------------------------------*/

if(!function_exists('adeetheming_get_video_id')){
    function adeetheming_get_video_id($url){
        $video = parse_url($url);

        switch($video['host']) {
            case 'youtu.be':
            $id = trim($video['path'],'/');
            $src = 'https://www.youtube.com/embed/' . esc_attr($id);
            break;

            case 'www.youtube.com':
            case 'youtube.com':
            parse_str($video['query'], $query);
            $id = $query['v'];
            $src = 'https://www.youtube.com/embed/' . esc_attr($id);
            break;

            case 'vimeo.com':
            case 'www.vimeo.com':
            $id = esc_attr(trim($video['path'],'/'));
            $src = "http://player.vimeo.com/video/{$id}";
        }

        return $src;
    }
}


/*-----------------------------------------------------
 *              Coming Soon Page Settings
 *----------------------------------------------------*/
if (isset($adeetheming_options['comingsoon-en']) && $adeetheming_options['comingsoon-en']) {
    if(!function_exists('adeetheming_my_page_template_redirect')):
        function adeetheming_my_page_template_redirect()
        {
            if( is_page( ) || is_home() || is_category() || is_single() )
            {
                get_template_part( 'coming','soon');
                exit();
            }
        }
        add_action( 'template_redirect', 'adeetheming_my_page_template_redirect' );
    endif;

    if(!function_exists('adeetheming_cooming_soon_wp_title')):
        function adeetheming_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'adeetheming_cooming_soon_wp_title' );
    endif;
}



/*-----------------------------------------------------
 *              Custom Excerpt Length
 *----------------------------------------------------*/

if(!function_exists('the_excerpt_max_charlength')):

    function the_excerpt_max_charlength($charlength) {
        $excerpt = get_the_excerpt();
        $charlength++;

        if ( mb_strlen( $excerpt ) > $charlength ) {
            $subex = mb_substr( $excerpt, 0, $charlength - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                return mb_substr( $subex, 0, $excut );
            } else {
                return $subex;
            }
            return '[...]';
        } else {
            return $excerpt;
        }
    }

endif;


/*-------------------------------------------*
*               Excerpt Read More
*------------------------------------------*/
if(!function_exists('new_excerpt_more')):

    if( isset($adeetheming_options['blog-continue-en']) && $adeetheming_options['blog-continue-en'] ){

        function new_excerpt_more( $more )
        {
            global $adeetheming_options;
            $continue = 'Continue Reading...';

            if ( isset($adeetheming_options['blog-continue']) ){
                $continue = esc_html($adeetheming_options['blog-continue']);
            }
            
            return '&nbsp;<br /><br /><a class="btn btn-style" href="'. get_permalink( get_the_ID() ) . '">'.$continue. '</a>';
        }
        add_filter( 'excerpt_more', 'new_excerpt_more' );

    }

endif;


/*-----------------------------------------------------
 *              Hex Color to RGBA
 *----------------------------------------------------*/
if(!function_exists('adeetheming_hex2rgb')){
    function adeetheming_hex2rgb($hex, $opacity = false) {
       $default = 'rgb(0,0,0)';

       if (empty($hex)) {
           return $default;
       }

       if ($hex[0] = '#') {
           $hex = substr($hex, 1);
       }

       if (strlen($hex) == 6) {
           $hexcolor = array( $hex[0] . $hex[1] , $hex[2] . $hex[3] , $hex[4] . $hex[5]);
       } elseif (strlen($hex) == 3) {
           $hexcolor = array( $hex[0] . $hex[0] , $hex[1] . $hex[1] , $hex[2] . $hex[2]);
       } else {
           return $default;
       }

       $rgb = array_map('hexdec', $hexcolor);

       if ($opacity) {
           if (abs($opacity) > 1)
               $opacity = 1.0;
            $output = 'rgba(' . implode(',', $rgb) . ',' . $opacity. ')';
        } else {
            $output = 'rgb(' . implode(',', $rgb) . ')';
        }

       return $output;
    }
}

/*-----------------------------------------------------
 *              Hex Color to RGBA
 *----------------------------------------------------*/
function dc_hex_to_rgb( $hex ) {
    $hex = preg_replace( '~[^0-9a-f]+~', '', $hex );
    if ( strlen( $hex ) == 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    if ( strlen( $hex ) != 6 ) {
        return array( 255, 255, 255 );
    }

    return array( hexdec( $hex[0] . $hex[1] ), hexdec( $hex[2] . $hex[3] ), hexdec( $hex[4] . $hex[5] ) );
}


/*-----------------------------------------------------
 *              Shade Color
 *----------------------------------------------------*/
function dc_shadecolor( $color = '#eeeeee', $hue = 20 ) {
    $dark = dc_hex_to_rgb($color);
    for ($i=0; $i < 3; $i++) { 
        $rgb[$i] = min(250, $dark[$i] + $hue);
    }

    return sprintf( '#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2] );
}


/*-----------------------------------------------------
 *              Tint Color
 *----------------------------------------------------*/
function dc_tintcolor( $color = '#eeeeee', $hue = 20 ) {
    $dark = dc_hex_to_rgb($color);
    for ($i=0; $i < 3; $i++) { 
        $rgb[$i] = max(5, $dark[$i] - $hue);
    }

    return sprintf( '#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2] );
}


/*=====================================
 * Search Form
 *====================================*/
if ( ! function_exists( 'adeetheming_search_query' ) ) {
    function adeetheming_search_query() {
        global $adeetheming_options; ?>

        <div class="dc-search-modal-outer">
            <div class="dc-search-modal-bg"></div>
            <div class="dc-search-modal-container">
                <a href="#" data-rel="close-modal" class="dc-search-modal-close" title="Close"></a>
                <div id="dc-search-content">

                    <?php if ( $adeetheming_options['search_type'] != 'product') : ?>
                        <form class="searchform simple-search" method="get" action="<?php esc_url( home_url( '/' ) ); ?>">
                            <input type="text" name="s" id="s" class="searchfield" placeholder="<?php echo esc_html__( 'Enter your search', 'adeecore' ); ?>" value="<?php get_search_query() ?>" />
                            <input type="submit" class="btn searchbutton" value="<?php echo esc_html__( 'Search', 'adeecore' ); ?>" />
                        </form>
                    <?php else : 
                        $args = array(
                        'show_option_all'   => __( 'All Categories', 'adeecore' ),
                        'hide_empty'        => 1,
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hierarchical'      => 1,
                        'tab_index'         => 1,
                        );

                        if ( class_exists( 'WooCommerce' ) ) {
                            $args['taxonomy']   = 'product_cat';
                            $args['name']       = 'product_cat';
                            $args['class']      = 'prod-search';
                        } else {
                            $args['taxonomy']   = 'category';
                            $args['name']       = 'category';
                            $args['class']      = 'post-search';
                        } ?>
                        <form class="searchform wooc-search" method="get" action="<?php esc_url( home_url( '/' ) ); ?>">
                            <div class="search-group category-search">
                                <?php wp_dropdown_categories( $args ); ?>
                            </div>
                            <div class="search-group input-search">
                                <input type="text" name="s" id="s" class="searchfield" placeholder="<?php echo esc_html__( 'Enter your search', 'adeecore' ); ?>" value="<?php get_search_query() ?>" />
                            </div>
                            <input type="submit" class="btn searchbutton" value="<?php echo esc_html__( 'Search', 'adeecore' ); ?>" />
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php }

    add_action('wp_footer', 'adeetheming_search_query');
}


/*=============================================================================
 * Split Menu
 *=============================================================================*/
if ( ! function_exists('adeetheming_splitmenu') ) {
    function adeetheming_splitmenu () {
        global $detect;
            // Main Menu Left ----------------------------
            $args = array( 
                'container'         => false,
                'menu_class'        => 'nav navbar-nav menu_left',
                'fallback_cb'       => 'wp_page_menu', 
                'theme_location'    => 'primary',
                'depth'             => 3,
                'walker'            => new Megamenu_Walker()
            );

            /*/ custom walker for mega menu
            if ( $detect->isMobile() || $detect->isTablet() ) {
                $args['walker'] = new wp_bootstrap_mobile_navwalker();
            } else {
                $args['walker'] = new Megamenu_Walker();
            } */

            wp_nav_menu( $args );

            // Main Menu Right ----------------------------
            $args = array( 
                'container'         =>  false,
                'menu_class'        => 'nav navbar-nav menu_right',
                'fallback_cb'       => 'wp_page_menu', 
                'theme_location'    => 'split-menu',
                'depth'             => 3,
                'walker'            => new Megamenu_Walker()
            );

            /*/ custom walker for mega menu
            if ( $detect->isMobile() || $detect->isTablet() ) {
                $args['walker'] = new wp_bootstrap_mobile_navwalker();
            } else {
                $args['walker'] = new Megamenu_Walker();
            } */

            wp_nav_menu( $args );
    }
}


/*=============================================================================
 * Topbar Header
 *=============================================================================*/
if ( ! function_exists('adeetheming_topbar') ) {
    function adeetheming_topbar() {
        global $adeetheming_options;

        if ( isset($adeetheming_options['topbar']) && $adeetheming_options['topbar'] == true ) : ?>
            <div id="topheader-container">
                <div class="container">
                    <div class="row">
                        <ul class="contact-details">
                            <?php
                            if ( $adeetheming_options['top_welcome_note'] != '' ) {
                                echo '<li class="welcome-note">' . $adeetheming_options['top_welcome_note'] . '</li>';
                            }

                            if ( $adeetheming_options['top_hotline'] != '' ) {
                                echo '<li class="hotline"><i class="ion-android-call"></i><a href="tel:' . str_replace( ' ', '', $adeetheming_options['top_hotline'] ) . '">' . $adeetheming_options['top_hotline'] . '</a></li>';
                            }

                            if ( $adeetheming_options['top_hotline2'] != '' ) {
                                echo '<li class="hotline"><i class="ion-android-call"></i><a href="tel:' . str_replace( ' ', '', $adeetheming_options['top_hotline2'] ) . '">' . $adeetheming_options['top_hotline2'] . '</a></li>';
                            }

                            if ( $adeetheming_options['top_email'] != '' ) {
                                echo '<li class="top-email"><i class="ion-email"></i><a href="mailto:' . $adeetheming_options['top_email'] . '">' . $adeetheming_options['top_email'] . '</a></li>';
                            }
                            ?>
                        </ul>

                        <?php
                            if ( has_nav_menu('top-menu') ) {
                                 wp_nav_menu(  array(
                                        'theme_location' => 'top-menu',
                                        'container'      => '', 
                                        'menu_class'     => 'top-social-menu',
                                        'fallback_cb'    => 'wp_page_menu',
                                        'depth'          => 1,
                                    )
                                ); 
                         } elseif ($adeetheming_options['top_social'] == true) {
                            $target = '';
                            if ( isset($adeetheming_options['social_link_target']) && $adeetheming_options['social_link_target'] != '' ) {
                                    $target = 'target="_blank"';
                             } 
                        ?>
                            <ul class="top-social-icons">
                                <?php if(isset($adeetheming_options['wp-facebook'])){ if( $adeetheming_options['wp-facebook'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-facebook'] ); ?>"><i class="fa fa-facebook"></i></a></li><?php } } ?>
                                <?php if(isset($adeetheming_options['wp-twitter'])){ if( $adeetheming_options['wp-twitter'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-twitter'] ); ?>"><i class="fa fa-twitter"></i></a></li><?php } } ?>
                                <?php if(isset($adeetheming_options['wp-google-plus'])){ if( $adeetheming_options['wp-google-plus'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-google-plus'] ); ?>"><i class="fa fa-google-plus"></i></a></li><?php } } ?>
                                <?php if(isset($adeetheming_options['wp-pinterest'])){ if( $adeetheming_options['wp-pinterest'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-pinterest'] ); ?>"><i class="fa fa-pinterest"></i></a></li><?php } } ?>
                               <?php if(isset($adeetheming_options['wp-youtube'])){ if( $adeetheming_options['wp-youtube'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-youtube'] ); ?>"><i class="fa fa-youtube"></i></a></li><?php } } ?>
                                <?php if(isset($adeetheming_options['wp-linkedin'])){ if( $adeetheming_options['wp-linkedin'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-linkedin'] ); ?>"><i class="fa fa-linkedin"></i></a></li><?php } } ?>
                                <?php if(isset($adeetheming_options['wp-instagram'])){ if( $adeetheming_options['wp-instagram'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-instagram'] ); ?>"><i class="fa fa-instagram"></i></a></li><?php } } ?>
                                <?php if(isset($adeetheming_options['wp-dribbble'])){ if( $adeetheming_options['wp-dribbble'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-dribbble'] ); ?>"><i class="fa fa-dribbble"></i></a></li><?php } } ?>
                                <?php if(isset($adeetheming_options['wp-behance'])){ if( $adeetheming_options['wp-behance'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-behance'] ); ?>"><i class="fa fa-behance"></i></a></li><?php } } ?>
                                <?php if(isset($adeetheming_options['wp-flickr'])){ if( $adeetheming_options['wp-flickr'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-flickr'] ); ?>"><i class="fa fa-flickr"></i></a></li><?php } } ?>
                                <?php if(isset($adeetheming_options['wp-vk'])){ if( $adeetheming_options['wp-vk'] != '' ){ ?><li><a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $adeetheming_options['wp-vk'] ); ?>"><i class="fa fa-vk"></i></a></li><?php } } ?>
                                <?php if(isset($adeetheming_options['wp-skype'])){ if( $adeetheming_options['wp-skype'] != '' ){ ?><li><a href="skype:<?php echo esc_url( $adeetheming_options['wp-skype'] ); ?>?chat"><i class="fa fa-skype"></i></a></li><?php } } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>         
            </div>
        <?php endif;
    }
}


/*=============================================================================
 * Show Sidebars in Meta Box.
 *=============================================================================*/
if (!function_exists('adeetheming_show_sidebars')) {
    function adeetheming_show_sidebars() {
        $sidebars = array();
        global $wp_registered_sidebars;

        foreach ($wp_registered_sidebars as $sidebar) {
            $sidebars[$sidebar['id']] = $sidebar['name'];
        }
        return $sidebars;
    }
}


/*=============================================================================
 *  Show Revolution Sliders in Meta Box.
 *=============================================================================*/
if (!function_exists('adeetheming_show_revslider')) {
    function adeetheming_show_revslider() {
        global $wpdb;

        $revslider = array();
        $revslider = array(''   => __( 'Select Slider Revolution', 'naikee' ));

        if( function_exists( 'rev_slider_shortcode' ) ) {
            $wp_revslider = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'revslider_sliders' );

            if( is_array($wp_revslider) ) {
                foreach ($wp_revslider as $rev) {
                    if ( $rev->type != 'template' ) {
                        $revslider[$rev->alias] = $rev->title;
                    }
                }
            }
        }

        return $revslider;
    }
}


/* =============================================================================
*      GET Categories
* ============================================================================= */
if( ! function_exists( 'dc_get_categories' ) )
{
    /**
     * Categories for posts or specified taxonomy
     * @param string $category
     * @return array
     */
    function dc_get_categories( $category ) {
        $categories = get_categories( array( 'taxonomy' => $category ));

        $array = array( __( 'All', 'adeecore' ) => '' );
        foreach( $categories as $cat ){
            if( is_object($cat) ) $array[$cat->name] = $cat->slug;
        }
            
        return $array;
    }
}


/* =============================================================================
*     Unique Shortcode Class
* ============================================================================= */
if (! function_exists('adeetheming_uniqclass')) {
    function adeetheming_uniqclass($uniqclass = 'dc-uniqclass') {
        STATIC $count = 1;
        return $uniqclass . $count++;
    }
}

if (! function_exists('adeetheming_shortcodecss')) {
    function adeetheming_shortcodecss($dc_shortcodecss) {
        ob_start();
            echo $dc_shortcodecss;
        $css = ob_get_clean();

        wp_enqueue_style('shortcode-style');
        wp_add_inline_style( 'shortcode-style', $css );
    }

}


/*=============================================================================
 * WooCommerce Configuration
 *=============================================================================*/
//Products Per Page
add_filter( 'loop_shop_per_page', 'adeetheming_loop_shop_per_page', 20 );

function adeetheming_loop_shop_per_page( $cols ) {
    global $adeetheming_options;

    $cols = $adeetheming_options['shop_products'];
    return $cols;
}

// Change number of products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        global $adeetheming_options;

        $ret = $adeetheming_options['shop_row'];
        return $ret; // 3 products per row
    }
}

// Change number of related products
add_filter( 'woocommerce_output_related_products_args', 'adeetheming_related_products_limit' );

function adeetheming_related_products_limit() {
  global $product, $adeetheming_options;
    
    $args['posts_per_page'] = $adeetheming_options['related_products'];
    return $args;
}


// Header Mini Cart
if ( ! function_exists( 'adeetheming_mini_cart' ) ) {
    function adeetheming_mini_cart () {

        global $woocommerce;

        $wooc_empty = $woocommerce->cart->is_empty(); ?>
        <div class="minicart-dropdown minicart-content-container">
            <?php if ( ! $wooc_empty ) : ?>
                <div class="dropdown-content">
                    <h5 class="title-count">
                        <?php echo sprintf(_n( '%d item in my cart', '%d items in my cart', $woocommerce->cart->cart_contents_count, 'adeecore' ), $woocommerce->cart->cart_contents_count ); ?>
                    </h5>
                    <ul class="cart-list-item product_list_widget">
                        <?php
                        $index = 0;
                        foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
                            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            //$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                            if ( $_product  && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) :

                                $product_price = apply_filters( 'woocommerce_cart_item_price', $woocommerce->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                ?>
                                <li class="<?php echo $minicart_list_class = ($index == 0 ? "first minicart-item" : ($index == count( $woocommerce->cart->get_cart() ) - 1 ? "last minicart-item" : "minicart-item")) ?>">
                                    <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
                                        <?php echo $_product->get_image(); ?>
                                    </a>

                                    <?php
                                    
                                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove-product" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'adeecore' ) ), $cart_item_key );
                                    ?>

                                    <div class="minicart-item-details">
                                        <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
                                            <?php echo apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ); ?>
                                        </a>
                                        <p class="p-price"><?php echo( $product_price ); ?></p>
                                        <?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>
                                        <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( 'Qty: %s', $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); ?>
                                    </div>
                                </li>
                            <?php endif;

                            $index++;
                        } ?>
                    </ul>
                </div>
            <?php endif;
            $cart_empty = '';
            if ( $wooc_empty ) {
                $cart_empty = 'minicart_empty_item';
            } ?>
            <div class="minicart_footer <?php echo $cart_empty; ?>">
                <?php if ( ! $wooc_empty ) : ?>
                    <p class="total-cart">
                        <span><?php echo esc_html__( 'Subtotal: ', 'adeecore' ); ?></span>
                        <?php echo $woocommerce->cart->get_cart_subtotal(); ?>
                    </p>
                    <p class="btn dc-checkout-btn">
                        <a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="button_checkout" title="<?php _e( 'Checkout', 'adeecore' ); ?>"><?php echo esc_html__( 'Checkout', 'adeecore' ); ?></a>
                    </p>
                    <p class="btn dc-cart-btn">
                        <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="button_shopping_cart" title="<?php _e( 'Go to Shopping Cart', 'adeecore' ); ?>"><?php echo esc_html__( 'Go to Shopping Cart', 'adeecore' ); ?></a>
                    </p>
                <?php else : 
                    _e('You have no items in your shopping cart.','adeecore');
                endif; ?>
            </div>
        </div>
        <?php
    }
}

//header Ajax mini cart
if (! function_exists('adeetheming_ajax_cart')) {
    function adeetheming_ajax_cart() {
        global $woocommerce;

        ob_start();
        ?>

        <div id="adeetheming-mini-cart" class="dc-mini-cart">
            <div class="dc-mini-cart-settings">
                <a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View Cart', 'adeecore' ); ?>" class="dc-cart-count">
                    <span id="dc-mini-cart-no"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                </a>
            </div>
                                        
            <?php echo adeetheming_mini_cart(); ?>
        </div>
        <?php

        return ob_get_clean();

    }
}

//header Ajax filter
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option('active_plugins'))) || class_exists( 'WooCommerce' )) {
    if( version_compare( WC_VERSION, '2.3', '<' ) ){
        // WC 2.3 -
        add_filter('add_to_cart_fragments', 'adeetheming_ajax_filter');
    } else {
        // WC 2.3 +
        add_filter('woocommerce_add_to_cart_fragments', 'adeetheming_ajax_filter');
    }
    if (! function_exists('adeetheming_ajax_filter')) {
        function adeetheming_ajax_filter($filter) {
        
            $fragments['.dc-mini-cart'] = adeetheming_ajax_cart();

            return $fragments;

        }
    }
}
