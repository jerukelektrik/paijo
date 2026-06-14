<?php
/**
 * Document footer.
 *
 * @package Paijo
 */

get_template_part( 'template-parts/footer/site-footer' );
?>

<!-- Floating Theme Toggle (Sidebar Body) -->
<button type="button" 
		class="fixed right-4 top-1/2 -translate-y-1/2 z-50 w-12 h-12 rounded-full bg-white dark:bg-neutral-900 border border-[#f1818f]/30 dark:border-neutral-800 shadow-xl flex items-center justify-center text-[#f1818f] dark:text-white cursor-pointer hover:scale-105 active:scale-95 transition-all duration-200" 
		data-paijo-theme-toggle 
		aria-label="<?php esc_attr_e( 'Toggle Theme', 'paijo' ); ?>">
	<!-- Sun icon (shows in dark mode) -->
	<svg class="hidden dark:block h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
		<circle cx="12" cy="12" r="5"></circle>
		<line x1="12" y1="1" x2="12" y2="3"></line>
		<line x1="12" y1="21" x2="12" y2="23"></line>
		<line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
		<line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
		<line x1="1" y1="12" x2="3" y2="12"></line>
		<line x1="21" y1="12" x2="23" y2="12"></line>
		<line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
		<line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
	</svg>
	<!-- Moon icon (shows in light mode) -->
	<svg class="block dark:hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
		<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
	</svg>
</button>

<?php
wp_footer();
?>
</body>
</html>
