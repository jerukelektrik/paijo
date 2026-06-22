<?php
/**
 * Asset loading.
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', 'paijo_enqueue_assets' );
function paijo_enqueue_assets(): void {
	wp_enqueue_style(
		'paijo-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Libre+Bodoni:ital,wght@0,400..700;1,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'paijo-theme',
		PAIJO_URI . '/assets/css/theme.css',
		array( 'paijo-fonts' ),
		paijo_asset_version( 'assets/css/theme.css' )
	);

	wp_enqueue_style(
		'paijo-hamburger',
		PAIJO_URI . '/assets/css/hamburger.css',
		array( 'paijo-theme' ),
		paijo_asset_version( 'assets/css/hamburger.css' )
	);

	wp_enqueue_script(
		'paijo-navigation',
		PAIJO_URI . '/assets/js/navigation.js',
		array(),
		paijo_asset_version( 'assets/js/navigation.js' ),
		array( 'strategy' => 'defer', 'in_footer' => true )
	);

	wp_enqueue_script(
		'paijo-theme-toggle',
		PAIJO_URI . '/assets/js/theme-toggle.js',
		array(),
		paijo_asset_version( 'assets/js/theme-toggle.js' ),
		array( 'strategy' => 'defer', 'in_footer' => true )
	);

	if ( is_front_page() ) {
		wp_enqueue_script(
			'paijo-slider',
			PAIJO_URI . '/assets/js/slider.js',
			array(),
			paijo_asset_version( 'assets/js/slider.js' ),
			array( 'strategy' => 'defer', 'in_footer' => true )
		);
	}
}
