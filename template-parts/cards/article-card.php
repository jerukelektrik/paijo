<?php
/**
 * Article card.
 *
 * @package Paijo
 */

$thumbnail = paijo_get_thumbnail_url( get_the_ID(), 'paijo-card' );
?>

<article <?php post_class( 'paijo-card group flex h-full flex-col' ); ?>>
	<a class="block aspect-[4/3] overflow-hidden bg-paijo-ink" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php if ( $thumbnail ) : ?>
			<img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="<?php echo esc_url( $thumbnail ); ?>" alt="">
		<?php else : ?>
			<div class="flex h-full w-full items-center justify-center p-8 text-center text-sm font-black uppercase tracking-[0.18em] text-white">
				<?php echo esc_html( paijo_get_category_label() ); ?>
			</div>
		<?php endif; ?>
	</a>
	<div class="flex flex-1 flex-col p-5">
		<p class="paijo-eyebrow"><?php echo esc_html( paijo_get_category_label() ); ?></p>
		<h2 class="mt-3 text-2xl font-black leading-tight">
			<a class="hover:text-paijo-accent" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<p class="mt-4 text-sm leading-6 text-paijo-muted"><?php echo esc_html( paijo_get_card_excerpt() ); ?></p>
		<div class="mt-auto flex items-center justify-between pt-6 text-xs font-bold uppercase tracking-[0.12em] text-paijo-muted">
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<span><?php echo esc_html( paijo_get_reading_time() ); ?></span>
		</div>
	</div>
</article>
