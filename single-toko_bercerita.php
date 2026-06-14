<?php
/**
 * Single Toko Bercerita CPT template.
 *
 * @package Paijo
 */

get_header();
?>

<main id="main-content" class="paijo-section bg-neutral-50 dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 transition-colors duration-300 min-h-screen">
	<div class="paijo-container max-w-5xl mx-auto py-6">
		<?php
		while ( have_posts() ) :
			the_post();
			$post_id     = get_the_ID();
			$embed_url   = get_post_meta( $post_id, '_paijo_toko_embed_url', true );
			$views_count = paijo_update_toko_metric( $post_id, 'views' );
			$loves_count = paijo_get_toko_metric( $post_id, 'loves' );
			$shares_count = paijo_get_toko_metric( $post_id, 'shares' );
			$metric_nonce = wp_create_nonce( 'paijo_toko_metric' );
			$archive_url  = get_post_type_archive_link( 'toko_bercerita' ) ?: home_url( '/pj-feed/' );
			
			// Use the custom logo asset requested by the user
			$logo_url = esc_url( PAIJO_URI . '/assets/images/instagram-logo.jpg' );
			?>

			<nav class="mb-4 flex flex-wrap items-center gap-2 font-sans text-[11px] font-bold uppercase tracking-[0.18em] text-neutral-400 dark:text-neutral-500" aria-label="<?php esc_attr_e( 'Breadcrumb', 'paijo' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="transition-colors hover:text-[#f1818f]"><?php esc_html_e( 'Beranda', 'paijo' ); ?></a>
				<span aria-hidden="true">/</span>
				<a href="<?php echo esc_url( $archive_url ); ?>" class="transition-colors hover:text-[#f1818f]"><?php esc_html_e( 'PJ Feed', 'paijo' ); ?></a>
				<span aria-hidden="true">/</span>
				<span class="max-w-[220px] truncate text-neutral-600 dark:text-neutral-300 sm:max-w-md" aria-current="page"><?php the_title(); ?></span>
			</nav>
			
			<!-- Split Screen Container (Kumparan Style Layout) -->
			<div class="flex flex-col md:flex-row w-full max-w-[1000px] mx-auto bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 md:h-[720px] rounded-3xl overflow-hidden shadow-xl mb-12">
				<!-- Left Column: Video Player with absolute overlay logos -->
				<div class="w-full md:w-[480px] h-[600px] md:h-full bg-neutral-100 dark:bg-neutral-950 flex items-center justify-center relative shrink-0 border-b md:border-b-0 md:border-r border-neutral-200 dark:border-neutral-800">

					<!-- Thumbnail Image Wrapper -->
					<div class="w-full h-full flex items-center justify-center p-3">
						<?php if ( $embed_url ) : ?>
							<a href="<?php echo esc_url( $embed_url ); ?>" target="_blank" class="group relative w-full h-full max-h-[660px] rounded-2xl overflow-hidden bg-neutral-900 flex items-center justify-center shadow-md">
								<?php
								$thumbnail_url = paijo_get_social_thumbnail_url( $embed_url, get_the_ID() );
								if ( $thumbnail_url ) :
									?>
									<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
								<?php else : ?>
									<div class="text-center p-6 text-neutral-400 font-sans">
										<svg class="w-12 h-12 mx-auto stroke-current fill-none mb-3 opacity-60" viewBox="0 0 24 24" stroke-width="1.5">
											<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
											<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
											<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
										</svg>
										<span class="text-xs font-bold uppercase tracking-wider block"><?php esc_html_e( 'No Preview Available', 'paijo' ); ?></span>
									</div>
								<?php endif; ?>
								
								<!-- Play Overlay Button -->
								<div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
									<div class="w-16 h-16 rounded-full bg-black/60 backdrop-blur-sm flex items-center justify-center text-white scale-95 group-hover:scale-100 group-hover:bg-[#f1818f] transition-all duration-300 shadow-md">
										<!-- Play SVG Icon -->
										<svg class="w-6 h-6 fill-current translate-x-0.5" viewBox="0 0 24 24">
											<path d="M8 5v14l11-7z"/>
										</svg>
									</div>
								</div>
							</a>
						<?php else : ?>
							<div class="text-center py-20 text-neutral-500 font-sans">
								<svg class="w-12 h-12 mx-auto stroke-current fill-none mb-4 opacity-40" viewBox="0 0 24 24" stroke-width="1.5">
									<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
									<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
									<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
								</svg>
								<span class="text-xs font-bold uppercase tracking-wider block"><?php esc_html_e( 'Tidak Ada Video Embed', 'paijo' ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Right Column: Sidebar (Kumparan Style Layout) -->
				<div class="flex-1 bg-white dark:bg-neutral-900 flex flex-col h-[600px] md:h-full overflow-hidden border-t md:border-t-0 border-neutral-200 dark:border-neutral-800">
					<!-- Top Profile Bar -->
					<div class="p-5 border-b border-neutral-200 dark:border-neutral-800/80 flex items-center shrink-0">
						<div class="flex items-center gap-3">
							<div class="relative w-10 h-10 rounded-full p-[2px] bg-gradient-to-tr from-yellow-500 via-pink-500 to-purple-600 flex items-center justify-center shrink-0">
								<div class="w-full h-full rounded-full border border-black bg-neutral-900 flex items-center justify-center overflow-hidden">
									<?php if ( $logo_url ) : ?>
										<img class="w-full h-full object-cover" src="<?php echo esc_url( $logo_url ); ?>" alt="pandanganjogja">
									<?php else : ?>
										<span class="font-sans font-black text-xs text-white">P</span>
									<?php endif; ?>
								</div>
							</div>
							<div class="flex flex-col">
								<div class="flex items-center gap-1">
									<span class="font-sans font-bold text-sm text-neutral-900 dark:text-white">pandanganjogja</span>
									<!-- verified check -->
									<svg class="w-3.5 h-3.5 text-[#0095f6] fill-current" viewBox="0 0 24 24">
										<path d="M12.003 2.001c-5.522 0-9.998 4.477-9.998 10s4.476 10 9.998 10 10-4.477 10-10-4.478-10-10-10zm4.505 7.793l-5.637 5.637a.579.579 0 01-.82 0l-2.818-2.819a.579.579 0 010-.82l.82-.82a.579.579 0 01.82 0l1.588 1.58 4.407-4.407a.579.579 0 01.82 0l.82.82a.579.579 0 010 .829z"/>
									</svg>
								</div>
								<span class="text-[10px] text-neutral-500 dark:text-neutral-400 font-sans">
									<?php echo esc_html( human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?> yang lalu · <?php echo esc_html( get_the_date( 'j F Y' ) ); ?>
								</span>
							</div>
						</div>
					</div>

					<!-- Scrollable Content: Title + CMS Caption + Actions -->
					<div class="flex-1 overflow-y-auto p-6 space-y-6 scrollbar-none" id="sidebar-scroll-content">
						<!-- Post Title & Content/Caption -->
						<div class="font-sans">
							<h1 class="text-xl sm:text-2xl font-bold leading-snug tracking-tight text-neutral-900 dark:text-white mb-4">
								<?php the_title(); ?>
							</h1>
							<div class="prose prose-neutral dark:prose-invert max-w-none text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed font-sans [&>p]:mb-4">
								<?php the_content(); ?>
							</div>
						</div>

						<!-- Horizontal Separator -->
						<div class="border-t border-neutral-100 dark:border-neutral-800/60 my-2"></div>

						<div class="flex items-center gap-6 border-t border-neutral-100 dark:border-neutral-800/60 pt-1 font-sans text-neutral-950 dark:text-white" data-toko-actions data-post-id="<?php echo esc_attr( $post_id ); ?>" data-ajax-url="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" data-nonce="<?php echo esc_attr( $metric_nonce ); ?>" data-title="<?php echo esc_attr( get_the_title() ); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>">
							<div class="flex items-center gap-2 text-sm font-bold text-neutral-500 dark:text-neutral-400" aria-label="<?php echo esc_attr( sprintf( __( '%s views', 'paijo' ), paijo_format_toko_metric( $views_count ) ) ); ?>">
								<svg class="h-7 w-7 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="1.9">
									<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" />
									<circle cx="12" cy="12" r="3" />
								</svg>
								<span data-toko-count="views"><?php echo esc_html( paijo_format_toko_metric( $views_count ) ); ?></span>
							</div>

							<button type="button" class="group flex items-center gap-2 text-sm font-bold transition-colors hover:text-[#f1818f] focus:outline-none cursor-pointer" data-toko-action="love" aria-pressed="false" aria-label="<?php esc_attr_e( 'Love this post', 'paijo' ); ?>">
								<svg class="h-8 w-8 fill-none stroke-current transition-colors" viewBox="0 0 24 24" stroke-width="1.9">
									<path d="M20.8 4.6a5.4 5.4 0 0 0-7.6 0L12 5.8l-1.2-1.2a5.4 5.4 0 0 0-7.6 7.6l1.2 1.2L12 21l7.6-7.6 1.2-1.2a5.4 5.4 0 0 0 0-7.6z" />
								</svg>
								<span data-toko-count="loves"><?php echo esc_html( paijo_format_toko_metric( $loves_count ) ); ?></span>
							</button>

							<button type="button" class="group flex items-center gap-2 text-sm font-bold transition-colors hover:text-[#f1818f] focus:outline-none cursor-pointer" data-toko-action="share" aria-label="<?php esc_attr_e( 'Share this post', 'paijo' ); ?>">
								<svg class="h-8 w-8 fill-none stroke-current transition-colors" viewBox="0 0 24 24" stroke-width="1.9">
									<circle cx="18" cy="5" r="3" />
									<circle cx="6" cy="12" r="3" />
									<circle cx="18" cy="19" r="3" />
									<path d="M8.6 10.5 15.4 6.5" />
									<path d="M8.6 13.5 15.4 17.5" />
								</svg>
								<span data-share-label><?php esc_html_e( 'Bagikan', 'paijo' ); ?></span>
								<span class="text-neutral-500 dark:text-neutral-400" data-toko-count="shares"><?php echo esc_html( paijo_format_toko_metric( $shares_count ) ); ?></span>
							</button>

							<a href="<?php echo esc_url( $archive_url ); ?>" class="ml-auto flex h-11 w-11 items-center justify-center rounded-full bg-neutral-100 text-neutral-500 transition-colors hover:bg-neutral-200 hover:text-neutral-950 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:hover:text-white" aria-label="<?php esc_attr_e( 'Open PJ Feed archive', 'paijo' ); ?>">
								<svg class="h-6 w-6 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="1.8">
									<path d="M5 4v16" />
									<path d="M5 5h12l-1.5 4L17 13H5" />
								</svg>
								<span class="sr-only"><?php esc_html_e( 'PJ Feed', 'paijo' ); ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
			
			<script>
			document.addEventListener('DOMContentLoaded', function() {
				const actionRoot = document.querySelector('[data-toko-actions]');

				if (!actionRoot) {
					return;
				}

				const postId = actionRoot.dataset.postId;
				const ajaxUrl = actionRoot.dataset.ajaxUrl;
				const nonce = actionRoot.dataset.nonce;
				const postTitle = actionRoot.dataset.title;
				const postUrl = actionRoot.dataset.url;
				const loveButton = actionRoot.querySelector('[data-toko-action="love"]');
				const shareButton = actionRoot.querySelector('[data-toko-action="share"]');
				const shareLabel = actionRoot.querySelector('[data-share-label]');
				const lovedKey = `paijo_toko_loved_${postId}`;

				function updateMetric(metric, delta = 1) {
					const body = new URLSearchParams({
						action: 'paijo_toko_metric',
						post_id: postId,
						metric,
						delta: String(delta),
						nonce,
					});

					return fetch(ajaxUrl, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded',
						},
						body,
					})
						.then((response) => response.json())
						.then((payload) => {
							if (!payload.success) {
								throw new Error('Metric update failed');
							}

							const countNode = actionRoot.querySelector(`[data-toko-count="${metric}"]`);

							if (countNode) {
								countNode.textContent = payload.data.formatted;
							}

							return payload.data;
						});
				}

				function setLovedState(isLoved) {
					if (!loveButton) {
						return;
					}

					loveButton.setAttribute('aria-pressed', isLoved ? 'true' : 'false');
					loveButton.classList.toggle('border-[#f1818f]', isLoved);
					loveButton.classList.toggle('text-[#f1818f]', isLoved);
				}

				setLovedState(localStorage.getItem(lovedKey) === '1');

				if (loveButton) {
					loveButton.addEventListener('click', function() {
						const willLove = localStorage.getItem(lovedKey) !== '1';
						setLovedState(willLove);
						localStorage.setItem(lovedKey, willLove ? '1' : '0');

						updateMetric('loves', willLove ? 1 : -1).catch(() => {
							setLovedState(!willLove);
							localStorage.setItem(lovedKey, willLove ? '0' : '1');
						});
					});
				}

				if (shareButton) {
					shareButton.addEventListener('click', async function() {
						updateMetric('shares');

						try {
							if (navigator.share) {
								await navigator.share({
									title: postTitle,
									url: postUrl,
								});
							} else if (navigator.clipboard) {
								await navigator.clipboard.writeText(postUrl);
								if (shareLabel) {
									shareLabel.textContent = 'Disalin';
									setTimeout(() => {
										shareLabel.textContent = 'Bagikan';
									}, 1600);
								}
							}
						} catch (error) {
							if (error.name !== 'AbortError' && navigator.clipboard) {
								await navigator.clipboard.writeText(postUrl);
							}
						}
					});
				}
			});
			</script>

			<!-- Related posts from CPT -->
			<?php
			$related = new WP_Query(
				array(
					'post_type'           => 'toko_bercerita',
					'post_status'         => 'publish',
					'posts_per_page'      => 3,
					'post__not_in'        => array( get_the_ID() ),
					'ignore_sticky_posts' => true,
				)
			);

			if ( $related->have_posts() ) :
				?>
				<div class="mt-8 border-t border-neutral-200 dark:border-neutral-800 pt-8">
					<h2 class="text-xs font-sans font-bold text-neutral-400 dark:text-neutral-500 mb-6 uppercase tracking-widest">
						More posts from <span class="text-neutral-900 dark:text-white font-extrabold">pandanganjogja</span>
					</h2>
					
					<div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
						<?php
						while ( $related->have_posts() ) :
							$related->the_post();
							$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
							?>
							<a href="<?php the_permalink(); ?>" class="group relative block aspect-[4/3] sm:aspect-square overflow-hidden bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-xl hover:scale-[1.02] transition-all duration-300">
								<?php if ( $thumb_url ) : ?>
									<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
								<?php else : ?>
									<div class="w-full h-full flex flex-col items-center justify-center p-4 bg-neutral-50 dark:bg-neutral-950 text-center text-neutral-500 font-sans">
										<span class="text-[10px] font-bold uppercase tracking-wider line-clamp-2 px-2 mb-2"><?php the_title(); ?></span>
									</div>
								<?php endif; ?>
								
								<!-- Play Icon Overlay in bottom-right -->
								<div class="absolute right-3 bottom-3 sm:right-4 sm:bottom-4 bg-black/60 backdrop-blur-sm p-2 rounded-lg text-white group-hover:bg-[#f1818f] transition-colors duration-300 flex items-center justify-center">
									<svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
										<path d="M8 5v14l11-7z"/>
									</svg>
								</div>
							</a>
						<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
			<?php endif; ?>

		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
