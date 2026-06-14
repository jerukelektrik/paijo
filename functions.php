<?php
/**
 * Paijo theme bootstrap.
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PAIJO_VERSION', '0.1.0' );
define( 'PAIJO_DIR', get_template_directory() );
define( 'PAIJO_URI', get_template_directory_uri() );

$paijo_includes = array(
	'inc/setup.php',
	'inc/helpers.php',
	'inc/queries.php',
	'inc/theme-options.php',
	'inc/assets.php',
	'inc/metaboxes.php',
	'inc/content-management.php',
);

foreach ( $paijo_includes as $paijo_include ) {
	require_once PAIJO_DIR . '/' . $paijo_include;
}
