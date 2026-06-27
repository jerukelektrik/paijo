<?php
/**
 * Template Name: Pedoman Media Siber
 *
 * Template halaman Pedoman Media Siber berdasarkan panduan Dewan Pers.
 * Jika konten editor WordPress dikosongkan, template ini akan menampilkan
 * konten default yang lengkap secara otomatis.
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
						Pedoman Jurnalistik
					</span>
					<h1 class="text-4xl md:text-5xl font-sans font-black tracking-tight text-paijo-ink mb-4">
						<?php 
						$title = get_the_title();
						echo esc_html( $title ? $title : 'Pedoman Media Siber' ); 
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
						<div style="background: rgba(241,129,143,0.05); border-left: 4px solid #f1818f; border-radius: 0 0.75rem 0.75rem 0; padding: 1.5rem; margin-bottom: 1rem;">
							<p style="font-size: 1rem; line-height: 1.75; margin: 0; font-family: 'PT Serif', Georgia, serif;">
								Kemerdekaan berpendapat, kemerdekaan berekspresi, dan kemerdekaan pers adalah hak asasi manusia yang dilindungi Pancasila, Undang-Undang Dasar 1945, dan Deklarasi Universal Hak Asasi Manusia PBB. Keberadaan media siber di Indonesia juga merupakan bagian dari kemerdekaan berpendapat, kemerdekaan berekspresi, dan kemerdekaan pers. Media siber memiliki karakter khusus sehingga memerlukan pedoman agar pengelolaannya dapat dilaksanakan secara profesional, memenuhi fungsi, hak, dan kewajibannya sesuai Undang-Undang Nomor 40 Tahun 1999 tentang Pers dan Kode Etik Jurnalistik. Untuk itu Dewan Pers bersama organisasi pers, pengelola media siber, dan masyarakat menyusun Pedoman Pemberitaan Media Siber sebagai berikut:
							</p>
						</div>

						<!-- 1. Ruang Lingkup -->
						<h2 style="margin-top: 0.5rem; margin-bottom: 0.75rem;">1. Ruang Lingkup</h2>
						<ol style="list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.5rem; space-y: 0.5rem;">
							<li>Media Siber adalah segala bentuk media yang menggunakan wahana internet dan melaksanakan kegiatan jurnalistik, serta memenuhi persyaratan Undang-Undang Pers dan Standar Perusahaan Pers yang ditetapkan Dewan Pers.</li>
							<li><strong><?php echo esc_html( $site_name ); ?></strong> sebagai media siber tunduk pada Undang-Undang Nomor 40 Tahun 1999 tentang Pers dan Kode Etik Jurnalistik yang dibuat oleh Dewan Pers.</li>
							<li>Pedoman ini secara spesifik mengatur hal-hal baru yang terkait dengan pemberitaan di media siber yang belum diatur dalam ketentuan yang ada.</li>
						</ol>

						<!-- 2. Verifikasi dan keberimbangan berita -->
						<h2 style="margin-top: 2rem; margin-bottom: 0.75rem;">2. Verifikasi dan Keberimbangan Berita</h2>
						<ol style="list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.5rem; space-y: 0.5rem;">
							<li>Pada prinsipnya setiap berita harus melalui verifikasi.</li>
							<li>Berita yang dapat merugikan pihak lain memerlukan verifikasi pada berita yang sama untuk memenuhi prinsip akurasi dan keberimbangan.</li>
							<li>Ketentuan dalam butir (a) di atas dikecualikan, dengan syarat:
								<ol style="list-style-type: lower-alpha; padding-left: 1.5rem; margin-top: 0.5rem; space-y: 0.5rem;">
									<li>Berita benar-benar mengandung kepentingan publik yang bersifat mendesak;</li>
									<li>Sumber berita yang pertama adalah sumber yang jelas disebutkan identitasnya, kredibel dan kompeten;</li>
									<li>Subyek berita yang harus dikonfirmasi tidak diketahui keberadaannya dan atau tidak dapat diwawancarai;</li>
									<li>Media memberikan penjelasan kepada pembaca bahwa berita tersebut masih memerlukan verifikasi lebih lanjut yang diupayakan dalam waktu secepatnya. Penjelasan dimuat pada bagian akhir dari berita yang sama, di dalam kurung dan menggunakan huruf miring.</li>
								</ol>
							</li>
							<li>Setelah memuat berita sesuai dengan butir (c), media wajib meneruskan upaya verifikasi, dan setelah verifikasi didapatkan, hasil verifikasi dicantumkan pada berita pemutakhiran (update) dengan tautan pada berita yang belum terverifikasi.</li>
						</ol>

						<!-- 3. Isi Buatan Pengguna (UGC) -->
						<h2 style="margin-top: 2rem; margin-bottom: 0.75rem;">3. Isi Buatan Pengguna (User Generated Content)</h2>
						<ol style="list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.5rem; space-y: 0.5rem;">
							<li><strong><?php echo esc_html( $site_name ); ?></strong> mencantumkan syarat dan ketentuan mengenai Isi Buatan Pengguna yang tidak bertentangan dengan Undang-Undang No. 40 tahun 1999 tentang Pers dan Kode Etik Jurnalistik, yang ditempatkan secara terang dan jelas.</li>
							<li><strong><?php echo esc_html( $site_name ); ?></strong> mewajibkan setiap pengguna untuk mendaftar dan melakukan log-in terlebih dahulu untuk dapat mempublikasikan semua bentuk Isi Buatan Pengguna.</li>
							<li>Dalam ketentuan mengenai log-in, <strong><?php echo esc_html( $site_name ); ?></strong> mewajibkan pengguna memberi persetujuan tertulis bahwa Isi Buatan Pengguna yang dipublikasikan tidak memuat unsur bohong, fitnah, sadis dan cabul; atau tidak mengandung isi yang menyinggung sentimen suku, agama, ras, dan antar golongan (SARA).</li>
							<li><strong><?php echo esc_html( $site_name ); ?></strong> berhak mengedit atau menghapus Isi Buatan Pengguna yang pelaporannya menyalahi ketentuan pada poin (c).</li>
							<li><strong><?php echo esc_html( $site_name ); ?></strong> menyediakan mekanisme pengaduan jika ada pelanggaran atas Isi Buatan Pengguna di atas. Mekanisme tersebut disediakan secara mencolok, sehingga mudah diakses pengguna.</li>
							<li>Pengaduan harus diselesaikan dalam waktu 2x24 jam sejak pengaduan diterima.</li>
						</ol>

						<!-- 4. Ralat, Koreksi, dan Hak Jawab -->
						<h2 style="margin-top: 2rem; margin-bottom: 0.75rem;">4. Ralat, Koreksi, dan Hak Jawab</h2>
						<ol style="list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.5rem; space-y: 0.5rem;">
							<li>Ralat, koreksi, dan hak jawab mengacu pada Undang-Undang Pers, Kode Etik Jurnalistik, dan Pedoman Hak Jawab yang ditetapkan Dewan Pers.</li>
							<li>Ralat, koreksi dan atau hak jawab wajib ditautkan pada berita yang diralat, dikoreksi atau yang diberi hak jawab.</li>
							<li>Di setiap berita ralat, koreksi, dan hak jawab wajib dicantumkan waktu pemuatan ralat, koreksi, dan atau hak jawab tersebut.</li>
							<li>Bila suatu berita media siber tertentu disebarluaskan media siber lain, maka tanggung jawab koreksi dan ralat ada pada media yang pertama kali mempublikasikan. Media penerus diwajibkan untuk ikut meralat dan membuat koreksi sesuai dengan yang diterbitkan.</li>
							<li>Hak jawab atau ralat dapat dikirimkan ke <a href="mailto:<?php echo esc_attr( $admin_email ); ?>" style="color: #f1818f; font-weight: bold;"><?php echo esc_html( $admin_email ); ?></a>.</li>
						</ol>

						<!-- 5. Pencabutan Berita -->
						<h2 style="margin-top: 2rem; margin-bottom: 0.75rem;">5. Pencabutan Berita</h2>
						<ol style="list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.5rem; space-y: 0.5rem;">
							<li>Berita yang sudah dipublikasikan tidak dapat dicabut karena alasan penyensoran dari pihak luar redaksi, kecuali terkait masalah SARA, kesusilaan, masa depan anak, pengalaman traumatis korban, atau atas pertimbangan khusus lainnya sesuai Kode Etik Jurnalistik.</li>
							<li>Setiap pencabutan berita wajib disertai dengan alasan pencabutan dan diumumkan kepada publik.</li>
						</ol>

						<!-- 6. Iklan -->
						<h2 style="margin-top: 2rem; margin-bottom: 0.75rem;">6. Iklan</h2>
						<ol style="list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.5rem; space-y: 0.5rem;">
							<li><strong><?php echo esc_html( $site_name ); ?></strong> wajib membedakan dengan tegas antara produk berita dan iklan.</li>
							<li>Setiap berita/artikel/isi yang merupakan iklan dan/atau isi berbayar wajib mencantumkan keterangan <em>'advertorial'</em>, <em>'iklan'</em>, <em>'ads'</em>, <em>'sponsored'</em>, atau kata lain yang menjelaskan bahwa isi tersebut adalah iklan.</li>
						</ol>

						<!-- 7. Hak Cipta -->

						<!-- 9. Sengketa -->
						<h2>9. Penyelesaian Sengketa</h2>
						<ol style="list-style-type: decimal; padding-left: 1.5rem;">
							<li>Penilaian akhir atas sengketa tentang pelaksanaan Pedoman Media Siber ini diselesaikan oleh <strong>Dewan Pers</strong>.</li>
							<li>Pembaca yang merasa dirugikan oleh pemberitaan <strong><?php echo esc_html( $site_name ); ?></strong> dapat mengajukan pengaduan kepada Dewan Pers sesuai mekanisme yang berlaku.</li>
						</ol>

						<!-- Referensi -->
						<div style="margin-top: 2.5rem; padding-top: 1rem; border-top: 1px solid var(--paijo-line);">
							<h3 style="margin-top: 0;">Referensi</h3>
							<ul style="list-style-type: disc; padding-left: 1.5rem; color: var(--paijo-muted); font-size: 0.875rem;">
								<li>Undang-Undang Nomor 40 Tahun 1999 tentang Pers</li>
								<li>Kode Etik Jurnalistik — Dewan Pers</li>
								<li>Pedoman Pemberitaan Media Siber — Dewan Pers</li>
								<li>Pedoman Hak Jawab — Dewan Pers</li>
							</ul>
						</div>

						<!-- Hubungi Kami -->
						<div style="margin-top: 2rem; background: #f5f5f5; border-radius: 1rem; padding: 1.5rem; text-align: center;">
							<h3 style="font-size: 1.25rem; font-weight: 900; margin-bottom: 0.5rem; margin-top: 0;">Ada Pertanyaan atau Pengaduan?</h3>
							<p style="color: var(--paijo-muted); margin-bottom: 1rem;">Jika Anda memiliki pertanyaan tentang Pedoman Media Siber kami atau ingin mengajukan hak jawab, silakan hubungi redaksi melalui email:</p>
							<a href="mailto:<?php echo esc_attr( $admin_email ); ?>" style="display: inline-block; background: #f1818f; color: white; font-weight: bold; padding: 0.75rem 1.5rem; border-radius: 9999px; text-decoration: none;">
								<?php echo esc_html( $admin_email ); ?>
							</a>
						</div>

					<?php endif; ?>

				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
