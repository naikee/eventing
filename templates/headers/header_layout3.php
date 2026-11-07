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

    $topheader = '';

    if ( isset($adeetheming_options['topbar']) && $adeetheming_options['topbar'] == true ) {
        $topheader = 'has-topheader';
    }
?>
		<header id="header" class="header header_layout3 md-visible-up <?php echo $header_type . ' ' . $topheader; ?>">
			<?php adeetheming_topbar(); ?>
                <div id="header-container" class="site-header">
				    <div id="logosection" class="container">
                        <div class="row">
                            <div class="col-sm-4">
        				    	<div class="logo-header">
        						
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
                            </div>

                            <div class="col-sm-8 company-details">

                                <?php if ( isset($adeetheming_options['office_address']) && $adeetheming_options['office_address'] != '' || isset($adeetheming_options['office_address_span']) && $adeetheming_options['office_address_span'] != '' ) : ?>
                                    <div class="header-office">
                                        <?php 
                                            $office = $adeetheming_options['office_address'];
                                            $office2 = $adeetheming_options['office_address_span'];
                                        ?>
                                        <div class="icon_wrap">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div class="desc_wrap">
                                            <p>
                                                <?php echo $office; ?>
                                                <span><?php echo $office2; ?></span>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>                             

                                <?php if ( isset($adeetheming_options['working_hours']) && $adeetheming_options['working_hours'] != '' || isset($adeetheming_options['working_hours_span']) && $adeetheming_options['working_hours_span'] != '' ) : ?>
                                    <div class="working-hours">
                                        <?php 
                                            $working = $adeetheming_options['working_hours'];
                                            $working2 = $adeetheming_options['working_hours_span'];
                                        ?>
                                        <div class="icon_wrap">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="desc_wrap">
                                            <p>
                                                <?php echo $working; ?>
                                                <span><?php echo $working2; ?></span>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div><!--/.company-details-->
                        </div>
                    </div>
                </div>

            <div class="navsection">
                <div id="navigation" class="container">
                    <div class="row">
                        <div class="col-sm-12">  

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
                                        <a class="search_button" href="javascript:void(0)"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php 
                            if( class_exists( 'WooCommerce' ) ) { 
                                if( isset($adeetheming_options['cart_enable']) && $adeetheming_options['cart_enable'] == true ) {
                                    echo adeetheming_ajax_cart();
                                }
                            } ?>

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
                        </div>
                        
                    </div><!--/.row--> 
                </div><!--/.container--> 
			</div><!--/.navsection-->

            <?php get_template_part('templates/headers/header_sticky1'); ?>

		</header><!--/#header-->
