<?php
/**
 * Template Name: Kebijakan Privasi
 *
 * Template halaman Kebijakan Privasi.
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
						Legal & Privasi
					</span>
					<h1 class="text-4xl md:text-5xl font-sans font-black tracking-tight text-paijo-ink mb-4">
						<?php 
						$title = get_the_title();
						echo esc_html( $title ? $title : 'Kebijakan Privasi' ); 
						?>
					</h1>
					<p class="text-paijo-muted text-base">Terakhir diperbarui: <?php echo get_the_modified_date( 'd F Y' ); ?></p>
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
							<p style="font-size: 1rem; line-height: 1.75; margin: 0; font-family: 'PT Serif', Georgia, serif;">
								Privasi Anda sangat penting bagi <strong><?php echo esc_html( $site_name ); ?></strong>. Kebijakan Privasi ini menguraikan jenis informasi pribadi yang kami terima dan kumpulkan saat Anda menggunakan situs web kami, serta bagaimana kami menjaga dan menggunakan informasi tersebut.
							</p>
						</div>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">1. Pengumpulan Informasi</h2>
						<p>Kami mengumpulkan informasi dari Anda ketika Anda mengunjungi situs kami, mendaftar di situs kami, berlangganan newsletter, mengisi formulir pendaftaran, atau berinteraksi dengan fitur situs lainnya. Informasi yang dikumpulkan mencakup:</p>
						<ul style="list-style-type: disc; padding-left: 1.5rem; margin-bottom: 2rem; space-y: 0.5rem;">
							<li style="margin-bottom: 0.5rem;"><strong>Informasi Pribadi:</strong> Nama, alamat email, dan data diri lain yang Anda berikan secara sukarela.</li>
							<li style="margin-bottom: 0.5rem;"><strong>Informasi Non-Pribadi:</strong> Alamat IP, jenis browser, sistem operasi, halaman yang dikunjungi, dan waktu kunjungan untuk keperluan analitik.</li>
						</ul>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">2. Penggunaan Informasi</h2>
						<p>Setiap informasi yang kami kumpulkan dari Anda dapat digunakan untuk salah satu hal berikut:</p>
						<ul style="list-style-type: disc; padding-left: 1.5rem; margin-bottom: 2rem; space-y: 0.5rem;">
							<li style="margin-bottom: 0.5rem;">Meningkatkan pengalaman Anda sebagai pembaca (informasi Anda membantu kami lebih merespons kebutuhan individu Anda).</li>
							<li style="margin-bottom: 0.5rem;">Meningkatkan kualitas situs web kami (kami terus berupaya meningkatkan penawaran situs web kami berdasarkan informasi dan umpan balik yang kami terima dari Anda).</li>
							<li style="margin-bottom: 0.5rem;">Mengirim email berkala (jika Anda mendaftar newsletter kami).</li>
						</ul>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">3. Penggunaan Cookies</h2>
						<p>Seperti situs web pada umumnya, <strong><?php echo esc_html( $site_name ); ?></strong> menggunakan "cookies". Cookie adalah file kecil yang ditransfer oleh situs atau penyedia layanannya ke hard drive komputer Anda melalui browser Web Anda (jika Anda mengizinkan) yang memungkinkan sistem situs mengenali browser Anda dan menangkap serta mengingat informasi tertentu. Kami menggunakan cookies untuk memahami dan menyimpan preferensi Anda untuk kunjungan di masa mendatang.</p>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">4. Perlindungan Informasi</h2>
						<p>Kami menerapkan berbagai langkah keamanan untuk menjaga keamanan informasi pribadi Anda saat Anda memasukkan, mengirimkan, atau mengakses informasi pribadi Anda. Meskipun demikian, perlu dipahami bahwa tidak ada transmisi data melalui internet yang dapat dijamin 100% aman.</p>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">5. Tautan Pihak Ketiga</h2>
						<p>Terkadang, atas kebijakan kami, kami dapat menyertakan atau menawarkan produk atau layanan pihak ketiga di situs web kami. Situs pihak ketiga ini memiliki kebijakan privasi yang terpisah dan independen. Oleh karena itu, kami tidak memiliki tanggung jawab atau kewajiban atas konten dan aktivitas situs terkait ini.</p>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">6. Persetujuan Anda</h2>
						<p style="margin-bottom: 2.5rem;">Dengan menggunakan situs kami, Anda menyetujui Kebijakan Privasi web kami.</p>

						<!-- Hubungi Kami -->
						<div style="margin-top: 2rem; background: #f5f5f5; border-radius: 1rem; padding: 2rem; text-align: center;">
							<h3 style="font-size: 1.5rem; font-weight: 900; margin-bottom: 1rem; margin-top: 0;">Pertanyaan Lebih Lanjut?</h3>
							<p style="color: var(--paijo-muted); margin-bottom: 1.5rem;">Jika ada pertanyaan mengenai kebijakan privasi ini, Anda dapat menghubungi kami melalui informasi di bawah ini.</p>
							<a href="mailto:<?php echo esc_attr( $admin_email ); ?>" class="inline-flex items-center justify-center bg-[#f1818f] text-white font-bold rounded-full transition-colors w-full sm:w-auto hover:bg-[#d96a78] max-w-full no-underline" style="padding: 1rem 2.5rem;">
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
