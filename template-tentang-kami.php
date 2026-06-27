<?php
/**
 * Template Name: Tentang Kami
 *
 * Template halaman Tentang Kami.
 * Jika konten editor WordPress dikosongkan, template ini akan menampilkan
 * konten default secara otomatis.
 *
 * @package Paijo
 */

get_header();

$site_name   = get_bloginfo( 'name' );
$site_url    = get_site_url();
$admin_email = get_option( 'admin_email' );
?>

<main id="main-content" class="paijo-section bg-paijo-paper min-h-screen">
	<div class="paijo-container py-12">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'mx-auto max-w-4xl bg-white dark:bg-neutral-900 border border-paijo-line rounded-3xl p-8 sm:p-12 shadow-sm' ); ?>>
				
				<!-- Header Section -->
				<div class="text-center mb-12 pb-8 border-b border-paijo-line">
					<h1 class="text-4xl md:text-5xl font-sans font-black tracking-tight text-paijo-ink mb-8">
						<?php 
						$title = get_the_title();
						echo esc_html( $title ? $title : 'Tentang Kami' ); 
						?>
					</h1>
                    <div class="flex justify-center items-center">
                        <?php if ( has_custom_logo() ) : ?>
                            <span class="h-12 w-auto object-contain inline-block"><?php the_custom_logo(); ?></span>
                        <?php else : ?>
                            <img class="h-12 w-auto object-contain block dark:hidden" src="<?php echo esc_url( PAIJO_URI . '/assets/images/logo.png?ver=' . paijo_asset_version( 'assets/images/logo.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                            <img class="h-12 w-auto object-contain hidden dark:block" src="<?php echo esc_url( PAIJO_URI . '/assets/images/logo-white.png?ver=' . paijo_asset_version( 'assets/images/logo-white.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                        <?php endif; ?>
                    </div>
				</div>

				<!-- Content Section -->
				<div class="paijo-prose prose-lg dark:prose-invert max-w-none text-paijo-ink">
					
					<?php 
					// Tampilkan konten tambahan dari editor (jika ada) di atas struktur default
					$content = get_the_content();
					$clean_content = preg_replace( '/&nbsp;|\s+/', '', wp_strip_all_tags( $content ) );
					if ( strlen( $clean_content ) > 15 ) {
						echo '<div class="mb-8">';
						the_content();
						echo '</div>';
					}
					?>

						<!-- Logo dan Pendahuluan -->
						<div style="text-align: center; margin-bottom: 2.5rem;">
							<div style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; background: rgba(241,129,143,0.1); border-radius: 50%; margin-bottom: 1.5rem;">
								<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#f1818f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
							</div>
							<p style="font-size: 1.125rem; line-height: 1.75; margin: 0; font-family: 'PT Serif', Georgia, serif; max-width: 48rem; margin-left: auto; margin-right: auto;">
								Diluncurkan pada <em>Oktober 2019</em>, <strong><?php echo esc_html( $site_name ); ?></strong> adalah media lokal inovatif dan tepercaya yang menghadirkan cerita bermakna dan mendorong perubahan nyata di Yogyakarta.
							</p>
						</div>

						<!-- Visi -->
						<h2 style="margin-top: 3rem; margin-bottom: 1rem; text-align: center;">Visi <?php echo esc_html( $site_name ); ?></h2>
						<div style="background: rgba(241,129,143,0.05); border-left: 4px solid #f1818f; border-radius: 0 0.75rem 0.75rem 0; padding: 1.5rem; margin-bottom: 1.5rem; text-align: center;">
							<p style="font-size: 1.25rem; font-weight: 800; margin: 0; color: #f1818f;">
								“Menjadi media ‘Move People’.”
							</p>
						</div>
						<p style="text-align: center; margin-bottom: 3rem; max-width: 42rem; margin-left: auto; margin-right: auto; color: var(--paijo-muted);">
							<?php echo esc_html( $site_name ); ?> percaya media bukan hanya tempat menyampaikan informasi, tetapi juga bagian dari ekosistem perubahan yang ikut membangun masa depan Yogyakarta (dan Indonesia) secara lebih berkelanjutan, inklusif, dan manusiawi.
						</p>

						<!-- Misi -->
                            </p>
                        </div>

                        <div style="margin-bottom: 2.5rem;">
                            <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1rem;">3. Dampak Nyata</h3>
                            <p style="margin-bottom: 1rem;">
                                <?php echo esc_html( $site_name ); ?> percaya bahwa jurnalisme sejati tidak berhenti di layar. Setiap konten adalah undangan untuk bergerak: dari tulisan dan video menuju event, kolaborasi, hingga advokasi kebijakan.
                            </p>
                            <p>
                                Bersama masyarakat, bisnis, pemerintah, kampus, dan komunitas, PJ membangun berbagai inisiatif yang mendorong perubahan sosial dan pembangunan berkelanjutan di Yogyakarta dan Indonesia.
                            </p>
                        </div>

					<?php endif; ?>

				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
