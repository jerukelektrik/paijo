<?php
/**
 * Query helpers.
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function paijo_get_home_hero_query(): WP_Query {
	return new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => -1,
			'ignore_sticky_posts' => true,
			'meta_key'            => '_paijo_is_hero',
			'meta_value'          => '1',
			'orderby'             => 'date',
			'order'               => 'DESC',
		)
	);
}

function paijo_get_latest_query( array $exclude = array(), int $posts_per_page = 9 ): WP_Query {
	return new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $posts_per_page,
			'post__not_in'        => array_map( 'intval', $exclude ),
			'ignore_sticky_posts' => true,
		)
	);
}

function paijo_get_home_categories(): array {
	$selected = array_filter(
		array(
			(int) get_theme_mod( 'paijo_home_category_1', 0 ),
			(int) get_theme_mod( 'paijo_home_category_2', 0 ),
			(int) get_theme_mod( 'paijo_home_category_3', 0 ),
			(int) get_theme_mod( 'paijo_home_category_4', 0 ),
		)
	);

	if ( ! empty( $selected ) ) {
		$terms = array();
		foreach ( $selected as $term_id ) {
			$term = get_category( (int) $term_id );
			if ( $term && ! is_wp_error( $term ) && $term->count > 0 ) {
				$terms[] = $term;
			}
		}
		return $terms;
	}

	return get_categories(
		array(
			'orderby'    => 'count',
			'order'      => 'DESC',
			'hide_empty' => true,
			'number'     => 4,
		)
	);
}

function paijo_get_category_query( int $term_id, array $exclude = array() ): WP_Query {
	return new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 3,
			'cat'                 => $term_id,
			'post__not_in'        => array_map( 'intval', $exclude ),
			'ignore_sticky_posts' => true,
		)
	);
}
