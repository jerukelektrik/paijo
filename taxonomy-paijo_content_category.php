<?php
/**
 * Custom taxonomy archive template for paijo_content_category.
 * Kumparan style: Constrained Hero Header + Centered list with sorting controls precisely above the list.
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$term_id      = get_queried_object_id();
$current_term = get_queried_object();
$orderby      = isset( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : 'date';
$paged        = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

// Base query arguments constrained strictly to the current term in custom taxonomy
$args = array(
	'post_type'           => 'paijo_content',
	'post_status'         => 'publish',
	'paged'               => $paged,
	'posts_per_page'      => 9,
	'ignore_sticky_posts' => true,
	'tax_query'           => array(
		array(
			'taxonomy' => 'paijo_content_category',
			'field'    => 'term_id',
			'terms'    => $term_id,
		),
	),
);

// Order by Terbaru vs Terpopuler
if ( 'popular' === $orderby ) {
	$args['orderby'] = 'comment_count';
	$args['order']   = 'DESC';
} else {
	$args['orderby'] = 'date';
	$args['order']   = 'DESC';
}

$term_query = new WP_Query( $args );
?>

<main id="main-content" class="paijo-section bg-paijo-card text-paijo-ink transition-colors duration-300 min-h-screen">
	<div class="paijo-container max-w-3xl mx-auto">
		
		<!-- Breadcrumbs -->
		<nav class="flex items-center gap-2 text-[10px] sm:text-xs font-bold text-neutral-400 uppercase tracking-widest mb-4" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-paijo-accent transition-colors">Home</a>
			<span class="text-neutral-300" aria-hidden="true">/</span>
			<span class="text-neutral-500"><?php echo esc_html( $current_term->name ); ?></span>
		</nav>

		<!-- Header Section (Without Sort Icons) -->
		<div class="w-full mb-8 border-b border-neutral-100 dark:border-neutral-800/60 pb-8">
			<span class="inline-block bg-[#f1818f] text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.15em] mb-3">
				<?php esc_html_e( 'Kategori Konten', 'paijo' ); ?>
			</span>
			<h1 class="text-3xl sm:text-4xl lg:text-5xl font-sans font-extrabold text-paijo-ink leading-tight mb-3"><?php echo esc_html( $current_term->name ); ?></h1>
			<?php if ( ! empty( $current_term->description ) ) : ?>
				<div class="text-paijo-muted text-sm sm:text-base leading-relaxed"><?php echo esc_html( $current_term->description ); ?></div>
			<?php endif; ?>
		</div>

		<?php if ( $term_query->have_posts() ) : ?>
			
			<?php
			$post_count = 0;
			$has_list   = false;
			?>

			<!-- Main Posts Loop -->
			<?php while ( $term_query->have_posts() ) : $term_query->the_post(); $post_count++; ?>
				
				<?php if ( 1 === $paged && 1 === $post_count ) : ?>
					<!-- 1. Constrained Hero Header (First Post, Page 1 Only - Aligned to max-w-3xl) -->
					<?php 
					$hero_thumb = paijo_get_thumbnail_url( get_the_ID(), 'paijo-hero' ); 
					$author_name = get_the_author();
					$reading_time = paijo_get_reading_time();
					$excerpt = paijo_get_card_excerpt( get_the_ID(), 28 );
					?>
					<div class="relative w-full aspect-[16/10] bg-paijo-ink rounded-3xl overflow-hidden mb-10 group shadow-lg transition-all duration-300">
						<!-- Background Image -->
						<?php if ( $hero_thumb ) : ?>
							<img class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-[1.02]" src="<?php echo esc_url( $hero_thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
						<?php endif; ?>
						
						<!-- Dark Gradient Overlay -->
						<div class="absolute inset-0 bg-gradient-to-t from-[#050b14] via-[#050b14]/55 to-[#050b14]/15 z-0"></div>

						<!-- Content Overlay -->
						<div class="relative z-10 h-full flex flex-col justify-end p-6 sm:p-10">
							<div class="w-full">
								<!-- Category Badge -->
								<span class="inline-block bg-[#f1818f] text-white text-[9px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider mb-3">
									<?php echo esc_html( $current_term->name ); ?>
								</span>
								
								<!-- Title -->
								<h2 class="text-xl sm:text-2xl md:text-3xl font-sans font-black text-white leading-tight tracking-tight mb-3 hover:text-[#f1818f] transition-colors">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>

								<!-- Excerpt -->
								<?php if ( $excerpt ) : ?>
									<p class="hidden sm:block text-xs sm:text-sm text-neutral-200 line-clamp-2 leading-relaxed mb-4">
										<?php echo esc_html( $excerpt ); ?>
									</p>
								<?php endif; ?>

								<!-- Meta Row -->
								<div class="flex items-center gap-3 text-[10px] sm:text-xs text-neutral-300 font-semibold mb-4">
									<!-- Author Avatar -->
									<img class="w-6 h-6 rounded-full object-cover bg-neutral-200/20 border border-white/20" src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ), 60 ) ); ?>" alt="<?php echo esc_attr( $author_name ); ?>">
									
									<span class="text-white"><?php echo esc_html( $author_name ); ?></span>
									<span class="text-neutral-400" aria-hidden="true">•</span>
									<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
									<span class="text-neutral-400" aria-hidden="true">•</span>
									<span><?php echo esc_html( $reading_time ); ?></span>
								</div>

								<!-- Button -->
								<a href="<?php the_permalink(); ?>" class="inline-block bg-white text-neutral-900 hover:bg-[#f1818f] hover:text-white px-5 py-2.5 rounded-full font-black uppercase text-[10px] tracking-wider transition-colors duration-200 shadow-sm">
									<?php esc_html_e( 'Baca Artikel', 'paijo' ); ?>
								</a>
							</div>
						</div>
					</div>

				<?php else : ?>
					
					<?php
					// Open the list wrapper if not already opened
					if ( ! $has_list ) {
						?>
						<!-- List Header with Sort Controls -->
						<div class="w-full flex items-center justify-between mb-4 mt-8">
							<h3 class="text-xs font-black uppercase tracking-wider text-paijo-ink">
								<?php esc_html_e( 'Daftar Artikel', 'paijo' ); ?>
							</h3>
							
							<!-- Sort Icons Selector -->
							<div class="flex items-center gap-2">
								<!-- Sort by Terbaru (Newest) -->
								<a href="<?php echo esc_url( add_query_arg( 'orderby', 'date', get_term_link( $term_id, 'paijo_content_category' ) ) ); ?>" 
								   class="flex items-center justify-center w-8 h-8 rounded-lg transition-all duration-200 <?php echo 'date' === $orderby ? 'bg-[#f1818f] text-white shadow-sm border border-transparent' : 'bg-white dark:bg-neutral-900 text-black dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 hover:text-black dark:hover:text-white border border-neutral-200 dark:border-neutral-800'; ?>" 
								   title="Terbaru">
									<!-- Clock Icon -->
									<svg class="w-4 h-4 stroke-current fill-none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<circle cx="12" cy="12" r="10"></circle>
										<polyline points="12 6 12 12 16 14"></polyline>
									</svg>
								</a>

								<!-- Sort by Terpopuler (Most Popular) -->
								<a href="<?php echo esc_url( add_query_arg( 'orderby', 'popular', get_term_link( $term_id, 'paijo_content_category' ) ) ); ?>" 
								   class="flex items-center justify-center w-8 h-8 rounded-lg transition-all duration-200 <?php echo 'popular' === $orderby ? 'bg-[#f1818f] text-white shadow-sm border border-transparent' : 'bg-white dark:bg-neutral-900 text-black dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 hover:text-black dark:hover:text-white border border-neutral-200 dark:border-neutral-800'; ?>" 
								   title="Terpopuler">
									<!-- Flame Icon -->
									<svg class="w-4 h-4 stroke-current fill-none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"></path>
									</svg>
								</a>
							</div>
						</div>
						<?php
						
						echo '<div class="w-full bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800/80 rounded-2xl px-6 sm:px-8 shadow-[0_4px_20px_rgba(0,0,0,0.01)] transition-colors duration-300">';
						echo '<div class="divide-y divide-neutral-100 dark:divide-neutral-800/60">';
						$has_list = true;
					}

					// Render List Row
					$thumbnail = paijo_get_thumbnail_url( get_the_ID(), 'paijo-square' );
					$relative_date = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' yang lalu';
					$author_name = get_the_author();
					$author_id = get_the_author_meta( 'ID' );
					$is_verified = user_can( $author_id, 'manage_options' );
					?>
					<article class="flex gap-4 sm:gap-6 py-5 sm:py-6 items-center justify-between group">
						<div class="flex-1 min-w-0">
							<!-- Title -->
							<h2 class="text-sm sm:text-base font-sans font-extrabold leading-snug tracking-tight mb-2.5 text-paijo-ink hover:text-[#f1818f] transition-colors duration-200">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>

							<!-- Brand & Meta Info -->
							<div class="flex flex-col gap-1.5">
								<!-- Verified Brand label -->
								<div class="flex items-center gap-1.5 text-xs text-neutral-800 dark:text-neutral-200 font-bold">
									<span class="w-4.5 h-4.5 rounded-full bg-[#f1818f]/10 dark:bg-[#f1818f]/20 text-[#f1818f] text-[9px] flex items-center justify-center font-black">
										<?php echo esc_html( strtoupper( substr( $author_name, 0, 1 ) ) ); ?>
									</span>
									<span class="hover:text-[#f1818f] transition-colors"><?php echo esc_html( $author_name ); ?></span>
									<?php if ( $is_verified ) : ?>
										<!-- Verified Checkmark Icon -->
										<svg class="w-3.5 h-3.5 text-[#00A3A3] dark:text-[#00B5B5] fill-current" viewBox="0 0 24 24">
											<path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
										</svg>
									<?php endif; ?>
								</div>
								
								<!-- Relative Publication Date -->
								<span class="text-[10px] sm:text-xs text-neutral-400 dark:text-neutral-500 font-medium">
									<?php echo esc_html( $relative_date ); ?>
								</span>
							</div>
						</div>

						<!-- Right Side Image Thumbnail -->
						<?php if ( $thumbnail ) : ?>
							<a href="<?php the_permalink(); ?>" class="block w-16 h-16 sm:w-20 sm:h-20 shrink-0 overflow-hidden rounded-xl border border-neutral-100 dark:border-neutral-800/80 bg-neutral-50 dark:bg-neutral-900 transition-colors duration-300">
								<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
							</a>
						<?php endif; ?>
					</article>
				<?php endif; ?>

			<?php endwhile; ?>

			<?php
			// Close list wrappers if they were opened
			if ( $has_list ) {
				echo '</div>'; // divide-y
				echo '</div>'; // bg-white
			}
			?>

			<!-- Custom Styled Pagination -->
			<?php
			$big        = 999999999;
			$pagination = paginate_links( array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, $paged ),
				'total'     => $term_query->max_num_pages,
				'prev_text' => '&larr; Prev',
				'next_text' => 'Next &rarr;',
				'type'      => 'array',
			) );

			if ( ! empty( $pagination ) ) :
				?>
				<div class="w-full mt-8">
					<nav class="flex justify-center items-center gap-2 py-6 border-t border-neutral-100 dark:border-neutral-800/60" aria-label="<?php esc_attr_e( 'Page navigation', 'paijo' ); ?>">
						<?php
						foreach ( $pagination as $page_link ) :
							if ( strpos( $page_link, 'current' ) !== false ) {
								$page_link = str_replace( "class='page-numbers current'", "class='px-4 py-2 rounded-lg bg-paijo-accent text-white font-extrabold shadow-sm'", $page_link );
							} else {
								$page_link = str_replace( "class='page-numbers'", "class='px-4 py-2 rounded-lg bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-paijo-ink font-bold hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors'", $page_link );
								$page_link = str_replace( "class='prev page-numbers'", "class='px-4 py-2 rounded-lg bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-paijo-ink font-bold hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors'", $page_link );
								$page_link = str_replace( "class='next page-numbers'", "class='px-4 py-2 rounded-lg bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-paijo-ink font-bold hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors'", $page_link );
							}
							echo $page_link;
						endforeach;
						?>
					</nav>
				</div>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>

		<?php else : ?>
			<div class="w-full py-12 text-center bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800/80 rounded-2xl p-8 transition-colors duration-300">
				<p class="text-lg font-bold text-paijo-muted mb-4"><?php esc_html_e( 'Tidak ada artikel yang ditemukan dalam kategori ini.', 'paijo' ); ?></p>
				<a href="<?php echo esc_url( get_term_link( $term_id, 'paijo_content_category' ) ); ?>" class="inline-block px-5 py-2.5 bg-paijo-accent text-white font-extrabold rounded-full hover:bg-neutral-900 transition-colors">
					Lihat Semua Artikel
				</a>
			</div>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
