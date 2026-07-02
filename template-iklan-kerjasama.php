<?php
/**
 * Template Name: Iklan dan Kerjasama
 *
 * Template halaman Iklan dan Kerjasama.
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
						Partnership
					</span>
					<h1 class="text-4xl md:text-5xl font-sans font-black tracking-tight text-paijo-ink mb-4">
						<?php 
						$title = get_the_title();
						echo esc_html( $title ? $title : 'Iklan dan Kerjasama' ); 
						?>
					</h1>
					<p class="text-paijo-muted text-base">Jangkau audiens yang tepat bersama <?php echo esc_html( $site_name ); ?></p>
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

						<!-- Pendahuluan -->
						<div style="background: rgba(241,129,143,0.05); border-left: 4px solid #f1818f; border-radius: 0 0.75rem 0.75rem 0; padding: 1.5rem; margin-bottom: 2rem;">
							<p style="font-size: 1.125rem; line-height: 1.75; margin: 0; font-family: 'PT Serif', Georgia, serif;">
								<strong><?php echo esc_html( $site_name ); ?></strong> adalah mitra strategis untuk mengembangkan bisnis Anda. Kami menawarkan berbagai solusi periklanan dan kolaborasi yang dirancang untuk membangun kesadaran merek (<em>brand awareness</em>), meningkatkan konversi, dan menciptakan interaksi yang bermakna dengan audiens yang relevan.
							</p>
						</div>

						<!-- Mengapa Memilih Kami -->
						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">Mengapa Bekerja Sama dengan Kami?</h2>
						<p style="margin-bottom: 1.5rem;">Kami percaya bahwa setiap merek memiliki cerita yang unik. Melalui pendekatan jurnalisme berkualitas tinggi dan distribusi lintas platform, kami siap membantu Anda menyampaikan pesan tersebut kepada audiens yang tepat.</p>
						
						<ul style="list-style-type: disc; padding-left: 1.5rem; margin-bottom: 2rem; space-y: 0.5rem;">
							<li style="margin-bottom: 0.5rem;"><strong>Audiens Tersegmen:</strong> Pembaca setia yang kritis, melek digital, dan memiliki daya beli.</li>
							<li style="margin-bottom: 0.5rem;"><strong>Kredibilitas Tinggi:</strong> Pesan merek Anda disandingkan dengan konten jurnalistik yang independen dan tepercaya.</li>
							<li style="margin-bottom: 0.5rem;"><strong>Solusi Kreatif:</strong> Format periklanan fleksibel yang disesuaikan dengan kebutuhan kampanye Anda.</li>
						</ul>

						<!-- Layanan Kami -->
						<h2 style="margin-top: 2rem; margin-bottom: 1.5rem;">Layanan Kami</h2>
						
						<div style="margin-bottom: 1.5rem; padding: 1.25rem; border: 1px solid var(--paijo-line); border-radius: 0.75rem;">
							<h3 style="font-size: 1.25rem; font-weight: 800; margin-top: 0; margin-bottom: 0.5rem;">1. Artikel Advertorial & Konten Sponsor (Native Ads)</h3>
							<p style="margin: 0; font-size: 0.95rem;">Artikel mendalam yang mengedukasi dan menceritakan nilai produk Anda dengan gaya bahasa jurnalistik. Sangat efektif untuk <em>soft-selling</em> dan meningkatkan SEO merek Anda.</p>
						</div>

						<div style="margin-bottom: 1.5rem; padding: 1.25rem; border: 1px solid var(--paijo-line); border-radius: 0.75rem;">
							<h3 style="font-size: 1.25rem; font-weight: 800; margin-top: 0; margin-bottom: 0.5rem;">2. Iklan Banner (Display Ads)</h3>
							<p style="margin: 0; font-size: 0.95rem;">Penempatan banner premium di berbagai posisi strategis pada situs web kami (Header, Sidebar, In-Article) untuk mendapatkan visibilitas maksimal.</p>
						</div>

						<div style="margin-bottom: 1.5rem; padding: 1.25rem; border: 1px solid var(--paijo-line); border-radius: 0.75rem;">
							<h3 style="font-size: 1.25rem; font-weight: 800; margin-top: 0; margin-bottom: 0.5rem;">3. Amplifikasi Media Sosial</h3>
							<p style="margin: 0; font-size: 0.95rem;">Distribusi konten promosi melalui akun media sosial resmi kami (Instagram, Twitter/X, TikTok, Facebook) yang memiliki tingkat keterlibatan (<em>engagement</em>) tinggi.</p>
						</div>

						<div style="margin-bottom: 2.5rem; padding: 1.25rem; border: 1px solid var(--paijo-line); border-radius: 0.75rem;">
							<h3 style="font-size: 1.25rem; font-weight: 800; margin-top: 0; margin-bottom: 0.5rem;">4. Media Partner & Kolaborasi Event</h3>
							<p style="margin: 0; font-size: 0.95rem;">Dukungan publikasi untuk acara, seminar, kompetisi, atau inisiatif komunitas yang Anda selenggarakan.</p>
						</div>

						<!-- Disclaimer -->
						<div style="margin-bottom: 2.5rem; font-size: 0.875rem; color: var(--paijo-muted); padding-left: 1rem; border-left: 2px solid var(--paijo-line);">
							<p style="margin: 0;"><em>Catatan: Kami menjunjung tinggi integritas jurnalistik. Seluruh konten iklan dan sponsor akan diberi label yang jelas (seperti "Advertorial" atau "Sponsored") agar tidak membingungkan pembaca.</em></p>
						</div>

						<!-- Hubungi Kami -->
						<div style="margin-top: 3rem; background: #f5f5f5; border-radius: 1rem; padding: 2rem; text-align: center;">
							<h3 style="font-size: 1.5rem; font-weight: 900; margin-bottom: 1rem; margin-top: 0;">Mari Berkolaborasi!</h3>
							<p style="color: var(--paijo-muted); margin-bottom: 1.5rem; max-width: 32rem; margin-left: auto; margin-right: auto;">Dapatkan <em>Media Kit</em> (profil audiens, statistik, dan daftar harga lengkap) dengan menghubungi tim bisnis kami. Mari diskusikan kampanye yang paling cocok untuk merek Anda.</p>
							<a href="mailto:<?php echo esc_attr( $admin_email ); ?>" class="inline-flex flex-col sm:flex-row items-center justify-center bg-[#f1818f] text-white font-bold rounded-full transition-colors w-full sm:w-auto hover:bg-[#d96a78] max-w-full no-underline" style="padding: 1rem 2.5rem;">
								<span class="sm:mr-1.5 mb-0.5 sm:mb-0 text-sm sm:text-base">Hubungi:</span>
								<span class="break-all text-center text-sm sm:text-base"><?php echo esc_html( $admin_email ); ?></span>
							</a>
						</div>

				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
