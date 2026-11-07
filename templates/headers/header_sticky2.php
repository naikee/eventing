<?php 
 global $adeetheming_options;

 global $woocommerce;

 $prefix = 'adee_';
?>
        <div id="stickyhead">
            <div id="header-container" class="site-header header_layout5">
                <div id="navigation" class="container">
                    <div class="row">
                        <div class="col-sm-12  woo-menu-item-add">
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

                            <?php if ( isset($adeetheming_options['search_enable'] ) && $adeetheming_options['search_enable'] == true ) : ?>
                                <div id="adeetheming-head-search" class="dc-head-search">
                                    <div class="dc-search-settings">
                                        <a id="search_button" href="javascript:void(0)"><i class="fa fa-search"></i></a>
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
                                adeetheming_splitmenu ();
                                ?>

                            </div><!--/#main-menu-->
                        </div>
                        
                    </div><!--/.row--> 
                </div><!--/.container--> 
            </div>
        </div>
