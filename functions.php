<?php

/**
 *	Require Once
 */
require_once( 'includes/customizer.php' );

/**
 *	Define
 */
define( 'GET_CHILDTHEME_DIRECTORY_URI', get_stylesheet_directory_uri() );

/**
 *	Theme Setup
 */
if( !function_exists( 'minimalzerif_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'minimalzerif_theme_setup' );
	function minimalzerif_theme_setup() {
		load_theme_textdomain( 'minimalzerif', get_template_directory() . '/languages' );
	}
}

/**
 *	WP Enqueue Styles
 */
if( !function_exists( 'minimalzerif_enqueue_styles' ) ) {
	add_action( 'wp_enqueue_scripts', 'minimalzerif_enqueue_styles' );
	function minimalzerif_enqueue_styles() {
		// Google Fonts
		$google_fonts_args = array(
			'family'	=> 'Roboto:700'
		);

		// WP Register Style
		wp_register_style( 'google-fonts', add_query_arg( $google_fonts_args, "//fonts.googleapis.com/css" ), array(), null );

		// WP Enqueue Style
        wp_enqueue_style( 'minimalzerif-style', GET_CHILDTHEME_DIRECTORY_URI . '/style.css', array( 'zerif_style' ), '1.0.0', 'all' );
        wp_enqueue_style( 'zerif_style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'google-fonts' );
	}
}