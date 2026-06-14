<?php
/**
 * Fallback template.
 *
 * @package Paijo
 */

get_header();
?>

<main id="main-content" class="paijo-section">
	<div class="paijo-container">
		<?php if ( have_posts() ) : ?>
			<div class="paijo-grid paijo-grid-archive">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/cards/article-card' );
				endwhile;
				?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/cards/text-card', null, array( 'title' => __( 'No posts found', 'paijo' ) ) ); ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
