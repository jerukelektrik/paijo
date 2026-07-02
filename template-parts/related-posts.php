<?php
/**
 * Related posts.
 *
 * @package Paijo
 */

$post_type       = get_post_type();
$post_id         = get_the_ID();
$is_paijo_content = ( 'paijo_content' === $post_type );

if ( $is_paijo_content ) {
	// Get the paijo_content_category terms for this post.
	$terms = wp_get_post_terms( $post_id, 'paijo_content_category', array( 'fields' => 'ids' ) );
	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return;
	}
	$args = array(
		'post_type'           => 'paijo_content',
		'post_status'         => 'publish',
		'posts_per_page'      => 3,
		'post__not_in'        => array( $post_id ),
		'tax_query'           => array(
			array(
				'taxonomy' => 'paijo_content_category',
				'field'    => 'term_id',
				'terms'    => $terms,
			),
		),
		'ignore_sticky_posts' => true,
	);
} else {
	$category_ids = wp_get_post_categories( $post_id, array( 'fields' => 'ids' ) );
	if ( empty( $category_ids ) ) {
		return;
	}
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 3,
		'post__not_in'        => array( $post_id ),
		'category__in'        => $category_ids,
		'ignore_sticky_posts' => true,
	);
}

$related = new WP_Query( $args );

if ( ! $related->have_posts() ) {
	return;
}
?>

<section class="mt-6 sm:mt-14 border-t border-paijo-line pt-6 sm:pt-8">
	<div class="mb-6">
		<h2 class="text-xl font-extrabold text-paijo-ink font-sans uppercase tracking-wider"><?php esc_html_e( 'Related Stories', 'paijo' ); ?></h2>
	</div>
	<div class="space-y-4">
		<?php
		while ( $related->have_posts() ) :
			$related->the_post();
			$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
			?>
			<div class="flex items-start sm:items-center justify-between gap-3 sm:gap-4 p-3 sm:p-5 rounded-xl bg-[#F8F9FA] dark:bg-neutral-900 border border-transparent hover:bg-[#F1F3F5] dark:hover:bg-neutral-800/80 transition-all duration-200">
				<!-- Left content -->
				<div class="flex-1 min-w-0">
					<!-- Title -->
					<h3 class="font-sans font-extrabold text-sm sm:text-base text-paijo-ink leading-snug <?php echo $is_paijo_content ? 'mb-1' : 'mb-2 sm:mb-3'; ?> line-clamp-2">
						<a href="<?php the_permalink(); ?>" class="hover:text-paijo-accent transition-colors duration-200">
							<?php the_title(); ?>
						</a>
					</h3>
					
					<?php if ( ! $is_paijo_content ) : ?>
					<!-- Author & Meta -->
					<div class="flex items-center flex-wrap gap-1.5 sm:gap-2 text-[10px] sm:text-xs text-paijo-muted">
						<!-- Author Avatar -->
						<img class="w-4 h-4 sm:w-5 sm:h-5 rounded-full object-cover bg-neutral-200 border border-paijo-line" src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ), 40 ) ); ?>" alt="<?php echo esc_attr( get_the_author() ); ?>">
						
						<!-- Author Name -->
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="font-bold text-paijo-ink hover:text-paijo-accent transition-colors line-clamp-1 max-w-[80px] sm:max-w-none">
							<?php echo esc_html( get_the_author() ); ?>
						</a>

						<!-- Verified Check icon (Blue circular checkmark) -->
						<span class="inline-flex items-center shrink-0" title="Verified Creator">
							<svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" viewBox="0 0 24 24" fill="none">
								<circle cx="12" cy="12" r="10" fill="#00A3A3"/>
								<path d="M8 12l3 3 5-5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</span>

						<span class="text-neutral-300 dark:text-neutral-700 hidden sm:inline-block" aria-hidden="true">·</span>

						<!-- Time relative -->
						<span class="text-[10px] sm:text-xs shrink-0 w-full sm:w-auto mt-0.5 sm:mt-0">
							<?php
							$time_diff = current_time( 'timestamp' ) - get_the_time( 'U' );
							if ( $time_diff < DAY_IN_SECONDS ) {
								echo esc_html( sprintf( __( '%s yang lalu', 'paijo' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ) );
							} else {
								echo esc_html( get_the_date() );
							}
							?>
						</span>
					</div>
					<?php else : ?>
					<!-- Simple date for paijo_content related -->
					<span class="text-[10px] sm:text-xs text-paijo-muted">
						<?php echo esc_html( get_the_date() ); ?>
					</span>
					<?php endif; ?>
				</div>

				<!-- Right Thumbnail -->
				<?php if ( $thumb_url ) : ?>
					<a href="<?php the_permalink(); ?>" class="flex-shrink-0 block w-20 h-20 sm:w-24 sm:h-24 overflow-hidden rounded-xl border border-paijo-line/30 hover:scale-[1.02] transition-transform duration-200">
						<img class="w-full h-full object-cover" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
					</a>
				<?php endif; ?>
			</div>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>

