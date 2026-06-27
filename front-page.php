<?php
/**
 * Front page template.
 *
 * @package Paijo
 */

get_header();

$hero_query = paijo_get_home_hero_query();
$hero_ids   = paijo_post_ids_from_query( $hero_query );
?>

<main id="main-content">
	<?php if ( $hero_query->have_posts() ) : ?>
		<section class="relative w-full overflow-hidden bg-paijo-ink h-screen" data-paijo-slider>
			<!-- Slides Wrapper -->
			<div class="flex w-full h-full transition-transform duration-700 ease-in-out" data-paijo-slider-wrapper style="transform: translateX(0%);">
				<?php
				while ( $hero_query->have_posts() ) :
					$hero_query->the_post();
					$thumbnail = paijo_get_thumbnail_url( get_the_ID(), 'paijo-hero' );
					?>
					<div class="w-full h-full flex-shrink-0 relative" data-paijo-slide>
						<?php if ( $thumbnail ) : ?>
							<img class="absolute inset-0 h-full w-full object-cover" src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
							<div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/35 to-black/20"></div>
							<!-- Fade overlay at the bottom to blend with grid section -->
							<div class="absolute inset-x-0 bottom-0 h-1/4 pointer-events-none z-10" style="background: linear-gradient(to bottom, transparent, var(--color-paijo-paper));"></div>
						<?php else : ?>
							<div class="absolute inset-0 bg-paijo-ink"></div>
						<?php endif; ?>

						<div class="relative z-10 h-full paijo-container flex flex-col justify-end pt-28 pb-24 sm:pb-32">
							<div class="flex flex-col md:flex-row md:items-end md:justify-between gap-8">
								<div class="max-w-3xl">
									<span class="paijo-eyebrow text-white mb-3 inline-block"><?php echo esc_html( paijo_get_category_label() ); ?></span>
									<h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight">
										<a class="hover:text-white/85 transition-colors" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									<p class="mt-4 text-sm sm:text-base leading-7 text-white/80 line-clamp-2">
										<?php echo esc_html( paijo_get_card_excerpt( get_the_ID(), 22 ) ); ?>
									</p>
									<div class="mt-4 flex items-center gap-4 text-xs font-bold uppercase tracking-[0.12em] text-white/60">
										<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
										<span aria-hidden="true">•</span>
										<span><?php echo esc_html( paijo_get_reading_time() ); ?></span>
									</div>
								</div>
								<div class="flex-shrink-0">
									<a href="<?php the_permalink(); ?>" class="paijo-button bg-white text-[#111111] hover:bg-paijo-accent hover:text-white transition-all duration-200 px-6 py-3 text-sm font-black uppercase tracking-[0.1em]">
										<?php esc_html_e( 'Read Article', 'paijo' ); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

			<!-- Navigation Controls -->
			<?php if ( $hero_query->post_count > 1 ) : ?>
				<button class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 z-20 flex h-12 w-12 items-center justify-center rounded-full border border-white/20 bg-black/25 text-white hover:bg-paijo-accent hover:border-paijo-accent transition duration-200 focus:outline-none cursor-pointer" type="button" data-paijo-slider-prev aria-label="<?php esc_attr_e( 'Previous slide', 'paijo' ); ?>">
					<svg class="h-6 w-6 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<polyline points="15 18 9 12 15 6"></polyline>
					</svg>
				</button>
				<button class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 z-20 flex h-12 w-12 items-center justify-center rounded-full border border-white/20 bg-black/25 text-white hover:bg-paijo-accent hover:border-paijo-accent transition duration-200 focus:outline-none cursor-pointer" type="button" data-paijo-slider-next aria-label="<?php esc_attr_e( 'Next slide', 'paijo' ); ?>">
					<svg class="h-6 w-6 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<polyline points="9 18 15 12 9 6"></polyline>
					</svg>
				</button>

				<!-- Indicators/Dots -->
				<div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2" data-paijo-slider-dots>
					<?php for ( $i = 0; $i < $hero_query->post_count; $i++ ) : ?>
						<button class="h-2 rounded-full transition-all duration-300 cursor-pointer focus:outline-none <?php echo 0 === $i ? 'w-8 bg-white' : 'w-3 bg-white/40'; ?>" type="button" data-paijo-slider-dot="<?php echo $i; ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Go to slide %d', 'paijo' ), $i + 1 ) ); ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"></button>
					<?php endfor; ?>
				</div>
			<?php endif; ?>
		</section>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<section class="paijo-section pt-8">
			<div class="paijo-container">
				<?php get_template_part( 'template-parts/cards/text-card', null, array( 'title' => __( 'Paijo is ready', 'paijo' ), 'body' => __( 'Publish your first posts to populate the editorial homepage.', 'paijo' ) ) ); ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- Category Entry Points Section -->
	<?php
	$featured_content_categories = paijo_get_featured_content_category_terms();
	$featured_content_categories = array_values(
		array_filter(
			$featured_content_categories,
			static function ( $category ) {
				return in_array(
					$category->slug,
					array(
						'kultur-by-pandangan-jogja',
						'skena-jogsel',
						'derby-istimewa',
						'kuliner-berbintang',
					),
					true
				);
			}
		)
	);
	$featured_content_categories = array_slice( $featured_content_categories, 0, 4 );
	if ( ! empty( $featured_content_categories ) ) :
	?>
		<section class="paijo-section border-b border-paijo-line bg-paijo-paper relative overflow-hidden">
			<!-- Dark Overlay for subtle background shadow effect -->
			<div class="absolute right-0 bottom-0 w-[500px] h-[210px] sm:w-[650px] sm:h-[270px] lg:w-[800px] lg:h-[333px] bg-contain bg-right-bottom bg-no-repeat z-0 pointer-events-none watercolor-bg-layer" style="background-image: url('<?php echo esc_url( PAIJO_URI . '/assets/images/watercolor.png?ver=' . paijo_asset_version( 'assets/images/watercolor.png' ) ); ?>');"></div>
			<div class="paijo-container relative z-10">
			<div class="relative inset-0 bg-black/85 z-0 pointer-events-none"></div>
			
			<div class="paijo-container text-center relative z-10">
				<h2 class="text-3xl sm:text-5xl font-sans font-black tracking-tight mb-3"><?php esc_html_e( 'Baca Artikel Khas', 'paijo' ); ?></h2>
				<p class="text-sm sm:text-base text-neutral-400 max-w-2xl mx-auto mb-12"><?php esc_html_e( 'Beragam cerita, menggerakkan ekosistem', 'paijo' ); ?></p>
				
				<!-- Category Entry Points (Baca Artikel Khas) -->
				<div class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-8 sm:gap-8">

					<?php
					foreach ( $featured_content_categories as $category ) :
						$latest_post = paijo_get_latest_content_for_category( (int) $category->term_id );
						$img_url = '';
						if ( $latest_post instanceof WP_Post ) {
							$img_url = paijo_get_thumbnail_url( (int) $latest_post->ID, 'paijo-card' );
						}
						$category_label = 'kultur-by-pandangan-jogja' === $category->slug ? __( 'Kultur', 'paijo' ) : $category->name;
						?>
							<a class="group relative block aspect-[3/4] overflow-hidden bg-neutral-900 w-full" href="<?php echo esc_url( get_term_link( $category ) ); ?>">
								<span class="sr-only"><?php echo esc_html( $category_label ); ?></span>
								
								<!-- Category Image -->
								<span class="absolute inset-0 block">
									<?php if ( $img_url ) : ?>
										<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>">
									<?php else : ?>
										<span class="w-full h-full flex items-center justify-center bg-neutral-800 text-neutral-500 font-black text-4xl uppercase tracking-[0.2em]">
											<?php echo esc_html( mb_substr( $category_label, 0, 1 ) ); ?>
										</span>
									<?php endif; ?>
								</span>
								<span class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></span>
								
								<!-- Category Title -->
								<span class="absolute inset-x-0 bottom-0 z-10 block p-3 sm:p-6 text-left">
									<span class="block text-base sm:text-2xl font-sans font-black leading-tight tracking-tight text-white transition-colors group-hover:text-white/85">
										<?php echo esc_html( $category_label ); ?>
									</span>
								</span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	$content_showcase_query = paijo_get_latest_query( $hero_ids, 7 );
	if ( $content_showcase_query->have_posts() ) :
		$content_showcase_posts = $content_showcase_query->posts;
		$showcase_featured      = $content_showcase_posts[0];
		$showcase_grid_posts    = array_slice( $content_showcase_posts, 1, 6 );
		$featured_image         = paijo_get_thumbnail_url( (int) $showcase_featured->ID, 'paijo-hero' );
		?>
		<section class="paijo-section bg-paijo-paper text-paijo-ink border-b border-paijo-line">
			<div class="paijo-container">
				<div class="mb-12 text-center">
					<h2 class="text-3xl sm:text-5xl font-sans font-black tracking-tight"><?php esc_html_e( 'Terus Update', 'paijo' ); ?></h2>
					<p class="mt-3 text-sm sm:text-base text-paijo-muted max-w-2xl mx-auto"><?php esc_html_e( 'Apa yang Terjadi di Jogja Hari Ini?', 'paijo' ); ?></p>
				</div>

				<div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-stretch">
					<a class="group relative min-h-[420px] overflow-hidden bg-paijo-ink text-white sm:min-h-[560px] lg:h-full" href="<?php echo esc_url( get_permalink( $showcase_featured ) ); ?>">
						<?php if ( $featured_image ) : ?>
							<img class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( get_the_title( $showcase_featured ) ); ?>">
						<?php else : ?>
							<div class="absolute inset-0 bg-neutral-900"></div>
						<?php endif; ?>
						<div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
						<div class="absolute inset-x-0 bottom-0 z-10 p-6 sm:p-10">
							<p class="paijo-eyebrow mb-3 text-white/80"><?php echo esc_html( paijo_get_category_label( (int) $showcase_featured->ID ) ); ?></p>
							<h3 class="max-w-xl text-3xl sm:text-5xl font-serif font-medium leading-tight text-white"><?php echo esc_html( get_the_title( $showcase_featured ) ); ?></h3>
							<p class="mt-4 max-w-xl text-sm sm:text-base leading-7 text-white/75 line-clamp-2">
								<?php echo esc_html( paijo_get_card_excerpt( (int) $showcase_featured->ID, 24 ) ); ?>
							</p>
							<span class="mt-6 inline-flex border border-white/40 px-7 py-3 text-xs font-black uppercase tracking-[0.14em] text-white transition-colors group-hover:bg-white group-hover:text-black">
								<?php esc_html_e( 'Baca Sekarang', 'paijo' ); ?>
							</span>
						</div>
					</a>

						<div class="flex gap-5 overflow-x-auto pb-2 snap-x snap-mandatory lg:grid lg:grid-cols-2 xl:grid-cols-3 lg:overflow-visible lg:pb-0">
							<?php foreach ( $showcase_grid_posts as $showcase_post ) : ?>
							<?php
							$card_image = paijo_get_thumbnail_url( (int) $showcase_post->ID, 'paijo-square' );
							?>
								<article class="group min-w-[38%] snap-start sm:min-w-[30%] lg:min-w-0">
								<a class="block overflow-hidden bg-neutral-200 aspect-square" href="<?php echo esc_url( get_permalink( $showcase_post ) ); ?>">
									<?php if ( $card_image ) : ?>
										<img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" src="<?php echo esc_url( $card_image ); ?>" alt="<?php echo esc_attr( get_the_title( $showcase_post ) ); ?>">
									<?php else : ?>
										<div class="flex h-full w-full items-center justify-center bg-neutral-200 text-neutral-400 text-3xl font-black uppercase">
											<?php echo esc_html( mb_substr( get_the_title( $showcase_post ), 0, 1 ) ); ?>
										</div>
									<?php endif; ?>
								</a>
								<div class="pt-4">
									<p class="mb-2 text-[10px] font-black uppercase tracking-[0.16em] text-paijo-accent"><?php echo esc_html( paijo_get_category_label( (int) $showcase_post->ID ) ); ?></p>
									<h3 class="text-base font-serif font-bold leading-snug text-paijo-ink">
										<a class="hover:text-paijo-accent" href="<?php echo esc_url( get_permalink( $showcase_post ) ); ?>"><?php echo esc_html( get_the_title( $showcase_post ) ); ?></a>
									</h3>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<!-- Insight Category Showcase Section -->
	<?php
	$insight_term = get_category_by_slug( 'insight' );
	if ( $insight_term && ! is_wp_error( $insight_term ) ) :
		$insight_query = new WP_Query(
			array(
				'post_type'           => 'post',
				'post_status'         => 'publish',
				'posts_per_page'      => 3,
				'ignore_sticky_posts' => true,
				'cat'                 => $insight_term->term_id,
			)
		);

		if ( $insight_query->have_posts() ) :
			$insight_posts        = $insight_query->posts;
			$insight_featured_img = paijo_get_thumbnail_url( (int) $insight_posts[0]->ID, 'paijo-hero' );
			$insight_term_link    = get_category_link( $insight_term );
			?>
			<section class="border-b border-paijo-line bg-paijo-card">
				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 overflow-hidden">
					
					<!-- Column 1: Category Gateway Card -->
					<a class="group relative bg-[#050b14] text-white aspect-square w-full overflow-hidden flex flex-col justify-between p-6 sm:p-8" href="<?php echo esc_url( $insight_term_link ); ?>">
						<?php if ( $insight_featured_img ) : ?>
							<img class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-30" src="<?php echo esc_url( $insight_featured_img ); ?>" alt="<?php echo esc_attr( $insight_term->name ); ?>">
						<?php else : ?>
							<div class="absolute inset-0 bg-[#050b14]"></div>
						<?php endif; ?>
						<div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/55 to-black/20"></div>
						
						<div class="relative z-10">
							<span class="text-xs font-mono text-white/50 tracking-wider">04</span>
						</div>
						<div class="relative z-10 mt-auto">
							<h3 class="max-w-xl text-3xl sm:text-5xl font-sans font-black leading-tight text-white mb-3"><?php echo esc_html( $insight_term->name ); ?></h3>
							<p class="text-xs sm:text-sm text-white/70 leading-relaxed font-sans mb-6">
								<?php if ( ! empty( $insight_term->description ) ) : ?>
									<?php echo esc_html( $insight_term->description ); ?>
								<?php else : ?>
									<?php esc_html_e( 'Laporan mendalam dan liputan khusus dari isu-isu penting yang membentuk masa depan Jogja.', 'paijo' ); ?>
								<?php endif; ?>
							</p>
							<span class="text-[10px] font-black uppercase tracking-[0.15em] text-white/90 group-hover:text-paijo-accent transition-colors inline-flex items-center gap-1.5">
								<?php esc_html_e( 'Lihat Semua Insight', 'paijo' ); ?> &rarr;
							</span>
						</div>
					</a>

					<!-- Columns 2, 3, 4: Posts -->
					<?php foreach ( $insight_posts as $insight_post ) : ?>
						<?php
						$card_image = paijo_get_thumbnail_url( (int) $insight_post->ID, 'paijo-square' );
						?>
							<a class="group relative aspect-square w-full overflow-hidden bg-paijo-ink text-white hidden flex-col justify-end p-6 sm:flex sm:p-8" href="<?php echo esc_url( get_permalink( $insight_post ) ); ?>">
							<?php if ( $card_image ) : ?>
								<img class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo esc_url( $card_image ); ?>" alt="<?php echo esc_attr( get_the_title( $insight_post ) ); ?>">
							<?php else : ?>
								<div class="absolute inset-0 bg-neutral-900"></div>
							<?php endif; ?>
							<div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
							
							<div class="relative z-10">
								<span class="inline-block bg-black/50 backdrop-blur-sm text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 mb-3 rounded-sm">
									<?php echo esc_html( paijo_get_category_label( (int) $insight_post->ID ) ); ?>
								</span>
								<h3 class="text-base sm:text-lg font-serif font-bold leading-snug text-white mb-2 group-hover:text-paijo-accent transition-colors line-clamp-2">
									<?php echo esc_html( get_the_title( $insight_post ) ); ?>
								</h3>
								<time class="block text-[10px] text-white/60 font-sans uppercase tracking-wider" datetime="<?php echo esc_attr( get_the_date( DATE_W3C, $insight_post ) ); ?>">
									<?php echo esc_html( strtoupper( get_the_date( 'j F Y', $insight_post ) ) ); ?>
								</time>
							</div>
						</a>
					<?php endforeach; ?>

				</div>
			</section>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	<?php endif; ?>

	<!-- Tinggal di Jogja Category Showcase Section -->
	<?php
	$tinggal_term = get_term_by( 'slug', 'tinggal-di-jogja', 'paijo_content_category' );
	if ( $tinggal_term && ! is_wp_error( $tinggal_term ) ) :
		$tinggal_query = new WP_Query(
			array(
				'post_type'           => 'paijo_content',
				'post_status'         => 'publish',
				'posts_per_page'      => 3,
				'ignore_sticky_posts' => true,
				'tax_query'           => array(
					array(
						'taxonomy' => 'paijo_content_category',
						'field'    => 'term_id',
						'terms'    => $tinggal_term->term_id,
					),
				),
			)
		);

		if ( $tinggal_query->have_posts() ) :
			$tinggal_posts        = $tinggal_query->posts;
			$tinggal_featured_img = paijo_get_thumbnail_url( (int) $tinggal_posts[0]->ID, 'paijo-hero' );
			$tinggal_term_link    = get_term_link( $tinggal_term );
			?>
			<section class="border-b border-paijo-line bg-paijo-card">
				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 overflow-hidden">
					
					<!-- Column 1: Category Gateway Card -->
					<a class="group relative bg-[#050b14] text-white aspect-square w-full overflow-hidden flex flex-col justify-between p-6 sm:p-8" href="<?php echo esc_url( $tinggal_term_link ); ?>">
						<?php if ( $tinggal_featured_img ) : ?>
							<img class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-30" src="<?php echo esc_url( $tinggal_featured_img ); ?>" alt="<?php echo esc_attr( $tinggal_term->name ); ?>">
						<?php else : ?>
							<div class="absolute inset-0 bg-[#050b14]"></div>
						<?php endif; ?>
						<div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/55 to-black/20"></div>
						
						<div class="relative z-10">
							<span class="text-xs font-mono text-white/50 tracking-wider">05</span>
						</div>
						<div class="relative z-10 mt-auto">
							<h3 class="max-w-xl text-3xl sm:text-5xl font-sans font-black leading-tight text-white mb-3"><?php echo esc_html( $tinggal_term->name ); ?></h3>
							<p class="text-xs sm:text-sm text-white/70 leading-relaxed font-sans mb-6">
								<?php esc_html_e( 'Kost, kontrak, atau beli rumah: bisa sama enaknya.', 'paijo' ); ?>
							</p>
							<span class="text-[10px] font-black uppercase tracking-[0.15em] text-white/90 group-hover:text-paijo-accent transition-colors inline-flex items-center gap-1.5">
								<?php esc_html_e( 'Lihat Semua Tinggal di Jogja', 'paijo' ); ?> &rarr;
							</span>
						</div>
					</a>

					<!-- Columns 2, 3, 4: CPT Posts -->
					<?php foreach ( $tinggal_posts as $tinggal_post ) : ?>
						<?php
						$card_image = paijo_get_thumbnail_url( (int) $tinggal_post->ID, 'paijo-square' );
						?>
							<a class="group relative aspect-square w-full overflow-hidden bg-paijo-ink text-white hidden flex-col justify-end p-6 sm:flex sm:p-8" href="<?php echo esc_url( get_permalink( $tinggal_post ) ); ?>">
							<?php if ( $card_image ) : ?>
								<img class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo esc_url( $card_image ); ?>" alt="<?php echo esc_attr( get_the_title( $tinggal_post ) ); ?>">
							<?php else : ?>
								<div class="absolute inset-0 bg-neutral-900"></div>
							<?php endif; ?>
							<div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
							
							<div class="relative z-10">
								<span class="inline-block bg-black/50 backdrop-blur-sm text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 mb-3 rounded-sm">
									<?php echo esc_html( paijo_get_content_category_label( (int) $tinggal_post->ID ) ); ?>
								</span>
								<h3 class="text-base sm:text-lg font-serif font-bold leading-snug text-white mb-2 group-hover:text-paijo-accent transition-colors line-clamp-2">
									<?php echo esc_html( get_the_title( $tinggal_post ) ); ?>
								</h3>
								<time class="block text-[10px] text-white/60 font-sans uppercase tracking-wider" datetime="<?php echo esc_attr( get_the_date( DATE_W3C, $tinggal_post ) ); ?>">
									<?php echo esc_html( strtoupper( get_the_date( 'j F Y', $tinggal_post ) ) ); ?>
								</time>
							</div>
						</a>
					<?php endforeach; ?>

				</div>
			</section>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	<?php endif; ?>

	<!-- Feed Reels Section -->
	<?php
	$feed_reels_url = get_post_type_archive_link( 'feed_reels' ) ?: home_url( '/pj-feed/' );

	$feed_reels_query = new WP_Query(
		array(
			'post_type'           => 'feed_reels',
			'post_status'         => 'publish',
			'posts_per_page'      => 9, // Query up to 9 posts to make a total of 10 slides including the CTA card
			'ignore_sticky_posts' => true,
			'meta_key'            => '_paijo_feed_reels_timestamp',
			'orderby'             => 'meta_value_num',
			'order'               => 'DESC',
		)
	);

	if ( $feed_reels_query->have_posts() ) :
		?>
		<section class="paijo-section border-b border-paijo-line bg-paijo-paper relative overflow-hidden">
			<!-- Background Layer: Positioned specifically in the bottom right corner with custom dark mode pink filter -->
			<div class="absolute right-0 bottom-0 w-[500px] h-[210px] sm:w-[650px] sm:h-[270px] lg:w-[800px] lg:h-[333px] bg-contain bg-right-bottom bg-no-repeat z-0 pointer-events-none watercolor-bg-layer" style="background-image: url('<?php echo esc_url( PAIJO_URI . '/assets/images/watercolor.png?ver=' . paijo_asset_version( 'assets/images/watercolor.png' ) ); ?>');"></div>
			<div class="paijo-container relative z-10">
				<!-- Header Section -->
				<div class="mb-10 text-center">
					<span class="inline-block bg-[#f1818f]/10 text-[#f1818f] text-[10px] font-black uppercase tracking-[0.15em] px-3 py-1 rounded-full mb-3">
						Rubrik Video
					</span>
					<h2 class="text-3xl sm:text-5xl font-sans font-black tracking-tight text-paijo-ink"><?php esc_html_e( 'Feed Reels', 'paijo' ); ?></h2>
					<p class="mt-3 text-sm sm:text-base text-paijo-muted max-w-2xl mx-auto"><?php esc_html_e( 'Rangkuman visual peristiwa penting di Yogyakarta saat ini.', 'paijo' ); ?></p>
				</div>

				<!-- Horizontal Scroll Slider Wrapper -->
				<div class="relative group">
					<!-- Slider Container -->
					<div id="feed-reels-slider" class="grid grid-flow-col auto-cols-[82%] md:auto-cols-[46%] lg:auto-cols-[calc(20%-16px)] overflow-x-auto snap-x snap-mandatory gap-5 pb-5 scrollbar-none">
						<?php
						while ( $feed_reels_query->have_posts() ) :
							$feed_reels_query->the_post();
							$embed_url = get_post_meta( get_the_ID(), '_paijo_feed_reels_embed_url', true );
							?>
							<div class="snap-start flex flex-col bg-white dark:bg-neutral-900 border border-paijo-line rounded-2xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
								<!-- Thumbnail Container -->
								<a href="<?php the_permalink(); ?>" class="group relative w-full h-[400px] bg-black overflow-hidden flex items-center justify-center">
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
							</div>
						<?php
						endwhile;
						?>

						<!-- Last Card: Watch More Recommendation -->
						<div class="snap-start flex flex-col bg-white dark:bg-neutral-900 rounded-2xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
							<!-- CTA Container -->
							<a href="<?php echo esc_url( $feed_reels_url ); ?>" class="group relative w-full h-[400px] bg-gradient-to-br from-[#050b14] to-[#121b2d] flex flex-col justify-between p-6 overflow-hidden">
								<!-- Background Pattern Circle -->
								<div class="absolute -right-10 -bottom-10 w-44 h-44 rounded-full bg-[#f1818f]/10 group-hover:bg-[#f1818f]/20 transition-all duration-500"></div>
								
								<div class="relative z-10 mt-4">
									<span class="text-[9px] font-black uppercase tracking-widest text-[#f1818f]">Lihat Semua</span>
									<h3 class="font-sans font-black text-2xl text-white mt-4 leading-tight group-hover:text-[#f1818f] transition-colors"><?php esc_html_e( 'Tonton Video Lainnya', 'paijo' ); ?></h3>
									<p class="text-xs text-neutral-400 mt-3 leading-relaxed"><?php esc_html_e( 'Rangkuman visual peristiwa penting di Yogyakarta saat ini selengkapnya di rubrik Feed Reels.', 'paijo' ); ?></p>
								</div>

								<div class="relative z-10 mb-4 self-start">
									<div class="w-12 h-12 rounded-full bg-[#f1818f] text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
										<!-- Right Arrow Icon -->
										<svg class="w-5 h-5 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
											<line x1="5" y1="12" x2="19" y2="12"></line>
											<polyline points="12 5 19 12 12 19"></polyline>
										</svg>
									</div>
								</div>
							</a>
						</div>

						<?php
						wp_reset_postdata();
						?>
					</div>

					<!-- Navigation Arrow Buttons Overlay -->
					<button id="feed-reels-prev-btn" class="absolute -left-4 top-[200px] -translate-y-1/2 z-20 flex items-center justify-center w-14 h-14 rounded-2xl bg-[#f1818f] text-white hover:bg-[#d96a78] shadow-xl hover:scale-105 active:scale-95 transition-all duration-200 cursor-pointer opacity-0 pointer-events-none" aria-label="Previous videos">
						<svg class="w-6 h-6 stroke-current fill-none" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="15 18 9 12 15 6"></polyline>
						</svg>
					</button>

					<button id="feed-reels-next-btn" class="absolute -right-4 top-[200px] -translate-y-1/2 z-20 flex items-center justify-center w-14 h-14 rounded-2xl bg-[#f1818f] text-white hover:bg-[#d96a78] shadow-xl hover:scale-105 active:scale-95 transition-all duration-200 cursor-pointer" aria-label="Next videos">
						<svg class="w-6 h-6 stroke-current fill-none" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="9 18 15 12 9 6"></polyline>
						</svg>
					</button>
				</div>

				<script>
				document.addEventListener('DOMContentLoaded', function() {
					const container = document.getElementById('feed-reels-slider');
					const prevBtn = document.getElementById('feed-reels-prev-btn');
					const nextBtn = document.getElementById('feed-reels-next-btn');
					
					if (container && nextBtn && prevBtn) {
						// Use IntersectionObserver for 100% reliable detection of start/end
						const observerOptions = {
							root: container,
							threshold: 0.95 // Trigger when card is almost fully visible
						};

						const observer = new IntersectionObserver((entries) => {
							entries.forEach(entry => {
								// Check if first card is visible
								if (entry.target === container.firstElementChild) {
									if (entry.isIntersecting) {
										prevBtn.classList.add('opacity-0', 'pointer-events-none');
									} else {
										prevBtn.classList.remove('opacity-0', 'pointer-events-none');
									}
								}
								// Check if last card is visible
								if (entry.target === container.lastElementChild) {
									if (entry.isIntersecting) {
										nextBtn.classList.add('opacity-0', 'pointer-events-none');
									} else {
										nextBtn.classList.remove('opacity-0', 'pointer-events-none');
									}
								}
							});
						}, observerOptions);

						// Observe the first and last slides
						if (container.firstElementChild) {
							observer.observe(container.firstElementChild);
						}
						if (container.lastElementChild) {
							observer.observe(container.lastElementChild);
						}

						nextBtn.addEventListener('click', function() {
							const firstCard = container.firstElementChild;
							if (firstCard) {
								const cardWidth = firstCard.clientWidth;
								const gap = parseInt(window.getComputedStyle(container).gap) || 20;
								const scrollAmount = cardWidth + gap;
								container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
							}
						});

						prevBtn.addEventListener('click', function() {
							const firstCard = container.firstElementChild;
							if (firstCard) {
								const cardWidth = firstCard.clientWidth;
								const gap = parseInt(window.getComputedStyle(container).gap) || 20;
								const scrollAmount = cardWidth + gap;
								container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
							}
						});
					}
				});
				</script>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php
get_footer();
