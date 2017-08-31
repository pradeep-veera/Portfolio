<?php


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'huku' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->					
				</article><!-- #post-## -->				

			<?php endwhile; // end of the loop. ?>

		</main>
	</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
