<!-- start footer -->
    <?php global $adeetheming_options; ?>
    <footer id="footer" class="footer-wrap">
        <div class="footer-wrap-inner">
            <div class="container">
                <div class="row">
                    <?php if ( isset($adeetheming_options['main_footer_en']) && $adeetheming_options['main_footer_en'] != 0 ) : ?>
                        <div class="main-footer">
                        <?php $layout = $adeetheming_options['footer_layout'];
                            $cols = 12;
                            if($layout != 0) $cols /= $layout;

                            for ($i=1; $i <= $layout ; $i++) : ?>
                                <div class="col-sm-<?php echo esc_attr($cols); ?> footer-widget-content">
                                    <?php if( is_active_sidebar('footer-' . $i) ) {
                                        dynamic_sidebar('footer-' . $i);
                                    } ?>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( isset($adeetheming_options['bottom_footer_en']) && $adeetheming_options['bottom_footer_en'] != 0 ) : ?>
                    <div class="col-sm-12 bottom-footer">

                        <?php if(isset($adeetheming_options['copyright-text']) && $adeetheming_options['copyright-en'] == true){ ?>   
                            <span class="copyright">
                                <?php echo balanceTags($adeetheming_options['copyright-text']); ?>
                            </span>
                        <?php } ?> 

                        <ul class="social-icons">
                            <?php if(isset($adeetheming_options['wp-facebook'])){ if( $adeetheming_options['wp-facebook'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $adeetheming_options['wp-facebook'] ); ?>"><i class="fa fa-facebook"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-twitter'])){ if( $adeetheming_options['wp-twitter'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $adeetheming_options['wp-twitter'] ); ?>"><i class="fa fa-twitter"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-google-plus'])){ if( $adeetheming_options['wp-google-plus'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $adeetheming_options['wp-google-plus'] ); ?>"><i class="fa fa-google-plus"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-pinterest'])){ if( $adeetheming_options['wp-pinterest'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $adeetheming_options['wp-pinterest'] ); ?>"><i class="fa fa-pinterest"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-youtube'])){ if( $adeetheming_options['wp-youtube'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $adeetheming_options['wp-youtube'] ); ?>"><i class="fa fa-youtube"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-linkedin'])){ if( $adeetheming_options['wp-linkedin'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $adeetheming_options['wp-linkedin'] ); ?>"><i class="fa fa-linkedin"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-dribbble'])){ if( $adeetheming_options['wp-dribbble'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $adeetheming_options['wp-dribbble'] ); ?>"><i class="fa fa-dribbble"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-behance'])){ if( $adeetheming_options['wp-behance'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $adeetheming_options['wp-behance'] ); ?>"><i class="fa fa-behance"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-flickr'])){ if( $adeetheming_options['wp-flickr'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $adeetheming_options['wp-flickr'] ); ?>"><i class="fa fa-flickr"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-vk'])){ if( $adeetheming_options['wp-vk'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $adeetheming_options['wp-vk'] ); ?>"><i class="fa fa-vk"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-skype'])){ if( $adeetheming_options['wp-skype'] != '' ){ ?><li><a href="skype:<?php echo esc_url( $adeetheming_options['wp-skype'] ); ?>?chat"><i class="fa fa-skype"></i></a></li><?php } } ?>
                            <?php if(isset($adeetheming_options['wp-instagram'])){ if( $adeetheming_options['wp-instagram'] != '' ){ ?><li><a href="<?php echo esc_url( $adeetheming_options['wp-instagram'] ); ?>"><i class="fa fa-instagram"></i></a></li><?php } } ?>
                        </ul>

                    </div> <!-- end bottom-footer -->
                <?php endif; ?>
                <?php if(isset($adeetheming_options['back_to_top']) && $adeetheming_options['back_to_top'] == 1) : ?>
                    <div class="back-to-top dc-scrolltop">
                        <i class="fa fa-angle-up"></i>
                    </div>
                <?php endif; ?>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </div> <!-- end footer-wrap-inner -->
    </footer>
</div> <!-- #page -->

    <?php if(isset($adeetheming_options['google-analytics'])) echo $adeetheming_options['google-analytics']; ?>

<?php if( isset($adeetheming_options['preloader_en']) && $adeetheming_options['preloader_en']==1 ) { ?>   
    <!-- =========================
       Preloader
    ============================== -->
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            setTimeout(function(){ 
                jQuery("#preloading").fadeOut(1000);
            }, 500);
        });
    </script>
<?php } ?> 

<?php wp_footer(); ?>
<script type="text/javascript">
<?php echo adeetheming_options('custom_js'); ?>
</script>

</body>
</html>