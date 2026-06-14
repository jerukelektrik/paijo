<?php
/**
 * Display helpers.
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function paijo_asset_version( string $relative_path ): string {
	$file = PAIJO_DIR . '/' . ltrim( $relative_path, '/' );
	return file_exists( $file ) ? (string) filemtime( $file ) : PAIJO_VERSION;
}

function paijo_get_primary_category( ?int $post_id = null ): ?WP_Term {
	$post_id    = $post_id ?: get_the_ID();
	$categories = get_the_category( $post_id );

	if ( empty( $categories ) || is_wp_error( $categories ) ) {
		return null;
	}

	return $categories[0];
}

function paijo_get_category_label( ?int $post_id = null ): string {
	$post_id   = $post_id ?: get_the_ID();
	$post_type = get_post_type( $post_id );

	if ( 'paijo_content' === $post_type ) {
		return paijo_get_content_category_label( $post_id );
	}

	$category = paijo_get_primary_category( $post_id );
	return $category ? $category->name : __( 'News', 'paijo' );
}

function paijo_get_card_excerpt( ?int $post_id = null, int $words = 22 ): string {
	$post_id = $post_id ?: get_the_ID();
	$excerpt = get_the_excerpt( $post_id );

	if ( '' === trim( $excerpt ) ) {
		$excerpt = wp_strip_all_tags( get_post_field( 'post_content', $post_id ) );
	}

	return wp_trim_words( $excerpt, $words );
}

function paijo_get_thumbnail_url( ?int $post_id = null, string $size = 'paijo-card' ): string {
	$post_id = $post_id ?: get_the_ID();

	if ( has_post_thumbnail( $post_id ) ) {
		$url = get_the_post_thumbnail_url( $post_id, $size );
		return $url ? $url : '';
	}

	return '';
}

function paijo_get_reading_time( ?int $post_id = null ): string {
	$post_id = $post_id ?: get_the_ID();
	$content = wp_strip_all_tags( get_post_field( 'post_content', $post_id ) );
	$count   = str_word_count( $content );
	$minutes = max( 1, (int) ceil( $count / 220 ) );

	return sprintf(
		/* translators: %d: estimated reading minutes. */
		_n( '%d min read', '%d min read', $minutes, 'paijo' ),
		$minutes
	);
}

function paijo_post_ids_from_query( WP_Query $query ): array {
	return array_map(
		static function ( WP_Post $post ): int {
			return (int) $post->ID;
		},
		$query->posts
	);
}

function paijo_category_menu_fallback( string $class = 'flex items-center gap-8 text-sm font-bold uppercase tracking-[0.12em]' ): void {
	$target_slugs = array( 'insight', 'urban-legend', 'sport' );

	echo '<ul class="' . esc_attr( $class ) . '">';
	echo '<li><a class="hover:text-paijo-accent" href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'paijo' ) . '</a></li>';

	foreach ( $target_slugs as $slug ) {
		$category = get_category_by_slug( $slug );
		if ( $category && ! is_wp_error( $category ) ) {
			echo '<li><a class="hover:text-paijo-accent" href="' . esc_url( get_category_link( $category ) ) . '">' . esc_html( $category->name ) . '</a></li>';
		}
	}

	echo '</ul>';
}

function paijo_get_inline_related_post_html( $related_post ) {
	$permalink = get_permalink( $related_post->ID );
	$title     = get_the_title( $related_post->ID );
	$date      = get_the_date( '', $related_post->ID );
	$thumb_url = get_the_post_thumbnail_url( $related_post->ID, 'medium' );

	$cats     = get_the_category( $related_post->ID );
	$cat_html = '';
	if ( ! empty( $cats ) ) {
		$cat      = $cats[0];
		$cat_html = sprintf(
			'<a href="%s" class="inline-block paijo-category-capsule px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider mb-2">%s</a>',
			esc_url( get_category_link( $cat->term_id ) ),
			esc_html( $cat->name )
		);
	} else {
		$cat_html = sprintf(
			'<span class="inline-block paijo-category-capsule px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider mb-2">%s</span>',
			esc_html( paijo_get_category_label( $related_post->ID ) )
		);
	}

	$thumb_html = '';
	if ( $thumb_url ) {
		$thumb_html = sprintf(
			'<a href="%s" class="flex-shrink-0 block w-20 h-20 sm:w-24 sm:h-24 overflow-hidden rounded-xl border border-paijo-line/30 hover:scale-[1.02] transition-transform duration-200">
				<img class="w-full h-full object-cover" src="%s" alt="%s">
			</a>',
			esc_url( $permalink ),
			esc_url( $thumb_url ),
			esc_attr( $title )
		);
	}

	return sprintf(
		'<div class="my-8 flex items-center justify-between gap-4 p-4 sm:p-5 rounded-xl bg-[#F8F9FA] dark:bg-neutral-900 border border-transparent hover:bg-[#F1F3F5] dark:hover:bg-neutral-800/80 transition-all duration-200 non-prose">
			<!-- Left content -->
			<div class="flex-1 min-w-0">
				<!-- Category Capsule -->
				<div class="mb-1">%s</div>
				<!-- Title -->
				<h4 class="font-sans font-extrabold text-sm sm:text-base text-white leading-snug mb-2 line-clamp-2">
					<a href="%s" class="hover:text-paijo-accent transition-colors duration-200">%s</a>
				</h4>
				<!-- Date -->
				<div class="text-[11px] sm:text-xs text-paijo-muted font-bold">%s</div>
			</div>
			<!-- Right Thumbnail -->
			%s
		</div>',
		$cat_html,
		esc_url( $permalink ),
		esc_html( $title ),
		esc_html( $date ),
		$thumb_html
	);
}

// Register block and shortcode hooks
add_action( 'init', 'paijo_register_related_post_block_and_shortcode' );
function paijo_register_related_post_block_and_shortcode() {
	// Register the shortcode [related_post id="123"]
	add_shortcode( 'related_post', 'paijo_related_post_shortcode' );

	// Register block JS script
	wp_register_script(
		'paijo-related-post-block-js',
		PAIJO_URI . '/assets/js/blocks/related-post.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-block-editor', 'wp-data' ),
		'1.0',
		true
	);

	// Register block
	register_block_type(
		'paijo/related-post',
		array(
			'editor_script'   => 'paijo-related-post-block-js',
			'render_callback' => 'paijo_render_related_post_block',
			'attributes'      => array(
				'postId' => array(
					'type'    => 'string',
					'default' => '',
				),
			),
		)
	);
}

// Shortcode render callback
function paijo_related_post_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'id' => '',
		),
		$atts,
		'related_post'
	);

	if ( empty( $atts['id'] ) ) {
		return '';
	}

	$post_id = intval( $atts['id'] );
	$post    = get_post( $post_id );

	if ( ! $post || 'post' !== $post->post_type ) {
		return '';
	}

	return paijo_get_inline_related_post_html( $post );
}

// Gutenberg Block render callback
function paijo_render_related_post_block( $attributes ) {
	if ( empty( $attributes['postId'] ) ) {
		return '<div class="p-4 bg-neutral-100 text-xs text-neutral-500 rounded border border-dashed border-neutral-300">Paijo Related Post Block: Please select an article.</div>';
	}

	$post_id = intval( $attributes['postId'] );
	$post    = get_post( $post_id );

	if ( ! $post || 'post' !== $post->post_type ) {
		return '';
	}

	return paijo_get_inline_related_post_html( $post );
}

// Classic Editor TinyMCE integrations
add_action( 'admin_init', 'paijo_add_tinymce_button' );
function paijo_add_tinymce_button() {
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
		add_filter( 'mce_external_plugins', 'paijo_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'paijo_register_tinymce_button' );
	}
}

function paijo_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['paijo_related_post'] = PAIJO_URI . '/assets/js/admin-tinymce.js';
	return $plugin_array;
}

function paijo_register_tinymce_button( $buttons ) {
	array_push( $buttons, 'paijo_related_post' );
	return $buttons;
}

// AJAX handler to render the related post selector HTML page
add_action( 'wp_ajax_paijo_editor_posts_selector', 'paijo_editor_posts_selector_callback' );
function paijo_editor_posts_selector_callback() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( 'Unauthorized' );
	}

	$categories = get_categories();
	?>
	<!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<title>Pilih Artikel Terkait</title>
		<style>
			body {
				font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
				background: #f0f0f1;
				margin: 0;
				padding: 15px;
				box-sizing: border-box;
			}
			.selector-container {
				background: #fff;
				border: 1px solid #c3c4c7;
				border-radius: 4px;
				padding: 15px;
				display: flex;
				flex-direction: column;
				height: calc(100vh - 30px);
				box-sizing: border-box;
			}
			.filter-bar {
				display: flex;
				gap: 10px;
				margin-bottom: 15px;
				flex-wrap: wrap;
			}
			.filter-bar input[type="text"] {
				flex: 1;
				min-width: 200px;
				padding: 8px 12px;
				font-size: 13px;
				border: 1px solid #8c8f94;
				border-radius: 6px;
				outline: none;
				transition: border-color 0.2s ease;
			}
			.filter-bar input[type="text"]:focus {
				border-color: #f1818f;
				box-shadow: 0 0 0 1px #f1818f;
			}
			.filter-bar select {
				padding: 6px 24px 6px 12px;
				font-size: 13px;
				border: 1px solid #8c8f94;
				border-radius: 6px;
				min-width: 140px;
				background-color: #fff;
				outline: none;
			}
			.filter-bar select:focus {
				border-color: #f1818f;
			}
			.posts-list {
				flex: 1;
				overflow-y: auto;
				border: 1px solid #dcdcde;
				background: #fafafa;
				border-radius: 6px;
				padding: 10px;
			}
			.post-card {
				display: flex;
				align-items: center;
				gap: 15px;
				padding: 12px;
				background: #fff;
				border: 1px solid #dcdcde;
				border-radius: 8px;
				margin-bottom: 10px;
				cursor: pointer;
				transition: all 0.2s ease;
			}
			.post-card:hover {
				border-color: #f1818f;
				background: #fdf5f6;
				transform: translateY(-1px);
				box-shadow: 0 2px 5px rgba(0,0,0,0.05);
			}
			.post-card img {
				width: 50px;
				height: 50px;
				object-fit: cover;
				border-radius: 6px;
				background: #eee;
				flex-shrink: 0;
			}
			.post-card .post-info {
				flex: 1;
				min-width: 0;
			}
			.post-card .post-title {
				font-weight: 700;
				font-size: 13.5px;
				color: #1d2327;
				margin: 0 0 6px 0;
				white-space: nowrap;
				overflow: hidden;
				text-overflow: ellipsis;
			}
			.post-card .post-meta {
				font-size: 11px;
				color: #646970;
				display: flex;
				align-items: center;
				gap: 8px;
			}
			.post-card .cat-badge {
				background: #f1818f;
				color: #fff;
				padding: 2px 7px;
				border-radius: 10px;
				font-size: 9px;
				font-weight: 800;
				text-transform: uppercase;
				letter-spacing: 0.05em;
			}
			.no-results {
				padding: 30px;
				text-align: center;
				color: #646970;
				font-size: 13px;
			}
			.loading-spinner {
				text-align: center;
				padding: 20px;
				font-size: 13px;
				color: #646970;
				display: none;
			}
		</style>
	</head>
	<body>
		<div class="selector-container">
			<div class="filter-bar">
				<!-- Search -->
				<input type="text" id="search-input" placeholder="Cari artikel...">
				
				<!-- Category Filter -->
				<select id="cat-select">
					<option value="0">Semua Kategori</option>
					<?php foreach ( $categories as $category ) : ?>
						<option value="<?php echo esc_attr( $category->term_id ); ?>"><?php echo esc_html( $category->name ); ?></option>
					<?php endforeach; ?>
				</select>
				
				<!-- Sort Filter -->
				<select id="sort-select">
					<option value="date">Terbaru</option>
					<option value="popular">Terpopuler</option>
				</select>
			</div>

			<div class="loading-spinner" id="loading-indicator">Memuat artikel...</div>
			
			<div class="posts-list" id="posts-container">
				<!-- Rendered dynamically -->
			</div>
		</div>

		<script>
			document.addEventListener('DOMContentLoaded', () => {
				const searchInput = document.getElementById('search-input');
				const catSelect = document.getElementById('cat-select');
				const sortSelect = document.getElementById('sort-select');
				const postsContainer = document.getElementById('posts-container');
				const loadingIndicator = document.getElementById('loading-indicator');

				function fetchPosts() {
					loadingIndicator.style.display = 'block';
					postsContainer.style.display = 'none';

					const s = searchInput.value;
					const cat = catSelect.value;
					const orderby = sortSelect.value;

					const url = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>' + 
						'?action=paijo_filter_editor_posts' + 
						'&s=' + encodeURIComponent(s) + 
						'&cat=' + cat + 
						'&orderby=' + orderby;

					fetch(url)
						.then(res => res.json())
						.then(response => {
							loadingIndicator.style.display = 'none';
							postsContainer.style.display = 'block';

							if (response.success) {
								renderPosts(response.data);
							} else {
								postsContainer.innerHTML = '<div class="no-results">Gagal memuat data.</div>';
							}
						})
						.catch(err => {
							loadingIndicator.style.display = 'none';
							postsContainer.style.display = 'block';
							postsContainer.innerHTML = '<div class="no-results">Gagal memuat data.</div>';
						});
				}

				function renderPosts(posts) {
					if (!posts || posts.length === 0) {
						postsContainer.innerHTML = '<div class="no-results">Artikel tidak ditemukan.</div>';
						return;
					}

					let html = '';
					posts.forEach(post => {
						const imgHtml = post.thumbnail 
							? `<img src="${post.thumbnail}" alt="${post.title}">`
							: '<div style="width:50px;height:50px;background:#e5e7eb;border-radius:6px;flex-shrink:0;"></div>';

						html += `
							<div class="post-card" data-id="${post.id}">
								${imgHtml}
								<div class="post-info">
									<h4 class="post-title">${post.title}</h4>
									<div class="post-meta">
										<span class="cat-badge">${post.category}</span>
										<span>·</span>
										<span>${post.date}</span>
									</div>
								</div>
							</div>
						`;
					});

					postsContainer.innerHTML = html;

					document.querySelectorAll('.post-card').forEach(card => {
						card.addEventListener('click', () => {
							const id = card.getAttribute('data-id');
							if (id) {
								if (window.parent && window.parent.tinymce) {
									window.parent.tinymce.activeEditor.insertContent('[related_post id="' + id + '"]');
									window.parent.tinymce.activeEditor.windowManager.close();
								}
							}
						});
					});
				}

				let debounceTimer;
				searchInput.addEventListener('input', () => {
					clearTimeout(debounceTimer);
					debounceTimer = setTimeout(fetchPosts, 300);
				});

				catSelect.addEventListener('change', fetchPosts);
				sortSelect.addEventListener('change', fetchPosts);

				fetchPosts();
			});
		</script>
	</body>
	</html>
	<?php
	wp_die();
}

// AJAX handler to filter posts
add_action( 'wp_ajax_paijo_filter_editor_posts', 'paijo_filter_editor_posts_callback' );
function paijo_filter_editor_posts_callback() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_send_json_error( 'Unauthorized' );
	}

	$s       = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
	$cat     = isset( $_GET['cat'] ) ? intval( $_GET['cat'] ) : 0;
	$orderby = isset( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : 'date';

	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 20,
	);

	if ( ! empty( $s ) ) {
		$args['s'] = $s;
	}

	if ( $cat > 0 ) {
		$args['cat'] = $cat;
	}

	if ( 'popular' === $orderby ) {
		$args['orderby'] = 'comment_count';
		$args['order']   = 'DESC';
	} else {
		$args['orderby'] = 'date';
		$args['order']   = 'DESC';
	}

	$query = new WP_Query( $args );
	$posts_data = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$thumb = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
			$cats = get_the_category();
			$cat_name = ! empty( $cats ) ? $cats[0]->name : 'Uncategorized';

			$posts_data[] = array(
				'id'        => get_the_ID(),
				'title'     => html_entity_decode( get_the_title() ),
				'date'      => get_the_date(),
				'category'  => $cat_name,
				'thumbnail' => $thumb ? $thumb : '',
			);
		}
		wp_reset_postdata();
	}

	wp_send_json_success( $posts_data );
}

function paijo_get_social_embed_html( string $url ): string {
	$url = trim( $url );

	// Match Instagram post / reel / reels patterns: e.g. instagram.com/p/CODE or instagram.com/reel/CODE
	if ( preg_match( '~instagram\.com/(?:p|reel|reels)/([^/?#]+)~i', $url, $matches ) ) {
		$code = $matches[1];
		return sprintf(
			'<iframe src="https://www.instagram.com/p/%s/embed/" class="w-full h-full border-0" scrolling="no" allowtransparency="true" style="min-height: 580px; max-width: 540px; margin: 0 auto; border-radius: 12px;"></iframe>',
			esc_attr( $code )
		);
	}

	// Match TikTok video: e.g. tiktok.com/@username/video/VIDEO_ID
	if ( preg_match( '~tiktok\.com/@([^/]+)/video/(\d+)~i', $url, $matches ) ) {
		$username = $matches[1];
		$video_id = $matches[2];
		return sprintf(
			'<blockquote class="tiktok-embed w-full h-full" cite="https://www.tiktok.com/@%1$s/video/%2$s" data-video-id="%2$s" style="margin: 0 auto; max-width: 540px; min-height: 580px;">
				<section>
					<a target="_blank" href="https://www.tiktok.com/@%1$s">@%1$s</a>
				</section>
			</blockquote>
			<script async src="https://www.tiktok.com/embed.js"></script>',
			esc_attr( $username ),
			esc_attr( $video_id )
		);
	}

	// Fallback to standard oEmbed
	$oembed = wp_oembed_get( $url );
	return $oembed ? $oembed : '';
}

function paijo_get_social_thumbnail_url( string $url, ?int $post_id = null ): string {
	$post_id = $post_id ?: get_the_ID();

	// Check if post has a custom uploaded thumbnail (featured image)
	if ( has_post_thumbnail( $post_id ) ) {
		$thumb = get_the_post_thumbnail_url( $post_id, 'large' );
		if ( $thumb ) {
			return $thumb;
		}
	}

	$url = trim( $url );

	// Resolve Instagram media thumbnail directly using standard public redirect url
	if ( preg_match( '~instagram\.com/(?:p|reel|reels)/([^/?#]+)~i', $url, $matches ) ) {
		$code = $matches[1];
		return sprintf( 'https://www.instagram.com/p/%s/media/?size=l', esc_attr( $code ) );
	}

	return '';
}



