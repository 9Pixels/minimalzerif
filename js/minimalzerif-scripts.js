/**
 *	jQuery Ready
 */
jQuery( document ).ready( function($) {

	var topNavigationHeight = $( '.top-navigation' ).height();
	var containerNavHeight = $( '.top-navigation .container' ).height();
	var buttonMenuHeight = $( '.top-navigation .container .hambuger-menu' ).height();

	$( window ).scroll( function() {
		var scrollTop = $( window ).scrollTop();
		if( scrollTop >= topNavigationHeight ) {
			$( '.top-navigation' ).addClass( 'fixed-navigation' );
		} else {
			$( '.top-navigation' ).removeClass( 'fixed-navigation' );
		}
	});

	$( '.top-navigation .container .hambuger-menu' ).click( function() {
		$( '.top-navigation .container .header-menu' ).toggleClass( 'open' );
	});

	$( '.top-navigation .container .hambuger-menu' ).css( 'margin-top', ( containerNavHeight - buttonMenuHeight ) / 2 );

});