<?php
/**
 * Template Name: Cookies
 *
 * Template halaman Kebijakan Cookies.
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
						echo esc_html( $title ? $title : 'Kebijakan Cookies' ); 
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
								Kebijakan Cookie ini menjelaskan apa itu cookie dan bagaimana <strong><?php echo esc_html( $site_name ); ?></strong> menggunakannya. Anda sebaiknya membaca kebijakan ini agar Anda dapat memahami jenis cookie yang kami gunakan, informasi yang kami kumpulkan menggunakan cookie, dan bagaimana informasi tersebut digunakan.
							</p>
						</div>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">1. Apa itu Cookie?</h2>
						<p>Cookie adalah file teks kecil yang dikirimkan ke perangkat keras (komputer atau perangkat seluler) Anda melalui browser web saat Anda mengunjungi sebuah situs. Cookie memungkinkan situs web mengenali perangkat Anda dan menyimpan beberapa informasi tentang preferensi Anda atau tindakan Anda di masa lalu.</p>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">2. Bagaimana Kami Menggunakan Cookie?</h2>
						<p>Kami menggunakan cookie untuk beberapa alasan yang dirinci di bawah ini:</p>
						<ul style="list-style-type: disc; padding-left: 1.5rem; margin-bottom: 2rem; space-y: 0.5rem;">
							<li style="margin-bottom: 0.5rem;"><strong>Cookie Penting (Essential Cookies):</strong> Cookie ini sangat penting untuk memberi Anda layanan yang tersedia melalui situs web kami dan untuk memungkinkan Anda menggunakan beberapa fiturnya (misal: login).</li>
							<li style="margin-bottom: 0.5rem;"><strong>Cookie Kinerja dan Analitik:</strong> Cookie ini melacak informasi tentang lalu lintas ke situs web dan bagaimana pengguna berinteraksi dengan situs web (misal: Google Analytics). Informasi yang dikumpulkan tidak mengidentifikasi pengunjung secara individu.</li>
							<li style="margin-bottom: 0.5rem;"><strong>Cookie Fungsionalitas:</strong> Cookie ini memungkinkan situs web mengingat pilihan yang Anda buat (seperti nama pengguna Anda, preferensi bahasa, atau wilayah Anda).</li>
							<li style="margin-bottom: 0.5rem;"><strong>Cookie Iklan atau Penargetan:</strong> Cookie ini digunakan untuk menayangkan iklan yang lebih relevan bagi Anda dan minat Anda. Mereka juga digunakan untuk membatasi berapa kali Anda melihat iklan serta membantu mengukur efektivitas kampanye iklan.</li>
						</ul>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">3. Cookie Pihak Ketiga</h2>
						<p>Dalam beberapa kasus khusus, kami juga menggunakan cookie yang disediakan oleh pihak ketiga yang tepercaya. Bagian berikut merinci cookie pihak ketiga mana yang mungkin Anda temui melalui situs ini.</p>
						<ul style="list-style-type: disc; padding-left: 1.5rem; margin-bottom: 2rem; space-y: 0.5rem;">
							<li style="margin-bottom: 0.5rem;">Situs ini menggunakan <strong>Google Analytics</strong> yang merupakan salah satu solusi analitik paling tersebar luas dan tepercaya di web untuk membantu kami memahami bagaimana Anda menggunakan situs ini dan cara kami dapat meningkatkan pengalaman Anda.</li>
							<li style="margin-bottom: 0.5rem;">Layanan <strong>Google AdSense</strong> yang kami gunakan untuk menayangkan iklan menggunakan cookie DoubleClick untuk menayangkan iklan yang lebih relevan di seluruh web dan membatasi frekuensi penayangan iklan tertentu kepada Anda.</li>
							<li style="margin-bottom: 0.5rem;">Kami juga menggunakan tombol dan/atau plugin media sosial (Facebook, Twitter, dll) di situs ini yang memungkinkan Anda terhubung dengan jejaring sosial Anda. Agar ini berfungsi, situs media sosial tersebut akan mengatur cookie melalui situs kami.</li>
						</ul>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">4. Menonaktifkan Cookie</h2>
						<p>Anda dapat mencegah pengaturan cookie dengan menyesuaikan pengaturan di browser Anda (lihat Bantuan browser Anda untuk cara melakukannya). Sadarilah bahwa menonaktifkan cookie akan memengaruhi fungsionalitas situs ini dan banyak situs web lain yang Anda kunjungi. Oleh karena itu, disarankan agar Anda tidak menonaktifkan cookie.</p>

						<h2 style="margin-top: 2rem; margin-bottom: 1rem;">5. Informasi Lebih Lanjut</h2>
						<p style="margin-bottom: 2.5rem;">Semoga hal ini mengklarifikasi hal-hal untuk Anda. Jika ada sesuatu yang Anda tidak yakin apakah Anda butuhkan atau tidak, biasanya lebih aman untuk membiarkan cookie tetap aktif. Untuk informasi lebih umum tentang cookie, silakan baca artikel mengenai "HTTP Cookies".</p>

						<!-- Hubungi Kami -->
						<div style="margin-top: 2rem; background: #f5f5f5; border-radius: 1rem; padding: 2rem; text-align: center;">
							<h3 style="font-size: 1.5rem; font-weight: 900; margin-bottom: 1rem; margin-top: 0;">Masih Punya Pertanyaan?</h3>
							<p style="color: var(--paijo-muted); margin-bottom: 1.5rem;">Jika Anda masih mencari informasi lebih lanjut mengenai Kebijakan Cookie kami, Anda dapat menghubungi kami.</p>
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
