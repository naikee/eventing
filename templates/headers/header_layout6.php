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
        <header id="header" class="header header_layout6 md-visible-up <?php echo $header_type;?>">
             
            <div id="header-container" class="site-header">
                <div id="navigation" class="left-header">
                    <div class="left_side">
                        <div class="left-menu-item-add">
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
                            </div>

                            <div id="main-menu">

                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu(  array(
                                        'theme_location' => 'primary',
                                        'container'      => '', 
                                        'menu_class'     => 'nav',
                                        'fallback_cb'    => 'wp_page_menu',
                                        'depth'          => 3,
                                        'walker'         => new Megamenu_Walker()
                                        )
                                    ); 
                                }
                                ?>

                            </div><!--/#main-menu-->

                            <?php 
                            if( class_exists( 'WooCommerce' ) ) { 
                                if( isset($adeetheming_options['cart_enable']) && $adeetheming_options['cart_enable'] == true ) {
                                    echo adeetheming_ajax_cart();
                                }
                            } ?>
                        </div>
                        
                        <?php if ( isset($adeetheming_options['topbar']) && $adeetheming_options['topbar'] == true ) : ?>
                        <div id="topheader-container" class="hidden-xs">
                            <ul class="contact-details">
                                <?php

                                if ( $adeetheming_options['top_hotline'] != '' ) {
                                    echo '<li class="hotline"><i class="fa fa-phone"></i><a href="tel:' . str_replace( ' ', '', $adeetheming_options['top_hotline'] ) . '">' . $adeetheming_options['top_hotline'] . '</a></li>';
                                }

                                if ( $adeetheming_options['top_email'] != '' ) {
                                    echo '<li class="top-email"><i class="fa fa-envelope"></i><a href="mailto:' . $adeetheming_options['top_email'] . '">' . $adeetheming_options['top_email'] . '</a></li>';
                                }
                                ?>
                            </ul>

                            <?php
                            if ($adeetheming_options['top_social'] == true) {
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
                    <?php endif; ?>

                    </div><!--/.row--> 
                </div><!--/.container--> 
            </div>

        </header><!--/#header-->
