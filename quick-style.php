<?php
header('Content-type: text/css');

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

global $adeetheming_options;

$output = '';

$headerbg = $adeetheming_options['header-bg'];

//$output .= '.header_layout2 .navsection:before { background-color: '.esc_attr($headerbg).'; }';
	
if (isset($adeetheming_options['topbar_bg']) || isset($adeetheming_options['topbar_color']) || isset($adeetheming_options['topbar_link_color']) || isset($adeetheming_options['topbar_link_hover'])) {
	$output .= '#topheader-container { background: ' . esc_attr($adeetheming_options['topbar_bg']) . '; color: ' . esc_attr($adeetheming_options['topbar_color']) . '; border-bottom: 1px solid ' . esc_attr($adeetheming_options['topbar_color']) . '; } .contact-details li, .top-social-icons li, .top-social-menu li { border-right: 1px solid '  . esc_attr($adeetheming_options['topbar_color']) . '; } .contact-details li:first-child, .top-social-icons li:first-child, .top-social-menu li:first-child { border-left: 1px solid '  . esc_attr($adeetheming_options['topbar_color']) . '; }' ;
	$output .= '.contact-details li a, .top-social-icons li a, .top-social-menu li a { color: ' . esc_attr($adeetheming_options['topbar_link_color']) . '; }';
	$output .= '.contact-details li a:hover, .top-social-icons li a:hover, .top-social-menu li a:hover { color: ' . esc_attr($adeetheming_options['topbar_link_hover']) . '; }';
}

if(isset($headerbg)){
	if ($adeetheming_options['header_type'] == 'layout2' ) {
		$output .= '.header_layout2 .navsection:before { background-color: '.esc_attr($headerbg).'; }';
	}
	
	$output .= '.header_layout1 #header-container, .header_layout2 #header-container, .header_layout3 #header-container, .header_layout4 #header-container, .header_layout5 #header-container, .header_layout6 #header-container, .header_layout2 .navsection:before { background-color: '.esc_attr($headerbg).'; }';
}

if ($adeetheming_options['header_type'] == 'layout2' && isset($adeetheming_options['menu_bg'])) {
	$output .= '.header_layout2 .navsection #navigation { background-color: '.esc_attr($adeetheming_options['menu_bg']) .'; }'; 
}

if ($adeetheming_options['header_type'] == 'layout3' && isset($adeetheming_options['menu_bg'])) {
	$output .= '.header_layout3 .navsection { background-color: '.esc_attr($adeetheming_options['menu_bg']) .'; }'; 
}

if ($adeetheming_options['header_type'] == 'layout4' && isset($adeetheming_options['menu_bg'])) {
	$output .= '.header_layout4 .navsection { background-color: '.esc_attr($adeetheming_options['menu_bg']) .'; }'; 
}

if ($adeetheming_options['header-fixed']){

	if(isset($headerbg)){
		$output .= '#stickyhead.sticky, .header_layout1 #stickyhead.sticky #header-container, .header_layout2 #stickyhead.sticky #header-container, .header_layout3 #stickyhead.sticky #header-container, .header_layout4 #stickyhead.sticky #header-container, .header_layout5 #stickyhead.sticky #header-container { background-color: '.esc_attr(adeetheming_hex2rgb($headerbg, 0.85)).'; }';
	}
	$output .= '#stickyhead.sticky{ position:fixed;top:0; z-index:99999;margin:0 auto 30px; width:100%;box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.22);}';
	$output .= '#stickyhead.sticky #header-container{ padding:0;transition: padding 200ms linear; -webkit-transition:padding 200ms linear;}';
	$output .= '#stickyhead.sticky .navbar.navbar-default{ background: rgba(255,255,255,.95); border-bottom:1px solid #f5f5f5}';
}

if(isset($adeetheming_options['menu-font-color'])){
	$output .= '#main-menu .nav > li > a { color: '.esc_attr($adeetheming_options['menu-font-color']) .'; }';
	$output .= '@media (min-width: 992px) { .header_layout6 #main-menu .nav > li > a { color: '.esc_attr($adeetheming_options['menu-font-color']) .'; } }';
}

if(isset($adeetheming_options['menu-active'])){
	$output .= 'header #main-menu .nav>li.active > a, header #main-menu #menu-main-menu>li.current-menu-item > a, header #main-menu #menu-main-menu>li.active > a { color: '.esc_attr($adeetheming_options['menu-active']) .'; -webkit-box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-active']) .'; -moz-box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-active']) .'; -ms-box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-active']) .'; -o-box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-active']) .'; box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-active']) .'; }';

	$output .= 'header #main-menu #menu-main-menu .has-menu-child .sub-menu li.active > a { color: '.esc_attr($adeetheming_options['menu-active']) .'; -webkit-box-shadow: 0 1px 0 '.esc_attr($adeetheming_options['menu-active']) .'; -moz-box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-active']) .'; -ms-box-shadow: 0 1px 0 '.esc_attr($adeetheming_options['menu-active']) .'; -o-box-shadow: 0 1px 0 '.esc_attr($adeetheming_options['menu-active']) .'; box-shadow: 0 1px 0 '.esc_attr($adeetheming_options['menu-active']) .'; }';
}

if(isset($adeetheming_options['menu-hover'])){
	$output .= '#main-menu .nav > li > a:hover, header #main-menu #menu-main-menu > li > a:hover { color: '.esc_attr($adeetheming_options['menu-hover']) .'; -webkit-box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-hover']) .'; -moz-box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-hover']) .'; -ms-box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-hover']) .'; -o-box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-hover']) .'; box-shadow: 0 4px 0 '.esc_attr($adeetheming_options['menu-hover']) .'; }';
}

if(isset($adeetheming_options['button-menu-bg-color'])){
	$output .= '#main-menu .nav>li.button-menu a{ background-color: '.esc_attr($adeetheming_options['button-menu-bg-color']) .'; }';
}
if(isset($adeetheming_options['button-menu-bg-hover-color'])){
	$output .= '#main-menu .nav>li.button-menu a:hover{ background-color: '.esc_attr($adeetheming_options['button-menu-bg-hover-color']) .'; }';
}

#submenu subheader-title-bg

$subheader_bg = $adeetheming_options['subheader_bg'];
$subheader_pad = $adeetheming_options['subheader_pad'];
$subheader_border = $adeetheming_options['subheader_border'];

if (isset($subheader_bg) || isset($subheader_pad) || isset($subheader_border)) {
	$output .= '.sub-title-breadcrumb { background-color: ' . esc_attr($subheader_bg['background-color']) . '; background-image: url(' . esc_attr($subheader_bg['background-image']) . '); background-repeat: ' . esc_attr($subheader_bg['background-repeat']) . '; background-position: ' .esc_attr($subheader_bg['background-position']) . '; background-size: ' .esc_attr($subheader_bg['background-size']) . '; background-attachment: ' .esc_attr($subheader_bg['background-attachment']) . '; padding-top: ' . esc_attr($subheader_pad['padding-top']) . 'px ; padding-bottom: ' . esc_attr($subheader_pad['padding-bottom']) . 'px ; padding-left: ' . esc_attr($subheader_pad['padding-left']) . 'px ; padding-right: ' . esc_attr($subheader_pad['padding-right']) . 'px ; border-bottom: ' . esc_attr($subheader_border['border-bottom']) . ' ' . esc_attr($subheader_border['border-style']) . ' ' . esc_attr($subheader_border['border-color']) . '; }';
}

if(isset($adeetheming_options['submenu-bg'])){
	$output .= '#main-menu .nav>li ul { background-color: '.esc_attr($adeetheming_options['submenu-bg']) .'; }';
}
if(isset($adeetheming_options['submenu-text-color'])){
	$output .= '#main-menu .nav>li>ul li a{ color: '.esc_attr($adeetheming_options['submenu-text-color']) .'; }';
}
if(isset($adeetheming_options['submenu-hover-bg'])){
	$output .= '#main-menu .nav>li>ul li:hover{ background-color: '.esc_attr($adeetheming_options['submenu-hover-bg']) .'; }';
}
if(isset($adeetheming_options['submenu-text-hover-color'])){
	$output .= '#main-menu .nav>li>ul li a:hover, header #main-menu #menu-main-menu .has-menu-child .sub-menu li.active a:hover { color: '.esc_attr($adeetheming_options['submenu-text-hover-color']) .'; }';
}

// .sub-title-inner h2
if(isset($adeetheming_options['subheader-title-bg'])){
	$output .= '.sub-title-inner h2{ color: '.esc_attr($adeetheming_options['subheader-title-bg']) .'; }';
}



if(isset($adeetheming_options['subheader-title-color'])){
	$output .= '.sub-title-inner h2{ color: '.esc_attr($adeetheming_options['subheader-title-color']) .'; }';
}

if(isset($adeetheming_options['header-font-size'])){
	$output .= '.sub-title-inner h2{ font-size: '.esc_attr($adeetheming_options['header-font-size']) .'px; }';
}

if(isset($adeetheming_options['breadcrumb-text-color'])){
	$output .= '.sub-title .breadcrumbs, .sub-title .breadcrumbs>li>a, .breadcrumbs>li+li:before, .sub-title .breadcrumbs>.item_current{ color: '.esc_attr($adeetheming_options['breadcrumb-text-color']) .'; }';
}

if(isset($adeetheming_options['breadcrumb-font-size'])){
	$output .= '.sub-title .breadcrumbs{ font-size: '.esc_attr($adeetheming_options['breadcrumb-font-size']) .'px; }';
}

if(isset($adeetheming_options['subheader-margin-bottom'])){
	$output .= '.sub-title{ margin-bottom: '.esc_attr($adeetheming_options['subheader-margin-bottom']['margin-bottom']) .'px; }';
}
# End ...


//Content & Sidebar
if (isset($adeetheming_options['content_padding'])) {
	$output .= '#main .site-content, #sidebar { padding-top: ' . $adeetheming_options['content_padding']['padding-top'] . '; padding-bottom: ' . $adeetheming_options['content_padding']['padding-bottom'] . '; }';
}



if($adeetheming_options['logo-width']){
	$output .= '.logo-wrapper .navbar-brand>img{ width: '. (int) esc_attr($adeetheming_options['logo-width']) .'px; }';
}
if($adeetheming_options['logo-height']){
	$output .= '.logo-wrapper .navbar-brand>img{ height: '. (int) esc_attr($adeetheming_options['logo-height']) .'px; }';
}

if(isset($adeetheming_options['header-padding-top'])){
	$output .= '.site-header { padding-top: '. (int) esc_attr($adeetheming_options['header-padding-top']) .'px; }';
}

if(isset($adeetheming_options['header-height'])){
	$output .= '.site-header { min-height: '. (int) esc_attr($adeetheming_options['header-height']) .'px; }';
}

if(isset($adeetheming_options['header-padding-bottom'])){
	$output .= '.site-header { padding-bottom: '. (int) esc_attr($adeetheming_options['header-padding-bottom']) .'px; }';
}

if( $adeetheming_options['header_type'] == 'layout1' || $adeetheming_options['header_type'] == 'layout5' && isset($adeetheming_options['header_border'])){
	$output .= '.site-header { border-bottom: ' . esc_attr($adeetheming_options['header_border']['border-bottom']) . ' ' . esc_attr($adeetheming_options['header_border']['border-style']) . ' ' . esc_attr($adeetheming_options['header_border']['border-color']) . '; }';
}

if( $adeetheming_options['header_type'] == 'layout2' && isset($adeetheming_options['header_border'])){
	$output .= '.header_layout2 .navsection #navigation { border-bottom: ' . esc_attr($adeetheming_options['header_border']['border-bottom']) . ' ' . esc_attr($adeetheming_options['header_border']['border-style']) . ' ' . esc_attr($adeetheming_options['header_border']['border-color']) . '; }';
}

if( $adeetheming_options['header_type'] == 'layout3' && isset($adeetheming_options['header_border'])){
	$output .= '.header_layout3 .navsection { border-bottom: ' . esc_attr($adeetheming_options['header_border']['border-bottom']) . ' ' . esc_attr($adeetheming_options['header_border']['border-style']) . ' ' . esc_attr($adeetheming_options['header_border']['border-color']) . '; }';
}

if( $adeetheming_options['header_type'] == 'layout4' && isset($adeetheming_options['header_border'])){
	$output .= '.header_layout4 .navsection { border-bottom: ' . esc_attr($adeetheming_options['header_border']['border-bottom']) . ' ' . esc_attr($adeetheming_options['header_border']['border-style']) . ' ' . esc_attr($adeetheming_options['header_border']['border-color']) . '; }';
}

if( $adeetheming_options['header_type'] == 'layout6' && isset($adeetheming_options['header_border'])){
	$output .= '@media (min-width: 992px) { .site-header { border-right: ' . esc_attr($adeetheming_options['header_border']['border-bottom']) . ' ' . esc_attr($adeetheming_options['header_border']['border-style']) . ' ' . esc_attr($adeetheming_options['header_border']['border-color']) . '; } }';
	$output .= '@media (max-width: 991px) { .site-header { border-bottom: ' . esc_attr($adeetheming_options['header_border']['border-bottom']) . ' ' . esc_attr($adeetheming_options['header_border']['border-style']) . ' ' . esc_attr($adeetheming_options['header_border']['border-color']) . '; } }';
}


if(isset($adeetheming_options['search_bgcolor'])){
	$output .= '.dc-head-search .search_popup { background-color : ' . esc_attr($adeetheming_options['search_bgcolor']) .'; }';
}



if(isset($adeetheming_options['footer-bg-color'])){
	$output .= 'footer{ background-color: '.esc_attr($adeetheming_options['footer-bg-color']) .'; }';
}

if(isset($adeetheming_options['footer-heading-color'])){
	$output .= '#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6 { color: ' . esc_attr($adeetheming_options['footer-heading-color']) . ' !important; }';
}

if(isset($adeetheming_options['footer-text-color'])){
	$output .= '#footer, .footer-wrap-inner .copyright, footer .social-icons i{ color: '.esc_attr($adeetheming_options['footer-text-color']) .' !important; }';
}

if(isset($adeetheming_options['footer-link-color'])){
	$output .= '#footer .footer-wrap-inner a { color: '.esc_attr($adeetheming_options['footer-link-color']) .' !important; }';
}


if(isset($adeetheming_options['comingsoon-en']) && $adeetheming_options['comingsoon-en']) {
	$output .= "body {
		background: #fff;
		display: table;
		width: 100%;
		height: 100%;
		min-height: 100%;
	}";
}

if(isset($adeetheming_options['portfolio_pad'])) {
	$output .= '.flat_grid_layout.grid-item, .flat_masonry_layout.masonry-item { padding: ' . esc_attr($adeetheming_options['portfolio_pad']) . 'px !important; }';	
}


//404 background
$output .= ".error-page-inner{
	width: 100%;
    height: 100%;
    min-height: 100%;
    position: absolute;
    background: url(".esc_url($adeetheming_options['errorpage']['url']).") no-repeat 100% 0; 
    background-size: contain;
}";


/*************************************************
*	Shortcode
*************************************************/

//Accordion
if (isset($adeetheming_options['accordion-bg'])) {
	$output .= '.dc-sc-accordion.style_style1 div.accordion-title-wrap,
	.dc-sc-accordion.style_style2 div.accordion-title-wrap,
	.dc-sc-accordion.style_style3 div.accordion-title-wrap:before,
	.dc-sc-accordion.style_style4 div.accordion-title-wrap:before { background: ' .$adeetheming_options['accordion-bg']. '; }';
	$output .= '.dc-sc-accordion.style_style3 div.accordion-title-wrap,
	.dc-sc-accordion.style_style4 div.accordion-title-wrap,
	.dc-sc-accordion.style_style5 div.accordion-title-wrap { border-color: ' .$adeetheming_options['accordion-bg']. '; }';
}
if (isset($adeetheming_options['accordion-color'])) {
	$output .= '.dc-sc-accordion div.accordion-title-wrap > span,
	.dc-sc-accordion div.accordion-title-wrap:after { color: ' .$adeetheming_options['accordion-color']. '; }';
	$output .= '.dc-sc-accordion.style_style2 div.accordion-title-wrap:before { background: ' .$adeetheming_options['accordion-color']. '; }';
}
if (isset($adeetheming_options['accordion-bg-active'])) {
	$output .= '.dc-sc-accordion.style_style1 .accordion-item-wrap.active div.accordion-title-wrap,
	.dc-sc-accordion.style_style2 .accordion-item-wrap.active div.accordion-title-wrap,
	.dc-sc-accordion.style_style3 .accordion-item-wrap.active div.accordion-title-wrap:before,
	.dc-sc-accordion.style_style4 .accordion-item-wrap.active div.accordion-title-wrap:before { background: ' .$adeetheming_options['accordion-bg-active']. '; }';
	$output .= '.dc-sc-accordion.style_style3 .accordion-item-wrap.active div.accordion-title-wrap,
	.dc-sc-accordion.style_style4 .accordion-item-wrap.active div.accordion-title-wrap,
	.dc-sc-accordion.style_style5 .accordion-item-wrap.active div.accordion-title-wrap { border-color: ' .$adeetheming_options['accordion-bg-active']. '; }';
	$output .= '.dc-sc-accordion.style_style4.icons_align_right .active .accordion-title-wrap > span:first-child:before { border-right-color: ' .$adeetheming_options['accordion-bg-active']. '; }';
	$output .= '.dc-sc-accordion.style_style4.icons_align_left .active .accordion-title-wrap > span:first-child:before { border-left-color: ' .$adeetheming_options['accordion-bg-active']. '; }';
}
if (isset($adeetheming_options['accordion-color-active'])) {
	$output .= '.dc-sc-accordion .accordion-item-wrap.active div.accordion-title-wrap > span,
	.dc-sc-accordion .accordion-item-wrap.active div.accordion-title-wrap:after { color: ' .$adeetheming_options['accordion-color-active']. '; }';
	$output .= '.dc-sc-accordion.style_style2 .accordion-item-wrap.active div.accordion-title-wrap:before { background: ' .$adeetheming_options['accordion-color-active']. '; }';
}

//Audio
if (isset($adeetheming_options['audio-bg'])) {
	$output .= '.dc-sc-audio .audio-inner-wrap .audio-container,
	.mfp-content .audio-inner-wrap .audio-container { background: ' .$adeetheming_options['audio-bg']. '; }';
}
if (isset($adeetheming_options['audio-color'])) {
	$output .= '.dc-sc-audio .audio-inner-wrap .audio-container .audio-title,
	.mfp-content .audio-inner-wrap .audio-container .audio-title,
	.dc-sc-audio .audio-bg-wrap .audio-title,
	.dc-sc-audio .audio-bg-wrap .audio-content { color: ' .$adeetheming_options['audio-color']. '; }';
}
if (isset($adeetheming_options['audio-icon'])) {
	$output .= '.dc-sc-audio .audio-bg-wrap .dc-audio-icon { color: ' .$adeetheming_options['audio-icon']. '; }';
}

//Blockquote
if (isset($adeetheming_options['blockquote-color']) || isset($adeetheming_options['blockquote-background'])) {
	$output .= '.dc-sc-blockquote.type_simple { background: ' .$adeetheming_options['blockquote-background']. '; border-left-color: ' .$adeetheming_options['blockquote-color']. ';}';
	$output .= '.dc-sc-blockquote.type_classic { background: ' .$adeetheming_options['blockquote-background']. '; border-left-color: ' .$adeetheming_options['blockquote-color']. '; border-right-color: ' .$adeetheming_options['blockquote-color']. ';}';
	$output .= '.dc-sc-blockquote.type_modern { background: ' .$adeetheming_options['blockquote-background']. ';}';
	$output .= '.dc-sc-blockquote.type_modern:before { text-shadow: -3px 0 ' .$adeetheming_options['blockquote-background']. ';}.dc-sc-blockquote.type_modern:after { text-shadow: 3px 0 ' .$adeetheming_options['blockquote-background']. ';}';
}

//Button
if (isset($adeetheming_options['button-color']) || isset($adeetheming_options['button-bg']) || isset($adeetheming_options['button-color-hover']) || isset($adeetheming_options['button-bg-hover'])) {

	$btn3d = dc_tintcolor($adeetheming_options['button-bg']);
	$btn3dhover = dc_tintcolor($adeetheming_options['button-bg-hover']);

	$output .= 'a.btn, a:focus.btn, button { color: ' .$adeetheming_options['button-color']. '; background: ' .$adeetheming_options['button-bg']. '; }.dc-sc-button a.btn.type_outline { color: ' .$adeetheming_options['button-bg']. '; border-color: ' .$adeetheming_options['button-bg']. '; }.dc-sc-button a.btn.type_three_d { -webkit-box-shadow: 0 8px 0 ' .$btn3d. ', 0 15px 20px rgba(0,0,0,.35); -moz-box-shadow: 0 8px 0 ' .$btn3d. ', 0 15px 20px rgba(0,0,0,.35); box-shadow: 0 8px 0 ' .$btn3d. ', 0 15px 20px rgba(0,0,0,.35); }';
	$output .= 'a.btn:hover, a:active.btn, button { color: ' .$adeetheming_options['button-color-hover']. '; background: ' .$adeetheming_options['button-bg-hover']. '; }.dc-sc-button a.btn.type_outline:before { background: ' .$adeetheming_options['button-bg-hover']. '; }.dc-sc-button a.btn.type_outline:hover { color: ' .$adeetheming_options['button-color-hover']. '; border-color: ' .$adeetheming_options['button-bg-hover']. '; }.dc-sc-button a.btn.type_classic:before, .dc-sc-button a.btn.type_classic:after { background: ' .$adeetheming_options['button-bg-hover']. '; }.dc-sc-button a.btn.type_classic:hover { color: ' .$adeetheming_options['button-bg-hover']. '; }.dc-sc-button a.btn.type_three_d:hover { -webkit-box-shadow: 0 8px 0 ' .$btn3dhover. ', 0 15px 20px rgba(0,0,0,.35); -moz-box-shadow: 0 8px 0 ' .$btn3dhover. ', 0 15px 20px rgba(0,0,0,.35); box-shadow: 0 8px 0 ' .$btn3dhover. ', 0 15px 20px rgba(0,0,0,.35); }.dc-sc-button a.btn.type_three_d:active { -webkit-box-shadow: 0 2px 0 ' .$btn3dhover. ', 0 8px 10px rgba(0,0,0,.35); -moz-box-shadow: 0 2px 0 ' .$btn3dhover. ', 0 8px 10px rgba(0,0,0,.35); box-shadow: 0 2px 0 ' .$btn3dhover. ', 0 8px 10px rgba(0,0,0,.35); }.dc-sc-button a.btn.type_modern:hover { background: '  .$adeetheming_options['button-bg']. '; }.dc-sc-button a.btn.type_modern:before, .dc-sc-button a.btn.type_modern:after { background: '  .$adeetheming_options['button-bg-hover']. '; }' ;
}

//Chart
if (isset($adeetheming_options['chart-color']) || isset($adeetheming_options['chart-label'])) {
	$output .= '.dc-sc-chart h4.dc-chart-title { color: ' .$adeetheming_options['chart-color']. '; }';
	$output .= '.dc-sc-chart .chart .chart_label { color: ' .$adeetheming_options['chart-label']. '; }';
}

//Counter
if (isset($adeetheming_options['counter-color']) || isset($adeetheming_options['counter-icon-color']) || isset($adeetheming_options['counter-icon-bg'])) {
	$output .= '.dc-sc-counter .desc_wrapper > span {color: ' .$adeetheming_options['counter-color']. ';}';
	$output .= '.dc-sc-counter .counter-icon-wrap.style_square, .dc-sc-counter .counter-icon-wrap.style_circle, .dc-sc-counter .counter-icon-wrap.style_rounded, .dc-sc-counter.icon_small .counter-icon-wrap.style_diagonal, .dc-sc-counter.icon_medium .counter-icon-wrap.style_diagonal, .dc-sc-counter.icon_large .counter-icon-wrap.style_diagonal {color: ' .$adeetheming_options['counter-icon-color']. ';}';
	$output .= '.dc-sc-counter .counter-icon-wrap.style_square, .dc-sc-counter .counter-icon-wrap.style_circle, .dc-sc-counter .counter-icon-wrap.style_rounded, .dc-sc-counter.icon_small .counter-icon-wrap.style_diagonal,  .dc-sc-counter.icon_small .counter-icon-wrap.style_diagonal:before,  .dc-sc-counter.icon_small .counter-icon-wrap.style_diagonal:after, .dc-sc-counter.icon_medium .counter-icon-wrap.style_diagonal, .dc-sc-counter.icon_medium .counter-icon-wrap.style_diagonal:before, .dc-sc-counter.icon_medium .counter-icon-wrap.style_diagonal:after, .dc-sc-counter.icon_large .counter-icon-wrap.style_diagonal, .dc-sc-counter.icon_large .counter-icon-wrap.style_diagonal:before, .dc-sc-counter.icon_large .counter-icon-wrap.style_diagonal:after {background: ' .$adeetheming_options['counter-icon-bg']. ';}';
}

//Countdown
if (isset($adeetheming_options['countdown-color']) || isset($adeetheming_options['countdown-bg'])) {
	$output .= '';
}

//Dropcap
if (isset($adeetheming_options['dropcap-color']) || isset($adeetheming_options['dropcap-bg'])) {
	$dropcolor = (!empty($color)) ? 'color:' .$$adeetheming_options['dropcap-color']. ';' : '';
	$dropbackground = (!empty($background)) ? 'background:' .$adeetheming_options['dropcap-bg']. ';' : '';

	$output .= '.dc-sc-dropcap.dropcap_classic {' .$dropcolor.$dropbackground. '}';
}

//FAQ
if (isset($adeetheming_options['faq-color'])) {
	$output .= '.dc-sc-faq .faq-item-title {color: ' .$adeetheming_options['faq-color']. ';}';
	$output .= '.dc-sc-faq .faq-item-title .faq-question:before {background: ' .$adeetheming_options['faq-color']. ';}';
}
if (isset($adeetheming_options['faq-bg'])) {
	$output .= '.dc-sc-faq .faq-item-title, .dc-sc-faq .faq-item-title:before, .dc-sc-faq .faq-item-title:after {background: ' .$adeetheming_options['faq-bg']. ';}';
}
if (isset($adeetheming_options['faq-color-active'])) {
	$output .= '.dc-sc-faq .faq-active .faq-item-title {color: ' .$adeetheming_options['faq-color-active']. ';}';
	$output .= '.dc-sc-faq .faq-active .faq-item-title .faq-question:before {background: ' .$adeetheming_options['faq-color-active']. ';}';
	$output .= '.dc-sc-faq .faq-active .faq-item-title .faq-question:after {border-top-color: ' .$adeetheming_options['faq-color-active']. ';}';
}
if (isset($adeetheming_options['faq-bg-active'])) {
	$output .= '.dc-sc-faq .faq-active .faq-item-title, .dc-sc-faq .faq-active .faq-item-title:after {background: ' .$adeetheming_options['faq-bg-active']. ';}';
}


/*************************************************
*	ThemeOptions | CustomCSS
*************************************************/
if(isset($adeetheming_options['custom-css'])){
	$output .= $adeetheming_options['custom-css'];
}

echo $output;

