<?php
/**
 * Template Name: Kontak
 *
 * Template halaman Kontak / Hubungi Kami.
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
					<span class="inline-block bg-[#f1818f]/10 text-[#f1818f] text-xs font-black uppercase tracking-[0.15em] px-4 py-1.5 rounded-full mb-4">
						Get In Touch
					</span>
					<h1 class="text-4xl md:text-5xl font-sans font-black tracking-tight text-paijo-ink mb-4">
						<?php 
						$title = get_the_title();
						echo esc_html( $title ? $title : 'Kontak Kami' ); 
						?>
					</h1>
					<p class="text-paijo-muted text-base">Kami selalu terbuka untuk mendengar dari Anda</p>
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

						<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
							
							<!-- Kotak Alamat -->
							<div style="background: #fdfdfd; border: 1px solid var(--paijo-line); border-radius: 1rem; padding: 1.5rem; text-align: center;">
								<div style="background: rgba(241,129,143,0.1); width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f1818f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
								</div>
								<h3 style="font-size: 1.25rem; font-weight: 800; margin-top: 0; margin-bottom: 0.5rem;">Kantor Redaksi</h3>
								<p style="margin: 0; font-size: 0.95rem; color: var(--paijo-muted); line-height: 1.6;">Yogyakarta, Indonesia<br>(Mohon buat janji temu sebelumnya)</p>
							</div>

							<!-- Kotak Email -->
							<div style="background: #fdfdfd; border: 1px solid var(--paijo-line); border-radius: 1rem; padding: 1.5rem; text-align: center;">
								<div style="background: rgba(241,129,143,0.1); width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f1818f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
								</div>
								<h3 style="font-size: 1.25rem; font-weight: 800; margin-top: 0; margin-bottom: 0.5rem;">Email</h3>
								<p style="margin: 0; font-size: 0.95rem; color: var(--paijo-muted); line-height: 1.6;">
									Redaksi: <a href="mailto:<?php echo esc_attr( $admin_email ); ?>" style="color: #f1818f; font-weight: bold;"><?php echo esc_html( $admin_email ); ?></a><br>
									Iklan & Kerjasama: <a href="mailto:<?php echo esc_attr( $admin_email ); ?>" style="color: #f1818f; font-weight: bold;"><?php echo esc_html( $admin_email ); ?></a>
								</p>
							</div>

						</div>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem; text-align: center;">Kirimkan Press Release atau Hak Jawab</h2>
						<p style="text-align: center; margin-bottom: 2.5rem; color: var(--paijo-muted);">Jika Anda memiliki rilis pers, undangan peliputan, opini, pengaduan, atau hak jawab, silakan kirimkan langsung melalui email redaksi kami. Lampirkan foto atau dokumen pendukung untuk memudahkan tim kami.</p>

						<!-- Pesan Singkat -->
						<div style="background: rgba(241,129,143,0.05); border-left: 4px solid #f1818f; border-radius: 0 0.75rem 0.75rem 0; padding: 1.5rem; margin-bottom: 2rem;">
							<p style="font-size: 1rem; line-height: 1.75; margin: 0; font-family: 'PT Serif', Georgia, serif;">
								"Media yang baik tidak hanya bicara, tetapi juga mendengarkan. Kami di <strong><?php echo esc_html( $site_name ); ?></strong> sangat menghargai setiap masukan, kritik, dan saran dari Anda untuk membangun jurnalisme yang lebih baik."
							</p>
						</div>

				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
