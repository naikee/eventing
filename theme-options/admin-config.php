<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo esc_url(wp_customize_url()); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','adeecore'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_html_e('Current theme preview','adeecore'); ?>" />
                <?php endif; ?>

                <h4><?php echo esc_html($this->theme->display('Name')); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            // ACTUAL DECLARATION OF SECTIONS





            /**********************************
            ********* General Setting ***********
            ***********************************/
            $this->sections[] = array(
                'title'     => __('General Setting', 'Home Setting'),
                'icon'      => 'el-icon-bookmark',
                'icon_class' => 'el-icon-large',
                'fields'    => array(


                    array(
                        'id'        => 'preloader_en',
                        'type'      => 'switch',
                        'title'     => __('Preloader Enable', 'adeecore'),
                        'subtitle' => __('Enable or disable Preloader', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'preloader_style',
                        'type'      => 'select',
                        'title'     => esc_html__('Select Preloader Style', 'adeecore'), 
                        'subtitle'  => esc_html__('Select the type of preloader for your website', 'adeecore'),
                        'options'   => array(
                            'style_one'            => 'Style 1',
                            'style_two'            => 'Style 2',
                            'style_three'          => 'Style 3',
                            'style_four'           => 'Style 4',
                            'style_five'           => 'Style 5',
                            'style_six'            => 'Style 6',
                            'style_seven'          => 'Style 7',
                            'style_eight'          => 'Style 8',
                            'style_nine'           => 'Style 9',
                            'style_ten'            => 'Style 10',
                            'style_eleven'         => 'Style 11',
                        ),
                        'required'  => array(
                            array( 'preloader_en', '=', true ),
                        ),
                        'default'   => 'style_one',
                    ),

                    array(
                        'id'        => 'preloader_color',
                        'type'      => 'color',
                        'title'     => __('Preloader Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for the Preloader (default: #2595FC).', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>true,
                    ),

                    array(
                        'id'        => 'preloader_bg_color',
                        'type'      => 'color',
                        'title'     => __('Preloader Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a Background color for the Preloader (default: #fff).', 'adeecore'),
                        'default'   => '#fff',
                        'validate'  => 'color',
                        'transparent'   =>true,
                    ),

                    array(
                        'id'        => 'onepage-eg',
                        'type'      => 'switch',
                        'title'     => __('Onepage', 'adeecore'),
                        'subtitle' => __('Enable or disable Onepage', 'adeecore'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'header-fixed',
                        'type'      => 'switch',
                        'title'     => __('Sticky Header', 'adeecore'),
                        'subtitle' => __('Enable or disable sicky Header', 'adeecore'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'cart_enable',
                        'type'      => 'switch',
                        'title'     => __('Cart Icon Enable', 'adeecore'),
                        'subtitle' => __('Enable or disable Cart Icon', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'search_enable',
                        'type'      => 'switch',
                        'title'     => __('Search Enable', 'adeecore'),
                        'subtitle' => __('Enable or disable Search', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'       => 'search_type',
                        'type'     => 'select',
                        'title'    => esc_html__('Search Type', 'adeecore'), 
                        'subtitle' => esc_html__('Select search type( Simple | Product )', 'adeecore'),
                        'options'  => array(
                            'simple'    => 'Simple Search',
                            'product' => 'Product Search'
                        ),
                        'default'  => 'simple',
                    ),

                    array(
                        'id'        => 'search_bgcolor',
                        'type'      => 'color',
                        'title'     => __('Search Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a background color for the search (default: #81d742).', 'adeecore'),
                        'default'   => '#81d742',
                        'validate'  => 'color',
                        'transparent'   => false,
                    ),
                                                                               
                    array(
                        'id'        => 'map-api-key',
                        'type'      => 'text',
                        'title'     => __('Google Map API Key', 'adeecore'),
                        'subtitle' => __('Put here Google Map API Key', 'adeecore'),
                        'default'   => '',
                    ), 

                    array(
                        'id'        => 'custom-css',
                        'type'      => 'ace_editor',
                        'mode'      => 'css',
                        'title'     => __('Custom CSS', 'adeecore'),
                        'subtitle' => __('Add some custom CSS', 'adeecore'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'custom_js',
                        'type'      => 'ace_editor',
                        'mode'      => 'javascript',
                        'title'     => __('Custom JS', 'adeecore'),
                        'subtitle' => __('Add some custom CSS', 'adeecore'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'google-analytics',
                        'type'      => 'textarea',
                        'title'     => __('Google Analytics Code', 'adeecore'),
                        'subtitle'  => __('Paste Your Google Analytics Code Here. This code will added to the footer', 'adeecore'),                                            
                    ), 

                )
            );

            /**********************************
            ********* Header Setting ***********
            ***********************************/
            $this->sections[] = array(
                'title'         => __('Header Settings', 'adeecore'),
                'icon'          => 'el el-lines',
                'icon_class'    => 'el-icon-large',
                'desc'          => __( 'General Header Settings', 'adeecore' ),
            );

            $this->sections[] = array(
                'title'         => __('Header', 'adeecore'),
                'subsection'    => true,
                'fields'        => array(  

                    array(
                        'id'        => 'header-padding-top',
                        'type'      => 'text',
                        'title'     => __('Header Top Padding', 'adeecore'),
                        'subtitle'  => __('Enter custom header top padding', 'adeecore'),
                        'default'   => '20',

                    ),  

                    array(
                        'id'        => 'header-padding-bottom',
                        'type'      => 'text',
                        'title'     => __('Header Bottom Padding', 'adeecore'),
                        'subtitle'  => __('Enter custom header bottom padding', 'adeecore'),
                        'default'   => '20',
                    ),     

                    array(
                        'id'        => 'header-height',
                        'type'      => 'text',
                        'title'     => __('Header Height ex. 60', 'adeecore'),
                        'subtitle'  => __('Enter custom header Height', 'adeecore'),
                        'default'   => '60',
                    ),

                    array(
                        'id'        => 'cta_button',
                        'type'      => 'switch',
                        'title'     => __('Call To Action Enable', 'adeecore'),
                        'subtitle' => __('Enable or disable call-to-action button', 'adeecore'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'cta_text',
                        'type'      => 'text',
                        'title'     => __('Call To Action Text', 'adeecore'),
                        'subtitle'  => __('Enter title for call to action button', 'adeecore'),
                        'required'  => array('cta_button', "=", true),
                    ),

                    array(
                        'id'        => 'cta_link',
                        'type'      => 'text',
                        'title'     => __('Call To Action Link', 'adeecore'),
                        'subtitle'  => __('Enter link for call to action button', 'adeecore'),
                        'required'  => array('cta_button', "=", true),
                    ),

                    array(
                        'id'        => 'cta_target',
                        'type'      => 'switch',
                        'title'     => __('Call To Action Target', 'adeecore'),
                        'subtitle' => __('Call to action button link target(new tab | same tab)', 'adeecore'),
                        'default'   => true,
                        'required'  => array('cta_button', "=", true),
                    ),

                    array(
                        'id'        => 'header_border',
                        'type'      => 'border',
                        'title'     => __('Header Border', 'adeecore'),
                        'subtitle'  => __('Set header bottom border', 'adeecore'),
                        'all'       => false,
                        'top'       => false,
                        'left'      => false,
                        'right'     => false,
                        'default'   => array(
                            'border-style'  => 'solid',
                            'border-bottom' => '2px',
                            'border-color'  => '#FC8C25',
                        ),
                    ),
                )
            );

            /***** Header Types *******/
            $this->sections[] = array(
                'title'         => __('Header Types', 'adeecore'),
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'        => 'header_type',
                        'type'      => 'image_select',
                        'title'     => __('Select Header Type', 'adeecore'),
                        'subtitle'  => __('Select an header for your website','adeecore'),
                        'options'   => array(
                            'layout1' => array('alt' => 'Header 1',       'img' => get_template_directory_uri() . '/images/headers/header_layout1.png'),
                            'layout2' => array('alt' => 'Header 2',       'img' => get_template_directory_uri() . '/images/headers/header_layout2.png'),
                            'layout3' => array('alt' => 'Header 3',       'img' => get_template_directory_uri() . '/images/headers/header_layout3.png'),
                            'layout4' => array('alt' => 'Header 4',       'img' => get_template_directory_uri() . '/images/headers/header_layout4.png'),
                            'layout5' => array('alt' => 'Header 5',       'img' => get_template_directory_uri() . '/images/headers/header_layout5.png'),
                            'layout6' => array('alt' => 'Header 6',       'img' => get_template_directory_uri() . '/images/headers/header_layout6.png'),
                            ),
                        'default'   => 'layout1'
                    ),

                    array(
                        'id'        => 'working_hours',
                        'type'      => 'text',
                        'title'     => __( 'Working Hours 1', 'adeecore' ),
                        'subtitle'  => __( 'Enter working hours line 1 (works with header layout 2 and 3)', 'adeecore' ),
                    ),

                    array(
                        'id'        => 'working_hours_span',
                        'type'      => 'text',
                        'title'     => __( 'Working Hours 2', 'adeecore' ),
                        'subtitle'  => __( 'Enter working hours line 2 (works with header layout 2 and 3)', 'adeecore' ),
                    ),

                    array(
                        'id'        => 'office_address',
                        'type'      => 'text',
                        'title'     => __( 'Office Address 1', 'adeecore' ),
                        'subtitle'  => __( 'Enter Office Address 1 (works with header layout 2 and 3)', 'adeecore' ),
                    ),

                    array(
                        'id'        => 'office_address_span',
                        'type'      => 'text',
                        'title'     => __( 'Office Address 2', 'adeecore' ),
                        'subtitle'  => __( 'Enter Office Address 2 (works with header layout 2 and 3)', 'adeecore' ),
                    ),
                )
            );

            /***** Header Top Setting *******/
            $this->sections[] = array(
                'title'         => __('Header Topbar', 'adeecore'),
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'        => 'topbar',
                        'type'      => 'switch',
                        'title'     => __('Topbar Enable', 'adeecore'),
                        'subtitle'  => __('Enable or disable Topbar', 'adeecore'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'top_welcome_note',
                        'type'      => 'text',
                        'title'     => __( 'Welcome Note', 'adeecore' ),
                        'subtitle'  => __( 'Enter website welcome note', 'adeecore' ),
                    ),

                    array(
                        'id'        => 'top_hotline',
                        'type'      => 'text',
                        'title'     => __( 'Hotline', 'adeecore' ),
                        'subtitle'  => __( 'Enter phone number', 'adeecore' ),
                    ),

                    array(
                        'id'        => 'top_hotline2',
                        'type'      => 'text',
                        'title'     => __( 'Hotline 2', 'adeecore' ),
                        'subtitle'  => __( 'Enter phone number', 'adeecore' ),
                    ),

                    array(
                        'id'        => 'top_email',
                        'type'      => 'text',
                        'title'     => __( 'Email', 'adeecore' ),
                        'subtitle'  => __( 'Enter email', 'adeecore' ),
                    ),

                    array(
                        'id'        => 'top_social',
                        'type'      => 'switch',
                        'title'     => __('Topbar Social Media', 'adeecore'),
                        'subtitle'  => __('Enable or disable topbar Social Media', 'adeecore'),
                        'default'   => false,
                    ),
                )
            );

            /***** Header Style *******/
            $this->sections[]  = array(
                'title'         => esc_html__('Header Style', 'adeecore'),
                'subsection'    => true,
                'fields'        => array(

                    array(
                        'id'            => 'topbar_bg',
                        'type'          => 'color',
                        'title'         => __('Topbar Background Color', 'adeecore'),
                        'subtitle'      => __('Pick a background color for the Topbar (default: #3F4347).', 'adeecore'),
                        'default'       => '#3F4347',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'topbar_color',
                        'type'          => 'color',
                        'title'         => __('Topbar Font Color', 'adeecore'),
                        'subtitle'      => __('Pick a font color for the topbar content (default: #dddddd).', 'adeecore'),
                        'default'       => '#dddddd',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'topbar_link_color',
                        'type'          => 'color',
                        'title'         => __('Topbar Link Color', 'adeecore'),
                        'subtitle'      => __('Pick a color for the topbar link (default: #dddddd).', 'adeecore'),
                        'default'       => '#dddddd',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'topbar_link_hover',
                        'type'          => 'color',
                        'title'         => __('Topbar Link Hover', 'adeecore'),
                        'subtitle'      => __('Pick a color for the topbar link hover (default: #F0F0F0).', 'adeecore'),
                        'default'       => '#F0F0F0',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    #header style
                    array(
                        'id'            => 'header-bg',
                        'type'          => 'color',
                        'title'         => __('Header Background Color', 'adeecore'),
                        'subtitle'      => __('Set a background color for the header (default: #F0F0F0).', 'adeecore'),
                        'default'       => '#F0F0F0',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'            => 'menu-font-color',
                        'type'          => 'color',
                        'title'         => __('Menu Font Color', 'adeecore'),
                        'subtitle'      => __('Set a Font color for the Menu (default: #2595FC).', 'adeecore'),
                        'default'       => '#2595FC',
                        'validate'      => 'color',
                        'transparent'   => false,
                    ),

                    array(
                        'id'        => 'menu-hover',
                        'type'      => 'color',
                        'title'     => __('Menu Hover Color', 'adeecore'),
                        'subtitle'  => __('Set a Menu Hover color (default: #3F4347).', 'adeecore'),
                        'default'   => '#3F4347',
                        'validate'  => 'color',
                        'transparent'   =>false,
                        'required'  => array('custom-preset-en', "=", 1),
                    ),

                    array(
                        'id'        => 'menu-active',
                        'type'      => 'color',
                        'title'     => __('Menu Active Color', 'adeecore'),
                        'subtitle'  => __('Set a menu active color (default: #3F4347).', 'adeecore'),
                        'default'   => '#3F4347',
                        'validate'  => 'color',
                        'transparent'   =>false,
                        'required'  => array('custom-preset-en', "=", 1),
                    ),


                    array(
                        'id'            => 'menu_bg',
                        'type'          => 'color',
                        'title'         => __('Menu Background Color', 'adeecore'),
                        'subtitle'      => __('Set a background color for the menu (default: #FFFFFF).', 'adeecore'),
                        'default'       => '#FFFFFF',
                        'validate'      => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'button-menu-color',
                        'type'      => 'color',
                        'title'     => __('Menu Button Color', 'adeecore'),
                        'subtitle'  => __('Pick a menu button color for the header (default: #F0F0F0).', 'adeecore'),
                        'default'   => '#F0F0F0',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'button-menu-bg-color',
                        'type'      => 'color',
                        'title'     => __('Button Menu Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a Button background color for the menu (default: #2595FC).', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'button-menu-hover-color',
                        'type'      => 'color',
                        'title'     => __('Menu Button Hover Color', 'adeecore'),
                        'subtitle'  => __('Pick a menu button color for the header (default: #FFFFFF).', 'adeecore'),
                        'default'   => '#FFFFFF',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'button-menu-bg-hover-color',
                        'type'      => 'color',
                        'title'     => __('Button Background Hover Color', 'adeecore'),
                        'subtitle'  => __('Pick a Button background Hover color for the menu (default: #1C70BD).', 'adeecore'),
                        'default'   => '#1C70BD',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    # sub menu
                    array(
                        'id'        => 'submenu-bg',
                        'type'      => 'color',
                        'title'     => __('Sub Menu Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a background color for the Subenu (default: #F0F0F0).', 'adeecore'),
                        'default'   => '#F0F0F0',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),
                    array(
                        'id'        => 'submenu-text-color',
                        'type'      => 'color',
                        'title'     => __('Sub Menu Text Color', 'adeecore'),
                        'subtitle'  => __('Pick a Text color for the Submenu (default: #2595FC).', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),
                    array(
                        'id'        => 'submenu-hover-bg',
                        'type'      => 'color',
                        'title'     => __('Sub Menu Background Hover Color', 'adeecore'),
                        'subtitle'  => __('Pick a background Hover color for the Submenu (default: #2595FC).', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),
                    array(
                        'id'        => 'submenu-text-hover-color',
                        'type'      => 'color',
                        'title'     => __('Sub Menu Text Hover Color', 'adeecore'),
                        'subtitle'  => __('Pick a Text Hover color for the Submenu (default: #F0F0F0).', 'adeecore'),
                        'default'   => '#F0F0F0',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),                                                                                                                                                            
                )
            );
               
                

            /**********************************
            **** Sub Header Color  *****
            ***********************************/
            
            $this->sections[] = array(
                'title'     => __('Sub Header', 'adeecore'),
                'icon'      => 'sub-header-icon',
                'icon_class' => 'el-icon-compass',
                'fields'    => array(

                    array(
                        'id'        => 'subheader_enable',
                        'type'      => 'switch',
                        'title'     => __('Enable Subtitle', 'adeecore'),
                        'subtitle' => __('Enable or disable Subtitle', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'       => 'home_breadcrumb',
                        'type'     => 'select',
                        'title'    => esc_html__('Select Home Breadcrumb', 'adeecore'), 
                        'subtitle' => esc_html__('Select Home title breadcrumb link type ( Text | Icon )', 'adeecore'),
                        'options'  => array(
                            'text'      => 'Text',
                            'icon'      => 'Icon',
                        ),
                        'default'  => 'text',
                    ),

                    array(
                        'id'        => 'subheader_bg',
                        'type'      => 'background',
                        'title'     => __('Subheader Background', 'adeecore'),
                        'subtitle'  => __('You can set Background color or images or patterns subheader', 'adeecore'),
                        'default'   => array(
                            'background-color'      => '#045191',
                        ),
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        =>'subheader_pad',
                        'type'      => 'spacing',
                        'mode'      => 'padding',
                        'title'     => __('Subheader Padding', 'adeecore'),
                        'subtitle'  => __('Set padding for subheader section', 'adeecore'),
                        'default'   => array('padding-top' => 30, 'padding-bottom' => 10, 'padding-left' => 0, 'padding-right' => 0)
                    ),

                    array(
                        'id'        => 'subheader_border',
                        'type'      => 'border',
                        'title'     => __('Subheader Border', 'adeecore'),
                        'subtitle'  => __('Set subheader bottom border', 'adeecore'),
                        'all'       => false,
                        'top'       => false,
                        'left'      => false,
                        'right'     => false,
                        'default'   => array(
                            'border-style'  => 'none',
                            'border-bottom' => '1px',
                            'border-color'  => '#2595FC',
                        ),
                    ),

                    array(
                        'id'        => 'subheader-title-color',
                        'type'      => 'color',
                        'title'     => __('Sub Header Title Color', 'adeecore'),
                        'subtitle'  => __('Pick a text color for the Sub header (default: #000).', 'adeecore'),
                        'default'   => '#FFFFFF',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'header-font-size',
                        'type'      => 'text',
                        'title'     => __('Sub Title Font Size ex. 48', 'adeecore'),
                        'subtitle' => __('Enter custom subtitle font size', 'adeecore'),
                        'default'   => '24',
                    ),  

                    #breadcrumb 

                    array(
                        'id'        => 'breadcrumb-text-color',
                        'type'      => 'color',
                        'title'     => __('Breadcrumb Text Color', 'adeecore'),
                        'subtitle'  => __('Pick a text sizr for the breadcrumb (default: #000).', 'adeecore'),
                        'default'   => '#FFFFFF',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'breadcrumb-font-size',
                        'type'      => 'text',
                        'title'     => __('Breadcrumb Font Size ex. 16', 'adeecore'),
                        'subtitle' => __('Enter custom breadcrumb font size', 'adeecore'),
                        'default'   => '14',
                    ),

                    array(
                        'id'        => 'subheader-margin-bottom',
                        'type'      => 'spacing',
                        'mode'      => 'margin',
                        'units'     => array('px'),
                        'title'     => __('Subheader Margin Bottom ex. 30', 'adeecore'),
                        'subtitle' => __('Enter custom Subheader Margin Bottom', 'adeecore'),
                        'left'      => false,
                        'right'     => false,
                        'top'       => false,
                        'default'            => array(
                            'margin-bottom'  => 0, 
                            'units'          => 'px', 
                        ),
                    ),

                ));
                        

            /**********************************
            ********* Logo & Favicon ***********
            ***********************************/

            $this->sections[] = array(
                'title'     => __('All Logo & favicon', 'adeecore'),
                'icon'      => 'el-icon-leaf',
                'icon_class' => 'el-icon-large',
                'fields'    => array(

                    array( 
                        'id'        => 'favicon', 
                        'type'      => 'media',
                        'desc'      => 'upload favicon image',
                        'title'      => 'Favicon',
                        'subtitle' => __('Upload favicon image', 'adeecore'),
                        'default' => array( 'url' => get_template_directory_uri() .'/images/favicon.ico' ), 
                    ),                                        

                    array(
                        'id'=>'logo',
                        'url'=> false,
                        'type' => 'media', 
                        'title' => __('Logo', 'adeecore'),
                        'default' => array( 'url' => get_template_directory_uri() .'/images/logo.png' ),
                        'subtitle' => __('Upload your custom site logo.', 'adeecore'),
                    ),

                    array(
                        'id'        => 'logo-width',
                        'type'      => 'text',
                        'title'     => esc_html__('Logo Widtht', 'adeecore'),
                        'subtitle' => esc_html__('Logo width', 'adeecore'),
                        'default'   => '134',
                    ), 

                    array(
                        'id'        => 'logo-height',
                        'type'      => 'text',
                        'title'     => esc_html__('Logo Height', 'adeecore'),
                        'subtitle' => esc_html__('Logo height', 'adeecore'),
                        'default'   => '35',
                    ),

                    array(
                        'id'=>'footer-logo',
                        'url'=> false,
                        'type' => 'media', 
                        'title' => __('Footer Logo', 'adeecore'),
                        'default' => array( 'url' => get_template_directory_uri() .'/images/footer-logo.png' ),
                        'subtitle' => __('Upload your custom footer logo.', 'adeecore'),
                    ),

                    array(
                        'id'        => 'logo-text-en',
                        'type'      => 'switch',
                        'title'     => __('Text Type Logo', 'adeecore'),
                        'subtitle' => __('Enable or disable text type logo', 'adeecore'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'logo-text',
                        'type'      => 'text',
                        'title'     => __('Logo Text', 'adeecore'),
                        'subtitle' => __('Use your Custom logo text Ex. adeecore', 'adeecore'),
                        'default'   => 'adeecore',
                        'required'  => array('logo-text-en', "=", 1),

                    ), 

                    array( 
                        'id'        => 'errorpage', 
                        'type'      => 'media',
                        'desc'      => 'upload 404 Page Background',
                        'title'      => '404 Page Background',
                        'subtitle' => __('Upload 404 Page Background', 'adeecore'),
                        'default' => array( 'url' => get_template_directory_uri() .'/images/404-bg.png' ), 
                    ),   

                    array( 
                        'id'        => 'comingsoon', 
                        'type'      => 'media',
                        'desc'      => 'Upload Coming Soon Page Background',
                        'title'      => 'Coming Soon Page Background',
                        'subtitle' => __('Upload Coming Soon Page Background', 'adeecore'),
                        'default' => array( 'url' => get_template_directory_uri() .'/images/countdown-bg.jpg' ), 
                    ),                                                         

                )
            );


            /**********************************
            ********* Layout & Styling ***********
            ***********************************/
            $this->sections[] = array(
                'title'         => __('Layout & Sidebars', 'adeecore'),
                'icon'          => 'el el-brush',
                'icon_class'    => 'el-icon-large',
                'desc'          => __( 'General Layout Settings', 'adeecore' ),
            );

            $this->sections[] = array(
                'subsection' => true,
                'title'     => __('Layout & Styling', 'adeecore'),
                'fields'    => array(

                   array(
                        'id'       => 'boxfull-en',
                        'type'     => 'image_select',
                        'title'    => esc_html__('Select Layout', 'adeecore'), 
                        'subtitle' => esc_html__('Select BoxWidth of FullWidth', 'adeecore'),
                        'options'  => array(
                            'boxwidth' => array('alt' => 'Box Width',       'img' => get_template_directory_uri() . '/images/boxwidth.png'),
                            'fullwidth' => array('alt' => 'Full Width',       'img' => get_template_directory_uri() . '/images/fullwidth.png'),
                        ),
                        'default'  => 'fullwidth',
                    ), 

                    array(
                        'id'            => 'box-background',
                        'type'          => 'background',
                        'output'        => array('body'),
                        'title'         => __('Body Background', 'adeecore'),
                        'subtitle'      => __('You can set Background color or images or patterns for site body tag', 'adeecore'),
                        'default'       => '#FFFFFF',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'preset',
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'title'     => __('Preset Layout', 'adeecore'),
                        'subtitle'  => __('select any preset', 'adeecore'),
                        'options'   => array(
                            '1' => array('alt' => 'Preset 1',       'img' => ReduxFramework::$_url . 'assets/img/presets/preset1.png'),
                            '2' => array('alt' => 'Preset 2',       'img' => ReduxFramework::$_url . 'assets/img/presets/preset2.png'),
                            '3' => array('alt' => 'Preset 3',       'img' => ReduxFramework::$_url . 'assets/img/presets/preset3.png'),
                            '4' => array('alt' => 'Preset 4',       'img' => ReduxFramework::$_url . 'assets/img/presets/preset4.png'),
                            ),
                        'default'   => '1'
                    ),  
                    
                    array(
                        'id'        => 'custom-preset-en',
                        'type'      => 'switch',
                        'title'     => __('Select Custom Color', 'adeecore'),
                        'subtitle' => __('You can use unlimited color', 'adeecore'),
                        'default'   => true,
                        
                    ),

                     array(
                        'id'        => 'link-color',
                        'type'      => 'color',
                        'title'     => __('Link Color', 'adeecore'),
                        'subtitle'  => __('Pick a link color (default: #2595FC).', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                        'required'  => array('custom-preset-en', "=", 1),
                    ),

                     array(
                        'id'        => 'hover-color',
                        'type'      => 'color',
                        'title'     => __('Hover Color', 'adeecore'),
                        'subtitle'  => __('Pick a hover color (default: #3c904f).', 'adeecore'),
                        'default'   => '#1C70BD',
                        'validate'  => 'color',
                        'transparent'   =>false,
                        'required'  => array('custom-preset-en', "=", 1),
                    ),

                    array( 
                        'id'        => 'content_padding', 
                        'type'      => 'spacing',
                        'mode'      => 'padding',
                        'units'     => array('px'),
                        'title'     => esc_html__('Content Padding','adeecore'),
                        'subtitle'  => esc_html__('Content Padding Top &amp; Bottom', 'adeecore'),
                        'left'      => false,
                        'right'     => false,
                        'default'   => array(
                            'padding-top'       => '40', 
                            'padding-bottom'    => '40', 
                            'units'             => 'px', 
                        ),
                    ), 
                )
            );

            /********** Sidebar **************/
            $this->sections[] = array(
                'subsection' => true,
                'title'     => __('Sidebar', 'adeecore'),
                'fields'    => array(

                    array(
                        'id'        => 'sidebar_generator',
                        'type'      => 'multi_text',
                        'title'     => __('Sidebar Generator', 'adeecore'),
                        'subtitle'  => __('Create custom unlimited sidebars', 'adeecore'),
                        'default'   => array(__('Primary Sidebar','adeecore'), __('Secondary Sidebar','adeecore')),
                    ),

                    array(
                        'id'        => 'sidebars_width',
                        'type'      => 'select',
                        'title'     => __( 'Sidebars Width', 'adeecore' ),
                        'subtitle'  => __( 'Set default sidebar width', 'adeecore' ),
                        'desc'      => '',
                        'options'   => array(
                            '3'         => __( 'One Fourth', 'adeecore' ),
                            '4'         => __( 'One Third', 'adeecore' ),
                        ),
                        'default'   => '4',
                    ),

                    array(
                        'id'        => 'pages_sidebar_layout',
                        'type'      => 'image_select',
                        'title'     => __( 'Pages Sidebar', 'adeecore' ),
                        'subtitle'  => __( 'Set default sidebar for pages', 'adeecore' ),
                        'desc'      => '',
                        'options'   => array(
                            'disabled'  => array( 'title'   => 'No Sidebar', 'img'  => get_template_directory_uri() . '/images/sidebars/sidebar_disabled.png' ),
                            'left'              => array( 'title'   => 'Left Sidebar', 'img'    => get_template_directory_uri() . '/images/sidebars/sidebar_left.png' ),
                            'right'             => array( 'title'   => 'Right Sidebar', 'img'   => get_template_directory_uri() . '/images/sidebars/sidebar_right.png' ),
                        ),
                        'default'       => 'disabled',
                    ),

                    array(
                        'id'        => 'single-page_sidebar',
                        'type'      => 'select',
                        'title'     => __( 'Select Page Sidebar', 'adeecore' ),
                        'subtitle'  => __( 'Select default pages sidebar', 'adeecore' ),
                        'desc'      => '',
                        'data'      => 'sidebars',
                    ),

                    array(
                        'id'        => 'post_sidebar_layout',
                        'type'      => 'image_select',
                        'title'     => __( 'Blogpost Sidebar', 'adeecore' ),
                        'subtitle'  => __( 'Set default sidebar for single blog post', 'adeecore' ),
                        'desc'      => '',
                        'options'   => array(
                            'disabled'  => array( 'title'   => 'No Sidebar', 'img'  => get_template_directory_uri() . '/images/sidebars/sidebar_disabled.png' ),
                            'left'              => array( 'title'   => 'Left Sidebar', 'img'    => get_template_directory_uri() . '/images/sidebars/sidebar_left.png' ),
                            'right'             => array( 'title'   => 'Right Sidebar', 'img'   => get_template_directory_uri() . '/images/sidebars/sidebar_right.png' ),
                        ),
                        'default'       => 'right',
                    ),

                    array(
                        'id'        => 'single-post_sidebar',
                        'type'      => 'select',
                        'title'     => __( 'Post Sidebar', 'adeecore' ),
                        'subtitle'  => __( 'Select default blog post sidebar', 'adeecore' ),
                        'desc'      => '',
                        'data'      => 'sidebars',
                    ),

                    array(
                        'id'        => 'portfolio_sidebar_layout',
                        'type'      => 'image_select',
                        'title'     => __( 'Portfolio Sidebar', 'adeecore' ),
                        'subtitle'  => __( 'Set default sidebar for Portfolio blog post', 'adeecore' ),
                        'desc'      => '',
                        'options'   => array(
                            'disabled'  => array( 'title'   => 'No Sidebar', 'img'  => get_template_directory_uri() . '/images/sidebars/sidebar_disabled.png' ),
                            'left'              => array( 'title'   => 'Left Sidebar', 'img'    => get_template_directory_uri() . '/images/sidebars/sidebar_left.png' ),
                            'right'             => array( 'title'   => 'Right Sidebar', 'img'   => get_template_directory_uri() . '/images/sidebars/sidebar_right.png' ),
                        ),
                        'default'       => 'right',
                    ),

                    array(
                        'id'        => 'single-portfolio_sidebar',
                        'type'      => 'select',
                        'title'     => __( 'Portfolio Sidebar', 'adeecore' ),
                        'subtitle'  => __( 'Select default blog portfolio sidebar', 'adeecore' ),
                        'desc'      => '',
                        'data'      => 'sidebars',
                    ),
                )
            );

            /**********************************
            ********* Typography ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-font',
                'icon_class' => 'el-icon-large',                
                'title'     => __('Typography', 'adeecore'),
                'fields'    => array(

                    array(
                        'id'            => 'body-font',
                        'type'          => 'typography',
                        'title'         => __('Body Font', 'adeecore'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        //'font-size'     => true,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('body'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Body Font', 'adeecore'),
                        'default'       => array(
                            'color'         => '#333',
                            'font-weight'    => '200',
                            'font-family'   => 'Merriweather',
                            'google'        => true,
                            'font-size'     => '14px'),
                    ), 

                    array(
                        'id'            => 'menu-font',
                        'type'          => 'typography',
                        'title'         => __('Menu Font', 'adeecore'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => false,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('#main-menu .nav>li>a, #main-menu ul.sub-menu li > a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Menu Font', 'adeecore'),
                        'default'       => array(
                            'font-weight'    => '500',
                            'font-family'   => 'Roboto',
                            'google'        => true,
                            'font-size'     => '16px'),
                    ),

                    array(
                        'id'            => 'headings-font_h1',
                        'type'          => 'typography',
                        'title'         => __('Headings Font h1', 'adeecore'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('h1'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Headings Font', 'adeecore'),
                        'default'       => array(
                            'color'         => '#000',
                            'font-weight'    => '400',
                            'font-family'   => 'Raleway',
                            'google'        => true,
                            'font-size'     => '42px'),
                    ),                      

                    array(
                        'id'            => 'headings-font_h2',
                        'type'          => 'typography',
                        'title'         => __('Headings Font h2', 'adeecore'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('h2'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Headings Font', 'adeecore'),
                        'default'       => array(
                            'color'         => '#000',
                            'font-weight'    => '300',
                            'font-family'   => 'Raleway',
                            'google'        => true,
                            'font-size'     => '36px'),
                    ),                      

                    array(
                        'id'            => 'headings-font_h3',
                        'type'          => 'typography',
                        'title'         => __('Headings Font h3', 'adeecore'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('h3'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Headings Font', 'adeecore'),
                        'default'       => array(
                            'color'         => '#000',
                            'font-weight'    => '300',
                            'font-family'   => 'Raleway',
                            'google'        => true,
                            'font-size'     => '32px'),
                    ),                     

                    array(
                        'id'            => 'headings-font_h4',
                        'type'          => 'typography',
                        'title'         => __('Headings Font h4', 'adeecore'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('h4'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Headings Font', 'adeecore'),
                        'default'       => array(
                            'color'         => '#000',
                            'font-weight'    => '300',
                            'font-family'   => 'Raleway',
                            'google'        => true,
                            'font-size'     => '24px'),
                    ),                      

                    array(
                        'id'            => 'headings-font_h5',
                        'type'          => 'typography',
                        'title'         => __('Headings Font h5', 'adeecore'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('h5'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Headings Font', 'adeecore'),
                        'default'       => array(
                            'color'         => '#000',
                            'font-weight'    => '200',
                            'font-family'   => 'Raleway',
                            'google'        => true,
                            'font-size'     => '18px'),
                    ),

                    array(
                        'id'            => 'headings-font_h6',
                        'type'          => 'typography',
                        'title'         => __('Headings Font h6', 'adeecore'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('h6'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Headings Font', 'adeecore'),
                        'default'       => array(
                            'color'         => '#000',
                            'font-weight'    => '200',
                            'font-family'   => 'Raleway',
                            'google'        => true,
                            'font-size'     => '15px'),
                    ),

                    array(
                        'id'            => 'blockquote_font',
                        'type'          => 'typography',
                        'title'         => __('blockquote Font', 'adeecore'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('blockquote p','blockquote'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website blockquote Font', 'adeecore'),
                        'default'       => array(
                            'color'         => '#3d3d3d',
                            'font-weight'    => '300',
                            'font-family'   => 'Merriweather',
                            'google'        => true,
                            'font-style'    => 'italic',
                            'font-size'     => '16px'),
                    ),    

                )
            );



            /**********************************
            ********* Shortcodes Color ********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-tasks',
                'icon_class' => 'el-icon-large',                
                'title'     => __('Shortcodes Color', 'adeecore'),
                'fields'    => array(

                    array(
                        'id'            => 'accordion-section',
                        'type'          => 'section',
                        'title'         => __('Accordion Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'accordion-color',
                        'type'      => 'color',
                        'title'     => __('Accordion Title Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for accordion title.', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'accordion-bg',
                        'type'      => 'color',
                        'title'     => __('Accordion Title Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for accordion title background.', 'adeecore'),
                        'default'   => '#dddddd',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'accordion-color-active',
                        'type'      => 'color',
                        'title'     => __('Accordion Title Color | ACTIVE', 'adeecore'),
                        'subtitle'  => __('Pick a color for active accordion title.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'accordion-bg-active',
                        'type'      => 'color',
                        'title'     => __('Accordion Title Background Color | ACTIVE', 'adeecore'),
                        'subtitle'  => __('Pick a color for active accordion title background.', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'audio-section',
                        'type'          => 'section',
                        'title'         => __('Audio Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'audio-color',
                        'type'      => 'color',
                        'title'     => __('Audio Title Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for audio title.', 'adeecore'),
                        'default'   => '#FFFFFF',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'audio-bg',
                        'type'      => 'color',
                        'title'     => __('Audio Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for audio background.', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'audio-icon',
                        'type'      => 'color',
                        'title'     => __('Audio Icon Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for audio icon(work with popup style).', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'blockquote-section',
                        'type'          => 'section',
                        'title'         => __('Blockquote Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'blockquote-background',
                        'type'      => 'color',
                        'title'     => __('Blockquote Background', 'adeecore'),
                        'subtitle'  => __('Pick a color for blockquote background color.', 'adeecore'),
                        'default'   => '#F9F9F9',
                        'validate'  => 'color',
                        'transparent'   =>true,
                    ),

                    array(
                        'id'        => 'blockquote-color',
                        'type'      => 'color',
                        'title'     => __('Blockquote Border', 'adeecore'),
                        'subtitle'  => __('Pick a color for blockquote border.', 'adeecore'),
                        'default'   => '#CCCCCC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'button-section',
                        'type'          => 'section',
                        'title'         => __('Button Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'button-color',
                        'type'      => 'color',
                        'title'     => __('Button Title Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for button title.', 'adeecore'),
                        'default'   => '#FFFFFF',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'button-bg',
                        'type'      => 'color',
                        'title'     => __('Button Title Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for button background color.', 'adeecore'),
                        'default'   => '#2082DD',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'button-color-hover',
                        'type'      => 'color',
                        'title'     => __('Button Title Color | HOVER', 'adeecore'),
                        'subtitle'  => __('Pick a color for hover button title.', 'adeecore'),
                        'default'   => '#F0F0F0',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'button-bg-hover',
                        'type'      => 'color',
                        'title'     => __('Button Background Color | HOVER', 'adeecore'),
                        'subtitle'  => __('Pick a color for hover button background.', 'adeecore'),
                        'default'   => '#175D9E',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'chart-section',
                        'type'          => 'section',
                        'title'         => __('Chart Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'chart-color',
                        'type'      => 'color',
                        'title'     => __('Chart Title Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for chart title.', 'adeecore'),
                        'default'   => '#333',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'chart-label',
                        'type'      => 'color',
                        'title'     => __('Chart Label Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for chart label color.', 'adeecore'),
                        'default'   => '#888',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'counter-section',
                        'type'          => 'section',
                        'title'         => __('Counter Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'counter-color',
                        'type'      => 'color',
                        'title'     => __('Counter Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for counter.', 'adeecore'),
                        'default'   => '#033057',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'counter-icon-color',
                        'type'      => 'color',
                        'title'     => __('Icon Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for counter icon.', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'counter-icon-bg',
                        'type'      => 'color',
                        'title'     => __('Icon Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for counter icon background.', 'adeecore'),
                        'default'   => '#F0F0F0',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'countdown-section',
                        'type'          => 'section',
                        'title'         => __('Countdown Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'countdown-color',
                        'type'      => 'color',
                        'title'     => __('Countdown Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for countdown.', 'adeecore'),
                        'default'   => '#333',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'countdown-bg',
                        'type'      => 'color',
                        'title'     => __('Countdown Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for countdown background(works with classic and modern type).', 'adeecore'),
                        'default'   => '#F0F0F0',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'dropcap-section',
                        'type'          => 'section',
                        'title'         => __('Dropcap Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'dropcap-color',
                        'type'      => 'color',
                        'title'     => __('Dropcap Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for dropcap.', 'adeecore'),
                        'default'   => '#333',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'dropcap-bg',
                        'type'      => 'color',
                        'title'     => __('Dropcap Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for dropcap background(works with classic and modern type).', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'faq-section',
                        'type'          => 'section',
                        'title'         => __('FAQ Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'faq-color',
                        'type'      => 'color',
                        'title'     => __('FAQ Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for faq title.', 'adeecore'),
                        'default'   => '#333',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'faq-bg',
                        'type'      => 'color',
                        'title'     => __('FAQ Title Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for faq title background.', 'adeecore'),
                        'default'   => '#F0F0F0',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'faq-color-active',
                        'type'      => 'color',
                        'title'     => __('FAQ Color | ACTIVE', 'adeecore'),
                        'subtitle'  => __('Pick a color for active faq title.', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'faq-bg-active',
                        'type'      => 'color',
                        'title'     => __('FAQ Title Background Color | ACTIVE', 'adeecore'),
                        'subtitle'  => __('Pick a color for active faq title background.', 'adeecore'),
                        'default'   => '#dddddd',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'map-section',
                        'type'          => 'section',
                        'title'         => __('Map Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'map-color',
                        'type'      => 'color',
                        'title'     => __('Map Text Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for map content text.', 'adeecore'),
                        'default'   => '#fff',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'map-bg',
                        'type'      => 'color',
                        'title'     => __('Map Details Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for map details background.', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'map-icon-color',
                        'type'      => 'color',
                        'title'     => __('Map Icon Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for map icon.', 'adeecore'),
                        'default'   => '#FC8C25',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'highlight-section',
                        'type'          => 'section',
                        'title'         => __('Highlight Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'highlight-color',
                        'type'      => 'color',
                        'title'     => __('Highlight Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for highlight text.', 'adeecore'),
                        'default'   => '#fff',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'highlight-bg',
                        'type'      => 'color',
                        'title'     => __('Highlight text Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for highlight text background.', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'iconbox-section',
                        'type'          => 'section',
                        'title'         => __('Iconbox Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'iconbox-icon-color',
                        'type'      => 'color',
                        'title'     => __('Icon Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for iconbox icon.', 'adeecore'),
                        'default'   => '#e3d200',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'iconbox-icon-bg',
                        'type'      => 'color',
                        'title'     => __('Icon Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for iconbox icon background.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'infolist-section',
                        'type'          => 'section',
                        'title'         => __('Info List Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'infolist-icon-color',
                        'type'      => 'color',
                        'title'     => __('Icon Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for infolist icon.', 'adeecore'),
                        'default'   => '#e3d200',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'infolist-icon-bg',
                        'type'      => 'color',
                        'title'     => __('Icon Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for infolist icon background.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'infolist-connector',
                        'type'      => 'color',
                        'title'     => __('Connector Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for infolist connector color.', 'adeecore'),
                        'default'   => '#c8c7c7',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),


                    array(
                        'id'            => 'pricing-section',
                        'type'          => 'section',
                        'title'         => __('Pricing Table Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'pricing-color',
                        'type'      => 'color',
                        'title'     => __('Pricing Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for price.', 'adeecore'),
                        'default'   => '#f4f4f4',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'pricing-bg',
                        'type'      => 'color',
                        'title'     => __('Pricing Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for pricing background.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'tabs-section',
                        'type'          => 'section',
                        'title'         => __('Tabs Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'tabs-color',
                        'type'      => 'color',
                        'title'     => __('Tabs Title Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for tabs title.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'tabs-bg',
                        'type'      => 'color',
                        'title'     => __('Tab Title Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for tabs title background.', 'adeecore'),
                        'default'   => '#dddddd',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'tabs-color-active',
                        'type'      => 'color',
                        'title'     => __('Tabs Title Color | ACTIVE', 'adeecore'),
                        'subtitle'  => __('Pick a color for active tabs title.', 'adeecore'),
                        'default'   => '#f4f4f4',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'tabs-bg-active',
                        'type'      => 'color',
                        'title'     => __('Tab Title Background Color | ACTIVE', 'adeecore'),
                        'subtitle'  => __('Pick a color for active tabs title background.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'tabs-section',
                        'type'          => 'section',
                        'title'         => __('Tabs Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'tabs-color',
                        'type'      => 'color',
                        'title'     => __('Tabs Title Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for tabs title.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'tabs-bg',
                        'type'      => 'color',
                        'title'     => __('Tab Title Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for tabs title background.', 'adeecore'),
                        'default'   => '#dddddd',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'tabs-color-active',
                        'type'      => 'color',
                        'title'     => __('Tabs Title Color | ACTIVE', 'adeecore'),
                        'subtitle'  => __('Pick a color for active tabs title.', 'adeecore'),
                        'default'   => '#f4f4f4',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'tabs-bg-active',
                        'type'      => 'color',
                        'title'     => __('Tab Title Background Color | ACTIVE', 'adeecore'),
                        'subtitle'  => __('Pick a color for active tabs title background.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'timeline-section',
                        'type'          => 'section',
                        'title'         => __('Timeline Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'timeline-color',
                        'type'      => 'color',
                        'title'     => __('Timeline Content Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for timeline content.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'timeline-bg',
                        'type'      => 'color',
                        'title'     => __('Timeline Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for timeline background.', 'adeecore'),
                        'default'   => '#FFFFFF',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'timeline-icon-color',
                        'type'      => 'color',
                        'title'     => __('Icon Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for timeline icon color.', 'adeecore'),
                        'default'   => '#f4f4f4',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'timeline-icon-bg',
                        'type'      => 'color',
                        'title'     => __('Icon Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for timeline icon background.', 'adeecore'),
                        'default'   => '#e3d200',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'toggle-section',
                        'type'          => 'section',
                        'title'         => __('Toggle Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'toggle-color',
                        'type'      => 'color',
                        'title'     => __('Toggle Title Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for toggle title.', 'adeecore'),
                        'default'   => '#e3d200',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'toggle-bg',
                        'type'      => 'color',
                        'title'     => __('Toggle Title Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for toggle title background.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'toggle-color-active',
                        'type'      => 'color',
                        'title'     => __('Toggle Title Color | ACTIVE', 'adeecore'),
                        'subtitle'  => __('Pick a color for active accordion toggle.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'toggle-bg-active',
                        'type'      => 'color',
                        'title'     => __('Toggle Title Background Color | ACTIVE', 'adeecore'),
                        'subtitle'  => __('Pick a color for active toggle title background.', 'adeecore'),
                        'default'   => '#e3d200',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'tooltip-section',
                        'type'          => 'section',
                        'title'         => __('Tooltip Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'tooltip-color',
                        'type'      => 'color',
                        'title'     => __('Tooltip Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for tooltip title.', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'tooltip-bg',
                        'type'      => 'color',
                        'title'     => __('Tooltip Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for tooltip background.', 'adeecore'),
                        'default'   => '#e3d200',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'            => 'video-section',
                        'type'          => 'section',
                        'title'         => __('Video Color', 'adeecore'),
                        'indent'        => true
                    ),

                    array(
                        'id'        => 'video-color',
                        'type'      => 'color',
                        'title'     => __('Video Title Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for video title.', 'adeecore'),
                        'default'   => '#fefefe',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'video-bg',
                        'type'      => 'color',
                        'title'     => __('Video Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for video background (work with popup style).', 'adeecore'),
                        'default'   => '#231f20',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'video-icon',
                        'type'      => 'color',
                        'title'     => __('Video Icon Color', 'adeecore'),
                        'subtitle'  => __('Pick a color for video icon (work with popup style).', 'adeecore'),
                        'default'   => '#e3d200',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                )
            );



            /**********************************
            ********* Coming Soon  ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-time',
                'icon_class' => 'el-icon-large',                  
                'title'     => __('Coming Soon', 'adeecore'),
                'fields'    => array(

                    array(
                        'id'        => 'comingsoon-en',
                        'type'      => 'switch',
                        'title'     => __('Enable Coming Soon', 'adeecore'),
                        'subtitle'  => __('Enable or disable coming soon mode', 'adeecore'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'comingsoon-date',
                        'type'      => 'date',
                        'title'     => __('Coming Soon date', 'adeecore'),
                        'subtitle'  => __('Coming Soon Date', 'adeecore'),
                        'default'   => __('08/30/2018', 'adeecore')
                        
                    ),

                    array(
                        'id'        => 'comingsoon-title',
                        'type'      => 'text',
                        'title'     => __('Title', 'adeecore'),
                        'subtitle'  => __('Coming Soon Title', 'adeecore'),
                        'default'   => __('A Minty Surprize is Coming Your Way!', 'adeecore')
                    ),

                    array(
                        'id'        => 'comingsoon-message-desc',
                        'type'      => 'text',
                        'title'     => __('Description', 'adeecore'),
                        'subtitle'  => __('Coming Soon Description', 'adeecore'),
                        'default'   => __('We’re working hard and our estimated time before launch:', 'adeecore')
                    ),
                )
            );


            /**********************************
            ********* Blog  ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-edit',
                'icon_class' => 'el-icon-large',                  
                'title'     => __('Blog', 'adeecore'),
                'fields'    => array(

                    array(
                        'id'        => 'blogpost_layout',
                        'type'      => 'image_select',
                        'title'     => __( 'Blogpost Layout', 'adeecore' ),
                        'subtitle'  => __( 'Select blogpost layout', 'adeecore' ),
                        'desc'      => '',
                        'options'   => array(
                            'full_image_layout' => array( 'title' => 'Full Image', 'img' =>  get_template_directory_uri()  . '/images/blog/full_image_layout.png' ),
                            'list_layout' => array( 'title' => 'List', 'img' =>  get_template_directory_uri()  . '/images/blog/list_layout.png' ),
                            'grid_layout' => array( 'title' => 'Grid', 'img' =>  get_template_directory_uri()  . '/images/blog/grid_layout.png' ),
                            'masonry_layout' => array( 'title' => 'Masonry', 'img' =>  get_template_directory_uri()  . '/images/blog/masonry_layout.png' ),
                        ),
                        'default'   => 'list_layout',
                    ),

                    array(
                        'id'        => 'blogpost_col',
                        'type'      => 'select',
                        'title'     => esc_html__('Select Column', 'adeecore'), 
                        'subtitle'  => esc_html__('Select column number. Works only with ( Grid and Masonry Layout )', 'adeecore'),
                        'options'   => array(
                            'cols__2'      => '2 Column',
                            'cols__3'      => '3 Column',
                            'cols__4'      => '4 Column',
                        ),
                        'required'  => array(
                            array( 'blogpost_layout', '!=', 'full_image_layout' ),
                            array( 'blogpost_layout', '!=', 'list_layout' ),
                        ),
                        'default'   => 'cols__3',
                    ),

                    array(
                        'id'        => 'blog-posts',
                        'type'      => 'text',
                        'title'     => __('Blog posts / Page', 'adeecore'),
                        'subtitle'  => __('Blog post to show per page', 'adeecore'),
                        'default'   => 10,
                    ),

                    array(
                        'id'        => 'blog-loadmore',
                        'type'      => 'switch',
                        'title'     => __('Load more', 'shapebootstrap'),
                        'subtitle'  => __('Enable load more button to replace the normal pagination', 'shapebootstrap'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'blog-social',
                        'type'      => 'switch',
                        'title'     => __('Blog Single Page Social Share', 'shapebootstrap'),
                        'subtitle'  => __('Enable or disable blog social share for single page', 'shapebootstrap'),
                        'default'   => true,
                    ),                     

                    array(
                        'id'        => 'blog-comment',
                        'type'      => 'switch',
                        'title'     => __('Post Comment', 'adeecore'),
                        'subtitle'  => __('Enable or disable post comment', 'adeecore'),
                        'default'   => true,
                    ),                 

                    array(
                        'id'        => 'blog-author',
                        'type'      => 'switch',
                        'title'     => __('Blog Author', 'adeecore'),
                        'subtitle'  => __('Enable Blog Author ex. Admin', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog-date',
                        'type'      => 'switch',
                        'title'     => __('Blog Date', 'adeecore'),
                        'subtitle'  => __('Enable Blog Date ', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog-category',
                        'type'      => 'switch',
                        'title'     => __('Blog Category', 'adeecore'),
                        'subtitle'  => __('Enable or disable blog category', 'adeecore'),
                        'default'   => true,
                    ), 


                    array(
                        'id'        => 'blog-tag',
                        'type'      => 'switch',
                        'title'     => __('Blog Tag', 'adeecore'),
                        'subtitle'  => __('Enable Blog Tag ', 'adeecore'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'post-love',
                        'type'      => 'switch',
                        'title'     => __('Like Post', 'adeecore'),
                        'subtitle'  => __('Enable or Disable like this post icon', 'adeecore'),
                        'default'   => true,
                    ),  

                    array(
                        'id'        => 'blog-edit-en',
                        'type'      => 'switch',
                        'title'     => __('Post Edit', 'adeecore'),
                        'subtitle'  => __('Enable or disable post edit', 'adeecore'),
                        'default'   => false,
                    ),                                        
                    
                    array(
                        'id'        => 'blog-single-comment-en',
                        'type'      => 'switch',
                        'title'     => __('Single Post Comment', 'adeecore'),
                        'subtitle'  => __('Enable Single post comment ', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'post-nav-en',
                        'type'      => 'switch',
                        'title'     => __('Post navigation', 'adeecore'),
                        'subtitle'  => __('Enable Post navigation ', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog-continue-en',
                        'type'      => 'switch',
                        'title'     => __('Blog Readmore', 'adeecore'),
                        'subtitle'  => __('Enable Blog Readmore', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog-continue',
                        'type'      => 'text',
                        'title'     => __('Continue Reading', 'adeecore'),
                        'subtitle'  => __('Continue Reading Text', 'adeecore'),
                        'default'   => __('Continue Reading...', 'adeecore'),
                        'required'  => array('blog-continue-en', "=", 1),
                    ),

                    array(
                        'id'        => 'excerpt-length',
                        'type'      => 'text',
                        'title'     => __('Excerpt Length', 'adeecore'),
                        'subtitle'  => __('Maximum excerpt length (default is 140)', 'adeecore'),
                        'default'   => 140,
                        'validate'  => 'numeric',
                        'required'  => array('blog-continue-en', "=", 1),
                    ),

                )
            );



            /**********************************
            ********* Portfolio  **************
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-folder',
                'icon_class' => 'el-icon-large',                  
                'title'     => __('Portfolio', 'adeecore'),
                'fields'    => array(

                    array(
                        'id'        => 'portfolio_layout',
                        'type'      => 'image_select',
                        'title'     => __( 'Portfolio Layout', 'adeecore' ),
                        'subtitle'  => __( 'Select portfolio layout', 'adeecore' ),
                        'desc'      => '',
                        'options'   => array(
                            'full_image_layout' => array( 'title' => 'Full Image', 'img' =>  get_template_directory_uri()  . '/images/blog/full_image_layout.png' ),
                            'list_layout' => array( 'title' => 'List', 'img' =>  get_template_directory_uri()  . '/images/blog/list_layout2.png' ),
                            'grid_layout' => array( 'title' => 'Grid', 'img' =>  get_template_directory_uri()  . '/images/blog/grid_layout.png' ),
                            'masonry_layout' => array( 'title' => 'Masonry', 'img' =>  get_template_directory_uri()  . '/images/blog/masonry_layout.png' ),
                            'flat_grid_layout' => array( 'title' => 'Flat Grid', 'img' =>  get_template_directory_uri()  . '/images/blog/flat_grid_layout.png' ),
                            'flat_masonry_layout' => array( 'title' => 'Flat Masonry', 'img' =>  get_template_directory_uri()  . '/images/blog/flat_masonry_layout.png' ),
                        ),
                        'default'   => 'list_layout',
                    ),

                    array(
                        'id'        => 'portfolio_col',
                        'type'      => 'select',
                        'title'     => esc_html__('Select Column', 'adeecore'), 
                        'subtitle'  => esc_html__('Select column number. Works only with ( Grid and Masonry Layout )', 'adeecore'),
                        'options'   => array(
                            'cols__2'      => '2 Column',
                            'cols__3'      => '3 Column',
                            'cols__4'      => '4 Column',
                        ),
                        'required'  => array(
                            array( 'portfolio_layout', '!=', 'full_image_layout' ),
                            array( 'portfolio_layout', '!=', 'list_layout' ),
                        ),
                        'default'   => 'cols__3',
                    ),

                    array(
                        'id'        => 'portfolio_pad',
                        'type'      => 'select',
                        'title'     => esc_html__('Portfolio Padding', 'adeecore'), 
                        'subtitle'  => esc_html__('Select Portfolio items padding ( Flat Grid and Flat Masonry Layout )', 'adeecore'),
                        'options'   => array(
                            0           => '0px',
                            5           => '5px',
                            10          => '10px',
                            15          => '15px',
                            20          => '20px',
                        ),
                        'required'  => array(
                            array( 'portfolio_layout', '!=', 'full_image_layout' ),
                            array( 'portfolio_layout', '!=', 'list_layout' ),
                            array( 'portfolio_layout', '!=', 'grid_layout' ),
                            array( 'portfolio_layout', '!=', 'masonry_layout' ),
                        ),
                        'default'   => 0,
                    ),

                    array(
                        'id'        => 'portfolio_filter',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Filter', 'adeecore'), 
                        'subtitle'  => esc_html__('Enable or disable portfolio filter. Works only with ( Grid and Masonry Layout )', 'adeecore'),
                        'required'  => array(
                            array( 'portfolio_layout', '!=', 'full_image_layout' ),
                            array( 'portfolio_layout', '!=', 'list_layout' ),
                        ),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'portfolio-posts',
                        'type'      => 'text',
                        'title'     => __('Portfolio posts / Page', 'adeecore'),
                        'subtitle'  => __('Portfolio post to show per page', 'adeecore'),
                        'default'   => 10,
                    ),

                    array(
                        'id'        => 'portfolio-loadmore',
                        'type'      => 'switch',
                        'title'     => __('Load more', 'shapebootstrap'),
                        'subtitle'  => __('Enable load more button to replace the normal pagination', 'shapebootstrap'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'portfolio-social',
                        'type'      => 'switch',
                        'title'     => __('Blog Single Page Social Share', 'shapebootstrap'),
                        'subtitle'  => __('Enable or disable blog social share for single page', 'shapebootstrap'),
                        'default'   => true,
                    ),                     

                    array(
                        'id'        => 'portfolio-comment',
                        'type'      => 'switch',
                        'title'     => __('Portfolio Comment', 'adeecore'),
                        'subtitle'  => __('Enable or disable portfolio comment', 'adeecore'),
                        'default'   => true,
                    ),                 

                    array(
                        'id'        => 'portfolio-author',
                        'type'      => 'switch',
                        'title'     => __('Blog Author', 'adeecore'),
                        'subtitle'  => __('Enable Blog Author ex. Admin', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'portfolio-date',
                        'type'      => 'switch',
                        'title'     => __('Portfolio Date', 'adeecore'),
                        'subtitle'  => __('Enable Portfolio Date ', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'portfolio-category',
                        'type'      => 'switch',
                        'title'     => __('Portfolio Category', 'adeecore'),
                        'subtitle'  => __('Enable or disable blog category', 'adeecore'),
                        'default'   => true,
                    ), 

                    array(
                        'id'        => 'post-love',
                        'type'      => 'switch',
                        'title'     => __('Like Portfolio', 'adeecore'),
                        'subtitle'  => __('Enable or Disable like this portfolio icon', 'adeecore'),
                        'default'   => true,
                    ),  

                    array(
                        'id'        => 'portfolio-edit-en',
                        'type'      => 'switch',
                        'title'     => __('Portfolio Edit', 'adeecore'),
                        'subtitle'  => __('Enable or disable portfolio edit', 'adeecore'),
                        'default'   => false,
                    ),                                        
                    
                    array(
                        'id'        => 'portfolio-single-comment-en',
                        'type'      => 'switch',
                        'title'     => __('Single Post Comment', 'adeecore'),
                        'subtitle'  => __('Enable Single post comment ', 'adeecore'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'portfolio-nav-en',
                        'type'      => 'switch',
                        'title'     => __('Portfolio navigation', 'adeecore'),
                        'subtitle'  => __('Enable portfolio navigation ', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'portfolio-continue-en',
                        'type'      => 'switch',
                        'title'     => __('Blog Readmore', 'adeecore'),
                        'subtitle'  => __('Enable Blog Readmore', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'portfolio-continue',
                        'type'      => 'text',
                        'title'     => __('Continue Reading', 'adeecore'),
                        'subtitle'  => __('Continue Reading Text', 'adeecore'),
                        'default'   => __('Continue Reading...', 'adeecore'),
                        'required'  => array('portfolio-continue-en', "=", 1),
                    ),

                )
            );



            /**********************************
            ********* Woocommerce  ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-shopping-cart',
                'icon_class' => 'el-icon-large',                  
                'title'     => __('Woocommerce', 'adeecore'),
                'fields'    => array(

                    array(
                        'id'        => 'shop_sidebar_layout',
                        'type'      => 'image_select',
                        'title'     => __( 'Woocommerce Sidebar', 'adeecore' ),
                        'subtitle'  => __( 'Set default sidebar for woocommerce', 'adeecore' ),
                        'desc'      => '',
                        'options'   => array(
                            'disabled'  => array( 'title'   => 'No Sidebar', 'img'  => get_template_directory_uri() . '/images/sidebars/sidebar_disabled.png' ),
                            'left'              => array( 'title'   => 'Left Sidebar', 'img'    => get_template_directory_uri() . '/images/sidebars/sidebar_left.png' ),
                            'right'             => array( 'title'   => 'Right Sidebar', 'img'   => get_template_directory_uri() . '/images/sidebars/sidebar_right.png' ),
                        ),
                        'default'       => 'right',
                    ),

                    array(
                        'id'        => 'shop_products',
                        'type'      => 'text',
                        'title'     => __('Products / Page', 'adeecore'),
                        'subtitle'  => __('Products to show per page', 'adeecore'),
                        'default'   => 10,
                        'validate'  => 'numeric',
                    ),

                    array(
                        'id'        => 'shop_row',
                        'type'      => 'select',
                        'title'     => esc_html__('Products / Row', 'adeecore'), 
                        'subtitle'  => esc_html__('Products column per row', 'adeecore'),
                        'options'   => array(
                            2           => '2 Column',
                            3           => '3 Column',
                            4           => '4 Column',
                        ),

                        'default'   => 3,
                    ),

                    array(
                        'id'        => 'shop_second_img',
                        'type'      => 'switch',
                        'title'     => __('Enable Secondary Image', 'adeecore'),
                        'subtitle'  => __('Enable or disable secondary image display on hover', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'related_product_en',
                        'type'      => 'switch',
                        'title'     => __('Enable related products', 'adeecore'),
                        'subtitle'  => __('Enable/Disable related products', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'related_products',
                        'type'      => 'text',
                        'title'     => __('Related Products count', 'adeecore'),
                        'subtitle'  => __('Number of related products to show', 'adeecore'),
                        'default'   => 6,
                        'validate'  => 'numeric',
                        'required'  => array(
                            array( 'related_product_en', '=', true ),
                        ),
                    ),
                )
            );



            /**********************************
            ********* Social Media Link ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-asterisk',
                'icon_class' => 'el-icon-large', 
                'title'     => __('Social Media', 'adeecore'),
                'fields'    => array(
                 
                    array(
                        'id'        => 'social_link_target',
                        'type'      => 'switch',
                        'title'     => __('Social Media Target', 'adeecore'),
                        'subtitle' => __('Select social media link target(new tab | same tab)', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'wp-facebook',
                        'type'      => 'text',
                        'title'     => __('Add Facebook URL', 'adeecore'),
                    ),
                    array(
                        'id'        => 'wp-twitter',
                        'type'      => 'text',
                        'title'     => __('Add Twitter URL', 'adeecore'),
                    ),
                    array(
                        'id'        => 'wp-google-plus',
                        'type'      => 'text',
                        'title'     => __('Add Google Plus URL', 'adeecore'),
                    ),
                    array(
                        'id'        => 'wp-pinterest',
                        'type'      => 'text',
                        'title'     => __('Add Pinterest URL', 'adeecore'),
                    ),
                    array(
                        'id'        => 'wp-youtube',
                        'type'      => 'text',
                        'title'     => __('Add Youtube URL', 'adeecore'),
                    ),
                    array(
                        'id'        => 'wp-linkedin',
                        'type'      => 'text',
                        'title'     => __('Add Linkedin URL', 'adeecore'),
                    ),
                    array(
                        'id'        => 'wp-dribbble',
                        'type'      => 'text',
                        'title'     => __('Add Dribbble URL', 'adeecore'),
                    ),
                    array(
                        'id'        => 'wp-behance',
                        'type'      => 'text',
                        'title'     => __('Add Behance URL', 'adeecore'),
                    ), 
                    array(
                        'id'        => 'wp-flickr',
                        'type'      => 'text',
                        'title'     => __('Add Flickr URL', 'adeecore'),
                    ), 
                    array(
                        'id'        => 'wp-vk',
                        'type'      => 'text',
                        'title'     => __('Add vk URL', 'adeecore'),
                    ),  
                    array(
                        'id'        => 'wp-skype',
                        'type'      => 'text',
                        'title'     => __('Add skype URL', 'adeecore'),
                    ),
                    array(
                        'id'        => 'wp-instagram',
                        'type'      => 'text',
                        'title'     => __('Add Instagram URL', 'adeecore'),
                    ),


                )
            );



            /**********************************
            ********* Footer ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-bookmark',
                'icon_class' => 'el-icon-large', 
                'title'     => __('Footer', 'adeecore'),
                'fields'    => array(
                 
                    array(
                        'id'        => 'main_footer_en',
                        'type'      => 'switch',
                        'title'     => __('Enable Main Footer', 'adeecore'),
                        'subtitle'  => __('Enable or Disable Main Footer', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'footer_layout',
                        'type'      => 'image_select',
                        'title'     => __('Select Footer Layout', 'adeecore'),
                        'subtitle'  => __('Select an footer layout for your website','adeecore'),
                        'options'   => array(
                            '1' => array('alt' => 'Footer 1',       'img' => get_template_directory_uri() . '/images/footers/footer_one.jpg'),
                            '2' => array('alt' => 'Footer 2',       'img' => get_template_directory_uri() . '/images/footers/footer_two.jpg'),
                            '3' => array('alt' => 'Footer 3',       'img' => get_template_directory_uri() . '/images/footers/footer_three.jpg'),
                            '4' => array('alt' => 'Footer 4',       'img' => get_template_directory_uri() . '/images/footers/footer_four.jpg'),
                            ),
                        'default'   => '4',
                    ),

                    array(
                        'id'        => 'bottom_footer_en',
                        'type'      => 'switch',
                        'title'     => __('Enable Bottom Footer', 'adeecore'),
                        'subtitle'  => __('Enable or Disable Bottom Footer', 'adeecore'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'footer-bg-color',
                        'type'      => 'color',
                        'title'     => __('Footer Background Color', 'adeecore'),
                        'subtitle'  => __('Pick a background color for the footer (default: #343d47).', 'adeecore'),
                        'default'   => '#343d47',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'footer-heading-color',
                        'type'      => 'color',
                        'title'     => __('Footer H1 - H6 Color', 'adeecore'),
                        'subtitle'  => __('Pick a Text color for the footer H1 to H6 (default: #999ea3).', 'adeecore'),
                        'default'   => '#999ea3',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'footer-text-color',
                        'type'      => 'color',
                        'title'     => __('Footer Text Color', 'adeecore'),
                        'subtitle'  => __('Pick a Text color for the footer (default: #999ea3).', 'adeecore'),
                        'default'   => '#999ea3',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'footer-link-color',
                        'type'      => 'color',
                        'title'     => __('Footer Link Color', 'adeecore'),
                        'subtitle'  => __('Pick a link color for the footer (default: #2595FC).', 'adeecore'),
                        'default'   => '#2595FC',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                    array( 
                        'id'        => 'footer_padding', 
                        'type'      => 'spacing',
                        'mode'      => 'padding',
                        'units'     => array('em', 'px'),
                        'output'    => array('footer'),
                        'title'     => esc_html__('Footer Padding','adeecore'),
                        'subtitle'  => esc_html__('Footer Padding Top &amp; Bottom', 'adeecore'),
                        'left'      => false,
                        'right'     => false,
                        'default'            => array(
                            'padding-top'     => '30', 
                            'padding-bottom'  => '10', 
                            'units'          => 'px', 
                        ),
                    ),

                    array(
                        'id'        => 'copyright-en',
                        'type'      => 'switch',
                        'title'     => __('Enable/ Disable Copyright', 'adeecore'),
                        'subtitle'  => __('Enable or disable footer copyriight', 'adeecore'),
                        'default'   => true,
                    ),                    

                    array(
                        'id'        => 'copyright-text',
                        'type'      => 'editor',
                        'title'     => __('Copyright Text', 'adeecore'),
                        'subtitle'  => __('Add Copyright Text', 'adeecore'),
                        'default'   => __('© 2015 Your Company. All Rights Reserved. Designed By <a href="http://www.adeethemes.com" target="_blank">ADEETHEMES</a>', 'adeecore'),
                        'required'  => array('copyright-en', "=", 1),
                        
                    ),

                    array(
                        'id'        => 'back_to_top',
                        'type'      => 'switch',
                        'title'     => __('Enable Back to Top', 'adeecore'),
                        'subtitle'  => __('Enable or Disable Back to Top', 'adeecore'),
                        'default'   => true,
                    ),

                )
            );


            /**********************************
            ********* Import / Export ***********
            ***********************************/

            $this->sections[] = array(
                'title'     => __('Import / Export', 'adeecore'),
                'desc'      => __('Import and Export your Theme Options settings from file, text or URL.', 'adeecore'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            ); 

        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'adeetheming_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'adeecore'),
                'page_title'        => __('Theme Options', 'adeecore'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'use_cdn'              => false,
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );
         }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
