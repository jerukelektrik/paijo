<?php
/**
 * Custom content management post types and taxonomies.
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'paijo_register_content_management_cpt' );
function paijo_register_content_management_cpt(): void {
	register_post_type(
		'paijo_content',
		array(
			'labels'            => array(
				'name'                  => __( 'Konten Khusus', 'paijo' ),
				'singular_name'         => __( 'Konten Khusus', 'paijo' ),
				'menu_name'             => __( 'Konten Khusus', 'paijo' ),
				'name_admin_bar'        => __( 'Konten Khusus', 'paijo' ),
				'add_new'               => __( 'Tambah Baru', 'paijo' ),
				'add_new_item'          => __( 'Tambah Konten Khusus', 'paijo' ),
				'edit_item'             => __( 'Edit Konten Khusus', 'paijo' ),
				'new_item'              => __( 'Konten Khusus Baru', 'paijo' ),
				'view_item'             => __( 'Lihat Konten Khusus', 'paijo' ),
				'view_items'            => __( 'Lihat Konten Khusus', 'paijo' ),
				'search_items'          => __( 'Cari Konten Khusus', 'paijo' ),
				'not_found'             => __( 'Belum ada konten khusus.', 'paijo' ),
				'not_found_in_trash'    => __( 'Tidak ada konten khusus di trash.', 'paijo' ),
				'all_items'             => __( 'Semua Konten Khusus', 'paijo' ),
				'archives'              => __( 'Arsip Konten Khusus', 'paijo' ),
				'attributes'            => __( 'Atribut Konten Khusus', 'paijo' ),
				'insert_into_item'      => __( 'Sisipkan ke konten khusus', 'paijo' ),
				'uploaded_to_this_item' => __( 'Diunggah ke konten khusus ini', 'paijo' ),
				'featured_image'        => __( 'Gambar Utama', 'paijo' ),
				'set_featured_image'    => __( 'Atur gambar utama', 'paijo' ),
				'remove_featured_image' => __( 'Hapus gambar utama', 'paijo' ),
				'use_featured_image'    => __( 'Gunakan sebagai gambar utama', 'paijo' ),
			),
			'public'            => true,
			'has_archive'       => true,
			'rewrite'           => array(
				'slug'       => 'konten-khusus',
				'with_front' => false,
			),
			'menu_position'     => 6,
			'menu_icon'         => 'dashicons-welcome-write-blog',
			'supports'          => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
			'show_in_rest'      => true,
			'capability_type'   => 'post',
			'map_meta_cap'      => true,
			'delete_with_user'  => false,
		)
	);

	register_taxonomy(
		'paijo_content_category',
		array( 'paijo_content' ),
		array(
			'labels'            => array(
				'name'                       => __( 'Kategori Konten', 'paijo' ),
				'singular_name'              => __( 'Kategori Konten', 'paijo' ),
				'menu_name'                  => __( 'Kategori Konten', 'paijo' ),
				'all_items'                  => __( 'Semua Kategori Konten', 'paijo' ),
				'edit_item'                  => __( 'Edit Kategori Konten', 'paijo' ),
				'view_item'                  => __( 'Lihat Kategori Konten', 'paijo' ),
				'update_item'                => __( 'Update Kategori Konten', 'paijo' ),
				'add_new_item'               => __( 'Tambah Kategori Konten', 'paijo' ),
				'new_item_name'              => __( 'Nama Kategori Konten Baru', 'paijo' ),
				'parent_item'                => __( 'Kategori Induk', 'paijo' ),
				'parent_item_colon'          => __( 'Kategori Induk:', 'paijo' ),
				'search_items'               => __( 'Cari Kategori Konten', 'paijo' ),
				'popular_items'              => __( 'Kategori Populer', 'paijo' ),
				'separate_items_with_commas' => __( 'Pisahkan kategori dengan koma', 'paijo' ),
				'add_or_remove_items'        => __( 'Tambah atau hapus kategori', 'paijo' ),
				'choose_from_most_used'      => __( 'Pilih dari kategori yang sering dipakai', 'paijo' ),
				'not_found'                  => __( 'Kategori tidak ditemukan.', 'paijo' ),
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'konten-khusus',
				'with_front' => false,
			),
		)
	);

	register_post_type(
		'toko_bercerita',
		array(
			'labels'            => array(
				'name'                  => __( 'PJ Feed', 'paijo' ),
				'singular_name'         => __( 'PJ Feed', 'paijo' ),
				'menu_name'             => __( 'PJ Feed', 'paijo' ),
				'name_admin_bar'        => __( 'PJ Feed', 'paijo' ),
				'add_new'               => __( 'Tambah Baru', 'paijo' ),
				'add_new_item'          => __( 'Tambah PJ Feed', 'paijo' ),
				'edit_item'             => __( 'Edit PJ Feed', 'paijo' ),
				'new_item'              => __( 'PJ Feed Baru', 'paijo' ),
				'view_item'             => __( 'Lihat PJ Feed', 'paijo' ),
				'view_items'            => __( 'Lihat PJ Feed', 'paijo' ),
				'search_items'          => __( 'Cari PJ Feed', 'paijo' ),
				'not_found'             => __( 'Belum ada PJ Feed.', 'paijo' ),
				'not_found_in_trash'    => __( 'Tidak ada PJ Feed di trash.', 'paijo' ),
				'all_items'             => __( 'Semua PJ Feed', 'paijo' ),
				'archives'              => __( 'Arsip PJ Feed', 'paijo' ),
			),
			'public'            => true,
			'has_archive'       => true,
			'rewrite'           => array(
				'slug'       => 'pj-feed',
				'with_front' => false,
			),
			'menu_position'     => 7,
			'menu_icon'         => 'dashicons-format-video',
			'supports'          => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'show_in_rest'      => true,
			'capability_type'   => 'post',
			'map_meta_cap'      => true,
			'delete_with_user'  => false,
		)
	);

	register_taxonomy(
		'pj_feed_category',
		array( 'toko_bercerita' ),
		array(
			'labels'            => array(
				'name'                       => __( 'Kategori Feed', 'paijo' ),
				'singular_name'              => __( 'Kategori Feed', 'paijo' ),
				'menu_name'                  => __( 'Kategori Feed', 'paijo' ),
				'all_items'                  => __( 'Semua Kategori Feed', 'paijo' ),
				'edit_item'                  => __( 'Edit Kategori Feed', 'paijo' ),
				'view_item'                  => __( 'Lihat Kategori Feed', 'paijo' ),
				'update_item'                => __( 'Update Kategori Feed', 'paijo' ),
				'add_new_item'               => __( 'Tambah Kategori Feed Baru', 'paijo' ),
				'new_item_name'              => __( 'Nama Kategori Feed Baru', 'paijo' ),
				'search_items'               => __( 'Cari Kategori Feed', 'paijo' ),
				'parent_item'                => __( 'Parent Kategori Feed', 'paijo' ),
				'parent_item_colon'          => __( 'Parent Kategori Feed:', 'paijo' ),
				'separate_items_with_commas' => __( 'Pisahkan kategori dengan koma', 'paijo' ),
				'add_or_remove_items'        => __( 'Tambah atau hapus kategori', 'paijo' ),
				'choose_from_most_used'      => __( 'Pilih dari kategori yang sering dipakai', 'paijo' ),
				'not_found'                  => __( 'Kategori tidak ditemukan.', 'paijo' ),
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'feed-category',
				'with_front' => false,
			),
		)
	);

	register_post_meta(
		'toko_bercerita',
		'_paijo_toko_embed_url',
		array(
			'type'              => 'string',
			'single'            => true,
			'sanitize_callback' => 'esc_url_raw',
			'auth_callback'     => static function ( bool $allowed, string $meta_key, int $post_id ): bool {
				return current_user_can( 'edit_post', $post_id );
			},
			'show_in_rest'      => true,
		)
	);

	paijo_ensure_content_category_terms();
	paijo_ensure_feed_category_terms();

	// Flush rewrite rules once to apply CPT slug changes
	if ( ! get_option( 'paijo_rewrite_rules_flushed_pj_feed' ) ) {
		flush_rewrite_rules();
		update_option( 'paijo_rewrite_rules_flushed_pj_feed', 1 );
	}
}

function paijo_ensure_content_category_terms(): void {
	$terms = array(
		'kultur-by-pandangan-jogja' => __( 'Kultur by Pandangan Jogja', 'paijo' ),
		'skena-jogsel'              => __( 'Skena Jogsel', 'paijo' ),
		'derby-istimewa'            => __( 'Derby Istimewa', 'paijo' ),
		'kuliner-berbintang'        => __( 'Kuliner Berbintang', 'paijo' ),
	);

	foreach ( $terms as $slug => $name ) {
		if ( term_exists( $slug, 'paijo_content_category' ) ) {
			continue;
		}

		wp_insert_term(
			$name,
			'paijo_content_category',
			array(
				'slug' => $slug,
			)
		);
	}
}

function paijo_get_featured_content_category_terms(): array {
	$term_slugs = array(
		'skena-jogsel',
		'kultur-by-pandangan-jogja',
		'derby-istimewa',
		'kuliner-berbintang',
	);
	$terms      = array();

	foreach ( $term_slugs as $slug ) {
		$term = get_term_by( 'slug', $slug, 'paijo_content_category' );

		if ( $term && ! is_wp_error( $term ) ) {
			$terms[] = $term;
		}
	}

	return $terms;
}

function paijo_get_latest_content_for_category( int $term_id ): ?WP_Post {
	$query = new WP_Query(
		array(
			'post_type'           => 'paijo_content',
			'post_status'         => 'publish',
			'posts_per_page'      => 1,
			'ignore_sticky_posts' => true,
			'tax_query'           => array(
				array(
					'taxonomy' => 'paijo_content_category',
					'field'    => 'term_id',
					'terms'    => $term_id,
				),
			),
		)
	);

	if ( ! $query->have_posts() ) {
		return null;
	}

	return $query->posts[0];
}

function paijo_get_content_showcase_query( int $posts_per_page = 7 ): WP_Query {
	return new WP_Query(
		array(
			'post_type'           => 'paijo_content',
			'post_status'         => 'publish',
			'posts_per_page'      => $posts_per_page,
			'ignore_sticky_posts' => true,
		)
	);
}

function paijo_get_content_category_label( ?int $post_id = null ): string {
	$post_id = $post_id ?: get_the_ID();
	$terms   = get_the_terms( $post_id, 'paijo_content_category' );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return __( 'Konten Khusus', 'paijo' );
	}

	$term = $terms[0];
	return 'kultur-by-pandangan-jogja' === $term->slug ? __( 'Kultur', 'paijo' ) : $term->name;
}

function paijo_ensure_feed_category_terms(): void {
	if ( ! taxonomy_exists( 'pj_feed_category' ) ) {
		return;
	}

	if ( ! term_exists( 'Toko Bercerita', 'pj_feed_category' ) ) {
		wp_insert_term(
			__( 'Toko Bercerita', 'paijo' ),
			'pj_feed_category',
			array(
				'slug' => 'toko-bercerita',
			)
		);
	}

	// Auto-assign existing posts to Toko Bercerita category if they have no category
	$posts = get_posts(
		array(
			'post_type'   => 'toko_bercerita',
			'numberposts' => -1,
			'post_status' => 'any',
		)
	);

	foreach ( $posts as $post ) {
		if ( ! has_term( '', 'pj_feed_category', $post->ID ) ) {
			wp_set_object_terms( $post->ID, 'toko-bercerita', 'pj_feed_category' );
		}
	}
}

add_action( 'after_switch_theme', 'paijo_flush_content_management_rewrite_rules' );
function paijo_flush_content_management_rewrite_rules(): void {
	paijo_register_content_management_cpt();
	flush_rewrite_rules();
}
