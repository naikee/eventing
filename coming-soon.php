<?php 
/*
 * Template Name: Coming Soon
 */
get_header('alternative'); ?>

<?php
    global $adeetheming_options;
    $comingsoon_date = '';
    if (isset($adeetheming_options['comingsoon-date'])) {
        $comingsoon_date = esc_attr($adeetheming_options['comingsoon-date']);
    }
?>

<div class="comingsoon" style="background-image: url(<?php echo esc_url($adeetheming_options['comingsoon']['url']); ?>);">
    <div>

    <div class="comingsoon-content">

        <script type="text/javascript">
        jQuery(function($) {
            $('#comingsoon-countdown').countdown("<?php echo str_replace('-', '/', $comingsoon_date); ?>", function(event) {
                $(this).html(event.strftime('<div class="countdown-section"><span class="countdown-amount first-item countdown-days">%-D </span><span class="countdown-period">%!D:<?php echo esc_html__("DAY", "adeecore"); ?>,<?php echo esc_html__("DAYS", "adeecore"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-hours">%-H </span><span class="countdown-period">%!H:<?php echo esc_html__("HOUR", "adeecore"); ?>,<?php echo esc_html__("HOURS", "adeecore"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-minutes">%-M </span><span class="countdown-period">%!M:<?php echo esc_html__("MINUTE", "adeecore"); ?>,<?php echo esc_html__("MINUTES", "adeecore"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-seconds">%-S </span><span class="countdown-period">%!S:<?php echo esc_html__("SECOND", "adeecore"); ?>,<?php echo esc_html__("SECONDS", "adeecore"); ?>;</span></div>'));
            });
        });
        </script>

        <div id="comingsoon-countdown"></div>

        <h2 class="page-header"><?php if (isset($adeetheming_options['comingsoon-title'])) echo esc_html($adeetheming_options['comingsoon-title']); ?></h2>
        <p class="comingsoon-message-desc"><?php if (isset($adeetheming_options['comingsoon-message-desc'])) echo esc_html($adeetheming_options['comingsoon-message-desc']); ?></p>

    
        <div class="social-share">
            <ul>
                <?php if ( isset($adeetheming_options['wp-facebook']) && $adeetheming_options['wp-facebook'] ) { ?>
                <li><a href="<?php echo esc_url($adeetheming_options['wp-facebook']); ?>"><i class="fa fa-facebook"></i></a></li>
                <?php } ?>   
                <?php if ( isset($adeetheming_options['wp-twitter']) && $adeetheming_options['wp-twitter'] ) { ?>
                <li><a href="<?php echo esc_url($adeetheming_options['wp-twitter']); ?>"><i class="fa fa-twitter"></i></a></li>
                <?php } ?>    
                <?php if ( isset($adeetheming_options['wp-google-plus']) && $adeetheming_options['wp-google-plus'] ) { ?>
                <li><a href="<?php echo esc_url($adeetheming_options['wp-google-plus']); ?>"><i class="fa fa-google-plus"></i></a></li>
                <?php } ?>
                <?php if ( isset($adeetheming_options['wp-pinterest']) && $adeetheming_options['wp-pinterest'] ) { ?>  
                <li><a href="<?php echo esc_url($adeetheming_options['wp-pinterest']); ?>"><i class="fa fa-pinterest"></i></a></li>
                <?php } ?>
                <?php if ( isset($adeetheming_options['wp-youtube']) && $adeetheming_options['wp-youtube'] ) { ?>  
                <li><a href="<?php echo esc_url($adeetheming_options['wp-youtube']); ?>"><i class="fa fa-youtube"></i></a></li>
                <?php } ?>
                <?php if ( isset($adeetheming_options['wp-linkedin']) && $adeetheming_options['wp-linkedin'] ) { ?>  
                <li><a href="<?php echo esc_url($adeetheming_options['wp-linkedin']); ?>"><i class="fa fa-linkedin"></i></a></li>
                <?php } ?>
                <?php if ( isset($adeetheming_options['wp-dribbble']) && $adeetheming_options['wp-dribbble'] ) { ?>  
                <li><a href="<?php echo esc_url($adeetheming_options['wp-dribbble']); ?>"><i class="fa fa-dribbble"></i></a></li>
                <?php } ?>
                <?php if ( isset($adeetheming_options['wp-behance']) && $adeetheming_options['wp-behance'] ) { ?>  
                <li><a href="<?php echo esc_url($adeetheming_options['wp-behance']); ?>"><i class="fa fa-behance"></i></a></li>
                <?php } ?>
                <?php if ( isset($adeetheming_options['wp-flickr']) && $adeetheming_options['wp-flickr'] ) { ?>  
                <li><a href="<?php echo esc_url($adeetheming_options['wp-flickr']); ?>"><i class="fa fa-flickr"></i></a></li>
                <?php } ?>
                <?php if ( isset($adeetheming_options['wp-vk']) && $adeetheming_options['wp-vk'] ) { ?>  
                <li><a href="<?php echo esc_url($adeetheming_options['wp-vk']); ?>"><i class="fa fa-vk"></i></a></li>
                <?php } ?>
                <?php if ( isset($adeetheming_options['wp-skype']) && $adeetheming_options['wp-skype'] ) { ?>  
                <li><a href="skype:#<?php echo esc_url($adeetheming_options['wp-skype']); ?>?chat"><i class="fa fa-skype"></i></a></li>
                <?php } ?>
                <?php if ( isset($adeetheming_options['wp-instagram']) && $adeetheming_options['wp-instagram'] ) { ?>  
                <li><a href="<?php echo esc_url($adeetheming_options['wp-instagram']); ?>"><i class="fa fa-instagram"></i></a></li>
                <?php } ?>
            </ul>
        </div>
        
        
    </div>
</div>
</div>


<?php get_footer('alternative');