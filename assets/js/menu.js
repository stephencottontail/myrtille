/**
 * We don't need the fancy-schmancy menu script that Genesis themes
 * normally use
 *
 * @since 1.0.0
 */

( function ( document, $ ) {
	'use strict';

	var container = $( '.nav-primary' );
	var menu = container.find( 'ul' );

	$( document ).ready( function() {
		if ( menu[0] ) {
			$( menu[0] ).before( $( '<button />', {
				'class' : 'menu-toggle mb-4 w-full lg:hidden',
				'aria-expanded' : false,
				'aria-pressed' : false,
				'aria-haspopup' : true
			} )
				.append( myrtille_responsive_menu.open )
				.on( 'click', function( e ) {
					e.preventDefault();

					container.toggleClass( 'menu-active' );
					_toggleAria( $( this ), 'aria-pressed' );
					_toggleAria( $( this ), 'aria-expanded' );

					if ( 'true' === $( this ).attr( 'aria-expanded' ) ) {
						$( '.menu-toggle' ).html( myrtille_responsive_menu.close );
					} else {
						$( '.menu-toggle' ).html( myrtille_responsive_menu.open );
					}
				} )
			);
		}
	} );

	function _toggleAria( el, attr ) {
		$( el ).attr( attr, function( index, value ) {
			return 'false' === value;
		} );
	}
} )( document, jQuery );
