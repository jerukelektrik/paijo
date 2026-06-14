<?php
/**
 * Theme setup.
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', 'paijo_setup' );
function paijo_setup(): void {
	load_theme_textdomain( 'paijo', PAIJO_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'search-form' ) );
	add_theme_support( 'custom-logo', array( 'height' => 96, 'width' => 320, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/theme.css' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'paijo' ),
			'footer'  => __( 'Footer Menu', 'paijo' ),
		)
	);

	add_image_size( 'paijo-hero', 1280, 800, true );
	add_image_size( 'paijo-card', 720, 520, true );
	add_image_size( 'paijo-square', 520, 520, true );
}
