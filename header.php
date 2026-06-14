<?php
/**
 * Document header.
 *
 * @package Paijo
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
		(function() {
			var t = localStorage.getItem('theme');
			if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
				document.documentElement.classList.add('dark');
			} else {
				document.documentElement.classList.remove('dark');
			}
		})();
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'min-h-screen' ); ?>>
<?php wp_body_open(); ?>
<a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:bg-white focus:p-3 focus:text-paijo-ink" href="#main-content">
	<?php esc_html_e( 'Skip to content', 'paijo' ); ?>
</a>
<?php get_template_part( 'template-parts/header/site-header' ); ?>
