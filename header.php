<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $adeetheming_options;

$prefix = 'adee_';
?>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
    if(isset($adeetheming_options['favicon'])){ ?>
        <link rel="shortcut icon" href="<?php echo esc_url($adeetheming_options['favicon']['url']); ?>" type="image/x-icon"/>
    <?php }else{ ?>
        <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri() .'/images/plus.png'); ?>" type="image/x-icon"/>
    <?php } ?>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<?php
 if ( isset($adeetheming_options['boxfull-en']) ) {
  $layout = esc_attr($adeetheming_options['boxfull-en']);
 }else{
    $layout = 'fullwidth';
 }

 if (isset($adeetheming_options['header_type'] ) ) {
     $header_layout = ' header_' . $adeetheming_options['header_type'];
 }
?>

<body <?php body_class( $layout.'-bg' . $header_layout ); ?>>
  
    <?php if( isset($adeetheming_options['preloader_en']) && $adeetheming_options['preloader_en'] == true ) { 
        require_once(get_template_directory()  . '/lib/main-function/dc-preloader.php');
    } ?>
    <div id="page" class="hfeed site <?php echo esc_attr($layout . $header_layout); ?>">
        <?php
         
        get_template_part('templates/headers/header_' . $adeetheming_options['header_type']);

        get_template_part('templates/headers/header_mobile');

        get_template_part('lib/sub-header');

