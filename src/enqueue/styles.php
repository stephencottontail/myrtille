<?php
/**
 * This file was automatically generated by Genesis Pro Tools.
 *
 * @package    Genesis Pro Tools
 * @author     Calvin Koepke <hello@calvinkoepke.com>
 * @version    1.0.0
 * @link       https://genesisprotools.com
 * @since      1.0.0
 */

add_action( 'wp_enqueue_scripts', 'myrtille_load_styles' );
/**
 * Load compiled theme styles.
 *
 * @since 1.0.0
 */
function myrtille_load_styles() {

	wp_enqueue_style( 'myrtille-style', get_stylesheet_uri() );
	wp_enqueue_style( 'myrtille-typekit', 'https://use.typekit.com/pxo8ien.css' );

}
