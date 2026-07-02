<?php
/**
 * Template Name: Sitemap
 *
 * @package Paijo
 */

get_header();
?>

<main id="main-content" class="paijo-section bg-paijo-paper min-h-screen">
	<div class="paijo-container py-12">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'mx-auto max-w-5xl' ); ?>>
				
				<!-- Header Section -->
				<div class="text-center mb-16">
					<span class="inline-block bg-[#f1818f]/10 text-[#f1818f] text-xs font-black uppercase tracking-[0.15em] px-4 py-1.5 rounded-full mb-4">
						Peta Situs
					</span>
					<h1 class="text-4xl md:text-6xl font-sans font-black tracking-tight text-paijo-ink mb-6"><?php the_title(); ?></h1>
					<?php if ( get_the_content() ) : ?>
						<div class="text-paijo-muted text-lg max-w-2xl mx-auto leading-relaxed">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- Custom CSS for WP Generated Lists -->
				<style>
					.sitemap-list ul {
						list-style: none;
						padding: 0;
						margin: 0;
					}
					.sitemap-list ul ul {
						padding-left: 1.25rem;
						border-left: 2px solid #e5e7eb;
						margin-top: 0.5rem;
						margin-bottom: 0.5rem;
					}
					html.dark .sitemap-list ul ul {
						border-left-color: #3f3f46;
					}
					.sitemap-list li {
						margin-bottom: 0.75rem;
						position: relative;
					}
					.sitemap-list li:last-child {
						margin-bottom: 0;
					}
					.sitemap-list li a {
						display: inline-flex;
						align-items: center;
						color: #4b5563;
						font-weight: 500;
						transition: all 0.2s ease;
						text-decoration: none;
					}
					html.dark .sitemap-list li a {
						color: #a1a1aa;
					}
					.sitemap-list li a::before {
						content: '';
						display: inline-block;
						width: 6px;
						height: 6px;
						background-color: #d1d5db;
						border-radius: 50%;
						margin-right: 0.75rem;
						transition: all 0.2s ease;
					}
					html.dark .sitemap-list li a::before {
						background-color: #52525b;
					}
					.sitemap-list li a:hover {
						color: #f1818f;
						transform: translateX(4px);
					}
					html.dark .sitemap-list li a:hover {
						color: #f1818f;
					}
					.sitemap-list li a:hover::before {
						background-color: #f1818f;
						transform: scale(1.5);
					}
					.sitemap-list ul ul li a {
						font-size: 0.95em;
						color: #6b7280;
					}
					html.dark .sitemap-list ul ul li a {
						color: #71717a;
					}
				</style>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
					
					<!-- Pages Card -->
					<div class="bg-white dark:bg-neutral-900 border border-paijo-line rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300">
						<div class="flex items-center gap-3 mb-6 pb-4 border-b border-paijo-line">
							<svg class="w-7 h-7 text-[#f1818f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
							<h2 class="text-2xl font-black text-paijo-ink m-0"><?php esc_html_e( 'Halaman Utama', 'paijo' ); ?></h2>
						</div>
						<div class="sitemap-list">
							<ul>
								<?php wp_list_pages( array( 'exclude' => '', 'title_li' => '' ) ); ?>
							</ul>
						</div>
					</div>

					<!-- Categories Card -->
					<div class="bg-white dark:bg-neutral-900 border border-paijo-line rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300">
						<div class="flex items-center gap-3 mb-6 pb-4 border-b border-paijo-line">
							<svg class="w-7 h-7 text-[#f1818f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
							<h2 class="text-2xl font-black text-paijo-ink m-0"><?php esc_html_e( 'Kategori Artikel', 'paijo' ); ?></h2>
						</div>
						<div class="sitemap-list">
							<ul>
								<?php wp_list_categories( array( 'exclude' => '', 'title_li' => '' ) ); ?>
							</ul>
						</div>
					</div>

					<!-- Special Content Categories Card -->
					<div class="bg-white dark:bg-neutral-900 border border-paijo-line rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300">
						<div class="flex items-center gap-3 mb-6 pb-4 border-b border-paijo-line">
							<svg class="w-7 h-7 text-[#f1818f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
							<h2 class="text-2xl font-black text-paijo-ink m-0"><?php esc_html_e( 'Konten Khusus', 'paijo' ); ?></h2>
						</div>
						<div class="sitemap-list">
							<ul>
								<?php wp_list_categories( array( 'taxonomy' => 'paijo_content_category', 'exclude' => '', 'title_li' => '' ) ); ?>
							</ul>
						</div>
					</div>

					<!-- Feed Reels Categories Card -->
					<div class="bg-white dark:bg-neutral-900 border border-paijo-line rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300">
						<div class="flex items-center gap-3 mb-6 pb-4 border-b border-paijo-line">
							<svg class="w-7 h-7 text-[#f1818f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
							<h2 class="text-2xl font-black text-paijo-ink m-0"><?php esc_html_e( 'Feed Reels', 'paijo' ); ?></h2>
						</div>
						<div class="sitemap-list">
							<ul>
								<?php wp_list_categories( array( 'taxonomy' => 'pj_feed_category', 'exclude' => '', 'title_li' => '' ) ); ?>
							</ul>
						</div>
					</div>

				</div>

				<!-- Recent Posts Section (Full Width) -->
				<div class="bg-white dark:bg-neutral-900 border border-paijo-line rounded-2xl p-8 shadow-sm">
					<div class="flex items-center justify-between mb-8 pb-4 border-b border-paijo-line">
						<div class="flex items-center gap-3">
							<svg class="w-7 h-7 text-[#f1818f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
							<h2 class="text-2xl font-black text-paijo-ink m-0"><?php esc_html_e( 'Artikel Terbaru', 'paijo' ); ?></h2>
						</div>
					</div>
					
					<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
						<?php
						$recent_posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 15 ) );
						if ( $recent_posts->have_posts() ) {
							while ( $recent_posts->have_posts() ) {
								$recent_posts->the_post();
								?>
								<a href="<?php the_permalink(); ?>" class="group block p-4 rounded-xl border border-transparent hover:border-[#f1818f]/30 hover:bg-[#f1818f]/5 transition-all duration-300">
									<div class="flex items-start gap-4">
										<div class="flex-shrink-0 w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 overflow-hidden">
											<?php if ( has_post_thumbnail() ) : ?>
												<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500' ) ); ?>
											<?php else : ?>
												<div class="w-full h-full flex items-center justify-center text-neutral-400">
													<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
												</div>
											<?php endif; ?>
										</div>
										<div class="flex-1 min-w-0">
											<p class="text-xs font-bold text-[#f1818f] uppercase tracking-wider mb-1"><?php echo esc_html( get_the_date() ); ?></p>
											<h3 class="text-sm font-bold text-paijo-ink group-hover:text-[#f1818f] transition-colors line-clamp-2 leading-snug">
												<?php the_title(); ?>
											</h3>
										</div>
									</div>
								</a>
								<?php
							}
							wp_reset_postdata();
						}
						?>
					</div>
				</div>

			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
