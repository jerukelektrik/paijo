<?php
/**
 * Featured card.
 *
 * @package Paijo
 */

$thumbnail = paijo_get_thumbnail_url( get_the_ID(), 'paijo-hero' );
?>

<article <?php post_class( 'group relative min-h-[420px] overflow-hidden rounded-none bg-paijo-ink text-white sm:min-h-[560px]' ); ?>>
	<?php if ( $thumbnail ) : ?>
		<img class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105" src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
		<div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-black/10"></div>
	<?php else : ?>
		<div class="absolute inset-0 bg-paijo-ink"></div>
	<?php endif; ?>

	<div class="relative z-10 flex min-h-[420px] flex-col justify-between p-6 sm:min-h-[560px] sm:p-10">
		<div class="flex items-center justify-between gap-4 text-xs font-black uppercase tracking-[0.18em]">
			<span><?php echo esc_html( paijo_get_category_label() ); ?></span>
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		</div>

		<div class="max-w-3xl">
			<h2 class="text-4xl font-black leading-none tracking-tight sm:text-6xl">
				<a class="hover:text-white/80" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<p class="mt-5 max-w-2xl text-base leading-7 text-white/80"><?php echo esc_html( paijo_get_card_excerpt( get_the_ID(), 28 ) ); ?></p>
		</div>
	</div>
</article>
