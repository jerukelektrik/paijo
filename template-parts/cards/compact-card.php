<?php
/**
 * Compact card.
 *
 * @package Paijo
 */

$thumbnail = paijo_get_thumbnail_url( get_the_ID(), 'paijo-square' );
?>

<article <?php post_class( 'paijo-card group grid grid-cols-[112px_1fr] gap-4 p-3' ); ?>>
	<a class="block aspect-square overflow-hidden bg-paijo-ink" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php if ( $thumbnail ) : ?>
			<img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="<?php echo esc_url( $thumbnail ); ?>" alt="">
		<?php else : ?>
			<div class="flex h-full w-full items-center justify-center p-3 text-center text-xs font-black uppercase tracking-[0.14em] text-white">
				<?php echo esc_html( paijo_get_category_label() ); ?>
			</div>
		<?php endif; ?>
	</a>
	<div class="flex min-w-0 flex-col justify-between">
		<p class="paijo-eyebrow"><?php echo esc_html( paijo_get_category_label() ); ?></p>
		<h3 class="mt-2 line-clamp-3 text-base font-black leading-tight">
			<a class="hover:text-paijo-accent" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<time class="mt-3 text-xs font-semibold text-paijo-muted" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
	</div>
</article>
