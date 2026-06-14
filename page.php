<?php
/**
 * Page template.
 *
 * @package Paijo
 */

get_header();
?>

<main id="main-content" class="paijo-section">
	<div class="paijo-container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'mx-auto max-w-3xl' ); ?>>
				<h1 class="text-4xl font-black tracking-tight sm:text-5xl"><?php the_title(); ?></h1>
				<div class="paijo-prose mt-8"><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
