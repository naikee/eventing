<?php 
 global $adeetheming_options;

 global $woocommerce;

 $prefix = 'adee_';

 $headertype = get_post_meta(get_the_ID(), $prefix . 'header_type',true); 
        
    $header_type = 'solid';
        
    if($headertype == 2) {
        $header_type = 'transparent';
    } else {
        $header_type = 'solid';
    }
?>
        <header id="header" class="header md-visible-down header_layout1 <?php echo $header_type;?>">
            <?php adeetheming_topbar(); ?>
            <div id="header-container" class="site-header">
                <div id="navigation" class="container">
                    <div class="row">
                        <div class="col-md-12 woo-menu-item-add">
                            <div class="navbar-header">
                                
                                <div class="logo-wrapper">
                                   <a class="navbar-brand" href="<?php echo site_url(); ?>">
                                        <?php
                                            if (isset($adeetheming_options['logo']))
                                           {
                                                
                                                if($adeetheming_options['logo-text-en']) { ?>
                                                    <h1> <?php echo esc_html($adeetheming_options['logo-text']); ?> </h1>
                                                <?php }
                                                else
                                                {
                                                    if(!empty($adeetheming_options['logo'])) {
                                                    ?>
                                                        <img class="enter-logo img-responsive" src="<?php echo esc_url($adeetheming_options['logo']['url']); ?>" alt="" title="">
                                                    <?php
                                                    }else{
                                                        echo esc_html(get_bloginfo('name'));
                                                    }
                                                }
                                           }
                                            else
                                           {
                                                echo esc_html(get_bloginfo('name'));
                                           }
                                        ?>
                                     </a>
                                </div>

                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>     

                                <?php if ( isset($adeetheming_options['cta_button']) && $adeetheming_options['cta_button'] != false ) : ?>
                                <div class="header-cta-button">
                                    <?php 
                                        $cta_text = $adeetheming_options['cta_text'];
                                        $cta_link = $adeetheming_options['cta_link'];
                                        $cta_target = $adeetheming_options['cta_target'];

                                        $target = '';
                                        if ( isset($cta_target) && $cta_target != '' ) {
                                            $target = 'target="_blank"';
                                        }

                                        if ( ! empty($cta_link) ) :
                                    ?>
                                    <a href="<?php echo esc_url($cta_link); ?>" <?php echo esc_attr($target); ?> class="button cta-button"><?php echo esc_attr($cta_text); ?></a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>                             

                                <?php if ( isset($adeetheming_options['search_enable'] ) && $adeetheming_options['search_enable'] == true ) : ?>
                                <div id="adeetheming-head-search" class="dc-head-search">
                                    <div class="dc-search-settings">
                                        <a id="search_button" href="#"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php 
                                if( class_exists( 'WooCommerce' ) ) { 
                                    if( isset($adeetheming_options['cart_enable']) && $adeetheming_options['cart_enable'] == true ) {
                                        echo adeetheming_ajax_cart();
                                    }
                                } ?>
                            </div>
                        
                            <div id="mobile-menu">
                                <div class="collapse navbar-collapse">
                                    <?php
                                    if ( $adeetheming_options['header_type'] != 'layout5' ) {
                                        if ( has_nav_menu( 'primary' ) ) {
                                            wp_nav_menu( array(
                                                'theme_location'      => 'primary',
                                                'container'           => false,
                                                'menu_class'          => 'nav navbar-nav',
                                                'fallback_cb'         => 'wp_page_menu',
                                                'depth'               => 3,
                                                'walker'              => new wp_bootstrap_mobile_navwalker()
                                                )
                                            ); 
                                        }
                                    } else {
                                        adeetheming_splitmenu ();
                                    }
                                    ?>
                                </div>
                            </div><!--/.#mobile-menu-->
                        </div><!--/.row--> 
                    </div><!--/.container--> 
                </div>
            </div>

        </header><!--/#header-->
