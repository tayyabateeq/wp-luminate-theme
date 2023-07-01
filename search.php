<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Luminate
 */

get_header();
?>

	<main id="primary" class="container site-main">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<div class="row">
				<header class="col-md-12 col-sm-12 page-header">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'luminate' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->
				
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					?>
					<div class="col-md-4 col-sm-6">
						<?php
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );
					?>
					</div>
					<?php

				endwhile;


				?>
				</div>
				<?php
			else :

				get_template_part( 'template-parts/content', 'none' );
				
			endif;
			the_posts_navigation();
			?>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
