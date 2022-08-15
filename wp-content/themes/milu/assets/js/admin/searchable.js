/**
 *  Searchable dropdown
 */
 /* global MiluAdminParams */
;( function( $ ) {

	'use strict';

	$( '.milu-searchable' ).chosen( {
		no_results_text: MiluAdminParams.noResult,
		width: '100%'
	} );

	$( document ).on( 'hover', '#menu-to-edit .pending', function() {
		if ( ! $( this ).find( '.chosen-container' ).length && $( this ).find( '.milu-searchable' ).length ) {
			$( this ).find( '.milu-searchable' ).chosen( {
				no_results_text: MiluAdminParams.noResult,
				width: '100%'
			} );
		}
	} );

} )( jQuery );