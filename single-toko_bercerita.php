<?php
/**
 * Single Toko Bercerita CPT template.
 *
 * @package Paijo
 */

get_header();
?>

<main id="main-content" class="paijo-section bg-neutral-50 dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 transition-colors duration-300 min-h-screen">
	<div class="paijo-container max-w-5xl mx-auto py-6">
		<?php
		while ( have_posts() ) :
			the_post();
			$embed_url = get_post_meta( get_the_ID(), '_paijo_toko_embed_url', true );
			
			// Use the custom logo asset requested by the user
			$logo_url = esc_url( PAIJO_URI . '/assets/images/instagram-logo.jpg' );

			// Get current user details for comments
			if ( is_user_logged_in() ) {
				$current_user = wp_get_current_user();
				$user_avatar = get_avatar_url( $current_user->ID, array( 'size' => 32 ) );
				$user_initial = strtoupper( substr( $current_user->display_name, 0, 1 ) );
			} else {
				$user_avatar = '';
				$user_initial = 'G';
			}
			?>
			
			<!-- Split Screen Container (Kumparan Style Layout) -->
			<div class="flex flex-col md:flex-row w-full max-w-[1000px] mx-auto bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 md:h-[720px] rounded-3xl overflow-hidden shadow-xl mb-12">
				<!-- Left Column: Video Player with absolute overlay logos -->
				<div class="w-full md:w-[480px] h-[600px] md:h-full bg-neutral-100 dark:bg-neutral-950 flex items-center justify-center relative shrink-0 border-b md:border-b-0 md:border-r border-neutral-200 dark:border-neutral-800">

					<!-- Thumbnail Image Wrapper -->
					<div class="w-full h-full flex items-center justify-center p-3">
						<?php if ( $embed_url ) : ?>
							<a href="<?php echo esc_url( $embed_url ); ?>" target="_blank" class="group relative w-full h-full max-h-[660px] rounded-2xl overflow-hidden bg-neutral-900 flex items-center justify-center shadow-md">
								<?php
								$thumbnail_url = paijo_get_social_thumbnail_url( $embed_url, get_the_ID() );
								if ( $thumbnail_url ) :
									?>
									<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
								<?php else : ?>
									<div class="text-center p-6 text-neutral-400 font-sans">
										<svg class="w-12 h-12 mx-auto stroke-current fill-none mb-3 opacity-60" viewBox="0 0 24 24" stroke-width="1.5">
											<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
											<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
											<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
										</svg>
										<span class="text-xs font-bold uppercase tracking-wider block"><?php esc_html_e( 'No Preview Available', 'paijo' ); ?></span>
									</div>
								<?php endif; ?>
								
								<!-- Play Overlay Button -->
								<div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
									<div class="w-16 h-16 rounded-full bg-black/60 backdrop-blur-sm flex items-center justify-center text-white scale-95 group-hover:scale-100 group-hover:bg-[#f1818f] transition-all duration-300 shadow-md">
										<!-- Play SVG Icon -->
										<svg class="w-6 h-6 fill-current translate-x-0.5" viewBox="0 0 24 24">
											<path d="M8 5v14l11-7z"/>
										</svg>
									</div>
								</div>
							</a>
						<?php else : ?>
							<div class="text-center py-20 text-neutral-500 font-sans">
								<svg class="w-12 h-12 mx-auto stroke-current fill-none mb-4 opacity-40" viewBox="0 0 24 24" stroke-width="1.5">
									<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
									<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
									<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
								</svg>
								<span class="text-xs font-bold uppercase tracking-wider block"><?php esc_html_e( 'Tidak Ada Video Embed', 'paijo' ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Right Column: Sidebar (Kumparan Style Layout) -->
				<div class="flex-1 bg-white dark:bg-neutral-900 flex flex-col h-[600px] md:h-full overflow-hidden border-t md:border-t-0 border-neutral-200 dark:border-neutral-800">
					<!-- Top Profile Bar -->
					<div class="p-5 border-b border-neutral-200 dark:border-neutral-800/80 flex items-center shrink-0">
						<div class="flex items-center gap-3">
							<div class="relative w-10 h-10 rounded-full p-[2px] bg-gradient-to-tr from-yellow-500 via-pink-500 to-purple-600 flex items-center justify-center shrink-0">
								<div class="w-full h-full rounded-full border border-black bg-neutral-900 flex items-center justify-center overflow-hidden">
									<?php if ( $logo_url ) : ?>
										<img class="w-full h-full object-cover" src="<?php echo esc_url( $logo_url ); ?>" alt="pandanganjogja">
									<?php else : ?>
										<span class="font-sans font-black text-xs text-white">P</span>
									<?php endif; ?>
								</div>
							</div>
							<div class="flex flex-col">
								<div class="flex items-center gap-1">
									<span class="font-sans font-bold text-sm text-neutral-900 dark:text-white">pandanganjogja</span>
									<!-- verified check -->
									<svg class="w-3.5 h-3.5 text-[#0095f6] fill-current" viewBox="0 0 24 24">
										<path d="M12.003 2.001c-5.522 0-9.998 4.477-9.998 10s4.476 10 9.998 10 10-4.477 10-10-4.478-10-10-10zm4.505 7.793l-5.637 5.637a.579.579 0 01-.82 0l-2.818-2.819a.579.579 0 010-.82l.82-.82a.579.579 0 01.82 0l1.588 1.58 4.407-4.407a.579.579 0 01.82 0l.82.82a.579.579 0 010 .829z"/>
									</svg>
								</div>
								<span class="text-[10px] text-neutral-500 dark:text-neutral-400 font-sans">
									<?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ); ?> yang lalu
								</span>
							</div>
						</div>
					</div>

					<!-- Scrollable Content: Title + CMS Caption + Comments -->
					<div class="flex-1 overflow-y-auto p-6 space-y-6 scrollbar-none" id="sidebar-scroll-content">
						<!-- Post Title & Content/Caption -->
						<div class="font-sans">
							<h1 class="text-xl sm:text-2xl font-bold leading-snug tracking-tight text-neutral-900 dark:text-white mb-4">
								<?php the_title(); ?>
							</h1>
							<div class="prose prose-neutral dark:prose-invert max-w-none text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed font-sans [&>p]:mb-4">
								<?php the_content(); ?>
							</div>
						</div>

						<!-- Horizontal Separator -->
						<div class="border-t border-neutral-100 dark:border-neutral-800/60 my-2"></div>

						<!-- Comments Section Area -->
						<div class="space-y-4">
							<h3 class="text-xs font-bold uppercase tracking-wider text-neutral-400 dark:text-neutral-500 mb-2">Komentar</h3>
							<?php
							$comments = get_comments(
								array(
									'post_id' => get_the_ID(),
									'status'  => 'approve',
									'order'   => 'ASC',
								)
							);

							if ( empty( $comments ) ) :
								?>
								<div class="text-center py-8 text-neutral-400 dark:text-neutral-500 text-xs font-sans">
									<?php esc_html_e( 'Belum ada komentar. Mulai obrolan!', 'paijo' ); ?>
								</div>
							<?php
							else :
								foreach ( $comments as $comment ) :
									$avatar_url = get_avatar_url( $comment->comment_author_email, array( 'size' => 32 ) );
									?>
									<div class="flex gap-3">
										<?php if ( $avatar_url ) : ?>
											<img class="w-8 h-8 rounded-full bg-neutral-100 dark:bg-neutral-800 shrink-0 object-cover" src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $comment->comment_author ); ?>">
										<?php else : ?>
											<div class="w-8 h-8 rounded-full bg-neutral-100 dark:bg-neutral-850 flex items-center justify-center shrink-0 font-sans text-[10px] font-bold text-neutral-500 dark:text-neutral-400">
												<?php echo esc_html( strtoupper( substr( $comment->comment_author, 0, 1 ) ) ); ?>
											</div>
										<?php endif; ?>
										
										<div class="flex-1 flex flex-col">
											<div>
												<span class="font-sans font-bold text-xs mr-1 text-neutral-900 dark:text-white"><?php echo esc_html( $comment->comment_author ); ?></span>
												<span class="text-xs text-neutral-600 dark:text-neutral-300 font-sans leading-relaxed"><?php echo esc_html( $comment->comment_content ); ?></span>
											</div>
											<span class="text-[9px] text-neutral-400 dark:text-neutral-500 mt-1"><?php echo esc_html( human_time_diff( strtotime( $comment->comment_date ), current_time('timestamp') ) ); ?> yang lalu</span>
										</div>
									</div>
								<?php
								endforeach;
							endif;
							?>
						</div>
					</div>

					<!-- Bottom Comment Input Form -->
					<div class="p-4 border-t border-neutral-200 dark:border-neutral-800/80 bg-white dark:bg-neutral-900 shrink-0">
						<form id="comment-form" action="<?php echo esc_url( site_url( '/wp-comments-post.php' ) ); ?>" method="post" class="flex items-center gap-3">
							<input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" id="comment_post_ID" />
							
							<div class="flex-1 bg-neutral-50 dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded-xl px-4 py-3 flex flex-col gap-2">
								<input type="text" name="comment" id="comment-input" placeholder="Tulis komentar..." class="w-full bg-transparent border-0 outline-none text-sm text-neutral-900 dark:text-neutral-100 placeholder-neutral-400" required />
								
								<?php if ( ! is_user_logged_in() ) : ?>
									<!-- Slide-down guest input fields on focus -->
									<div id="guest-fields" class="hidden flex gap-2 pt-2 border-t border-neutral-200/60 dark:border-neutral-800/60">
										<input type="text" name="author" placeholder="Nama" class="w-1/2 bg-transparent border-b border-neutral-200 dark:border-neutral-800 py-1 text-xs text-neutral-900 dark:text-neutral-100 outline-none" required />
										<input type="email" name="email" placeholder="Email" class="w-1/2 bg-transparent border-b border-neutral-200 dark:border-neutral-800 py-1 text-xs text-neutral-900 dark:text-neutral-100 outline-none" required />
									</div>
								<?php endif; ?>
							</div>
							
							<button type="submit" class="w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-950 hover:bg-[#f1818f] hover:text-white text-neutral-600 dark:text-neutral-400 transition-colors flex items-center justify-center shrink-0 shadow-sm cursor-pointer">
								<!-- Paper Plane SVG Icon -->
								<svg class="w-5 h-5 fill-current translate-x-0.5" viewBox="0 0 24 24">
									<path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
								</svg>
							</button>
						</form>
					</div>
				</div>
			</div>
			
			<script>
			document.addEventListener('DOMContentLoaded', function() {
				const commentInput = document.getElementById('comment-input');
				const guestFields = document.getElementById('guest-fields');
				
				// Guest fields slide down on comment focus
				if (commentInput && guestFields) {
					commentInput.addEventListener('focus', function() {
						guestFields.classList.remove('hidden');
					});
				}
			});
			</script>

			<!-- Related posts from CPT -->
			<?php
			$related = new WP_Query(
				array(
					'post_type'           => 'toko_bercerita',
					'post_status'         => 'publish',
					'posts_per_page'      => 3,
					'post__not_in'        => array( get_the_ID() ),
					'ignore_sticky_posts' => true,
				)
			);

			if ( $related->have_posts() ) :
				?>
				<div class="mt-8 border-t border-neutral-200 dark:border-neutral-800 pt-8">
					<h2 class="text-xs font-sans font-bold text-neutral-400 dark:text-neutral-500 mb-6 uppercase tracking-widest">
						More posts from <span class="text-neutral-900 dark:text-white font-extrabold">pandanganjogja</span>
					</h2>
					
					<div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
						<?php
						while ( $related->have_posts() ) :
							$related->the_post();
							$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
							?>
							<a href="<?php the_permalink(); ?>" class="group relative block aspect-[4/3] sm:aspect-square overflow-hidden bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-xl hover:scale-[1.02] transition-all duration-300">
								<?php if ( $thumb_url ) : ?>
									<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
								<?php else : ?>
									<div class="w-full h-full flex flex-col items-center justify-center p-4 bg-neutral-50 dark:bg-neutral-950 text-center text-neutral-500 font-sans">
										<span class="text-[10px] font-bold uppercase tracking-wider line-clamp-2 px-2 mb-2"><?php the_title(); ?></span>
									</div>
								<?php endif; ?>
								
								<!-- Play Icon Overlay in bottom-right -->
								<div class="absolute right-3 bottom-3 sm:right-4 sm:bottom-4 bg-black/60 backdrop-blur-sm p-2 rounded-lg text-white group-hover:bg-[#f1818f] transition-colors duration-300 flex items-center justify-center">
									<svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
										<path d="M8 5v14l11-7z"/>
									</svg>
								</div>
							</a>
						<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
			<?php endif; ?>

		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
