<div id="slider" class="row">
		<?php
					//$myCat = 'Actualités';
							
					//$my_query = new WP_Query('category_name=' . $myCat . '&showposts=5' .'&post__in=get_option('sticcky_pots')');
					$my_query = new WP_Query(array(
						'post__in' => get_option('sticky_posts'),
						'ignore_sticky_posts' => 1,
						'posts_per_page' => '10',
					));
					//print_r($my_query);
				?>
		<div data-ride="carousel" class="carousel slide" id="carousel-example-generic">
      <ol class="carousel-indicators">
       <?php rewind_posts(); 
       $toto=0;?>
       <?php if ( have_posts() ) { ?>
		<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li class="" data-slide-to="<?php echo $toto;$toto++; ?>" data-target="#carousel-example-generic"></li>
		<?php endwhile;  } else{?>
        	<!-- <li class="test" data-slide-to="0" data-target="#carousel-example-generic"></li> -->
        <?php }?>
      </ol>
      <div role="listbox" class="carousel-inner">
      	<?php rewind_posts(); ?>
      	<?php if ( have_posts() ) { ?>
		<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <div class="item">
          <?php 
				//real dimension of the slideshow image is 516w x 248h
					if ( function_exists( 'add_theme_support' ) && has_post_thumbnail()){
					//the_post_thumbnail(array(4000,9999), array('class' => 'feature-large'));?>
					<picture id="picture">
				<?php 
					$srcfull = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					$srclarge = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tablette' );
					$srcmedium = wp_get_attachment_image_src( get_post_thumbnail_id(), 'mobile' );
					$img_id = get_post_thumbnail_id($post->ID);
					$alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
					if (!$alt_text){
						$alt_text= get_the_title();
					}
					//echo 'test : '.$alt_text; //echo $test[0]; 
				?>
			    <source srcset="<?php echo $srcmedium[0]; ?>" media="(max-width: 768px)">
			    <source srcset="<?php echo $srclarge[0]; ?>" media="(max-width: 1000px)">
			    <source srcset="<?php echo $srcfull[0]; ?>">
			    <img src="<?php echo $srclarge[0]; ?>" srcset="<?php echo $srcfull[0]; ?>" alt="<?php echo $alt_text;?>">
			</picture>
				<?php	}
				?>
				<div class="carousel-caption">
					<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					<?php $my_excerpt = get_the_excerpt(); //print_r($my_excerpt);
						if ( '' != $my_excerpt ) {
					?>
					<p class="hidden-xs"><a href="<?php the_permalink();?>"><?php echo get_the_excerpt(); ?></a></p>
					<?php }
					?>
				</div>
        </div>
        <?php endwhile;   } else{?>
        	<div class="item">
        		<img alt="First slide [900x500]" src="<?php header_image(); ?>" alt="<?php bloginfo( 'description' ); ?>">
        	</div>
        <?php }?>
      </div>
      <?php if ( have_posts() ) { ?>
      <a data-slide="prev" role="button" href="#carousel-example-generic" class="left carousel-control">
        <span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a data-slide="next" role="button" href="#carousel-example-generic" class="right carousel-control">
        <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
      <?php } ?>
    </div>
   </div>