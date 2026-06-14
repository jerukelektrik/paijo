<?php
/**
 * Archive template for Toko Bercerita.
 *
 * @package Paijo
 */

get_header();

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
	'post_type'           => 'toko_bercerita',
	'post_status'         => 'publish',
	'paged'               => $paged,
	'posts_per_page'      => 9,
	'ignore_sticky_posts' => true,
);

$toko_query = new WP_Query( $args );
?>

<main id="main-content" class="paijo-section bg-paijo-card text-paijo-ink transition-colors duration-300">
	<div class="paijo-container">
		
		<!-- Breadcrumbs -->
		<nav class="flex items-center gap-2 text-[10px] sm:text-xs font-bold text-neutral-400 uppercase tracking-widest mb-4" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-paijo-accent transition-colors">Home</a>
			<span class="text-neutral-300" aria-hidden="true">/</span>
			<span class="text-neutral-500"><?php esc_html_e( 'Toko Bercerita', 'paijo' ); ?></span>
		</nav>

		<!-- Header Section -->
		<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-10 border-b border-neutral-100 dark:border-neutral-800/60 pb-8">
			<div class="max-w-3xl">
				<span class="inline-block paijo-category-capsule px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.15em] mb-3">
					Rubrik Video
				</span>
				<h1 class="text-3xl sm:text-4xl lg:text-5xl font-sans font-extrabold text-paijo-ink leading-tight"><?php esc_html_e( 'Toko Bercerita', 'paijo' ); ?></h1>
				<div class="mt-4 text-paijo-muted text-sm sm:text-base leading-relaxed"><?php esc_html_e( 'Cerita di balik kuliner legendaris, toko unik, dan bisnis kreatif di Jogja.', 'paijo' ); ?></div>
			</div>
		</div>

		<!-- Grid layout -->
		<?php if ( $toko_query->have_posts() ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
				<?php
				while ( $toko_query->have_posts() ) :
					$toko_query->the_post();
					$embed_url = get_post_meta( get_the_ID(), '_paijo_toko_embed_url', true );
					?>
					<div class="flex flex-col bg-white dark:bg-neutral-900 border border-paijo-line rounded-2xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
						<!-- Thumbnail Container -->
						<a href="<?php the_permalink(); ?>" class="group relative w-full h-[580px] bg-black overflow-hidden flex items-center justify-center">
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
									<span class="text-xs font-bold uppercase tracking-wider block"><?php esc_html_e( 'No Video Preview', 'paijo' ); ?></span>
								</div>
							<?php endif; ?>
							
							<!-- Play Overlay Button -->
							<div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
								<div class="w-16 h-16 rounded-full bg-black/60 backdrop-blur-sm flex items-center justify-center text-white scale-90 group-hover:scale-100 group-hover:bg-[#f1818f] transition-all duration-300 shadow-md">
									<!-- Play SVG Icon -->
									<svg class="w-6 h-6 fill-current translate-x-0.5" viewBox="0 0 24 24">
										<path d="M8 5v14l11-7z"/>
									</svg>
								</div>
							</div>
						</a>

						<!-- Title Area -->
						<div class="p-5 border-t border-paijo-line flex-1 flex flex-col justify-between">
							<h3 class="font-sans font-black text-base text-paijo-ink leading-snug hover:text-paijo-accent transition-colors line-clamp-2">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="flex items-center gap-2 mt-4 text-[10px] font-bold text-paijo-muted uppercase tracking-wider">
								<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
								<span>•</span>
								<a href="<?php the_permalink(); ?>" class="hover:text-paijo-accent transition-colors"><?php esc_html_e( 'Lihat Detail', 'paijo' ); ?> &rarr;</a>
							</div>
						</div>
					</div>
				<?php
				endwhile;
				?>
			</div>

			<!-- Pagination -->
			<?php
			$big        = 999999999;
			$pagination = paginate_links( array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, $paged ),
				'total'     => $toko_query->max_num_pages,
				'prev_text' => '&larr; Prev',
				'next_text' => 'Next &rarr;',
				'type'      => 'array',
			) );

			if ( ! empty( $pagination ) ) :
				?>
				<nav class="flex justify-center items-center gap-2 mt-12" aria-label="<?php esc_attr_e( 'Page navigation', 'paijo' ); ?>">
					<?php
					foreach ( $pagination as $page_link ) :
						if ( strpos( $page_link, 'current' ) !== false ) {
							$page_link = str_replace( "class='page-numbers current'", "class='px-4 py-2 rounded-lg bg-paijo-accent text-white font-extrabold shadow-sm'", $page_link );
						} else {
							$page_link = str_replace( "class='page-numbers'", "class='px-4 py-2 rounded-lg bg-paijo-card border border-neutral-200 dark:border-neutral-800 text-paijo-ink font-bold hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors'", $page_link );
							$page_link = str_replace( "class='prev page-numbers'", "class='px-4 py-2 rounded-lg bg-paijo-card border border-neutral-200 dark:border-neutral-800 text-paijo-ink font-bold hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors'", $page_link );
							$page_link = str_replace( "class='next page-numbers'", "class='px-4 py-2 rounded-lg bg-paijo-card border border-neutral-200 dark:border-neutral-800 text-paijo-ink font-bold hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors'", $page_link );
						}
						echo $page_link;
					endforeach;
					?>
				</nav>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>

		<?php else : ?>
			<div class="max-w-2xl mx-auto py-12 text-center">
				<p class="text-lg font-bold text-paijo-muted mb-4"><?php esc_html_e( 'Belum ada video Toko Bercerita.', 'paijo' ); ?></p>
			</div>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
