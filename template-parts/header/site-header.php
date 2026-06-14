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
					<svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<line x1="4" y1="12" x2="20" y2="12"></line>
						<line x1="4" y1="6" x2="20" y2="6"></line>
						<line x1="4" y1="18" x2="20" y2="18"></line>
					</svg>
				</button>
				<!-- Column 2: Search Icon -->
				<button class="<?php echo esc_attr( $btn_class ); ?>" type="button" data-paijo-header-btn data-paijo-search-toggle aria-controls="paijo-search-panel" aria-expanded="false" aria-label="<?php esc_attr_e( 'Search', 'paijo' ); ?>">
					<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="11" cy="11" r="8"></circle>
						<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
					</svg>
				</button>
			</div>

			<!-- Column 3: Logo Pandangan Jogja (Center) -->
			<div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex items-center justify-center">
				<a class="flex items-center no-underline" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php if ( has_custom_logo() ) : ?>
						<span class="max-w-44 block"><?php the_custom_logo(); ?></span>
					<?php else : ?>
						<img class="custom-logo custom-logo-dark h-10 w-auto object-contain" src="<?php echo esc_url( PAIJO_URI . '/assets/images/logo.png?ver=' . paijo_asset_version( 'assets/images/logo.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<img class="custom-logo custom-logo-white h-10 w-auto object-contain" src="<?php echo esc_url( PAIJO_URI . '/assets/images/logo-white.png?ver=' . paijo_asset_version( 'assets/images/logo-white.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<?php endif; ?>
				</a>
			</div>

			<!-- Column 4: Tagline Inovatif & Terpercaya (Right) -->
			<div class="flex justify-end items-center w-1/3 ml-auto z-10">
				<div class="hidden sm:flex items-center gap-2.5 text-right">
					<div class="flex flex-col justify-center font-sans text-right">
						<span class="text-[10px] sm:text-xs font-black uppercase tracking-[0.15em] text-white leading-tight">
							Inovatif
						</span>
						<span class="text-[10px] sm:text-xs font-black uppercase tracking-[0.15em] text-white leading-tight">
							Terpercaya
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

		<nav id="paijo-mobile-nav" class="hidden border border-t-0 border-white/10 py-5 px-4 bg-black/70 backdrop-blur-md text-white shadow-lg rounded-b-lg" data-paijo-mobile-nav aria-label="<?php esc_attr_e( 'Mobile menu', 'paijo' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'grid gap-3 text-base font-bold',
						'fallback_cb'    => false,
					)
				);
			} else {
				paijo_category_menu_fallback( 'grid gap-3 text-base font-bold' );
			}
			?>
		</nav>
	</div>
</header>
