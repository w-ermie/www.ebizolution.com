/**
 *  Reset theme mods button
 */
 /* global MiluAdminParams,
 confirm, console */
;( function( $ ) {

	'use strict';

	var $container = $( '#customize-header-actions' ),
		$button = $( '<button id="milu-mods-reset" class="button-secondary button">' )
		.text( MiluAdminParams.resetModsText )
		.css( {
		'float': 'right',
		'margin-right': '10px',
		'margin-left': '10px'
	} );

	$button.on( 'click', function ( event ) {

		event.preventDefault();

		var r = confirm( MiluAdminParams.confirm ),
			data = {
				wp_customize: 'on',
				action: 'milu_ajax_customizer_reset',
				nonce: MiluAdminParams.nonce.reset
			};

		if ( ! r ) {
			return;
		}

		$button.attr( 'disabled', 'disabled' );

		$.post( MiluAdminParams.ajaxUrl, data, function ( response ) {

			if ( 'OK' === response ) {
				wp.customize.state( 'saved' ).set( true );
				location.reload();
			} else {
				$button.removeAttr( 'disabled' );
				console.log( response );
			}
		} );
	} );

	$button.insertAfter( $container.find( '.button-primary.save' ) );
} )( jQuery );