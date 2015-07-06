<?php
/**
 *	Customizer
 */
if( !function_exists( 'minimalzerif_customizer' ) ) {
	add_action( 'customize_register', 'minimalzerif_customizer', 50 );
	function minimalzerif_customizer( $wp_customize ) {
		// Remove Panel
		$wp_customize->remove_panel( 'panel_about' );
		$wp_customize->remove_panel( 'panel_ribbons' );

		// Remove Section
		$wp_customize->remove_section( 'zerif_latestnews_section' );
		$wp_customize->remove_section( 'zerif_general_footer_section' );
	}
}
?>