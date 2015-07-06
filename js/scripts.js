/**
 *	jQuery Ready
 */
jQuery(document).ready(function() {

	jQuery( window ).scroll( function() {
		if( ( jQuery( window ).scrollTop() ) > 0 ) {
			jQuery( '#main-nav' ).addClass( 'fix' );
		}
	});

});