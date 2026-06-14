<?php
/**
 * 404 template.
 *
 * @package Paijo
 */

get_header();
?>

<main id="main-content" class="paijo-section">
	<div class="paijo-container">
		<div class="mx-auto max-w-2xl text-center">
			<p class="paijo-eyebrow"><?php esc_html_e( '404', 'paijo' ); ?></p>
			<h1 class="mt-3 text-5xl font-black tracking-tight"><?php esc_html_e( 'Page not found', 'paijo' ); ?></h1>
			<p class="mt-4 text-paijo-muted"><?php esc_html_e( 'The page may have moved or the address may be incorrect.', 'paijo' ); ?></p>
			<div class="mt-8"><?php get_search_form(); ?></div>
		</div>
	</div>
</main>

<?php
get_footer();
