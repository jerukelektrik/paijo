<?php
/**
 * Single post template.
 *
 * @package Paijo
 */

get_header();
?>

<main id="main-content" class="paijo-section bg-paijo-card text-paijo-ink transition-colors duration-300">
	<div class="paijo-container">
		<?php
		while ( have_posts() ) :
			the_post();
			$thumbnail = paijo_get_thumbnail_url( get_the_ID(), 'paijo-hero' );
			?>
			<div class="max-w-3xl mx-auto mt-4">
				<!-- Main Article Column -->
				<article <?php post_class(); ?>>
					<!-- Breadcrumbs -->
					<nav class="flex flex-wrap items-center gap-2 text-[10px] sm:text-xs font-bold text-neutral-400 uppercase tracking-widest mb-6" aria-label="Breadcrumb">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-paijo-accent transition-colors">Home</a>
						<span class="text-neutral-300" aria-hidden="true">/</span>
						<?php
						$primary_cat = paijo_get_primary_category();
						if ( $primary_cat ) :
							?>
							<a href="<?php echo esc_url( get_category_link( $primary_cat ) ); ?>" class="hover:text-paijo-accent transition-colors"><?php echo esc_html( $primary_cat->name ); ?></a>
							<span class="text-neutral-300" aria-hidden="true">/</span>
							<?php
						endif;
						?>
						<span class="text-neutral-500 truncate max-w-[150px] sm:max-w-xs"><?php the_title(); ?></span>
					</nav>

					<!-- Header Section -->
					<header class="mb-8">
						<!-- Category -->
						<div class="mb-4">
							<?php
							$primary_cat = paijo_get_primary_category();
							if ( $primary_cat ) :
								?>
								<a href="<?php echo esc_url( get_category_link( $primary_cat ) ); ?>" class="inline-block paijo-category-capsule px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.15em]">
									<?php echo esc_html( $primary_cat->name ); ?>
								</a>
								<?php
							else :
								?>
								<span class="inline-block paijo-category-capsule px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.15em]">
									<?php echo esc_html( paijo_get_category_label() ); ?>
								</span>
								<?php
							endif;
							?>
						</div>
						
						<!-- Title -->
						<h1 class="font-sans font-extrabold text-3xl sm:text-4xl lg:text-5xl text-paijo-ink leading-tight mb-6"><?php the_title(); ?></h1>
						
						<!-- Author & Meta & Share Bar (Kumparan Hits style) -->
						<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-y border-paijo-line py-4 my-6">
							<!-- Author Info -->
							<div class="flex items-center gap-3 text-xs text-paijo-muted">
								<!-- Author Avatar -->
								<img class="w-10 h-10 rounded-full object-cover bg-neutral-200 border border-paijo-line" src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ), 80 ) ); ?>" alt="<?php echo esc_attr( get_the_author() ); ?>">
								
								<div class="flex flex-col">
									<!-- Author Name -->
									<span class="font-bold text-paijo-ink text-sm hover:text-paijo-accent transition-colors">
										<?php echo esc_html( get_the_author() ); ?>
									</span>
									
									<!-- Date & Reading Time -->
									<div class="flex items-center gap-2 mt-0.5">
										<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
										<span class="text-neutral-300" aria-hidden="true">•</span>
										<span><?php echo esc_html( paijo_get_reading_time() ); ?></span>
									</div>
								</div>
							</div>

							<!-- Engagement & Actions Toolbar -->
							<div class="flex items-center gap-4 text-paijo-ink">
								<!-- Like (Heart) Button -->
								<button id="like-btn" class="flex items-center gap-2 hover:text-[#f1818f] transition-colors duration-200 focus:outline-none cursor-pointer" aria-label="Like this post">
									<svg id="like-icon" class="w-6 h-6 stroke-current fill-none transition-all duration-200" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
										<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
									</svg>
									<span id="like-count" class="text-sm font-bold">0</span>
								</button>

								<!-- Comment Button -->
								<button id="comment-btn" class="flex items-center gap-2 hover:text-paijo-accent transition-colors duration-200 focus:outline-none cursor-pointer" aria-label="Go to comments">
									<svg class="w-6 h-6 stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
										<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
									</svg>
									<span class="text-sm font-bold">0</span>
								</button>

								<!-- WhatsApp Button -->
								<a href="https://api.whatsapp.com/send?text=<?php echo rawurlencode( get_the_title() . ' - ' . get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-8 h-8 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-sm hover:scale-105 transition-all duration-200" aria-label="Share on WhatsApp">
									<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
										<path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.97C16.49 2.038 14.005.992 11.434.992c-5.461 0-9.905 4.417-9.909 9.803-.002 1.93.507 3.8 1.474 5.468l-.991 3.622 3.73-.974zm11.367-7.834c-.328-.163-1.94-.949-2.24-1.058-.298-.11-.517-.163-.73.163-.215.328-.83.1058-1.02.1274-.188.218-.375.244-.704.082-.328-.163-1.385-.505-2.637-1.613-.973-.861-1.629-1.924-1.82-2.25-.19-.328-.02-.505.143-.668.148-.145.328-.382.492-.573.163-.19.219-.327.328-.546.11-.218.054-.409-.028-.573-.082-.164-.73-1.748-1.002-2.404-.264-.637-.533-.55-.73-.56l-.623-.01c-.218 0-.573.082-.874.409-.3.327-1.147 1.118-1.147 2.727 0 1.61 1.173 3.166 1.337 3.385.163.218 2.308 3.499 5.59 4.916.78.337 1.39.539 1.86.687.784.248 1.498.213 2.062.13.628-.094 1.94-.787 2.21-1.547.275-.76.275-1.411.19-1.547-.082-.136-.298-.218-.627-.382z"/>
								</svg>
							</a>

								<!-- Copy Link Button & Tooltip Container -->
								<div class="relative inline-block">
									<button id="copy-link-btn" class="flex items-center justify-center w-8 h-8 rounded-full bg-[#00A3A3] hover:bg-[#008F8F] text-white shadow-sm hover:scale-105 transition-all duration-200 focus:outline-none cursor-pointer" aria-label="Copy post link">
										<svg class="w-4 h-4 fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
											<rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
											<path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
										</svg>
									</button>
									<!-- Tooltip -->
									<div id="copy-tooltip" class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2.5 py-1 text-[10px] font-bold text-white bg-neutral-900 rounded opacity-0 scale-95 pointer-events-none transition-all duration-200 whitespace-nowrap shadow-md">
										Copied!
									</div>
								</div>

								<!-- More Options Button -->
								<div class="relative inline-block">
									<button id="more-options-btn" class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors duration-200 focus:outline-none cursor-pointer" aria-label="More options">
										<svg class="w-6 h-6 stroke-current fill-none animate-pulse-slow" stroke-width="2" viewBox="0 0 24 24">
											<circle cx="12" cy="5" r="1.5"></circle>
											<circle cx="12" cy="12" r="1.5"></circle>
											<circle cx="12" cy="19" r="1.5"></circle>
										</svg>
									</button>
									<!-- Dropdown Menu -->
									<div id="more-dropdown" class="absolute right-0 mt-2 w-48 bg-white dark:bg-neutral-900 border border-paijo-line rounded-md shadow-lg py-1 z-10 hidden transition-all opacity-0 scale-95">
										<button id="web-share-btn" class="w-full text-left px-4 py-2 text-xs hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors font-bold text-paijo-ink flex items-center gap-2 cursor-pointer">
											<svg class="w-3.5 h-3.5 stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
												<circle cx="18" cy="5" r="3"></circle>
												<circle cx="6" cy="12" r="3"></circle>
												<circle cx="18" cy="19" r="3"></circle>
												<line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
												<line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
											</svg>
											Share Article...
										</button>
										<a href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode( get_the_title() . ' - ' . get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" class="w-full text-left px-4 py-2 text-xs hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors font-bold text-paijo-ink flex items-center gap-2">
											<svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
												<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
											</svg>
											Share on X (Twitter)
										</a>
									</div>
								</div>
							</div>
						</div>
					</header>


					<!-- Teaser / Excerpt (Standfirst) -->
					<?php if ( has_excerpt() ) : ?>
						<div class="font-sans text-lg sm:text-xl font-bold text-paijo-ink mb-6 leading-relaxed">
							<?php the_excerpt(); ?>
						</div>
					<?php endif; ?>

					<!-- Article Body -->
					<div class="paijo-prose text-paijo-ink leading-relaxed">
						<?php the_content(); ?>
						<?php
						wp_link_pages(
							array(
								'before' => '<div class="page-links mt-8 font-bold">',
								'after'  => '</div>',
							)
						);
						?>
					</div>

					<!-- Tags -->
					<footer class="mt-10 mb-12 border-t border-paijo-line pt-6 pb-6">
						<?php 
						$tags = get_the_tags();
						if ( $tags ) {
							echo '<div class="flex flex-col sm:flex-row sm:items-center gap-4">';
							echo '<span class="text-xs font-bold text-paijo-ink uppercase tracking-wider flex items-center gap-1.5 shrink-0">';
							echo '<svg class="w-4 h-4 text-[#f1818f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>';
							echo 'Tags:</span>';
							echo '<div class="flex flex-wrap gap-2.5">';
							foreach ( $tags as $tag ) {
								echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="relative group inline-block px-4 py-1.5 bg-[#f1818f] text-white text-[10px] sm:text-[11px] font-extrabold uppercase tracking-[0.1em] rounded-full shadow-sm hover:shadow-md hover:bg-[#e06d7b] transition-all duration-300 hover:-translate-y-0.5 overflow-hidden">';
								echo '<span class="relative z-10">' . esc_html( $tag->name ) . '</span>';
								// Underline animation
								echo '<span class="absolute bottom-[3px] left-4 right-4 h-[1.5px] bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>';
								echo '</a>';
							}
							echo '</div></div>';
						}
						?>
					</footer>
				</article>

				<!-- Mobile navigation (Previous/Next) -->
				<nav class="grid grid-cols-1 md:grid-cols-2 gap-4 border-t border-paijo-line mt-12 py-6 text-xs font-bold uppercase tracking-wider text-paijo-muted" aria-label="<?php esc_attr_e( 'Post navigation', 'paijo' ); ?>">
					<div><?php previous_post_link( '%link', esc_html__( '&larr; Previous: %title', 'paijo' ) ); ?></div>
					<div class="md:text-right"><?php next_post_link( '%link', esc_html__( 'Next: %title &rarr;', 'paijo' ) ); ?></div>
				</nav>

				<!-- Bottom Related Area -->
				<div class="mt-12">
					<?php get_template_part( 'template-parts/related-posts' ); ?>
				</div>

				<!-- JavaScript Interactions for Share/Engagement Toolbar -->
				<script>
				document.addEventListener('DOMContentLoaded', () => {
					// Like button behavior
					const likeBtn = document.getElementById('like-btn');
					const likeIcon = document.getElementById('like-icon');
					const likeCount = document.getElementById('like-count');
					let liked = false;
					
					if (likeBtn && likeIcon && likeCount) {
						likeBtn.addEventListener('click', () => {
							liked = !liked;
							if (liked) {
								likeIcon.classList.remove('fill-none');
								likeIcon.classList.add('fill-[#f1818f]', 'text-[#f1818f]');
								likeCount.innerText = '1';
								likeBtn.classList.add('text-[#f1818f]');
							} else {
								likeIcon.classList.remove('fill-[#f1818f]', 'text-[#f1818f]');
								likeIcon.classList.add('fill-none');
								likeCount.innerText = '0';
								likeBtn.classList.remove('text-[#f1818f]');
							}
						});
					}

					// Copy Link behavior
					const copyBtn = document.getElementById('copy-link-btn');
					const tooltip = document.getElementById('copy-tooltip');
					if (copyBtn && tooltip) {
						copyBtn.addEventListener('click', () => {
							navigator.clipboard.writeText(window.location.href).then(() => {
								tooltip.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
								tooltip.classList.add('opacity-100', 'scale-100');
								setTimeout(() => {
									tooltip.classList.remove('opacity-100', 'scale-100');
									tooltip.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
								}, 2000);
							}).catch(err => {
								console.error('Failed to copy text: ', err);
							});
						});
					}

					// More options behavior
					const moreBtn = document.getElementById('more-options-btn');
					const dropdown = document.getElementById('more-dropdown');
					if (moreBtn && dropdown) {
						moreBtn.addEventListener('click', (e) => {
							e.stopPropagation();
							const isHidden = dropdown.classList.contains('hidden');
							if (isHidden) {
								dropdown.classList.remove('hidden');
								setTimeout(() => {
									dropdown.classList.remove('opacity-0', 'scale-95');
									dropdown.classList.add('opacity-100', 'scale-100');
								}, 10);
							} else {
								dropdown.classList.remove('opacity-100', 'scale-100');
								dropdown.classList.add('opacity-0', 'scale-95');
								setTimeout(() => {
									dropdown.classList.add('hidden');
								}, 200);
							}
						});

						document.addEventListener('click', () => {
							if (!dropdown.classList.contains('hidden')) {
								dropdown.classList.remove('opacity-100', 'scale-100');
								dropdown.classList.add('opacity-0', 'scale-95');
								setTimeout(() => {
									dropdown.classList.add('hidden');
								}, 200);
							}
						});
					}

					// Web Share API
					const webShareBtn = document.getElementById('web-share-btn');
					if (webShareBtn) {
						webShareBtn.addEventListener('click', () => {
							if (navigator.share) {
								navigator.share({
									title: document.title,
									url: window.location.href
								}).catch(console.error);
							} else {
								alert('Web Share is not supported on this browser. Try copying the link!');
							}
						});
					}

					// Scroll to comments
					const commentBtn = document.getElementById('comment-btn');
					if (commentBtn) {
						commentBtn.addEventListener('click', () => {
							const relatedArea = document.querySelector('.mt-12');
							if (relatedArea) {
								relatedArea.scrollIntoView({ behavior: 'smooth' });
							}
						});
					}
				});
				</script>
			</div>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
