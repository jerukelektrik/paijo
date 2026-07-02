<?php
/**
 * Custom built-in demo content importer.
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the admin menu.
 */
add_action( 'admin_menu', 'paijo_demo_importer_menu' );
function paijo_demo_importer_menu(): void {
	add_theme_page(
		__( 'Import Demo Content', 'paijo' ),
		__( 'Import Demo', 'paijo' ),
		'manage_options',
		'paijo-demo-importer',
		'paijo_demo_importer_page'
	);
}

/**
 * Render the import page UI.
 */
function paijo_demo_importer_page(): void {
	wp_enqueue_media();
	?>
	<style>
		.paijo-import-wrap {
			max-width: 800px;
			margin: 40px auto;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
			background: #ffffff;
			border-radius: 12px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
			padding: 40px;
			border: 1px solid #e2e8f0;
			color: #1a202c;
		}
		.paijo-import-header {
			text-align: center;
			margin-bottom: 30px;
			border-bottom: 1px solid #edf2f7;
			padding-bottom: 25px;
		}
		.paijo-import-header h1 {
			font-size: 28px;
			font-weight: 800;
			color: #1a202c;
			margin: 0 0 10px 0;
			letter-spacing: -0.025em;
		}
		.paijo-import-header p {
			font-size: 15px;
			color: #718096;
			margin: 0;
		}
		.paijo-import-content {
			line-height: 1.6;
		}
		.paijo-card-info {
			background: #f7fafc;
			border-left: 4px solid #f1818f;
			padding: 20px;
			border-radius: 0 8px 8px 0;
			margin-bottom: 30px;
		}
		.paijo-card-info h3 {
			margin: 0 0 8px 0;
			font-size: 16px;
			font-weight: 700;
			color: #2d3748;
		}
		.paijo-card-info p {
			margin: 0;
			font-size: 14px;
			color: #4a5568;
		}
		.paijo-btn-container {
			text-align: center;
			margin: 30px 0;
		}
		.paijo-btn-import {
			background-color: #f1818f;
			color: #ffffff !important;
			border: none;
			padding: 14px 35px;
			font-size: 16px;
			font-weight: 700;
			border-radius: 9999px;
			cursor: pointer;
			transition: all 0.2s ease;
			box-shadow: 0 4px 14px rgba(241, 129, 143, 0.4);
		}
		.paijo-btn-import:hover {
			background-color: #e06d7c;
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(241, 129, 143, 0.5);
		}
		.paijo-btn-import:active {
			transform: translateY(0);
		}
		.paijo-btn-import:disabled {
			background-color: #cbd5e0;
			cursor: not-allowed;
			box-shadow: none;
			transform: none;
		}
		.paijo-progress-box {
			display: none;
			margin-top: 30px;
		}
		.paijo-progress-bar-wrap {
			background-color: #edf2f7;
			height: 16px;
			border-radius: 9999px;
			overflow: hidden;
			margin-bottom: 20px;
			border: 1px solid #e2e8f0;
		}
		.paijo-progress-bar {
			background: linear-gradient(90deg, #f1818f, #f3a0aa);
			height: 100%;
			width: 0%;
			transition: width 0.3s ease;
			border-radius: 9999px;
		}
		.paijo-progress-status {
			display: flex;
			justify-content: space-between;
			font-size: 14px;
			font-weight: 600;
			color: #4a5568;
			margin-bottom: 20px;
		}
		.paijo-log-console {
			background-color: #1a202c;
			border-radius: 8px;
			padding: 20px;
			font-family: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, Courier, monospace;
			font-size: 13px;
			color: #e2e8f0;
			height: 250px;
			overflow-y: auto;
			border: 1px solid #2d3748;
		}
		.paijo-log-line {
			margin-bottom: 8px;
			border-bottom: 1px solid #2d3748;
			padding-bottom: 4px;
		}
		.paijo-log-line.success {
			color: #48bb78;
		}
		.paijo-log-line.info {
			color: #63b3ed;
		}
		.paijo-log-line.error {
			color: #f56565;
		}
		.paijo-import-success {
			display: none;
			text-align: center;
			margin-top: 30px;
			padding: 30px;
			background: #f0fff4;
			border: 1px solid #c6f6d5;
			border-radius: 8px;
		}
		.paijo-import-success h2 {
			color: #38a169;
			margin-top: 0;
			font-size: 22px;
		}
		.paijo-import-success p {
			color: #276749;
			margin-bottom: 20px;
		}
	</style>

	<div class="paijo-import-wrap">
		<div class="paijo-import-header">
			<h1>Paijo Theme Demo Importer</h1>
			<p>Konfigurasi website instan dengan konten demo bawaan theme</p>
		</div>

		<div class="paijo-import-content">
			<div class="paijo-card-info">
				<h3>Informasi Penting Sebelum Impor</h3>
				<p>Proses ini akan mengimpor seluruh artikel dummy, halaman khusus, video Feed Reels, gambar pendukung, menu navigasi, dan konfigurasi customizer secara offline dari file local theme Anda. Konten bawaan WordPress yang tidak digunakan (seperti postingan 'Hello World') akan dihapus agar database bersih.</p>
			</div>

			<div class="paijo-btn-container" id="paijo-action-section">
				<button class="paijo-btn-import" id="paijo-start-btn">Mulai Impor Konten</button>
			</div>

			<div class="paijo-progress-box" id="paijo-progress-section">
				<div class="paijo-progress-status">
					<span id="paijo-status-text">Mempersiapkan lingkungan impor...</span>
					<span id="paijo-percentage-text">0%</span>
				</div>
				<div class="paijo-progress-bar-wrap">
					<div class="paijo-progress-bar" id="paijo-progress-indicator"></div>
				</div>
				<div class="paijo-log-console" id="paijo-console">
					<div class="paijo-log-line info">Console siap... Menunggu aksi user.</div>
				</div>
			</div>

			<div class="paijo-import-success" id="paijo-success-section">
				<h2>Impor Berhasil Diselesaikan! 🎉</h2>
				<p>Seluruh postingan, custom post types, menu, dan gambar lokal telah sukses disalin dan diaktifkan di Media Library Anda.</p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button button-primary button-large" target="_blank">Lihat Website Anda</a>
			</div>
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const startBtn = document.getElementById('paijo-start-btn');
			const actionSection = document.getElementById('paijo-action-section');
			const progressSection = document.getElementById('paijo-progress-section');
			const successSection = document.getElementById('paijo-success-section');
			const progressIndicator = document.getElementById('paijo-progress-indicator');
			const statusText = document.getElementById('paijo-status-text');
			const percentageText = document.getElementById('paijo-percentage-text');
			const consoleBox = document.getElementById('paijo-console');

			let attachmentsQueue = [];
			let totalSteps = 0;
			let completedSteps = 0;

			function log(message, type = 'info') {
				const line = document.createElement('div');
				line.className = `paijo-log-line ${type}`;
				line.textContent = `[${new Date().toLocaleTimeString()}] ${message}`;
				consoleBox.appendChild(line);
				consoleBox.scrollTop = consoleBox.scrollHeight;
			}

			function updateProgress(percentage, status) {
				progressIndicator.style.width = percentage + '%';
				percentageText.textContent = percentage + '%';
				statusText.textContent = status;
			}

			startBtn.addEventListener('click', function() {
				actionSection.style.display = 'none';
				progressSection.style.display = 'block';
				log('Memulai proses impor...', 'info');

				// Step 1: Initialize Import and get Attachment list
				ajaxRequest('paijo_import_init', {}, function(response) {
					if (response.success) {
						attachmentsQueue = response.data.attachments || [];
						totalSteps = attachmentsQueue.length + 3; // attachments + terms/init + content + menus/options
						completedSteps = 1;
						log(`Inisialisasi berhasil. Ditemukan ${attachmentsQueue.length} media lokal untuk disalin.`, 'success');
						
						// Start importing attachments
						importNextAttachment();
					} else {
						log('Inisialisasi gagal: ' + response.data.message, 'error');
					}
				});
			});

			function importNextAttachment() {
				if (attachmentsQueue.length === 0) {
					log('Semua media lokal berhasil disalin dan terdaftar di Media Library.', 'success');
					importContent();
					return;
				}

				const attachment = attachmentsQueue.shift();
				statusText.textContent = `Menyalin media: ${attachment.title}...`;
				log(`Menyalin berkas media lokal: ${attachment.filename}`, 'info');

				ajaxRequest('paijo_import_attachment', { attachment_data: attachment }, function(response) {
					if (response.success) {
						completedSteps++;
						const percent = Math.round((completedSteps / totalSteps) * 100);
						updateProgress(percent, `Mengimpor media: ${attachment.title}`);
						log(`Sukses mengimpor media "${attachment.title}" (ID Baru: ${response.data.id})`, 'success');
					} else {
						completedSteps++;
						log(`Gagal mengimpor media "${attachment.title}": ${response.data.message}`, 'error');
					}
					// Next
					importNextAttachment();
				});
			}

			function importContent() {
				statusText.textContent = 'Mengimpor artikel, halaman, dan custom post types...';
				log('Memulai impor konten tulisan & halaman...', 'info');

				ajaxRequest('paijo_import_content', {}, function(response) {
					if (response.success) {
						completedSteps++;
						const percent = Math.round((completedSteps / totalSteps) * 100);
						updateProgress(percent, 'Mengimpor konten...');
						log(`Konten berhasil diimpor. Total postingan: ${response.data.count}`, 'success');
						
						importMenus();
					} else {
						log('Impor konten gagal: ' + response.data.message, 'error');
					}
				});
			}

			function importMenus() {
				statusText.textContent = 'Mengimpor susunan menu navigasi...';
				log('Membangun struktur menu navigasi...', 'info');

				ajaxRequest('paijo_import_menus', {}, function(response) {
					if (response.success) {
						completedSteps++;
						const percent = Math.round((completedSteps / totalSteps) * 100);
						updateProgress(percent, 'Mengimpor menu navigasi...');
						log('Menu navigasi berhasil dibuat dan dipetakan ke Primary Menu.', 'success');
						
						importOptions();
					} else {
						log('Gagal mengimpor menu: ' + response.data.message, 'error');
						importOptions();
					}
				});
			}

			function importOptions() {
				statusText.textContent = 'Mengatur kustomisasi & pembersihan...';
				log('Mengimpor opsi theme customizer...', 'info');

				ajaxRequest('paijo_import_options', {}, function(response) {
					if (response.success) {
						updateProgress(100, 'Impor selesai!');
						log('Opsi theme berhasil diimpor dan database dibersihkan.', 'success');
						
						setTimeout(function() {
							progressSection.style.display = 'none';
							successSection.style.display = 'block';
						}, 1000);
					} else {
						log('Gagal mengimpor opsi theme: ' + response.data.message, 'error');
					}
				});
			}

			function ajaxRequest(action, data, callback) {
				const formData = new FormData();
				formData.append('action', action);
				formData.append('security', '<?php echo esc_js( wp_create_nonce( "paijo_import_nonce" ) ); ?>');
				
				for (const key in data) {
					if (typeof data[key] === 'object') {
						formData.append(key, JSON.stringify(data[key]));
					} else {
						formData.append(key, data[key]);
					}
				}

				fetch(ajaxurl, {
					method: 'POST',
					body: formData
				})
				.then(response => response.json())
				.then(result => callback(result))
				.catch(error => {
					log('Error Jaringan/AJAX: ' + error.message, 'error');
				});
			}
		});
	</script>
	<?php
}

/**
 * AJAX Handler: Init & Terms
 */
add_action( 'wp_ajax_paijo_import_init', 'paijo_ajax_import_init' );
function paijo_ajax_import_init(): void {
	check_ajax_referer( 'paijo_import_nonce', 'security' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => 'Unauthorized' ) );
	}

	$xml_file = PAIJO_DIR . '/demo-data/content.xml';
	if ( ! file_exists( $xml_file ) ) {
		wp_send_json_error( array( 'message' => 'File content.xml tidak ditemukan di folder demo-data.' ) );
	}

	// 1. Clean up default content
	$default_post = get_page_by_path( 'hello-world', OBJECT, 'post' );
	if ( $default_post ) {
		wp_delete_post( $default_post->ID, true );
	}
	$default_page = get_page_by_path( 'sample-page', OBJECT, 'page' );
	if ( $default_page ) {
		wp_delete_post( $default_page->ID, true );
	}

	// Clear previous maps
	delete_option( 'paijo_demo_import_post_map' );
	delete_option( 'paijo_demo_import_term_map' );

	// 2. Parse XML
	$xml = simplexml_load_file( $xml_file );
	if ( ! $xml ) {
		wp_send_json_error( array( 'message' => 'Format content.xml tidak valid.' ) );
	}

	$term_map = array();
	$attachments = array();

	// Load namespaces
	$wp_ns_uri = 'http://wordpress.org/export/1.2/';

	// 3. Pre-import all terms (categories, tags, custom taxonomies)
	// We scan all term definitions in the channel
	$channel_wp = $xml->channel->children( $wp_ns_uri );
	
	// Import categories
	if ( isset( $xml->channel->category ) ) {
		foreach ( $xml->channel->category as $cat ) {
			$cat_wp = $cat->children( $wp_ns_uri );
			$slug   = (string) $cat_wp->category_nicename;
			$name   = (string) $cat_wp->cat_name;
			
			$term = term_exists( $slug, 'category' );
			if ( ! $term ) {
				$term = wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
			}
			if ( ! is_wp_error( $term ) ) {
				$term_map[ 'category_' . $slug ] = (int) $term['term_id'];
			}
		}
	}

	// Import tags
	if ( isset( $xml->channel->tag ) ) {
		foreach ( $xml->channel->tag as $tag ) {
			$tag_wp = $tag->children( $wp_ns_uri );
			$slug   = (string) $tag_wp->tag_slug;
			$name   = (string) $tag_wp->tag_name;
			
			$term = term_exists( $slug, 'post_tag' );
			if ( ! $term ) {
				$term = wp_insert_term( $name, 'post_tag', array( 'slug' => $slug ) );
			}
			if ( ! is_wp_error( $term ) ) {
				$term_map[ 'post_tag_' . $slug ] = (int) $term['term_id'];
			}
		}
	}

	// Import custom taxonomy terms (from CPTs in items)
	// Also scan items for CPT attachments
	foreach ( $xml->channel->item as $item ) {
		$item_wp = $item->children( $wp_ns_uri );
		$post_type = (string) $item_wp->post_type;

		// Scan for attachment
		if ( 'attachment' === $post_type ) {
			$attachments[] = array(
				'id'       => (int) $item_wp->post_id,
				'title'    => (string) $item->title,
				'url'      => (string) $item_wp->attachment_url,
				'filename' => basename( (string) $item_wp->attachment_url ),
				'date'     => (string) $item_wp->post_date,
			);
		}

		// Scan categories inside items to ensure custom terms are registered
		if ( isset( $item->category ) ) {
			foreach ( $item->category as $cat ) {
				$domain = (string) $cat['domain'];
				$slug   = (string) $cat['nicename'];
				$name   = (string) $cat;

				if ( 'category' !== $domain && 'post_tag' !== $domain && 'nav_menu' !== $domain ) {
					$term = term_exists( $slug, $domain );
					if ( ! $term ) {
						$term = wp_insert_term( $name, $domain, array( 'slug' => $slug ) );
					}
					if ( ! is_wp_error( $term ) ) {
						$term_map[ $domain . '_' . $slug ] = (int) $term['term_id'];
					}
				}
			}
		}
	}

	update_option( 'paijo_demo_import_term_map', $term_map );

	wp_send_json_success( array(
		'attachments' => $attachments
	) );
}

/**
 * AJAX Handler: Import single Attachment
 */
add_action( 'wp_ajax_paijo_import_attachment', 'paijo_ajax_import_attachment' );
function paijo_ajax_import_attachment(): void {
	check_ajax_referer( 'paijo_import_nonce', 'security' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => 'Unauthorized' ) );
	}

	$attachment_data_json = isset( $_POST['attachment_data'] ) ? wp_unslash( $_POST['attachment_data'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	if ( empty( $attachment_data_json ) ) {
		wp_send_json_error( array( 'message' => 'Data media kosong.' ) );
	}

	$attachment_data = json_decode( $attachment_data_json, true );
	if ( ! $attachment_data ) {
		wp_send_json_error( array( 'message' => 'Format data media tidak valid.' ) );
	}

	$original_url = $attachment_data['url'];
	$original_id  = $attachment_data['id'];
	$title         = $attachment_data['title'];
	$date          = $attachment_data['date'];

	// 1. Get relative path from URL (e.g. 2026/06/filename.jpg)
	if ( ! preg_match( '#wp-content/uploads/(.+)$#i', $original_url, $matches ) ) {
		wp_send_json_error( array( 'message' => 'Format URL media tidak dikenal: ' . $original_url ) );
	}
	$relative_path = $matches[1];

	// 2. Check local source file inside theme
	$local_source = PAIJO_DIR . '/demo-data/uploads/' . $relative_path;
	if ( ! file_exists( $local_source ) ) {
		wp_send_json_error( array( 'message' => 'File fisik tidak ditemukan di: ' . $local_source ) );
	}

	// 3. Prepare upload directory in WordPress
	$wp_upload = wp_upload_dir( $date );
	if ( ! empty( $wp_upload['error'] ) ) {
		wp_send_json_error( array( 'message' => 'Upload directory error: ' . $wp_upload['error'] ) );
	}

	$dest_file = $wp_upload['basedir'] . '/' . $relative_path;
	wp_mkdir_p( dirname( $dest_file ) );

	// 4. Copy file
	if ( ! copy( $local_source, $dest_file ) ) {
		wp_send_json_error( array( 'message' => 'Gagal menyalin file ke ' . $dest_file ) );
	}

	// 5. Register in Media Library
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	$filetype = wp_check_filetype( basename( $dest_file ), null );
	$attachment = array(
		'guid'           => $wp_upload['baseurl'] . '/' . $relative_path,
		'post_mime_type' => $filetype['type'],
		'post_title'     => $title ?: preg_replace( '/\.[^.]+$/', '', basename( $dest_file ) ),
		'post_content'   => '',
		'post_status'    => 'inherit',
		'post_date'      => $date,
	);

	$attach_id = wp_insert_attachment( $attachment, $dest_file );
	if ( is_wp_error( $attach_id ) ) {
		wp_send_json_error( array( 'message' => 'Gagal memasukkan metadata media: ' . $attach_id->get_error_message() ) );
	}

	// Generate metadata sizes
	$attach_data = wp_generate_attachment_metadata( $attach_id, $dest_file );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	// 6. Map ID
	$post_map = get_option( 'paijo_demo_import_post_map', array() );
	$post_map[ (int) $original_id ] = (int) $attach_id;
	update_option( 'paijo_demo_import_post_map', $post_map );

	wp_send_json_success( array( 'id' => $attach_id ) );
}

/**
 * AJAX Handler: Import Posts, Pages & CPTs
 */
add_action( 'wp_ajax_paijo_import_content', 'paijo_ajax_import_content' );
function paijo_ajax_import_content(): void {
	check_ajax_referer( 'paijo_import_nonce', 'security' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => 'Unauthorized' ) );
	}

	$xml_file = PAIJO_DIR . '/demo-data/content.xml';
	$xml = simplexml_load_file( $xml_file );
	if ( ! $xml ) {
		wp_send_json_error( array( 'message' => 'Gagal memuat XML.' ) );
	}

	$post_map = get_option( 'paijo_demo_import_post_map', array() );
	$wp_ns_uri = 'http://wordpress.org/export/1.2/';
	$content_ns_uri = 'http://purl.org/rss/1.0/modules/content/';
	$excerpt_ns_uri = 'http://wordpress.org/export/1.2/excerpt/';

	$count = 0;

	// Loop to import posts, pages and CPTs
	foreach ( $xml->channel->item as $item ) {
		$item_wp = $item->children( $wp_ns_uri );
		$post_type = (string) $item_wp->post_type;

		// Skip attachments and menu items (handled in other stages)
		if ( 'attachment' === $post_type || 'nav_menu_item' === $post_type ) {
			continue;
		}

		$original_id = (int) $item_wp->post_id;
		$title = (string) $item->title;

		// Check if already imported
		if ( isset( $post_map[ $original_id ] ) ) {
			continue;
		}

		$content = (string) $item->children( $content_ns_uri )->encoded;
		$excerpt = (string) $item->children( $excerpt_ns_uri )->encoded;

		// Replace local domain references in content to dynamic site URL
		$content = str_replace( 'http://pandanganjogja.local', get_site_url(), $content );
		$content = str_replace( 'https://pandanganjogja.local', get_site_url(), $content );

		$post_data = array(
			'post_title'     => $title,
			'post_content'   => $content,
			'post_excerpt'   => $excerpt,
			'post_status'    => (string) $item_wp->status,
			'post_name'      => (string) $item_wp->post_name,
			'post_type'      => $post_type,
			'post_date'      => (string) $item_wp->post_date,
			'post_date_gmt'  => (string) $item_wp->post_date_gmt,
			'post_author'    => get_current_user_id(),
		);

		// Handle parent ID mapping if exists
		$parent_id = (int) $item_wp->post_parent;
		if ( $parent_id && isset( $post_map[ $parent_id ] ) ) {
			$post_data['post_parent'] = $post_map[ $parent_id ];
		}

		$new_post_id = wp_insert_post( $post_data );
		if ( is_wp_error( $new_post_id ) ) {
			continue;
		}

		$post_map[ $original_id ] = $new_post_id;
		$count++;

		// 1. Assign terms (taxonomies)
		if ( isset( $item->category ) ) {
			$tax_terms = array();
			foreach ( $item->category as $cat ) {
				$domain = (string) $cat['domain'];
				$slug   = (string) $cat['nicename'];
				if ( 'nav_menu' !== $domain ) {
					if ( ! isset( $tax_terms[ $domain ] ) ) {
						$tax_terms[ $domain ] = array();
					}
					$tax_terms[ $domain ][] = $slug;
				}
			}

			foreach ( $tax_terms as $taxonomy => $slugs ) {
				wp_set_object_terms( $new_post_id, $slugs, $taxonomy );
			}
		}

		// 2. Import postmeta (custom fields)
		if ( isset( $item_wp->postmeta ) ) {
			foreach ( $item_wp->postmeta as $meta ) {
				$key = (string) $meta->meta_key;
				$val = (string) $meta->meta_value;

				// Map featured image (_thumbnail_id)
				if ( '_thumbnail_id' === $key ) {
					$old_thumb_id = (int) $val;
					if ( isset( $post_map[ $old_thumb_id ] ) ) {
						$val = (string) $post_map[ $old_thumb_id ];
					}
				}

				update_post_meta( $new_post_id, $key, $val );
			}
		}
	}

	update_option( 'paijo_demo_import_post_map', $post_map );

	wp_send_json_success( array( 'count' => $count ) );
}

/**
 * AJAX Handler: Import navigation Menus
 */
add_action( 'wp_ajax_paijo_import_menus', 'paijo_ajax_import_menus' );
function paijo_ajax_import_menus(): void {
	check_ajax_referer( 'paijo_import_nonce', 'security' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => 'Unauthorized' ) );
	}

	$xml_file = PAIJO_DIR . '/demo-data/content.xml';
	$xml = simplexml_load_file( $xml_file );
	if ( ! $xml ) {
		wp_send_json_error( array( 'message' => 'Gagal memuat XML.' ) );
	}

	$post_map  = get_option( 'paijo_demo_import_post_map', array() );
	$term_map  = get_option( 'paijo_demo_import_term_map', array() );
	$wp_ns_uri = 'http://wordpress.org/export/1.2/';

	// 1. Scan for nav_menu_item CPTs and collect menu names
	$menu_names = array();
	$menu_items = array();

	foreach ( $xml->channel->item as $item ) {
		$item_wp = $item->children( $wp_ns_uri );
		$post_type = (string) $item_wp->post_type;

		if ( 'nav_menu_item' === $post_type ) {
			// Find associated menu category
			$menu_name = '';
			foreach ( $item->category as $cat ) {
				if ( 'nav_menu' === (string) $cat['domain'] ) {
					$menu_name = (string) $cat;
					break;
				}
			}
			if ( $menu_name ) {
				$menu_names[ $menu_name ] = true;
				$menu_items[ $menu_name ][] = $item;
			}
		}
	}

	// 2. Create the menus and populate items
	foreach ( $menu_names as $name => $dummy ) {
		$menu_exists = wp_get_nav_menu_object( $name );
		if ( $menu_exists ) {
			wp_delete_nav_menu( $menu_exists->term_id );
		}

		$menu_id = wp_create_nav_menu( $name );
		if ( is_wp_error( $menu_id ) ) {
			continue;
		}

		$menu_items_map = array();

		// Add items to menu
		foreach ( $menu_items[ $name ] as $item ) {
			$item_wp = $item->children( $wp_ns_uri );
			$title = (string) $item->title;
			$original_id = (int) $item_wp->post_id;

			// Extract postmeta
			$meta_data = array();
			foreach ( $item_wp->postmeta as $meta ) {
				$meta_data[ (string) $meta->meta_key ] = (string) $meta->meta_value;
			}

			$menu_item_type = $meta_data['_menu_item_type'] ?? 'custom';
			$menu_item_object = $meta_data['_menu_item_object'] ?? '';
			$menu_item_object_id = (int) ( $meta_data['_menu_item_object_id'] ?? 0 );

			// Map target IDs to new database IDs
			if ( 'post_type' === $menu_item_type ) {
				if ( isset( $post_map[ $menu_item_object_id ] ) ) {
					$menu_item_object_id = $post_map[ $menu_item_object_id ];
				}
			} elseif ( 'taxonomy' === $menu_item_type ) {
				// Search taxonomy term in term map
				$term_key = $menu_item_object . '_' . ( $meta_data['_menu_item_object_slug'] ?? '' );
				if ( isset( $term_map[ $term_key ] ) ) {
					$menu_item_object_id = $term_map[ $term_key ];
				}
			}

			$menu_item_url = $meta_data['_menu_item_url'] ?? '';
			if ( 'custom' === $menu_item_type && $menu_item_url ) {
				$menu_item_url = str_replace( 'http://pandanganjogja.local', get_site_url(), $menu_item_url );
				$menu_item_url = str_replace( 'https://pandanganjogja.local', get_site_url(), $menu_item_url );
			}

			$menu_item_data = array(
				'menu-item-title'     => $title,
				'menu-item-position'  => (int) $item_wp->menu_order,
				'menu-item-type'      => $menu_item_type,
				'menu-item-object'    => $menu_item_object,
				'menu-item-object-id' => $menu_item_object_id,
				'menu-item-url'       => $menu_item_url,
				'menu-item-status'    => 'publish',
				'menu-item-target'    => $meta_data['_menu_item_target'] ?? '',
				'menu-item-classes'   => isset( $meta_data['_menu_item_classes'] ) ? maybe_unserialize( $meta_data['_menu_item_classes'] ) : '',
			);

			// Handle parent item
			$menu_item_parent = (int) ( $meta_data['_menu_item_menu_item_parent'] ?? 0 );
			if ( $menu_item_parent && isset( $menu_items_map[ $menu_item_parent ] ) ) {
				$menu_item_data['menu-item-parent-id'] = $menu_items_map[ $menu_item_parent ];
			}

			$db_id = wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );
			if ( $db_id ) {
				$menu_items_map[ $original_id ] = $db_id;
			}
		}

		// Map to Header Menu primary location
		if ( 'Header Menu' === $name || 'header-menu' === sanitize_title( $name ) ) {
			set_theme_mod(
				'nav_menu_locations',
				array(
					'primary' => $menu_id,
				)
			);
		}
	}

	wp_send_json_success();
}

/**
 * AJAX Handler: Import customizer Theme Options & Cleanup
 */
add_action( 'wp_ajax_paijo_import_options', 'paijo_ajax_import_options' );
function paijo_ajax_import_options(): void {
	check_ajax_referer( 'paijo_import_nonce', 'security' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => 'Unauthorized' ) );
	}

	$options_file = PAIJO_DIR . '/demo-data/theme-options.json';
	if ( file_exists( $options_file ) ) {
		$options_content = file_get_contents( $options_file );
		$options = json_decode( $options_content, true );
		
		if ( $options ) {
			$post_map = get_option( 'paijo_demo_import_post_map', array() );

			// Map custom logo ID if defined
			if ( isset( $options['custom_logo'] ) ) {
				$old_logo_id = (int) $options['custom_logo'];
				if ( isset( $post_map[ $old_logo_id ] ) ) {
					$options['custom_logo'] = $post_map[ $old_logo_id ];
				}
			}

			// Exclude nav_menu_locations since we mapped primary menu in the menu step
			$menu_locations = get_theme_mod( 'nav_menu_locations' );
			
			// Save other theme mods
			foreach ( $options as $key => $val ) {
				if ( 'nav_menu_locations' !== $key ) {
					set_theme_mod( $key, $val );
				}
			}

			if ( $menu_locations ) {
				set_theme_mod( 'nav_menu_locations', $menu_locations );
			}
		}
	}

	// Cleanup temporary options
	delete_option( 'paijo_demo_import_post_map' );
	delete_option( 'paijo_demo_import_term_map' );

	wp_send_json_success();
}
