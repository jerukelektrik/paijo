<?php
/**
 * Theme options.
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'customize_register', 'paijo_customize_register' );
function paijo_customize_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_section(
		'paijo_homepage',
		array(
			'title'       => __( 'Paijo Homepage', 'paijo' ),
			'description' => __( 'Control reusable homepage sections.', 'paijo' ),
			'priority'    => 160,
		)
	);

	$wp_customize->add_setting(
		'paijo_show_category_sections',
		array(
			'default'           => true,
			'sanitize_callback' => 'paijo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'paijo_show_category_sections',
		array(
			'type'    => 'checkbox',
			'section' => 'paijo_homepage',
			'label'   => __( 'Show category sections on homepage', 'paijo' ),
		)
	);

	$category_choices = paijo_get_category_choices();
	for ( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting(
			"paijo_home_category_{$i}",
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			"paijo_home_category_{$i}",
			array(
				'type'        => 'select',
				'section'     => 'paijo_homepage',
				'label'       => sprintf(
					/* translators: %d: category slot number. */
					__( 'Homepage category %d', 'paijo' ),
					$i
				),
				'description' => __( 'Leave blank to let Paijo choose populated categories automatically.', 'paijo' ),
				'choices'     => $category_choices,
			)
		);
	}

	$wp_customize->add_section(
		'paijo_footer',
		array(
			'title'    => __( 'Paijo Footer', 'paijo' ),
			'priority' => 170,
		)
	);

	$wp_customize->add_setting(
		'paijo_footer_text',
		array(
			'default'           => get_bloginfo( 'name' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'paijo_footer_text',
		array(
			'type'    => 'text',
			'section' => 'paijo_footer',
			'label'   => __( 'Footer text', 'paijo' ),
		)
	);

	// Social Media URLs
	$wp_customize->add_section(
		'paijo_social',
		array(
			'title'    => __( 'Paijo Social Media', 'paijo' ),
			'priority' => 175,
		)
	);

	$social_networks = array(
		'facebook'  => __( 'Facebook URL', 'paijo' ),
		'twitter'   => __( 'Twitter URL', 'paijo' ),
		'instagram' => __( 'Instagram URL', 'paijo' ),
		'tiktok'    => __( 'TikTok URL', 'paijo' ),
	);

	foreach ( $social_networks as $network => $label ) {
		$wp_customize->add_setting(
			"paijo_social_{$network}",
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			"paijo_social_{$network}",
			array(
				'type'    => 'url',
				'section' => 'paijo_social',
				'label'   => $label,
			)
		);
	}
}

function paijo_sanitize_checkbox( $checked ): bool {
	return (bool) $checked;
}

function paijo_get_category_choices(): array {
	$choices = array( 0 => __( 'Automatic', 'paijo' ) );
	$terms   = get_categories(
		array(
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);

	foreach ( $terms as $term ) {
		$choices[ (int) $term->term_id ] = $term->name;
	}

	return $choices;
}

add_action( 'customize_register', 'paijo_customize_register_colors' );
function paijo_customize_register_colors( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_section(
		'paijo_colors',
		array(
			'title'    => __( 'Paijo Colors', 'paijo' ),
			'priority' => 150,
		)
	);

	$wp_customize->add_setting(
		'paijo_accent_color',
		array(
			'default'           => '#b3282d',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'paijo_accent_color',
			array(
				'section' => 'paijo_colors',
				'label'   => __( 'Accent color', 'paijo' ),
			)
		)
	);
}

add_action( 'wp_head', 'paijo_render_customizer_css' );
function paijo_render_customizer_css(): void {
	$accent = get_theme_mod( 'paijo_accent_color', '#b3282d' );

	if ( ! sanitize_hex_color( $accent ) ) {
		return;
	}

	printf(
		'<style id="paijo-customizer-css">:root{--color-paijo-accent:%s;}</style>' . "\n",
		esc_html( $accent )
	);
}
