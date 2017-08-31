<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package huku
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title">404 - Die Seite wurde nicht gefunden.</h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>Entweder gab es diese Seite noch nie, oder sie wurde entfernt.</p>
					<a href="<?php echo site_url(); ?>">Hier geht es weiter.</a>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>