<?php

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:300,400,500,700" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!--[if lt IE 9]>
<div class="old-browser">
<div class="message">
Sie benutzen einen sehr alten Browser, es könnte sein das dadurch diese Website nicht richtig dargestellt wird.
Sie sollten unbedingt Ihren Browser updaten oder einen aktuellen Browser installieren, auch um Sicherheitslücken zu schließen.
<a class="update" href="http://browsehappy.com/?locale=de_de" rel="nofollow" target="_blank">Browser updaten</a>
</div>
</div>
<![endif]-->
<?php include( get_template_directory() . '/images/svg-sprite.svg' ); ?>
<div id="page" class="hfeed site">
	<header id="header" class="site-header">
		<div class="inner">
			<!--a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img width="65" height="100" src="" alt="<?php bloginfo('name'); ?>"></a-->		

			<nav id="site-navigation" class="main-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
			</nav><!-- #site-navigation -->
			
			<a class="mobile-menu" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/burger-button.svg" alt=""></a>
			
			<!--Only for Mobile page-->
			<div class="dark-layer"></div>
			
			<nav id="mobile-navigation" class="mobile-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'container' => false ) ); ?>
			</nav><!-- #site-navigation -->
			
		</div>
	</header>

	<div id="content" class="site-content">
		<div id="particles-js"></div>
		<div class="count-particles"><span class="js-count-particles">--</span>  </div>     
		<div class="inner" id ="content-inner">
 		<script>
			particlesJS("particles-js", {"particles":{"number":{"value":400,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"edge"},"opacity":{"value":1,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.15,"width":1},"move":{"enable":true,"speed":2,"direction":"bottom","random":true,"straight":true,"out_mode":"out","bounce":true,"attract":{"enable":false,"rotateX":600,"rotateY":90}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"repulse"},"onclick":{"enable":false,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
		</script>	