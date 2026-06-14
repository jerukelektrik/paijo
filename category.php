<?php
/**
 * Category archive template (Kumparan Topic Style - Centered List, No Sidebar).
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$cat_id       = get_queried_object_id();
$current_cat  = get_queried_object();
$paged        = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$total_posts  = $GLOBALS['wp_query']->found_posts;
?>

<main id="main-content" class="paijo-section bg-paijo-card text-paijo-ink transition-colors duration-300 min-h-screen">
	<div class="paijo-container max-w-3xl mx-auto">
		
		<!-- Breadcrumbs -->
		<nav class="flex items-center gap-2 text-[10px] sm:text-xs font-bold text-neutral-400 uppercase tracking-widest mb-6" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-paijo-accent transition-colors">Home</a>
			<span class="text-neutral-300" aria-hidden="true">/</span>
			<span class="text-neutral-400"><?php esc_html_e( 'Category', 'paijo' ); ?></span>
			<span class="text-neutral-300" aria-hidden="true">/</span>
			<span class="text-neutral-500"><?php echo esc_html( $current_cat->name ); ?></span>
		</nav>

		<!-- Kumparan Topic Header Section -->
		<div class="bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800/80 rounded-2xl p-6 sm:p-8 mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] transition-colors duration-300">
			<div class="flex items-start sm:items-center gap-5">
				<!-- Category Circle Icon -->
				<div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-[#f1818f]/10 dark:bg-[#f1818f]/20 flex items-center justify-center text-[#f1818f] font-sans font-black text-2xl sm:text-3xl shrink-0">
					<?php echo esc_html( strtoupper( substr( $current_cat->name, 0, 1 ) ) ); ?>
				</div>
				
				<div>
					<h1 class="text-2xl sm:text-3xl font-sans font-black text-paijo-ink leading-tight mb-2">
						<?php echo esc_html( $current_cat->name ); ?>
					</h1>
					<div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-paijo-muted font-bold uppercase tracking-wider">
						<span><?php echo esc_html( sprintf( _n( '%d Cerita', '%d Cerita', $total_posts, 'paijo' ), $total_posts ) ); ?></span>
						<?php if ( ! empty( $current_cat->description ) ) : ?>
							<span class="text-neutral-300" aria-hidden="true">•</span>
							<span class="normal-case font-medium text-paijo-muted max-w-md truncate inline-block"><?php echo esc_html( $current_cat->description ); ?></span>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<!-- Pill Interactive Follow Button -->
			<div class="shrink-0 self-start sm:self-auto">
				<button id="cat-follow-btn" class="px-6 py-2.5 rounded-full border border-[#f1818f] text-[#f1818f] hover:bg-[#f1818f] hover:text-white font-sans font-extrabold text-xs uppercase tracking-wider transition-all duration-300 cursor-pointer shadow-sm focus:outline-none" aria-pressed="false">
					<?php esc_html_e( 'Ikuti', 'paijo' ); ?>
				</button>
			</div>
		</div>

		<!-- Main Vertical Article List (Kumparan Style) -->
		<div class="bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800/80 rounded-2xl px-6 sm:px-8 shadow-[0_4px_20px_rgba(0,0,0,0.01)] transition-colors duration-300">
			<?php if ( have_posts() ) : ?>
				<div class="divide-y divide-neutral-100 dark:divide-neutral-800/60">
					<?php
					while ( have_posts() ) :
						the_post();
						$thumbnail = paijo_get_thumbnail_url( get_the_ID(), 'paijo-square' );
						$relative_date = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' yang lalu';
						$author_name = get_the_author();
						$author_id = get_the_author_meta( 'ID' );
						$is_verified = user_can( $author_id, 'manage_options' ); // Verify administrators/editors
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
					<?php endwhile; ?>
				</div>

				<!-- Custom Styled Pagination -->
				<?php
				$big        = 999999999;
				$pagination = paginate_links( array(
					'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'    => '?paged=%#%',
					'current'   => max( 1, $paged ),
					'total'     => $GLOBALS['wp_query']->max_num_pages,
					'prev_text' => '&larr; Prev',
					'next_text' => 'Next &rarr;',
					'type'      => 'array',
				) );

				if ( ! empty( $pagination ) ) :
					?>
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
				<?php endif; ?>

			<?php else : ?>
				<div class="py-12 text-center p-8 transition-colors duration-300">
					<p class="text-lg font-bold text-paijo-muted mb-4">
						<?php esc_html_e( 'Tidak ada cerita yang ditemukan untuk kategori ini.', 'paijo' ); ?>
					</p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block px-6 py-2.5 bg-[#f1818f] text-white font-bold rounded-full hover:bg-[#e06d7c] transition-colors shadow-sm">
						<?php esc_html_e( 'Kembali ke Beranda', 'paijo' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>

<!-- Interactive Follow Button micro-interaction Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
	const followBtn = document.getElementById('cat-follow-btn');
	const catId = '<?php echo esc_js( $cat_id ); ?>';
	const followKey = `paijo_cat_followed_${catId}`;

	if (!followBtn) {
		return;
	}

	// Read state
	let isFollowing = localStorage.getItem(followKey) === '1';

	function setFollowState(state) {
		isFollowing = state;
		if (isFollowing) {
			followBtn.setAttribute('aria-pressed', 'true');
			followBtn.textContent = 'Mengikuti';
			followBtn.classList.remove('text-[#f1818f]', 'border-[#f1818f]');
			followBtn.classList.add('bg-[#f1818f]', 'text-white', 'border-transparent');
		} else {
			followBtn.setAttribute('aria-pressed', 'false');
			followBtn.textContent = 'Ikuti';
			followBtn.classList.remove('bg-[#f1818f]', 'text-white', 'border-transparent');
			followBtn.classList.add('text-[#f1818f]', 'border-[#f1818f]');
		}
	}

	// Init
	setFollowState(isFollowing);

	// Toggle on click
	followBtn.addEventListener('click', function() {
		const nextState = !isFollowing;
		localStorage.setItem(followKey, nextState ? '1' : '0');
		setFollowState(nextState);
	});
});
</script>

<?php
get_footer();
