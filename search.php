<?php
/**
 * Search results template.
 *
 * @package Paijo
 */

get_header();
?>

<main id="main-content" class="paijo-section">
	<div class="paijo-container">
		<header class="mb-8 max-w-3xl">
			<p class="paijo-eyebrow"><?php esc_html_e( 'Search', 'paijo' ); ?></p>
			<h1 class="mt-2 text-4xl font-black tracking-tight sm:text-5xl">
				<?php
				printf(
					/* translators: %s: search query. */
					esc_html__( 'Results for "%s"', 'paijo' ),
					esc_html( get_search_query() )
				);
				?>
			</h1>
		</header>

		<?php get_search_form(); ?>

		<?php if ( have_posts() ) : ?>
			<div class="paijo-grid paijo-grid-archive mt-8">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/cards/article-card' );
				endwhile;
				?>
			</div>
			<div class="mt-10"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<div class="mt-8">
				<?php get_template_part( 'template-parts/cards/text-card', null, array( 'title' => __( 'No matching posts', 'paijo' ), 'body' => __( 'Try a different search term or browse the latest articles.', 'paijo' ) ) ); ?>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
