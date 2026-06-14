<?php
/**
 * Archive template.
 *
 * @package Paijo
 */

get_header();
?>

<main id="main-content" class="paijo-section">
	<div class="paijo-container">
		<header class="mb-8 max-w-3xl">
			<p class="paijo-eyebrow"><?php esc_html_e( 'Archive', 'paijo' ); ?></p>
			<h1 class="mt-2 text-4xl font-black tracking-tight sm:text-5xl"><?php the_archive_title(); ?></h1>
			<?php if ( get_the_archive_description() ) : ?>
				<div class="mt-4 text-paijo-muted"><?php the_archive_description(); ?></div>
			<?php endif; ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="paijo-grid paijo-grid-archive">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/cards/article-card' );
				endwhile;
				?>
			</div>
			<div class="mt-10"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/cards/text-card', null, array( 'title' => __( 'No posts found', 'paijo' ) ) ); ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
