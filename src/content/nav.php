<?php
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	add_action( 'genesis_before_header', 'genesis_do_nav' );

	/**
	 * This targets the top-level <ul>
	 */
	add_filter( 'wp_nav_menu_args', function( $args ) {
		$args['menu_class'] = "$args[menu_class] list-reset";

		return $args;
	}, 10, 1 );

	add_filter( 'nav_menu_submenu_css_class', function( $classes, $args, $depth ) {
		return array_merge( $classes, array( 'list-reset' ) );
	}, 10, 3 );

	add_filter( 'nav_menu_css_class', function( $classes, $item, $args, $depth ) {
		// This should be any top-level <li>
		if ( 0 == $depth ) {
			return array_merge( $classes, array( 'uppercase', 'mb-4' ) );
		} else {
			// This should cover all other <li>
			return array_merge( $classes, array( 'lowercase mb-0' ) );
		}
	}, 10, 4 );
