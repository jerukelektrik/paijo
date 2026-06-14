<?php
/**
 * Category archive template.
 *
 * @package Paijo
 */

get_header();

$cat_id       = get_queried_object_id();
$current_cat  = get_queried_object();
$orderby      = isset( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : 'date';
$paged        = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

// Base query arguments constrained strictly to the current category
$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'cat'                 => $cat_id,
	'paged'               => $paged,
	'posts_per_page'      => 9,
	'ignore_sticky_posts' => true,
);

// Order by Terbaru vs Terpopuler
if ( 'popular' === $orderby ) {
	$args['orderby'] = 'comment_count';
	$args['order']   = 'DESC';
} else {
	$args['orderby'] = 'date';
	$args['order']   = 'DESC';
}

$cat_query = new WP_Query( $args );
?>

<main id="main-content" class="paijo-section bg-paijo-card text-paijo-ink transition-colors duration-300">
	<div class="paijo-container">
		
		<!-- Breadcrumbs -->
		<nav class="flex items-center gap-2 text-[10px] sm:text-xs font-bold text-neutral-400 uppercase tracking-widest mb-4" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-paijo-accent transition-colors">Home</a>
			<span class="text-neutral-300" aria-hidden="true">/</span>
			<span class="text-neutral-500"><?php echo esc_html( $current_cat->name ); ?></span>
		</nav>

		<!-- Header Section with Sort Icons -->
		<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-10 border-b border-neutral-100 dark:border-neutral-800/60 pb-8">
			<div class="max-w-3xl">
				<span class="inline-block paijo-category-capsule px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.15em] mb-3">
					Kategori
				</span>
				<h1 class="text-3xl sm:text-4xl lg:text-5xl font-sans font-extrabold text-paijo-ink leading-tight"><?php echo esc_html( $current_cat->name ); ?></h1>
				<?php if ( ! empty( $current_cat->description ) ) : ?>
					<div class="mt-4 text-paijo-muted text-sm sm:text-base leading-relaxed"><?php echo esc_html( $current_cat->description ); ?></div>
				<?php endif; ?>
			</div>

			<!-- Sort Icons Selector -->
			<div class="flex items-center gap-2 self-start sm:self-auto">
				<!-- Sort by Terbaru (Newest) -->
				<a href="<?php echo esc_url( add_query_arg( 'orderby', 'date', get_category_link( $cat_id ) ) ); ?>" 
				   class="flex items-center justify-center w-10 h-10 rounded-lg transition-all duration-200 <?php echo 'date' === $orderby ? 'bg-[#f1818f] text-white shadow-sm border border-transparent' : 'bg-[#F8F9FA] dark:bg-neutral-900 text-black dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 hover:text-black dark:hover:text-white border border-transparent'; ?>" 
				   title="Terbaru">
					<!-- Clock Icon -->
					<svg class="w-5 h-5 stroke-current fill-none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="12" cy="12" r="10"></circle>
						<polyline points="12 6 12 12 16 14"></polyline>
					</svg>
				</a>

				<!-- Sort by Terpopuler (Most Popular) -->
				<a href="<?php echo esc_url( add_query_arg( 'orderby', 'popular', get_category_link( $cat_id ) ) ); ?>" 
				   class="flex items-center justify-center w-10 h-10 rounded-lg transition-all duration-200 <?php echo 'popular' === $orderby ? 'bg-[#f1818f] text-white shadow-sm border border-transparent' : 'bg-[#F8F9FA] dark:bg-neutral-900 text-black dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 hover:text-black dark:hover:text-white border border-transparent'; ?>" 
				   title="Terpopuler">
					<!-- Flame Icon -->
					<svg class="w-5 h-5 stroke-current fill-none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"></path>
					</svg>
				</a>
			</div>
		</div>

		<!-- Posts Grid -->
		<?php if ( $cat_query->have_posts() ) : ?>
			<div class="paijo-grid paijo-grid-archive">
				<?php
				while ( $cat_query->have_posts() ) :
					$cat_query->the_post();
					get_template_part( 'template-parts/cards/article-card' );
				endwhile;
				?>
			</div>

			<!-- Custom Styled Pagination -->
			<?php
			$big        = 999999999;
			$pagination = paginate_links( array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, $paged ),
				'total'     => $cat_query->max_num_pages,
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
				<p class="text-lg font-bold text-paijo-muted mb-4"><?php esc_html_e( 'Tidak ada artikel yang ditemukan dalam kategori ini.', 'paijo' ); ?></p>
				<a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>" class="inline-block px-5 py-2.5 bg-paijo-accent text-white font-extrabold rounded-full hover:bg-neutral-900 transition-colors">
					Lihat Semua Artikel
				</a>
			</div>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
