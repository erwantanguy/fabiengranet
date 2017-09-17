<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>
			<?php 
				if(is_home() || is_front_page()) :
					bloginfo('name');
				else :
					wp_title("", true);
				endif;
			?>
		</title>
		<!--<?php if(is_home) :?>
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php endif; ?>-->
		<meta name="author" content="Matias">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
		<!--<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); echo '?ver=' . filemtime( get_bloginfo( 'stylesheet_url' ) ); ?>" type="text/css" media="screen" />-->
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div class="container">
			<section class="row">
				<header role="banner" id="top" class="navbar navbar-static-top bs-docs-nav col-lg-12">
				    <div class="navbar-header">
				      <button aria-expanded="false" aria-controls="bs-navbar" data-target="#bs-navbar" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="<?php bloginfo('url'); ?>"><?php 
				      	//$test = get_option("tl_logo_src");
						//print_r($test);
				      	if(!get_option("tl_logo_src")){bloginfo('name');} else{theme_logo();} 
				      ?></a>
				    </div>
				    <nav class="collapse navbar-collapse" id="bs-navbar">
				      	<?php wp_nav_menu(array(
							'theme_location' => 'premier',
							'walker' => new Bootstrap_Walker_Nav_Menu(),
							'menu_class' => 'nav navbar-nav'
						) );
						?>
						<?php wp_nav_menu(array(
							'theme_location' => 'deuxieme',
							'walker' => new Bootstrap_Walker_Nav_Menu(),
							'menu_class' => 'nav navbar-nav navbar-right'
						) );
						?>
						<div class="menu-menu-secondaire-container">
							<ul class="nav navbar-nav navbar-right" id="menu-menu-socialmedia">
								<?php if(get_option('facebook')){?>
								<li><a href="<?php echo get_option('facebook'); ?>" title="Facebook <?php bloginfo('name'); ?>"><i class="fa fa-facebook-square"></i></a></li>
								<?php }?>
								<?php if(get_option('twitter')){?>
									<li><a href="<?php echo get_option('twitter'); ?>" title="Twitter <?php bloginfo('name'); ?>"><i class="fa fa-twitter-square"></i></a></li>
								<?php }?>
								<?php if(get_option('instagram')){?>
									<li><a href="<?php echo get_option('instagram'); ?>" title="Instagram <?php bloginfo('name'); ?>"><i class="fa fa-instagram"></i></a></li>
								<?php }?>
								<?php if(get_option('pinterest')){?>
									<li><a href="<?php echo get_option('pinterest'); ?>" title="Pinterest <?php bloginfo('name'); ?>"><i class="fa fa-pinterest-square"></i></a></li>
								<?php }?>
								<?php if(get_option('linkedin')){?>
									<li><a href="<?php echo get_option('linkedin'); ?>" title="Linkedin <?php bloginfo('name'); ?>"><i class="fa fa-linkedin-square"></i></a></li>
								<?php }?>
							</ul>
						</div>
				    </nav>
				</header>
			</section>
		</div>
		<div class="container">