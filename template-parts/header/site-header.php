<?php
/**
 * Site header template part.
 *
 * @package Paijo
 */

$is_home = is_front_page();
$header_class = $is_home 
	? 'absolute top-0 left-0 w-full z-40 bg-transparent text-white border-b-0 transition-all duration-300' 
	: 'sticky top-0 z-40 border-b border-white/10 bg-black/50 backdrop-blur-md text-white transition-all duration-300 shadow-[0_4px_30px_rgba(0,0,0,0.15)]';

$btn_class = $is_home 
	? 'rounded-full border border-white/30 text-white bg-transparent w-10 h-10 flex items-center justify-center transition-all duration-200 focus:outline-none' 
	: 'rounded-full border border-white/15 text-white bg-white/10 backdrop-blur-sm w-10 h-10 flex items-center justify-center transition-all duration-200 focus:outline-none hover:border-paijo-accent hover:text-paijo-accent hover:bg-white/20';
?>

<header class="<?php echo esc_attr( $header_class ); ?>" <?php echo $is_home ? 'data-paijo-header-overlay' : ''; ?>>
	<div class="paijo-container">
		<div class="relative flex min-h-20 items-center justify-between gap-4">
			<!-- Column 1 & 2: Hamburger Menu & Search Icon (Left) -->
			<div class="flex items-center gap-2.5 w-1/3 z-10">
				<!-- Column 1: Hamburger Menu -->
				<button class="<?php echo esc_attr( $btn_class ); ?>" type="button" data-paijo-header-btn data-paijo-nav-toggle aria-controls="paijo-mobile-nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Menu', 'paijo' ); ?>">
					<span class="paijo-hamburger" aria-hidden="true">
						<span class="paijo-hamburger-bar paijo-hamburger-bar-top"></span>
						<span class="paijo-hamburger-bar paijo-hamburger-bar-middle"></span>
						<span class="paijo-hamburger-bar paijo-hamburger-bar-bottom"></span>
					</span>
				</button>
				<!-- Column 2: Search Icon -->
				<button class="<?php echo esc_attr( $btn_class ); ?>" type="button" data-paijo-header-btn data-paijo-search-toggle aria-controls="paijo-search-panel" aria-expanded="false" aria-label="<?php esc_attr_e( 'Search', 'paijo' ); ?>">
					<span class="paijo-search-icon" aria-hidden="true">
						<svg class="paijo-search-icon-default h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="11" cy="11" r="8"></circle>
							<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						</svg>
						<svg class="paijo-search-icon-close h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
							<line x1="6" y1="6" x2="18" y2="18"></line>
							<line x1="18" y1="6" x2="6" y2="18"></line>
						</svg>
					</span>
				</button>
			</div>

			<!-- Column 3: Logo Pandangan Jogja (Center) -->
			<div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex items-center justify-center">
					<a class="flex items-center no-underline" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img class="custom-logo h-10 w-auto object-contain" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					</a>
			</div>

			<!-- Column 4: Tagline Inovatif & Tepercaya (Right) -->
			<div class="flex justify-end items-center w-1/3 ml-auto z-10 gap-3">
				<button class="paijo-theme-switch" type="button" data-paijo-theme-toggle aria-label="<?php esc_attr_e( 'Toggle Theme', 'paijo' ); ?>">
					<span class="sr-only">Toggle theme</span>
					<!-- Switch thumb -->
					<span class="paijo-theme-thumb">
						<!-- Sun icon (Light mode) -->
						<svg class="paijo-theme-icon paijo-theme-icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="12" cy="12" r="5"></circle>
							<line x1="12" y1="1" x2="12" y2="3"></line>
							<line x1="12" y1="21" x2="12" y2="23"></line>
							<line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
							<line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
							<line x1="1" y1="12" x2="3" y2="12"></line>
							<line x1="21" y1="12" x2="23" y2="12"></line>
							<line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
							<line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
						</svg>
						<!-- Moon icon (Dark mode) -->
						<svg class="paijo-theme-icon paijo-theme-icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
							<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
						</svg>
					</span>
				</button>
				<div class="hidden sm:flex items-center gap-2.5 text-right">
					<div class="flex flex-col justify-center font-sans text-right">
						<span class="text-[10px] sm:text-xs font-black uppercase tracking-[0.15em] text-white leading-tight">
							Inovatif
						</span>
						<span class="text-[10px] sm:text-xs font-black uppercase tracking-[0.15em] text-white leading-tight">
							Tepercaya
						</span>
					</div>
					<!-- Large Hashtag Icon -->
					<svg class="w-7 h-7 text-[#f1818f] stroke-current fill-none" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
						<line x1="4" y1="9" x2="20" y2="9"></line>
						<line x1="4" y1="15" x2="20" y2="15"></line>
						<line x1="10" y1="3" x2="8" y2="21"></line>
						<line x1="16" y1="3" x2="14" y2="21"></line>
					</svg>
				</div>
			</div>
		</div>
		</div>

		<div id="paijo-search-panel" class="hidden border border-t-0 border-white/10 py-4 px-4 bg-black/70 backdrop-blur-md text-white shadow-lg rounded-b-lg" data-paijo-search-panel>
			<?php get_search_form(); ?>
		</div>

		<nav id="paijo-mobile-nav" class="hidden border border-t-0 border-white/10 py-6 px-6 bg-black/85 backdrop-blur-md text-white shadow-lg rounded-b-lg" data-paijo-mobile-nav aria-label="<?php esc_attr_e( 'Mobile menu', 'paijo' ); ?>">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 max-w-4xl mx-auto py-4">
				<!-- Column 1: Kategori Utama -->
				<div>
					<h3 class="text-xs font-black uppercase tracking-[0.2em] text-neutral-400 mb-5 pb-2 border-b border-white/10 flex items-center gap-2">
						<span class="w-1.5 h-1.5 rounded-full bg-neutral-400"></span>
						<?php esc_html_e( 'Kategori Utama', 'paijo' ); ?>
					</h3>
					<ul class="space-y-3">
						<?php
						$post_categories = get_categories( array( 'hide_empty' => false ) );
						foreach ( $post_categories as $cat ) {
							if ( 'uncategorized' === $cat->slug ) {
								continue;
							}
							?>
							<li>
								<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="group flex items-center justify-between text-sm font-bold py-1 transition-all duration-200 hover:translate-x-1.5 w-full">
									<span><?php echo esc_html( $cat->name ); ?></span>
									<svg class="w-3.5 h-3.5 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-200 text-[#f1818f]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
										<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
									</svg>
								</a>
							</li>
							<?php
						}
						?>
					</ul>
				</div>

				<!-- Column 2: Konten Khusus -->
				<div>
					<h3 class="text-xs font-black uppercase tracking-[0.2em] text-[#f1818f] mb-5 pb-2 border-b border-white/10 flex items-center gap-2">
						<span class="w-1.5 h-1.5 rounded-full bg-[#f1818f]"></span>
						<?php esc_html_e( 'Konten Khusus', 'paijo' ); ?>
					</h3>
					<ul class="space-y-3">
						<?php
						$cpt_categories = get_terms( array( 'taxonomy' => 'paijo_content_category', 'hide_empty' => false ) );
						if ( ! is_wp_error( $cpt_categories ) && ! empty( $cpt_categories ) ) {
							foreach ( $cpt_categories as $term ) {
								?>
								<li>
									<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="group flex items-center justify-between text-sm font-bold py-1 transition-all duration-200 hover:translate-x-1.5 w-full">
										<span><?php echo esc_html( $term->name ); ?></span>
										<svg class="w-3.5 h-3.5 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-200 text-[#f1818f]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
											<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
										</svg>
									</a>
								</li>
								<?php
							}
						}
						?>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</header>
