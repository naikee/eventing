<?php 
/*-------------------------------------------*
 *      adeecore Widget Registration
 *------------------------------------------*/

if(!function_exists('adeetheme_widget_init')):

    function adeetheme_widget_init()
    {
        global $woocommerce, $adeetheming_options;

        register_sidebar(
            array( 
                'name'          => esc_html__( 'Sidebar', 'adeecore' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'adeecore' ),
                'before_title'  => '<div class="adeetheming-title"><h3 class="widget_title">',
                'after_title'   => '</h3></div>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );
        if( $woocommerce ) {
            register_sidebar(array(
                'name'          => __( 'Shop', 'adeecore' ),
                'id'            => 'shop',
                'description'   => __( 'Widgets in this area will be shown on Shop Sidebar.', 'adeecore' ),
                'before_title'  => '<div class="adeetheming-title"><h3 class="widget_title">',
                'after_title'   => '</h3></div>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
                )
            );
        }

        if ( is_array($adeetheming_options['sidebar_generator']) && !empty($adeetheming_options['sidebar_generator']) ) {
            $custom_sidebars = $adeetheming_options['sidebar_generator'];
            foreach ($custom_sidebars as $title) {
                register_sidebar(
                    array(
                        'name'          => $title,
                        'id'            => 'sidebar-' . str_replace("+", "-", urlencode(strtolower($title))),
                        'description'   => 'Widgets in this sidebar will display on pages where ' . $title . ' is activated',
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<h4 class="widgettitle">',
                        'after_title'   => '</h4>',
                    )
                );
            }
        }

        for ($i=1; $i <= $adeetheming_options['footer_layout']; $i++) { 
              register_sidebar(
                array(
                    'name'          => 'Footer widget ' . $i,
                    'id'            => 'footer-' . $i,
                    'description'   => 'Widgets in this sidebar will display on website footer, if activated',
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h4 class="widgettitle">',
                    'after_title'   => '</h4>',
                )
            );
        }  

    }
    
    add_action('widgets_init','adeetheme_widget_init');

endif;




/*-------------------------------------------*
 *      Adeetheming Script
 *------------------------------------------*/

if(!function_exists('adeetheming_script')){

    function adeetheming_script(){
        global $adeetheming_options;

        wp_enqueue_script('bootstrap',THMJS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('extrajQuery',THMJS.'plugins.js',array(),false,true);
        wp_enqueue_script('mordernzr',THMJS.'modernizr.custom.97074.js',array(),false,true);
        wp_enqueue_script('hoverdir',THMJS.'jquery.hoverdir.js',array(),false,true);
        wp_enqueue_script('loopcounter',THMJS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('countto-js',THMJS.'countto.js',array(),false,true);
        if( isset($adeetheming_options['onepage-eg']) && $adeetheming_options['onepage-eg'] ) {
            wp_enqueue_script('jquery.nav',THMJS.'jquery.nav.js',array(),false,true);
            wp_enqueue_script('main-onepage',THMJS.'main-onepage.js',array(),false,true);
        }
            
        wp_enqueue_media();

        wp_enqueue_script('adeecore-main-js',THMJS.'main.js',array(),false,true);

        wp_enqueue_script('adeecore-flipbox-js',THMJS.'flipbox.js',array(),false,true);

    }

    add_action('wp_enqueue_scripts','adeetheming_script');

}


/*-------------------------------------------*
 *      Adeetheming Style
 *------------------------------------------*/
if (!function_exists('adeetheming_style')) {
    function adeetheming_style() {

        wp_enqueue_style('stylesheet', get_stylesheet_uri(), array(), false, 'all');

        wp_enqueue_style('bootstrap', THMCSS.'bootstrap.min.css', array(), false, 'all');
        wp_enqueue_style('font-awesome', THMCSS.'font-awesome.css', array(), false, 'all');
        wp_enqueue_style('ionicons', THMCSS.'ionicons.min.css', array(), false, 'all');
        wp_enqueue_style('animate', THMCSS.'animate.css', array(), false, 'all');
        wp_register_style('flipclock', THMCSS.'flipclock.css', array(), false, 'all');
        wp_enqueue_style('magnific-popup', THMCSS.'magnific-popup.css', array(), false, 'all');
        wp_enqueue_style('woocommerce', THMCSS.'woocommerce.css', array(), false, 'all');
        wp_enqueue_style('vegasSlide', THMCSS.'vegas.min.css', array(), false, 'all');
        wp_enqueue_style('responsive', THMCSS.'responsive.css', array(), false, 'all');
        wp_enqueue_style('main', THMCSS.'main.css', array(), false, 'all');

        if( isset($adeetheming_options['custom-preset-en']) && $adeetheming_options['custom-preset-en']==0 ) {
            wp_enqueue_style( 'adeetheming-preset', get_template_directory_uri(). '/css/presets/preset' . $adeetheming_options['preset'] . '.css', array(),false,'all' );       
        }else {
            wp_enqueue_style('quick-preset',get_template_directory_uri().'/quick-preset.php',array(),false,'all');
        }
        wp_enqueue_style('quick-preset',get_template_directory_uri().'/quick-preset.php',array(),false,'all');
        wp_enqueue_style('quick-style',get_template_directory_uri().'/quick-style.php',array(),false,'all');

        //ShortCode Register Style
        wp_register_style('shortcode-style',false,array(),false);

        //Enqueue Google Fonts
        $googlefont = array();
        $googlestyle = array( 100, 200, 300, 400, 500, 600, 700, 800, 900 );
        $options = array( 'menu', 'title', 'content', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote' );
        foreach ($options as $option) {
            if ( isset( $adeetheming_options[$option . '_fonts']['google'] ) && $king_settings[$option . '_fonts']['google'] === true) {
                $font  = urlencode( $king_settings[$option . '_fonts']['font-family']);
                if ( ! in_array($font, $googlefont) )
                    $googlefont[] = $font;
            }

            // subset
            $subset = '';
            if ( isset( $king_settings[$option . '_fonts']['subset'] ) && $king_settings[$option . '_fonts']['subset'] != '' ) {
                $subset = $king_settings[$option . '_fonts']['subset'];
                $subset = '&amp;subset='. str_replace(' ', '', $subset);
            }

            // style and weight
            $font_style = '';
            if ( isset( $king_settings[$option . '_fonts']['font-style'] ) && $king_settings[$option . '_fonts']['font-style'] != '' ) {
                $font_style = $king_settings[$option . '_fonts']['font-style'];
                if ( ! in_array( $font_style, $googlestyle ) )
                    $googlestyle[] = $font_style;
            }
        }
        $googlestyle = implode(',', $googlestyle);

        $font_family = '';
        foreach ( $googlefont as $font ) {
            $font_family = $font . ':' . $googlestyle . '%7C' . $subset;
        }

        $ssl = 'http';
        if(is_ssl()) $ssl = 'https';
        //wp_enqueue_style(  'adeetheming-google-fonts', $ssl. '://fonts.googleapis.com/css?family=' . $font_family );
    }

    add_action('wp_enqueue_scripts','adeetheming_style');
}

if (! function_exists('dc_head_css')) {
    function dc_head_css() {

        echo '<style id="dc_head_style">';

            //ob_start();

                $return = do_action('add_head_css');

            //$return = ob_get_contents();

            //ob_get_clean();

            echo $return;

        echo '</style>'."\n";
    }
}
add_action('wp_head', 'dc_head_css');


if(!function_exists('adeetheming_admin_script')) {

    function adeetheming_admin_script(){

        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('thmpostmeta');
    }

    add_action('admin_enqueue_scripts','adeetheming_admin_script');

}


if(!function_exists('adeetheming_admin_style')) {

    function adeetheming_admin_style(){
        wp_register_style('dateTimePickerCSS', THMCSS .'admin/jquery.datetimepicker.css');
        wp_enqueue_style('dateTimePickerCSS');

        wp_register_style('backendCSS', THMCSS .'admin/backendcss.css');
        wp_enqueue_style('backendCSS');
    }

    add_action('admin_enqueue_scripts','adeetheming_admin_style');

}


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/

require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'adeetheming_plugins_include');

if(!function_exists('adeetheming_plugins_include')):

    function adeetheming_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => 'Slider Revolution',
                    'slug'                  => 'revslider',
                    'source'                => 'http://demo.adeetheming.com/wordpress/plugins/revslider.zip',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),          
                array(
                    'name'                  => 'WPBakery Visual Composer',
                    'slug'                  => 'js_composer',
                    'source'                => 'http://demo.adeetheming.com/wordpress/plugins/js_composer.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),                               
                array(
                    'name'                  => 'Woocoomerce',
                    'slug'                  => 'woocommerce',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/woocommerce.2.5.5.zip',
                ),                               
                array(
                    'name'                  => 'MailChimp for WordPress',
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.3.1.6.zip',
                ),                                 
                array(
                    'name'                  => 'Widget Settings Importer/Exporter',
                    'slug'                  => 'widget-settings-importexport',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/widget-settings-importexport.1.5.0.zip',
                ),
                array(
                    'name'                  => 'Contact Form 7',
                    'slug'                  => 'contact-form-7',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/contact-form-7.4.4.1.zip',
                ),

            );
    $config = array(
            'domain'            => 'adeecore',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'adeecore' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'adeecore' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'adeecore' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'adeecore'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'adeecore'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','adeecore'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'adeecore' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;