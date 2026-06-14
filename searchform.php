<?php
/**
 * Custom Search Form Template
 *
 * @package Paijo
 */
?>
<form role="search" method="get" class="w-full max-w-2xl mx-auto" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="relative flex items-center w-full">
		<!-- Search Icon inside Input -->
		<div class="absolute left-4 text-paijo-muted pointer-events-none flex items-center justify-center">
			<svg class="w-5 h-5 stroke-current fill-none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<circle cx="11" cy="11" r="8"></circle>
				<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
			</svg>
		</div>
		
		<!-- Input Field -->
		<input type="search" 
			   class="w-full bg-paijo-card border border-paijo-line rounded-full pl-12 pr-28 py-3 text-sm text-paijo-ink placeholder-paijo-muted/65 focus:outline-none focus:border-paijo-accent focus:ring-1 focus:ring-paijo-accent transition-all duration-200" 
			   placeholder="<?php echo esc_attr_x( 'Cari artikel...', 'placeholder', 'paijo' ); ?>" 
			   value="<?php echo get_search_query(); ?>" 
			   name="s" />

		<!-- Submit Button -->
		<button type="submit" 
				class="absolute right-0 top-0 bottom-0 px-6 rounded-r-full bg-[#f1818f] hover:bg-[#e06f7d] active:scale-95 text-white text-xs font-black uppercase tracking-wider transition-all duration-150 cursor-pointer">
			<?php esc_html_e( 'Cari', 'paijo' ); ?>
		</button>
	</div>
</form>
