<?php
/**
 * Template Name: Redaksi
 *
 * Template halaman Susunan Redaksi.
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
						Tim Kami
					</span>
					<h1 class="text-4xl md:text-5xl font-sans font-black tracking-tight text-paijo-ink mb-4">
						<?php 
						$title = get_the_title();
						echo esc_html( $title ? $title : 'Susunan Redaksi' ); 
						?>
					</h1>
					<p class="text-paijo-muted text-base">Orang-orang di balik layar <?php echo esc_html( $site_name ); ?></p>
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
						<div style="background: rgba(241,129,143,0.05); border-left: 4px solid #f1818f; border-radius: 0 0.75rem 0.75rem 0; padding: 1.5rem; margin-bottom: 3rem;">
							<p style="font-size: 1rem; line-height: 1.75; margin: 0; font-family: 'PT Serif', Georgia, serif;">
								<strong><?php echo esc_html( $site_name ); ?></strong> dibangun oleh tim profesional yang berdedikasi tinggi terhadap kualitas jurnalisme. Kami berkomitmen untuk menyajikan informasi yang akurat, independen, dan tepercaya untuk menggerakkan masyarakat menuju arah yang lebih baik.
							</p>
						</div>

						<!-- Struktur Redaksi -->
						<div style="margin-bottom: 2rem;">
							<h3 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 0.5rem; border-bottom: 1px solid var(--paijo-line); padding-bottom: 0.5rem; text-align: center; margin-top: 2rem;">Dewan Redaksi</h3>
							
							<h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.25rem; margin-top: 1.5rem; color: var(--paijo-muted);">CEO</h3>
							<p style="margin-top: 0; margin-bottom: 1.5rem; font-weight: bold;">Eko Sugiarto Putro</p>
							
							<h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.25rem; margin-top: 1.5rem; color: var(--paijo-muted);">Pemimpin Redaksi</h3>
							<p style="margin-top: 0; margin-bottom: 1.5rem; font-weight: bold;">Erick Tanjung</p>
							
							<h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.25rem; margin-top: 1.5rem; color: var(--paijo-muted);">Manajer News</h3>
							<p style="margin-top: 0; margin-bottom: 1.5rem; font-weight: bold;">Widi RH Pradana</p>
							
							<h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.25rem; margin-top: 1.5rem; color: var(--paijo-muted);">Multiplatform Journalist</h3>
							<ul style="list-style-type: none; padding-left: 0; margin-top: 0; margin-bottom: 1.5rem; font-weight: bold;">
								<li style="margin-bottom: 0.25rem;">Resti Damayanti</li>
								<li style="margin-bottom: 0.25rem;">Gigih Imanadi</li>
								<li style="margin-bottom: 0.25rem;">M. Iqbal Tawakal</li>
								<li style="margin-bottom: 0.25rem;">Nuha Khairunnisa</li>
								<li style="margin-bottom: 0.25rem;">Tanayu Hangno</li>
							</ul>
							
							<h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.25rem; margin-top: 1.5rem; color: var(--paijo-muted);">Visual Arts Multiplatform Journalist</h3>
							<p style="margin-top: 0; margin-bottom: 1.5rem; font-weight: bold;">Eka Putri Mariningsih</p>
						</div>

						<!-- Disclaimer Integritas -->
						<div style="margin-top: 3rem; background: #fdfdfd; border: 1px solid var(--paijo-line); border-radius: 1rem; padding: 1.5rem;">
							<h3 style="font-size: 1.125rem; font-weight: 900; margin-top: 0; margin-bottom: 0.5rem; color: #d9534f;">PERHATIAN / DISCLAIMER JURNALISTIK</h3>
							<p style="margin: 0; font-size: 0.95rem; line-height: 1.6; color: var(--paijo-muted);">
								Wartawan dan staf <strong><?php echo esc_html( $site_name ); ?></strong> dalam menjalankan tugas jurnalistiknya dibekali tanda pengenal (kartu pers) dan surat tugas resmi. Wartawan kami <strong>dilarang keras</strong> meminta, memeras, ataupun menerima imbalan dalam bentuk apa pun (uang, barang, atau fasilitas) dari narasumber terkait dengan pemberitaan.
							</p>
						</div>

				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
