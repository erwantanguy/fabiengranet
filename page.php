<?php get_header(); ?>

<div class="row">
	<nav class="col-lg-9 colo-md-9 col-sm-12 hidden-xs text-right">
		<?php if ( function_exists('yoast_breadcrumb') ) 
{yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumb">','</p>');} ?>
	</nav>
</div>
<div class="row">
	<section id="col_gauche" class="col-lg-3 col-md-2 col-sm-4">
		<header>
			<h1><?php the_title();?></h1>
			<?php //the_excerpt(); ?>
		</header>
	</section>
	<?php while ( have_posts() ) : the_post(); ?>
	<section id="col_droite" class="col-lg-6 col-md-7 col-sm-8">
		<?php the_content(); ?>
	</section>
	<?php endwhile; ?>
	<aside class="col-lg-3 col-md-3 hidden-xs hidden-sm">
		<?php get_sidebar(); ?>
	</aside>
</div>

<?php get_footer(); ?>