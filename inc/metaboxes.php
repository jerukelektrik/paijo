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
 * Register Metabox for Feed Reels Social Media Embed URL
 */
add_action( 'add_meta_boxes', 'paijo_register_feed_reels_metabox' );
function paijo_register_feed_reels_metabox(): void {
	add_meta_box(
		'paijo_feed_reels_metabox',
		__( 'Pengaturan Embed', 'paijo' ),
		'paijo_feed_reels_metabox_callback',
		'feed_reels',
		'normal',
		'high'
	);
}

function paijo_feed_reels_metabox_callback( WP_Post $post ): void {
	wp_nonce_field( 'paijo_feed_reels_metabox_save', 'paijo_feed_reels_metabox_nonce' );
	$embed_url = get_post_meta( $post->ID, '_paijo_feed_reels_embed_url', true );
	?>
	<div style="margin: 10px 0;">
		<label for="paijo_feed_reels_embed_url" style="display: block; font-weight: bold; margin-bottom: 8px;"><?php esc_html_e( 'URL Embed Instagram / TikTok', 'paijo' ); ?></label>
		<input type="url" name="paijo_feed_reels_embed_url" id="paijo_feed_reels_embed_url" value="<?php echo esc_url( $embed_url ); ?>" class="large-text" placeholder="Contoh: https://www.instagram.com/p/C7X... atau https://www.tiktok.com/@pandanganjogja/video/..." style="width: 100%; padding: 8px; font-size: 14px;">
		<p class="description" style="margin-top: 8px;">
			<?php esc_html_e( 'Masukkan URL post Instagram atau TikTok lengkap. WordPress akan mengambil dan merender video/post tersebut secara otomatis menggunakan oEmbed.', 'paijo' ); ?>
		</p>
	</div>
	<?php
}

add_action( 'save_post', 'paijo_save_feed_reels_metabox_data' );
function paijo_save_feed_reels_metabox_data( int $post_id ): void {
	if ( ! isset( $_POST['paijo_feed_reels_metabox_nonce'] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['paijo_feed_reels_metabox_nonce'] ) );
	if ( ! wp_verify_nonce( $nonce, 'paijo_feed_reels_metabox_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['paijo_feed_reels_embed_url'] ) ) {
		$embed_url = esc_url_raw( wp_unslash( $_POST['paijo_feed_reels_embed_url'] ) );
		$old_url   = get_post_meta( $post_id, '_paijo_feed_reels_embed_url', true );
		update_post_meta( $post_id, '_paijo_feed_reels_embed_url', $embed_url );

		$timestamp = paijo_extract_social_timestamp( $embed_url );
		if ( $timestamp <= 0 ) {
			$timestamp = get_post_time( 'U', true, $post_id );
		}
		update_post_meta( $post_id, '_paijo_feed_reels_timestamp', $timestamp );

		if ( $embed_url !== $old_url || ! has_post_thumbnail( $post_id ) ) {
			paijo_download_social_thumbnail_and_set( $post_id, $embed_url );
		}
	} else {
		delete_post_meta( $post_id, '_paijo_feed_reels_embed_url' );
		delete_post_meta( $post_id, '_paijo_feed_reels_timestamp' );
	}
}

function paijo_extract_social_timestamp( string $url ): int {
	$url = trim( $url );
	
	if ( PHP_INT_SIZE < 8 ) {
		return 0; // Requires 64-bit PHP for large integer bitwise operations
	}

	// 1. Instagram Shortcode
	if ( preg_match( '~instagram\.com/(?:p|reel|reels)/([^/?#]+)~i', $url, $matches ) ) {
		$shortcode = $matches[1];
		$alphabet  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
		$id_int    = 0;
		foreach ( str_split( $shortcode ) as $char ) {
			$pos = strpos( $alphabet, $char );
			if ( $pos === false ) continue;
			$id_int = ( $id_int * 64 ) + $pos;
		}
		$timestamp_ms = ( $id_int >> 23 ) + 1314220021245;
		return (int) ( $timestamp_ms / 1000 );
	}

	// 2. TikTok ID
	if ( preg_match( '~tiktok\.com/@([^/]+)/video/(\d+)~i', $url, $matches ) ) {
		$video_id     = $matches[2];
		$video_id_int = (int) $video_id;
		$timestamp    = $video_id_int >> 32;
		return $timestamp;
	}

	return 0;
}

function paijo_download_social_thumbnail_and_set( int $post_id, string $url ): void {
	// Prevent loops
	remove_action( 'save_post', 'paijo_save_feed_reels_metabox_data' );

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
		add_action( 'save_post', 'paijo_save_feed_reels_metabox_data' );
		return;
	}

	// Sideload the image
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	$tmp = download_url( $image_url );
	if ( is_wp_error( $tmp ) ) {
		add_action( 'save_post', 'paijo_save_feed_reels_metabox_data' );
		return;
	}

	$file_array = array(
		'name'     => sanitize_file_name( basename( parse_url( $image_url, PHP_URL_PATH ) ) ),
		'tmp_name' => $tmp,
	);

	// Overwrite default name if empty or generic
	if ( empty( $file_array['name'] ) || strpos( $file_array['name'], '.' ) === false ) {
		$file_array['name'] = 'feed-reels-thumbnail-' . $post_id . '.jpg';
	}

	$thumb_id = media_handle_sideload( $file_array, $post_id, get_the_title( $post_id ) );

	if ( ! is_wp_error( $thumb_id ) ) {
		set_post_thumbnail( $post_id, $thumb_id );
	}

	add_action( 'save_post', 'paijo_save_feed_reels_metabox_data' );
}

/**
 * Backfill timestamps for existing feed reels.
 * Runs once and sets an option to prevent re-running.
 */
add_action( 'init', 'paijo_backfill_feed_reels_timestamps' );
function paijo_backfill_feed_reels_timestamps(): void {
	if ( get_option( 'paijo_feed_reels_timestamp_backfilled' ) ) {
		return;
	}

	$feed_reels = get_posts( array(
		'post_type'      => 'feed_reels',
		'posts_per_page' => -1,
		'post_status'    => 'any',
	) );

	foreach ( $feed_reels as $reel ) {
		$embed_url = get_post_meta( $reel->ID, '_paijo_feed_reels_embed_url', true );
		$timestamp = 0;
		if ( $embed_url ) {
			$timestamp = paijo_extract_social_timestamp( $embed_url );
		}
		if ( $timestamp <= 0 ) {
			$timestamp = get_post_time( 'U', true, $reel->ID );
		}
		update_post_meta( $reel->ID, '_paijo_feed_reels_timestamp', $timestamp );
	}

	update_option( 'paijo_feed_reels_timestamp_backfilled', true );
}

/**
 * Register Metabox for Tim Editor
 */
add_action( 'add_meta_boxes', 'paijo_register_editorial_team_metabox' );
function paijo_register_editorial_team_metabox(): void {
	add_meta_box(
		'paijo_editorial_team_metabox',
		__( 'Tim Editor', 'paijo' ),
		'paijo_editorial_team_metabox_callback',
		array( 'post', 'paijo_content' ),
		'normal',
		'default'
	);
}

function paijo_editorial_team_metabox_callback( WP_Post $post ): void {
	wp_nonce_field( 'paijo_editorial_team_metabox_save', 'paijo_editorial_team_metabox_nonce' );
	$editorial_team = get_post_meta( $post->ID, '_paijo_editorial_team', true );
	?>
	<div style="margin: 10px 0;">
		<label for="paijo_editorial_team" style="display: block; font-weight: bold; margin-bottom: 8px;"><?php esc_html_e( 'Anggota Tim (Format: Peran : Nama)', 'paijo' ); ?></label>
		<textarea name="paijo_editorial_team" id="paijo_editorial_team" rows="4" class="large-text" placeholder="Penulis : Budi&#10;Editor : Andi" style="width: 100%; padding: 8px; font-size: 14px;"><?php echo esc_textarea( $editorial_team ); ?></textarea>
		<p class="description" style="margin-top: 8px;">
			<?php esc_html_e( 'Masukkan anggota tim editor, satu orang per baris dengan format "Peran : Nama".', 'paijo' ); ?>
		</p>
	</div>
	<?php
}

add_action( 'save_post', 'paijo_save_editorial_team_metabox_data' );
function paijo_save_editorial_team_metabox_data( int $post_id ): void {
	if ( ! isset( $_POST['paijo_editorial_team_metabox_nonce'] ) ) {
		return;
	}
	$nonce = sanitize_text_field( wp_unslash( $_POST['paijo_editorial_team_metabox_nonce'] ) );
	if ( ! wp_verify_nonce( $nonce, 'paijo_editorial_team_metabox_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['paijo_editorial_team'] ) ) {
		$team_data = sanitize_textarea_field( wp_unslash( $_POST['paijo_editorial_team'] ) );
		update_post_meta( $post_id, '_paijo_editorial_team', $team_data );
	} else {
		delete_post_meta( $post_id, '_paijo_editorial_team' );
	}
}

/**
 * Register Metabox for Mitra Liputan
 */
add_action( 'add_meta_boxes', 'paijo_register_mitra_liputan_metabox' );
function paijo_register_mitra_liputan_metabox(): void {
	add_meta_box(
		'paijo_mitra_liputan_metabox',
		__( 'Mitra Liputan', 'paijo' ),
		'paijo_mitra_liputan_metabox_callback',
		array( 'post', 'paijo_content' ),
		'normal',
		'default'
	);
}

function paijo_mitra_liputan_metabox_callback( WP_Post $post ): void {
	wp_nonce_field( 'paijo_mitra_liputan_metabox_save', 'paijo_mitra_liputan_metabox_nonce' );
	$mitra_logo = get_post_meta( $post->ID, '_paijo_mitra_logo', true );
	$mitra_text = get_post_meta( $post->ID, '_paijo_mitra_text', true );
	$mitra_url  = get_post_meta( $post->ID, '_paijo_mitra_url', true );
	?>
	<div style="margin: 10px 0;">
		<label style="display: block; font-weight: bold; margin-bottom: 8px;"><?php esc_html_e( 'Logo Mitra (URL)', 'paijo' ); ?></label>
		<div style="display: flex; gap: 10px; align-items: center; margin-bottom: 15px;">
			<input type="text" name="paijo_mitra_logo" id="paijo_mitra_logo" value="<?php echo esc_url( $mitra_logo ); ?>" class="regular-text" style="width: 100%; max-width: 400px;">
			<button type="button" class="button button-secondary" id="paijo_mitra_logo_button"><?php esc_html_e( 'Pilih Gambar', 'paijo' ); ?></button>
		</div>
		
		<label for="paijo_mitra_url" style="display: block; font-weight: bold; margin-bottom: 8px;"><?php esc_html_e( 'Tautan URL Mitra (Opsional)', 'paijo' ); ?></label>
		<input type="url" name="paijo_mitra_url" id="paijo_mitra_url" value="<?php echo esc_url( $mitra_url ); ?>" class="regular-text" style="width: 100%; max-width: 400px; margin-bottom: 15px;" placeholder="https://...">
		
		<label for="paijo_mitra_text" style="display: block; font-weight: bold; margin-bottom: 8px;"><?php esc_html_e( 'Teks Keterangan', 'paijo' ); ?></label>
		<textarea name="paijo_mitra_text" id="paijo_mitra_text" rows="5" class="large-text" style="width: 100%; padding: 8px; font-size: 14px;"><?php echo esc_textarea( $mitra_text ); ?></textarea>
		<p class="description" style="margin-top: 8px;">
			<?php esc_html_e( 'Masukkan teks keterangan tentang mitra liputan (mendukung format dasar/HTML ringan).', 'paijo' ); ?>
		</p>
	</div>
	<script>
	jQuery(document).ready(function($){
		var image_frame;
		$('#paijo_mitra_logo_button').click(function(e) {
			e.preventDefault();
			if(image_frame){
				image_frame.open();
				return;
			}
			image_frame = wp.media({
				title: 'Pilih Logo Mitra',
				button: { text: 'Gunakan Gambar Ini' },
				multiple : false,
				library : { type : 'image' }
			});
			image_frame.on('select', function() {
				var selection = image_frame.state().get('selection').first().toJSON();
				$('#paijo_mitra_logo').val(selection.url);
			});
			image_frame.open();
		});
	});
	</script>
	<?php
}

add_action( 'save_post', 'paijo_save_mitra_liputan_metabox_data' );
function paijo_save_mitra_liputan_metabox_data( int $post_id ): void {
	if ( ! isset( $_POST['paijo_mitra_liputan_metabox_nonce'] ) ) {
		return;
	}
	$nonce = sanitize_text_field( wp_unslash( $_POST['paijo_mitra_liputan_metabox_nonce'] ) );
	if ( ! wp_verify_nonce( $nonce, 'paijo_mitra_liputan_metabox_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['paijo_mitra_logo'] ) ) {
		update_post_meta( $post_id, '_paijo_mitra_logo', esc_url_raw( wp_unslash( $_POST['paijo_mitra_logo'] ) ) );
	}
	if ( isset( $_POST['paijo_mitra_text'] ) ) {
		update_post_meta( $post_id, '_paijo_mitra_text', wp_kses_post( wp_unslash( $_POST['paijo_mitra_text'] ) ) );
	}
	if ( isset( $_POST['paijo_mitra_url'] ) ) {
		update_post_meta( $post_id, '_paijo_mitra_url', esc_url_raw( wp_unslash( $_POST['paijo_mitra_url'] ) ) );
	}
}

// Ensure wp_enqueue_media is loaded on post edit screens
add_action( 'admin_enqueue_scripts', 'paijo_enqueue_media_for_metabox' );
function paijo_enqueue_media_for_metabox( $hook ) {
	if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
		wp_enqueue_media();
	}
}
