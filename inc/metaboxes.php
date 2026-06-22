<?php
/**
 * Custom metaboxes for post selections.
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the hero selection meta so it is available to the block editor and REST API.
 */
add_action( 'init', 'paijo_register_hero_post_meta' );
function paijo_register_hero_post_meta(): void {
	register_post_meta(
		'post',
		'_paijo_is_hero',
		array(
			'type'              => 'string',
			'single'            => true,
			'default'           => '',
			'sanitize_callback' => 'paijo_sanitize_hero_post_meta',
			'auth_callback'     => static function ( bool $allowed, string $meta_key, int $post_id ): bool {
				return current_user_can( 'edit_post', $post_id );
			},
			'show_in_rest'      => true,
		)
	);
}

function paijo_sanitize_hero_post_meta( $value ): string {
	return '1' === (string) $value ? '1' : '';
}

/**
 * Register Metabox for Hero Section Selection (Pilihan Editor)
 */
add_action( 'add_meta_boxes', 'paijo_register_hero_metabox' );
function paijo_register_hero_metabox(): void {
	add_meta_box(
		'paijo_hero_metabox',
		__( 'Pilihan Editor', 'paijo' ),
		'paijo_hero_metabox_callback',
		'post',
		'side',
		'high'
	);
}

/**
 * Render the metabox HTML
 */
function paijo_hero_metabox_callback( WP_Post $post ): void {
	wp_nonce_field( 'paijo_hero_metabox_save', 'paijo_hero_metabox_nonce' );
	$is_hero = get_post_meta( $post->ID, '_paijo_is_hero', true );
	?>
	<p>
		<label for="paijo_is_hero" style="display: flex; align-items: flex-start; gap: 8px; cursor: pointer; font-weight: 600;">
			<input type="checkbox" name="paijo_is_hero" id="paijo_is_hero" value="1" <?php checked( $is_hero, '1' ); ?> style="margin-top: 3px;">
			<span><?php esc_html_e( 'Tampilkan di Hero Section (Pilihan Editor)', 'paijo' ); ?></span>
		</label>
	</p>
	<p class="description" style="margin-top: 8px; font-size: 12px; color: #666;">
		<?php esc_html_e( 'Centang pilihan ini agar artikel ini muncul dalam slider utama di halaman depan.', 'paijo' ); ?>
	</p>
	<?php
}

/**
 * Save metabox data
 */
add_action( 'save_post', 'paijo_save_hero_metabox_data' );
function paijo_save_hero_metabox_data( int $post_id ): void {
	if ( ! isset( $_POST['paijo_hero_metabox_nonce'] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['paijo_hero_metabox_nonce'] ) );
	if ( ! wp_verify_nonce( $nonce, 'paijo_hero_metabox_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['paijo_is_hero'] ) ) {
		update_post_meta( $post_id, '_paijo_is_hero', '1' );
		return;
	}

	delete_post_meta( $post_id, '_paijo_is_hero' );
}

/**
 * Register Metabox for Toko Bercerita Social Media Embed URL
 */
add_action( 'add_meta_boxes', 'paijo_register_toko_metabox' );
function paijo_register_toko_metabox(): void {
	add_meta_box(
		'paijo_toko_metabox',
		__( 'Pengaturan Embed', 'paijo' ),
		'paijo_toko_metabox_callback',
		'toko_bercerita',
		'normal',
		'high'
	);
}

function paijo_toko_metabox_callback( WP_Post $post ): void {
	wp_nonce_field( 'paijo_toko_metabox_save', 'paijo_toko_metabox_nonce' );
	$embed_url = get_post_meta( $post->ID, '_paijo_toko_embed_url', true );
	?>
	<div style="margin: 10px 0;">
		<label for="paijo_toko_embed_url" style="display: block; font-weight: bold; margin-bottom: 8px;"><?php esc_html_e( 'URL Embed Instagram / TikTok', 'paijo' ); ?></label>
		<input type="url" name="paijo_toko_embed_url" id="paijo_toko_embed_url" value="<?php echo esc_url( $embed_url ); ?>" class="large-text" placeholder="Contoh: https://www.instagram.com/p/C7X... atau https://www.tiktok.com/@pandanganjogja/video/..." style="width: 100%; padding: 8px; font-size: 14px;">
		<p class="description" style="margin-top: 8px;">
			<?php esc_html_e( 'Masukkan URL post Instagram atau TikTok lengkap. WordPress akan mengambil dan merender video/post tersebut secara otomatis menggunakan oEmbed.', 'paijo' ); ?>
		</p>
	</div>
	<?php
}

add_action( 'save_post', 'paijo_save_toko_metabox_data' );
function paijo_save_toko_metabox_data( int $post_id ): void {
	if ( ! isset( $_POST['paijo_toko_metabox_nonce'] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['paijo_toko_metabox_nonce'] ) );
	if ( ! wp_verify_nonce( $nonce, 'paijo_toko_metabox_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['paijo_toko_embed_url'] ) ) {
		$embed_url = esc_url_raw( wp_unslash( $_POST['paijo_toko_embed_url'] ) );
		$old_url   = get_post_meta( $post_id, '_paijo_toko_embed_url', true );
		update_post_meta( $post_id, '_paijo_toko_embed_url', $embed_url );

		if ( $embed_url !== $old_url || ! has_post_thumbnail( $post_id ) ) {
			paijo_download_social_thumbnail_and_set( $post_id, $embed_url );
		}
	} else {
		delete_post_meta( $post_id, '_paijo_toko_embed_url' );
	}
}

function paijo_download_social_thumbnail_and_set( int $post_id, string $url ): void {
	// Prevent loops
	remove_action( 'save_post', 'paijo_save_toko_metabox_data' );

	$url       = trim( $url );
	$image_url = '';

	// 1. Instagram
	if ( preg_match( '~instagram\.com/(?:p|reel|reels)/([^/?#]+)~i', $url, $matches ) ) {
		$code      = $matches[1];
		$image_url = sprintf( 'https://www.instagram.com/p/%s/media/?size=l', $code );
	}
	// 2. TikTok
	elseif ( preg_match( '~tiktok\.com/@([^/]+)/video/(\d+)~i', $url, $matches ) ) {
		$username   = $matches[1];
		$video_id   = $matches[2];
		$oembed_url = 'https://www.tiktok.com/oembed?url=' . urlencode( $url );
		$response   = wp_remote_get( $oembed_url );
		if ( ! is_wp_error( $response ) ) {
			$body = wp_remote_retrieve_body( $response );
			$data = json_decode( $body, true );
			if ( isset( $data['thumbnail_url'] ) ) {
				$image_url = $data['thumbnail_url'];
			}
		}
	}

	if ( empty( $image_url ) ) {
		add_action( 'save_post', 'paijo_save_toko_metabox_data' );
		return;
	}

	// Sideload the image
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	$tmp = download_url( $image_url );
	if ( is_wp_error( $tmp ) ) {
		add_action( 'save_post', 'paijo_save_toko_metabox_data' );
		return;
	}

	$file_array = array(
		'name'     => sanitize_file_name( basename( parse_url( $image_url, PHP_URL_PATH ) ) ),
		'tmp_name' => $tmp,
	);

	// Overwrite default name if empty or generic
	if ( empty( $file_array['name'] ) || strpos( $file_array['name'], '.' ) === false ) {
		$file_array['name'] = 'toko-thumbnail-' . $post_id . '.jpg';
	}

	$thumb_id = media_handle_sideload( $file_array, $post_id, get_the_title( $post_id ) );

	if ( ! is_wp_error( $thumb_id ) ) {
		set_post_thumbnail( $post_id, $thumb_id );
	}

	add_action( 'save_post', 'paijo_save_toko_metabox_data' );
}
