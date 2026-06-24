<?php
/**
 * Site footer template part.
 *
 * @package Paijo
 */

$footer_text = get_theme_mod( 'paijo_footer_text', 'Como 1907 Official Website' );
?>

<style>
	.custom-footer-bg { background-color: #f7f5f0; }
	html.dark .custom-footer-bg { background-color: #171717; }
</style>
<footer class="custom-footer-bg text-paijo-ink pt-16 pb-8 text-xs font-sans tracking-wide transition-colors duration-300 border-t border-paijo-line">
	<!-- Logos Row with extra spacing below -->
	<div class="paijo-container flex justify-center items-center mb-16">
		<!-- Site Custom Logo (Full Color) -->
		<?php if ( has_custom_logo() ) : ?>
			<span class="h-12 w-auto object-contain inline-block"><?php the_custom_logo(); ?></span>
		<?php else : ?>
			<img class="h-12 w-auto object-contain block dark:hidden" src="<?php echo esc_url( PAIJO_URI . '/assets/images/logo.png?ver=' . paijo_asset_version( 'assets/images/logo.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<img class="h-12 w-auto object-contain hidden dark:block" src="<?php echo esc_url( PAIJO_URI . '/assets/images/logo-white.png?ver=' . paijo_asset_version( 'assets/images/logo-white.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		<?php endif; ?>
	</div>

	<!-- Links & Social Grid -->
	<div class="paijo-container grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
		<!-- Column 1: KONTEN (Dynamic WordPress Categories) -->
		<div>
			<h4 class="text-paijo-ink font-bold uppercase tracking-wider mb-4">KONTEN</h4>
			<ul class="space-y-2 text-paijo-muted uppercase tracking-wider text-[11px]">
				<?php
				$footer_cats = get_categories(
					array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'hide_empty' => true,
						'number'     => 8,
					)
				);
				if ( ! empty( $footer_cats ) ) :
					foreach ( $footer_cats as $cat ) :
						?>
						<li>
							<a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="hover:text-paijo-accent transition-colors">
								<?php echo esc_html( $cat->name ); ?>
							</a>
						</li>
						<?php
					endforeach;
				else :
					?>
					<li><a href="#">No categories</a></li>
				<?php endif; ?>
			</ul>
		</div>

		<!-- Columns 2 & 3: PANDANGAN JOGJA (2 Columns Link List) -->
		<div class="md:col-span-2">
			<h4 class="text-paijo-ink font-bold uppercase tracking-wider mb-4">PANDANGAN JOGJA</h4>
			<ul class="flex flex-wrap text-paijo-muted uppercase tracking-wider text-[11px] gap-y-2">
				<li class="w-1/2 pr-2"><a href="/tentang-kami">Tentang Kami</a></li>
				<li class="w-1/2"><a href="/iklan-kerjasama">Iklan & Kerjasama</a></li>
				<li class="w-1/2 pr-2"><a href="/kontak">Kontak</a></li>
				<li class="w-1/2"><a href="/kebijakan-privasi">Kebijakan Privasi</a></li>
				<li class="w-1/2 pr-2"><a href="/redaksi">Redaksi</a></li>
				<li class="w-1/2"><a href="/kebijakan-cookies">Kebijakan Cookies</a></li>
				<li class="w-1/2 pr-2"><a href="/pedoman-media-siber">Pedoman Media Siber</a></li>
				<li class="w-1/2"><a href="/peta-situs">Peta Situs</a></li>
			</ul>
		</div>

		<!-- Column 4: ALAMAT & SOCIAL -->
		<div>
			<h4 class="text-paijo-ink font-bold uppercase tracking-wider mb-3">ALAMAT</h4>
			<p class="text-paijo-muted uppercase tracking-wider text-[11px] leading-relaxed mb-6">
				Jalan Camar No.79, Sidoarum, Kecamatan Godean, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55264
			</p>
			
			<h4 class="text-paijo-ink font-bold uppercase tracking-wider mb-3">SOCIAL</h4>
			<div class="flex items-center gap-4 text-paijo-muted">
				<!-- FB -->
				<a href="https://www.facebook.com/pandanganjogjacom" class="hover:text-paijo-accent transition-colors" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
					<svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.75z"/></svg>
				</a>
				
				<!-- X (Twitter) -->
				<a href="https://x.com/pandangan_jogja" class="hover:text-paijo-accent transition-colors" aria-label="X" target="_blank" rel="noopener noreferrer">
					<svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.657l-5.214-6.817L5.769 21.75H2.462l7.732-8.835L1.766 2.25h6.837l4.867 6.52 5.774-6.52zM16.5 20.25h1.833L7.997 3.75H6.074l10.426 16.5z"/></svg>
				</a>
				
				<!-- Instagram -->
				<a href="https://www.instagram.com/pandanganjogja" class="hover:text-paijo-accent transition-colors" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
					<svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
				</a>
				
				<!-- TikTok -->
				<a href="https://www.tiktok.com/@pandanganjogja" class="hover:text-paijo-accent transition-colors" aria-label="TikTok" target="_blank" rel="noopener noreferrer">
					<svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64c.29 0 .57.04.84.13V9.5a6.27 6.27 0 00-3.15-.3A6.34 6.34 0 002 15.56a6.34 6.34 0 0010.14 5.06 6.27 6.27 0 002.31-4.95V8.56A8.34 8.34 0 0019.59 11V7.58c-.85 0-1.67-.32-2.31-.89z"/></svg>
				</a>
			</div>
		</div>
	</div>

	<!-- Divider Line -->
	<div class="paijo-container mb-6">
		<hr class="border-paijo-line">
	</div>

	<!-- Copyright Bottom Row -->
	<div class="paijo-container text-center text-[10px] sm:text-xs text-paijo-muted uppercase tracking-[0.12em]">
		<p>Copyright &copy; 2026 Pandangan Jogja X VNDC Digital Agency | Media Partner Kumparan</p>
	</div>
</footer>
