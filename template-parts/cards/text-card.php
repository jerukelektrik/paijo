<?php
/**
 * Text card and empty state.
 *
 * @package Paijo
 */

$title = isset( $args['title'] ) ? $args['title'] : __( 'Nothing here yet', 'paijo' );
$body  = isset( $args['body'] ) ? $args['body'] : __( 'Publish a post to start filling this section.', 'paijo' );
?>

<div class="border border-dashed border-paijo-line bg-paijo-card p-8 text-center">
	<h2 class="text-2xl font-black text-paijo-ink"><?php echo esc_html( $title ); ?></h2>
	<p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-paijo-muted"><?php echo esc_html( $body ); ?></p>
</div>
