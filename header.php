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
	<!-- Favicon & Icons -->
	<link rel="icon" type="image/png" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/pj-logo.png' ); ?>" sizes="48x48">
	<link rel="icon" type="image/png" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/pj-logo.png' ); ?>" sizes="192x192">
	<link rel="apple-touch-icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/pj-logo.png' ); ?>">
	<meta name="msapplication-TileImage" content="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/pj-logo.png' ); ?>">
	<link rel="manifest" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/site.webmanifest' ); ?>">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
	<style>
		/* Global override for Gutenberg Image Captions (News Media Best Practice) */
		.wp-block-image figcaption, 
		.wp-element-caption,
		.paijo-prose figcaption {
			font-size: 10px !important;
			font-style: normal !important;
			font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
			color: #888888 !important;
			line-height: 1.4 !important;
			margin-top: 8px !important;
			margin-bottom: 0 !important;
			padding: 0 !important;
			text-align: left !important;
			display: block !important;
		}

		/* Typography for Article Content (Gutenberg Support) */
		.paijo-prose p {
			margin-bottom: 1.5em;
			font-size: 17px !important;
			line-height: 1.6 !important;
		}
		@media (min-width: 640px) {
			.paijo-prose p {
				font-size: 20px !important;
				line-height: 1.8 !important;
			}
		}
		.paijo-prose h1, .paijo-prose h2, .paijo-prose h3, .paijo-prose h4, .paijo-prose h5, .paijo-prose h6 {
			font-weight: 800; /* Extra bold */
			color: var(--color-paijo-ink, #111111);
			margin-top: 2em;
			margin-bottom: 0.75em;
			line-height: 1.3;
		}
		html.dark .paijo-prose h1, html.dark .paijo-prose h2, html.dark .paijo-prose h3, html.dark .paijo-prose h4, html.dark .paijo-prose h5, html.dark .paijo-prose h6 {
			color: #f3f4f6;
		}
		.paijo-prose h1 { font-size: 2.25em; }
		.paijo-prose h2 { font-size: 1.875em; }
		.paijo-prose h3 { font-size: 1.5em; }
		.paijo-prose h4 { font-size: 1.25em; }
		
		/* Lists and Blockquotes */
		.paijo-prose ul { list-style-type: disc; padding-left: 1.5em; margin-bottom: 1.5em; }
		.paijo-prose ol { list-style-type: decimal; padding-left: 1.5em; margin-bottom: 1.5em; }
		.paijo-prose blockquote { border-left: 4px solid #f1818f; padding-left: 1em; font-style: italic; color: #6b7280; margin-bottom: 1.5em; }

		/* Allow Gutenberg font size utility classes to work */
		.paijo-prose .has-small-font-size { font-size: var(--wp--preset--font-size--small, 13px) !important; }
		.paijo-prose .has-medium-font-size { font-size: var(--wp--preset--font-size--medium, 20px) !important; }
		.paijo-prose .has-large-font-size { font-size: var(--wp--preset--font-size--large, 36px) !important; }
		.paijo-prose .has-x-large-font-size { font-size: var(--wp--preset--font-size--x-large, 42px) !important; }

		/* Custom Theme Toggle Switch */
		.paijo-theme-switch {
			position: relative;
			display: inline-flex;
			height: 32px;
			width: 56px;
			align-items: center;
			border-radius: 9999px;
			transition: background-color 0.3s, border-color 0.3s;
			cursor: pointer;
			border: 1px solid rgba(255, 255, 255, 0.3);
			background-color: rgba(255, 255, 255, 0.2);
		}
		.paijo-theme-switch:hover {
			background-color: rgba(255, 255, 255, 0.3);
		}
		header:not(.bg-transparent) .paijo-theme-switch {
			background-color: rgba(0, 0, 0, 0.2);
			border-color: rgba(255, 255, 255, 0.15);
		}
		html.dark header:not(.bg-transparent) .paijo-theme-switch {
			background-color: rgba(255, 255, 255, 0.2);
		}
		.paijo-theme-thumb {
			display: inline-flex;
			height: 24px;
			width: 24px;
			align-items: center;
			justify-content: center;
			border-radius: 9999px;
			background-color: #ffffff;
			transition: transform 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
			transform: translateX(4px);
			box-shadow: 0 2px 4px rgba(0,0,0,0.2);
		}
		html.dark .paijo-theme-thumb {
			transform: translateX(26px);
		}
		.paijo-theme-icon {
			position: absolute;
			width: 14px;
			height: 14px;
			transition: opacity 0.3s, transform 0.3s;
		}
		.paijo-theme-icon-sun {
			color: #f59e0b;
			opacity: 1;
			transform: rotate(0deg);
		}
		html.dark .paijo-theme-icon-sun {
			opacity: 0;
			transform: rotate(-90deg);
		}
		.paijo-theme-icon-moon {
			color: #6366f1;
			opacity: 0;
			transform: rotate(90deg);
		}
		html.dark .paijo-theme-icon-moon {
			opacity: 1;
			transform: rotate(0deg);
		}
	</style>
</head>
<body <?php body_class( 'min-h-screen' ); ?>>
<?php wp_body_open(); ?>
<a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:bg-white focus:p-3 focus:text-paijo-ink" href="#main-content">
	<?php esc_html_e( 'Skip to content', 'paijo' ); ?>
</a>
<?php get_template_part( 'template-parts/header/site-header' ); ?>
